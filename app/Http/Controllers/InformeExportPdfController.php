<?php

namespace App\Http\Controllers;

use App\Models\Encuesta;
use App\Models\EncuestaPregunta;
use App\Models\EncuestaRespuesta;
use App\Models\nivel_satisfaccion;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class InformeExportPdfController extends Controller
{

    private function nivelesArray($detalles): array
    {
        return [
            $detalles->where('idNivelSatisfaccion', 1)->count(),
            $detalles->where('idNivelSatisfaccion', 2)->count(),
            $detalles->where('idNivelSatisfaccion', 3)->count(),
            $detalles->where('idNivelSatisfaccion', 4)->count(),
            $detalles->where('idNivelSatisfaccion', 5)->count(),
        ];
    }

    private function bucketEdad(int $edad): string
    {
        return match (true) {
            $edad < 18  => '<18',
            $edad < 30  => '18-29',
            $edad < 45  => '30-44',
            $edad < 60  => '45-59',
            default     => '≥60',
        };
    }

    private function normalizaSexo($valor): ?string
    {
        if ($valor === null) {
            return null;
        }

        $v = strtoupper(trim((string) $valor));

        return match (true) {
            $v === '1' || $v === 'M' || str_starts_with($v, 'MASCULINO') || $v === 'HOMBRE' => 'Masculino',
            $v === '2' || $v === 'F' || str_starts_with($v, 'FEMENINO') || $v === 'MUJER'   => 'Femenino',
            default                                                                       => null,
        };
    }

    private function bucketHora(?string $hhmmss): ?string
    {
        if (!$hhmmss) Return null;

        $h = (int) substr($hhmmss, 0, 2);

        return match (true) {
            $h <  7 => null,
            $h < 10 => '07-10',
            $h < 13 => '10-13',
            $h < 16 => '13-16',
            $h < 19 => '16-19',
            $h < 22 => '19-22',
            default => null,
        };
    }

    public function exportPdf(Encuesta $encuesta)
    {
        set_time_limit(300);

        /* ─── Parámetros de fechas ─── */
        $dateFrom = request('dateFrom');
        $dateTo   = request('dateTo');

        $f1 = $dateFrom ? Carbon::parse($dateFrom)->startOfDay() : null;
        $f2 = $dateTo   ? Carbon::parse($dateTo)->endOfDay()   : null;

        $diferenciaDias = 0;
        if ($f1 && $f2) {
            $diferenciaDias = (int) $f1->diffInDays($f2) + 1;
        }

        if ($diferenciaDias >= 7) {
            $semanas = intdiv($diferenciaDias, 7);
            $diasRestantes = $diferenciaDias % 7;
            $textoPeriodo = $semanas . ' semana' . ($semanas > 1 ? 's' : '');
            if ($diasRestantes > 0) {
                $textoPeriodo .= ' y ' . $diasRestantes . ' día' . ($diasRestantes > 1 ? 's' : '');
            }
        } else {
            $textoPeriodo = $diferenciaDias . ' día' . ($diferenciaDias > 1 ? 's' : '');
        }

        /* ─── Filtro de sexo ─── */
        $sexo = request('sexo', '');

        /* ─── Filtros dinámicos de preguntas ─── */
        // Se reciben codificados en base64+json: qf=base64({"preguntaId":"valor",...})
        $questionFilters = [];
        $qfRaw = request('qf', '');
        if ($qfRaw) {
            $decoded = json_decode(base64_decode($qfRaw), true);
            if (is_array($decoded)) {
                $questionFilters = $decoded;
            }
        }

        /* ─── Preguntas filtrables para la descripción en el PDF ─── */
        $preguntasFiltrables = EncuestaPregunta::where('idEncuesta', $encuesta->id)
            ->where('estadoPregunta', 1)
            ->whereIn('tipoPregunta', ['select', 'nivel_satisfaccion'])
            ->with('opciones')
            ->get()
            ->keyBy('id');

        $nivelesMap = nivel_satisfaccion::where('estadoNivelSatisfaccion', 1)
            ->pluck('nombreNivelSatisfaccion', 'id');

        /* ─── Construir query base con todos los filtros ─── */
        $query = EncuestaRespuesta::where('idEncuesta', $encuesta->id);

        if ($dateFrom) {
            $query->where('created_at', '>=', $dateFrom . ' 00:00:00');
        }
        if ($dateTo) {
            $query->where('created_at', '<=', $dateTo . ' 23:59:59');
        }
        if ($sexo !== '') {
            $query->where('sexoPaciente', $sexo);
        }

        // Filtros dinámicos por pregunta
        foreach ($questionFilters as $preguntaId => $valor) {
            if ($valor === '' || $valor === null) continue;

            $pregunta = $preguntasFiltrables->get($preguntaId);
            if (!$pregunta) continue;

            if ($pregunta->tipoPregunta === 'nivel_satisfaccion') {
                $query->whereHas('detalles', fn($q) =>
                    $q->where('idPregunta', $preguntaId)
                      ->where('idNivelSatisfaccion', $valor)
                );
            } elseif ($pregunta->tipoPregunta === 'select') {
                $query->whereHas('detalles', fn($q) =>
                    $q->where('idPregunta', $preguntaId)
                      ->where('respuestaOpcion', $valor)
                );
            }
        }

        /* ─── Recolectar datos con chunk para eficiencia ─── */
        $respuestas = collect();

        $query
            ->select(['id', 'created_at', 'sexoPaciente', 'edadPaciente'])
            ->with([
                'detalles.pregunta:id,tituloPregunta,tipoPregunta',
                'detalles.nivelSatisfaccion:id,nombreNivelSatisfaccion',
            ])
            ->orderBy('created_at')
            ->chunk(100, function ($chunk) use ($respuestas) {
                foreach ($chunk as $r) {
                    $respuestas->push($r);
                }
            });

        /* ─── Logo y Estética ─── */
        $logoPath = public_path('images/logo.png');
        $logoBase64 = '';
        if (file_exists($logoPath)) {
            $logoData = file_get_contents($logoPath);
            $logoBase64 = 'data:image/' . pathinfo($logoPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($logoData);
        }

        /* ─── Gráfica de sexo ─── */
        $sexoCounts = ['Masculino' => 0, 'Femenino' => 0];
        foreach ($respuestas as $r) {
            if ($et = $this->normalizaSexo($r->sexoPaciente)) {
                $sexoCounts[$et]++;
            }
        }
        $sexoChart = null;
        if ($sexoCounts['Masculino'] + $sexoCounts['Femenino'] > 0) {
            $sexoChart = 'https://quickchart.io/chart?format=png&w=600&h=300&c='
                . rawurlencode(json_encode([
                    'type' => 'bar',
                    'data' => [
                        'labels'   => ['Masculino', 'Femenino'],
                        'datasets' => [[
                            'backgroundColor' => ['#1a5276', '#a93226'],
                            'data'            => array_values($sexoCounts),
                        ]],
                    ],
                    'options' => [
                        'title'  => ['display' => true, 'text' => 'Distribución por sexo', 'fontSize' => 16, 'fontColor' => '#333'],
                        'legend' => ['display' => false],
                        'scales' => [
                            'yAxes' => [['ticks' => ['beginAtZero' => true, 'stepSize' => 1]]],
                            'xAxes' => [['ticks' => ['fontSize' => 12]]]
                        ],
                    ],
                ]));
        }

        /* ─── Gráfica de edad ─── */
        $edadBuckets = ['<18' => 0, '18-29' => 0, '30-44' => 0, '45-59' => 0, '≥60' => 0];
        foreach ($respuestas as $r) {
            if ($r->edadPaciente !== null) {
                $edadBuckets[$this->bucketEdad((int)$r->edadPaciente)]++;
            }
        }
        $edadChart = null;
        if (array_sum($edadBuckets) > 0) {
            $edadChart = 'https://quickchart.io/chart?format=png&w=600&h=300&c='
                . rawurlencode(json_encode([
                    'type' => 'bar',
                    'data' => [
                        'labels'   => array_keys($edadBuckets),
                        'datasets' => [[
                            'backgroundColor' => '#2471a3',
                            'data'            => array_values($edadBuckets),
                        ]],
                    ],
                    'options' => [
                        'title'  => ['display' => true, 'text' => 'Distribución por edad', 'fontSize' => 16, 'fontColor' => '#333'],
                        'legend' => ['display' => false],
                        'scales' => [
                            'yAxes' => [['ticks' => ['beginAtZero' => true, 'stepSize' => 1]]],
                            'xAxes' => [['ticks' => ['fontSize' => 12]]]
                        ],
                    ],
                ]));
        }

        /* ─── Agrupar por fecha y construir reportData ─── */
        $porFecha = $respuestas->groupBy(fn($r) =>
            Carbon::parse($r->created_at)
                ->locale('es')
                ->translatedFormat('j \\d\\e F \\d\\e Y')
        );

        $reportData = $porFecha->map(function ($coleccion, $fecha) {
            $preguntas = $coleccion->flatMap->detalles
                ->groupBy(fn($d) => $d->pregunta->tituloPregunta)
                ->map(function ($detallesPorPregunta) {
                    $tipoP = $detallesPorPregunta->first()->pregunta->tipoPregunta;

                    if ($tipoP === 'texto') {
                        return ['tipo' => 'omit'];
                    }

                    if ($tipoP === 'hora') {
                        $rangos = ['07-10' => 0, '10-13' => 0, '13-16' => 0, '16-19' => 0, '19-22' => 0];
                        foreach ($detallesPorPregunta as $d) {
                            $b = $this->bucketHora($d->respuestaHora);
                            if ($b !== null && isset($rangos[$b])) {
                                $rangos[$b]++;
                            }
                        }
                        return array_sum($rangos) > 0
                            ? ['tipo' => 'hora', 'rangos' => $rangos]
                            : ['tipo' => 'omit'];
                    }

                    // select: agrupar por valor de opción
                    if ($tipoP === 'select') {
                        $opciones = $detallesPorPregunta
                            ->groupBy(fn($d) => $d->respuestaOpcion ?? 'Sin respuesta')
                            ->map->count();
                        return array_sum($opciones->toArray()) > 0
                            ? ['tipo' => 'select', 'opciones' => $opciones]
                            : ['tipo' => 'omit'];
                    }

                    $niv = $this->nivelesArray($detallesPorPregunta);
                    return array_sum($niv) > 0
                        ? ['tipo' => 'niveles', 'niveles' => $niv]
                        : ['tipo' => 'omit'];
                });

            return [
                'fecha'            => $fecha,
                'totalEncuestados' => $coleccion->count(),
                'preguntas'        => $preguntas,
            ];
        })->values();

        /* ─── Construir etiquetas de filtros activos para el PDF ─── */
        $filtrosAplicados = [];
        if ($sexo === '1') $filtrosAplicados[] = 'Sexo: Masculino';
        if ($sexo === '2') $filtrosAplicados[] = 'Sexo: Femenino';

        foreach ($questionFilters as $preguntaId => $valor) {
            if ($valor === '' || $valor === null) continue;
            $pregunta = $preguntasFiltrables->get($preguntaId);
            if (!$pregunta) continue;
            if ($pregunta->tipoPregunta === 'nivel_satisfaccion') {
                $nombreNivel = $nivelesMap->get($valor, $valor);
                $filtrosAplicados[] = $pregunta->tituloPregunta . ': ' . $nombreNivel;
            } else {
                $filtrosAplicados[] = $pregunta->tituloPregunta . ': ' . $valor;
            }
        }

        /* ─── Generar PDF ─── */
        $pdf = Pdf::loadView('informes.encuestas.pdf', [
            'encuesta'         => $encuesta,
            'reportData'       => $reportData,
            'sexoChart'        => $sexoChart,
            'edadChart'        => $edadChart,
            'dateFrom'         => $dateFrom,
            'dateTo'           => $dateTo,
            'textoPeriodo'     => $textoPeriodo,
            'filtrosAplicados' => $filtrosAplicados,
            'logoBase64'       => $logoBase64,
        ])
        ->setPaper('a4', 'portrait')
        ->setOptions([
            'isRemoteEnabled'      => true,
            'isHtml5ParserEnabled' => true,
        ]);

        return $pdf->stream('informe_encuesta_' . $encuesta->codigoEncuesta . '.pdf');
    }
}
