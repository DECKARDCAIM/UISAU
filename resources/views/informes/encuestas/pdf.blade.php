<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        /* ═══════════════════════════════════════════
           CONFIGURACIÓN DE PÁGINA
        ═══════════════════════════════════════════ */
        @page {
            margin: 120px 40px 60px 40px; /* Top Right Bottom Left */
        }

        /* ═══════════════════════════════════════════
           BASE
        ═══════════════════════════════════════════ */
        * { box-sizing: border-box; }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            line-height: 1.4;
            color: #333;
        }

        /* ═══════════════════════════════════════════
           ENCABEZADO FIJO EN TODAS LAS PÁGINAS
        ═══════════════════════════════════════════ */
        header {
            position: fixed;
            top: -100px;
            left: 0;
            right: 0;
            height: 80px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .header-table td {
            vertical-align: middle;
            border: none;
            padding: 0;
        }

        .logo {
            max-width: 120px;
            height: auto;
        }

        .header-title {
            text-align: center;
        }

        .header-title h1 {
            font-size: 14px;
            color: #1a5276;
            margin: 0;
            text-transform: uppercase;
        }

        .header-title p {
            font-size: 11px;
            color: #2471a3;
            font-weight: bold;
            margin: 2px 0 0 0;
        }

        .header-meta {
            text-align: right;
            font-size: 9px;
            color: #666;
            width: 150px;
        }

        .header-meta strong {
            color: #1a5276;
        }

        .divider {
            border-bottom: 2px solid #1a5276;
            margin-top: 10px;
        }

        /* ═══════════════════════════════════════════
           PIE DE PÁGINA FIJO
        ═══════════════════════════════════════════ */
        footer {
            position: fixed;
            bottom: -40px;
            left: 0;
            right: 0;
            height: 30px;
            border-top: 1px solid #1a5276;
            padding-top: 5px;
            font-size: 8px;
            color: #666;
            text-align: center;
        }

        .footer-left { float: left; }
        .footer-right { float: right; }

        /* ═══════════════════════════════════════════
           CONTENIDO PRINCIPAL
        ═══════════════════════════════════════════ */
        main {
            /* Sin margen extra, body ya tiene el margin de @page */
        }

        h2 {
            font-size: 12px;
            color: #fff;
            background-color: #1a5276;
            padding: 5px 10px;
            margin: 15px 0 10px 0;
            border-radius: 3px;
            page-break-after: avoid;
            text-transform: uppercase;
        }

        h3 {
            font-size: 11px;
            color: #1a5276;
            margin: 15px 0 5px 0;
            border-bottom: 1px solid #aed6f1;
            padding-bottom: 2px;
            page-break-after: avoid;
        }

        p {
            text-align: justify;
            margin: 5px 0;
        }

        /* ═══════════════════════════════════════════
           FILTROS ACTIVOS
        ═══════════════════════════════════════════ */
        .filtros-box {
            background-color: #f4f9fd;
            border: 1px solid #aed6f1;
            padding: 5px 10px;
            margin-bottom: 15px;
            border-radius: 3px;
        }
        
        .filtros-title {
            font-weight: bold;
            color: #1a5276;
            font-size: 9px;
            margin-bottom: 5px;
        }

        .badge {
            background-color: #2471a3;
            color: #fff;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            margin-right: 5px;
            display: inline-block;
        }

        /* ═══════════════════════════════════════════
           SECCIONES Y COMPONENTES
        ═══════════════════════════════════════════ */
        .intro-text {
            background-color: #f9f9f9;
            padding: 10px;
            border-left: 3px solid #1a5276;
            margin-bottom: 15px;
        }

        .dia-resumen {
            background-color: #eaf4fb;
            padding: 5px 10px;
            border: 1px solid #aed6f1;
            border-radius: 3px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        /* Contenedor seguro para evitar saltos de página a mitad de gráfico/tabla */
        .bloque-seguro {
            page-break-inside: avoid;
            margin-bottom: 15px;
        }

        .chart-box {
            text-align: center;
            border: 1px solid #ddd;
            background: #fff;
            padding: 5px;
            border-radius: 3px;
            margin-bottom: 5px;
        }

        .chart-box img {
            width: 100%; /* Forza a que la imagen ocupe el ancho del contenedor */
            max-width: 600px;
            height: auto;
        }

        .analisis-box {
            background-color: #fef9e7;
            border: 1px solid #f1c40f;
            padding: 8px;
            border-radius: 3px;
            margin-top: 5px;
        }

        /* ═══════════════════════════════════════════
           TABLAS
        ═══════════════════════════════════════════ */
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        table.data th {
            background-color: #1a5276;
            color: #fff;
            padding: 5px;
            font-size: 9px;
            text-align: left;
        }

        table.data td {
            padding: 5px;
            border-bottom: 1px solid #eee;
            font-size: 9px;
        }

        table.data tr:nth-child(even) { background-color: #f9f9f9; }

        table.data tfoot td {
            background-color: #eaf4fb;
            font-weight: bold;
            border-top: 1px solid #1a5276;
        }

        .text-center { text-align: center !important; }

        /* ═══════════════════════════════════════════
           FIRMA Y CONCLUSIÓN
        ═══════════════════════════════════════════ */
        .conclusion {
            background-color: #f4f9fd;
            padding: 10px;
            border-radius: 3px;
            margin-top: 20px;
            border: 1px solid #aed6f1;
        }

        .firma {
            margin-top: 50px;
            text-align: left;
        }

        .firma-linea {
            border-top: 1px solid #333;
            width: 250px;
            padding-top: 5px;
            font-weight: bold;
        }

        .firma-cargo {
            font-size: 9px;
            color: #666;
            font-weight: normal;
        }

        .page-break { page-break-after: always; }
        
        .clear { clear: both; }

        /* Helpers colores */
        .c-verde { color: #27ae60; }
        .c-naranja { color: #d35400; }
        .c-rojo { color: #c0392b; }
    </style>
</head>
<body>

    @php
        use Carbon\Carbon;

        $df = $dateFrom ?? null;
        $dt = $dateTo   ?? null;

        $f1 = ($df && trim($df) !== '') ? Carbon::parse($df)->locale('es') : null;
        $f2 = ($dt && trim($dt) !== '') ? Carbon::parse($dt)->locale('es') : null;

        if ($f1 && $f2) {
            $textoRango = $f1->translatedFormat('j M Y') . ' al ' . $f2->translatedFormat('j M Y');
        } elseif ($f1) {
            $textoRango = 'Desde ' . $f1->translatedFormat('j M Y');
        } elseif ($f2) {
            $textoRango = 'Hasta ' . $f2->translatedFormat('j M Y');
        } else {
            $textoRango = Carbon::now()->locale('es')->translatedFormat('F Y');
        }

        $fechaGen = Carbon::now()->locale('es')->translatedFormat('d/m/Y H:i');
    @endphp

    <!-- HEADER FIJO -->
    <header>
        <table class="header-table">
            <tr>
                <td style="width: 130px;">
                    @if(!empty($logoBase64))
                        <img src="{{ $logoBase64 }}" class="logo" alt="Logo">
                    @endif
                </td>
                <td class="header-title">
                    <h1>INFORME DE TABULACIÓN</h1>
                    <p>{{ $encuesta->tituloEncuesta }}</p>
                </td>
                <td class="header-meta">
                    <strong>Código:</strong> {{ $encuesta->codigoEncuesta }}<br>
                    <strong>Período:</strong> {{ $textoRango }}<br>
                    <strong>Generado:</strong> {{ $fechaGen }}
                </td>
            </tr>
        </table>
        <div class="divider"></div>
    </header>

    <!-- FOOTER FIJO -->
    <footer>
        <div class="footer-left">Hospital de El Progreso – UISAU</div>
        <div class="footer-right">Generado el {{ $fechaGen }}</div>
        <div class="clear"></div>
    </footer>

    <!-- CONTENIDO -->
    <main>
        
        @if(!empty($filtrosAplicados))
            <div class="filtros-box">
                <div class="filtros-title">Filtros Aplicados:</div>
                @foreach($filtrosAplicados as $filtro)
                    <span class="badge">{{ $filtro }}</span>
                @endforeach
            </div>
        @endif

        <div class="intro-text">
            <p>El presente informe refleja la tabulación de datos de encuestas correspondientes al período de <strong>{{ $textoPeriodo }}</strong>. El objetivo es evaluar la calidad de atención y detectar áreas de oportunidad en los servicios del Hospital de El Progreso.</p>
        </div>

        @foreach($reportData as $index => $dia)
            @if($index > 0)
                <div class="page-break"></div>
            @endif

            <h2>{{ strtoupper($dia['fecha']) }}</h2>
            <div class="dia-resumen">
                Total de encuestados en este período: {{ $dia['totalEncuestados'] }}
            </div>

            @foreach($dia['preguntas'] as $titulo => $info)
                @if($info['tipo'] === 'omit') @continue @endif

                <!-- Bloque seguro: agrupa título, gráfica y análisis para que no se separen -->
                <div class="bloque-seguro">
                    
                    <h3>{{ $titulo }}</h3>

                    @if($info['tipo'] === 'niveles')
                        @php
                            $niveles = $info['niveles'];
                            $labels  = ['Muy insatisfecho', 'Insatisfecho', 'Neutral', 'Satisfecho', 'Muy satisfecho'];
                            $colors  = ['#c0392b', '#e74c3c', '#f1c40f', '#27ae60', '#1e8449'];

                            $urlNiv = 'https://quickchart.io/chart?format=png&w=600&h=250&c='
                                . rawurlencode(json_encode([
                                    'type' => 'bar',
                                    'data' => [
                                        'labels'   => $labels,
                                        'datasets' => [[
                                            'backgroundColor' => $colors,
                                            'data'            => $niveles,
                                        ]],
                                    ],
                                    'options' => [
                                        'legend' => ['display' => false],
                                        'scales' => [
                                            'yAxes' => [['ticks' => ['beginAtZero' => true, 'stepSize' => 1]]],
                                        ],
                                    ],
                                ]));

                            $total        = array_sum($niveles);
                            $cntInsat     = $niveles[0] + $niveles[1];
                            $cntNeutral   = $niveles[2];
                            $cntSat       = $niveles[3] + $niveles[4];
                            $pctInsat     = $total ? round($cntInsat   * 100 / $total, 1) : 0;
                            $pctNeutral   = $total ? round($cntNeutral * 100 / $total, 1) : 0;
                            $pctSat       = $total ? round($cntSat     * 100 / $total, 1) : 0;
                            // Promedio ponderado (1-5)
                            $pesos        = [1, 2, 3, 4, 5];
                            $sumaP        = 0;
                            foreach ($pesos as $i => $p) { $sumaP += $p * $niveles[$i]; }
                            $promedio     = $total ? round($sumaP / $total, 2) : 0;
                        @endphp

                        <div class="chart-box">
                            <img src="{{ $urlNiv }}" alt="Gráfica">
                        </div>

                        {{-- Tabla detallada por categoría individual + subtotales --}}
                        <table class="data" style="margin-top:6px;">
                            <thead>
                                <tr>
                                    <th>Categoría</th>
                                    <th class="text-center" style="width:70px;">Respuestas</th>
                                    <th class="text-center" style="width:65px;">% Individual</th>
                                    <th class="text-center" style="width:75px;">% Agrupado</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- GRUPO INSATISFECHO --}}
                                <tr style="background-color:#fdecea;">
                                    <td><span style="color:#c0392b;">&#9632;</span> <strong>Muy insatisfecho</strong></td>
                                    <td class="text-center">{{ $niveles[0] }}</td>
                                    <td class="text-center">{{ $total ? round($niveles[0]*100/$total,1) : 0 }}%</td>
                                    <td class="text-center" rowspan="2" style="vertical-align:middle; background-color:#f5b7b1; font-weight:bold; color:#922b21;">
                                        {{ $pctInsat }}%<br><small>Insatisfecho</small>
                                    </td>
                                </tr>
                                <tr style="background-color:#fdecea;">
                                    <td><span style="color:#e74c3c;">&#9632;</span> <strong>Insatisfecho</strong></td>
                                    <td class="text-center">{{ $niveles[1] }}</td>
                                    <td class="text-center">{{ $total ? round($niveles[1]*100/$total,1) : 0 }}%</td>
                                </tr>
                                {{-- GRUPO NEUTRO --}}
                                <tr style="background-color:#fef9e7;">
                                    <td><span style="color:#f1c40f;">&#9632;</span> <strong>Neutral</strong></td>
                                    <td class="text-center">{{ $niveles[2] }}</td>
                                    <td class="text-center">{{ $total ? round($niveles[2]*100/$total,1) : 0 }}%</td>
                                    <td class="text-center" style="background-color:#fdebd0; font-weight:bold; color:#784212;">
                                        {{ $pctNeutral }}%<br><small>Neutro</small>
                                    </td>
                                </tr>
                                {{-- GRUPO SATISFECHO --}}
                                <tr style="background-color:#eafaf1;">
                                    <td><span style="color:#27ae60;">&#9632;</span> <strong>Satisfecho</strong></td>
                                    <td class="text-center">{{ $niveles[3] }}</td>
                                    <td class="text-center">{{ $total ? round($niveles[3]*100/$total,1) : 0 }}%</td>
                                    <td class="text-center" rowspan="2" style="vertical-align:middle; background-color:#a9dfbf; font-weight:bold; color:#1e8449;">
                                        {{ $pctSat }}%<br><small>Satisfecho</small>
                                    </td>
                                </tr>
                                <tr style="background-color:#eafaf1;">
                                    <td><span style="color:#1e8449;">&#9632;</span> <strong>Muy satisfecho</strong></td>
                                    <td class="text-center">{{ $niveles[4] }}</td>
                                    <td class="text-center">{{ $total ? round($niveles[4]*100/$total,1) : 0 }}%</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><strong>TOTAL</strong></td>
                                    <td class="text-center"><strong>{{ $total }}</strong></td>
                                    <td class="text-center"><strong>100%</strong></td>
                                    <td class="text-center"><strong>100%</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><strong>Promedio ponderado (escala 1=Muy insatisfecho … 5=Muy satisfecho)</strong></td>
                                    <td class="text-center"><strong>{{ $promedio }} / 5</strong></td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="analisis-box" style="margin-top:6px;">
                            <strong>Análisis técnico detallado:</strong><br>
                            De las <strong>{{ $total }}</strong> respuestas registradas para esta pregunta:
                            <ul style="margin:4px 0 4px 15px; padding:0;">
                                <li><strong class="c-rojo">Muy insatisfecho:</strong> {{ $niveles[0] }} personas ({{ $total ? round($niveles[0]*100/$total,1) : 0 }}%)</li>
                                <li><strong class="c-rojo">Insatisfecho:</strong> {{ $niveles[1] }} personas ({{ $total ? round($niveles[1]*100/$total,1) : 0 }}%)</li>
                                <li><strong style="color:#b7950b;">Neutral:</strong> {{ $niveles[2] }} personas ({{ $total ? round($niveles[2]*100/$total,1) : 0 }}%)</li>
                                <li><strong class="c-verde">Satisfecho:</strong> {{ $niveles[3] }} personas ({{ $total ? round($niveles[3]*100/$total,1) : 0 }}%)</li>
                                <li><strong class="c-verde">Muy satisfecho:</strong> {{ $niveles[4] }} personas ({{ $total ? round($niveles[4]*100/$total,1) : 0 }}%)</li>
                            </ul>
                            <strong>Subtotales agrupados:</strong>
                            Insatisfacción total <strong class="c-rojo">{{ $pctInsat }}%</strong> ({{ $cntInsat }} resp.) |
                            Neutro <strong style="color:#b7950b;">{{ $pctNeutral }}%</strong> ({{ $cntNeutral }} resp.) |
                            Satisfacción total <strong class="c-verde">{{ $pctSat }}%</strong> ({{ $cntSat }} resp.).<br>
                            El <strong>promedio ponderado</strong> es <strong>{{ $promedio }}/5</strong>, lo que indica un nivel
                            @if($promedio >= 4.5) <strong class="c-verde">MUY ALTO</strong>. El servicio evaluado supera ampliamente las expectativas de los usuarios. Se recomienda mantener y documentar las buenas prácticas aplicadas.
                            @elseif($promedio >= 4.0) <strong class="c-verde">ALTO</strong>. El servicio evaluado es percibido positivamente por la mayoría de usuarios. Se recomienda sostener las prácticas actuales y continuar el monitoreo.
                            @elseif($promedio >= 3.5) <strong class="c-naranja">MEDIO-ALTO</strong>. El servicio es aceptable aunque existe margen de mejora. Se sugiere identificar los ítems con mayor insatisfacción para intervención focalizada.
                            @elseif($promedio >= 3.0) <strong class="c-naranja">MEDIO</strong>. El servicio se encuentra en un punto neutral con oportunidades claras de mejora. Se recomienda revisar procesos y aplicar correctivos antes del próximo período de evaluación.
                            @elseif($promedio >= 2.0) <strong class="c-rojo">BAJO</strong>. La mayoría de usuarios reporta insatisfacción. Se requiere intervención inmediata, identificación de causas raíz y plan de acción documentado al Comité de Calidad.
                            @else <strong class="c-rojo">MUY BAJO</strong>. El nivel de insatisfacción es crítico. Se exige revisión urgente del proceso, asignación de responsables y seguimiento semanal de indicadores.
                            @endif
                            Estos resultados son reportados al <strong>Comité de Calidad</strong> para análisis, seguimiento y toma de decisiones.
                        </div>

                    @elseif($info['tipo'] === 'hora')
                        @php
                            $rangos      = $info['rangos'];
                            $totalHora   = array_sum($rangos);
                            $urlHora     = null;
                            $rangoMayor  = '';
                            $maxVal      = 0;
                            if ($totalHora > 0) {
                                foreach ($rangos as $rk => $rv) {
                                    if ($rv > $maxVal) { $maxVal = $rv; $rangoMayor = $rk; }
                                }
                                $urlHora = 'https://quickchart.io/chart?format=png&w=600&h=250&c='
                                    . rawurlencode(json_encode([
                                        'type' => 'bar',
                                        'data' => [
                                            'labels'   => array_keys($rangos),
                                            'datasets' => [[
                                                'backgroundColor' => '#2471a3',
                                                'data'            => array_values($rangos),
                                            ]],
                                        ],
                                        'options' => [
                                            'legend' => ['display' => false],
                                            'scales' => [
                                                'yAxes' => [['ticks' => ['beginAtZero' => true, 'stepSize' => 1]]],
                                            ],
                                        ],
                                    ]));
                            }
                        @endphp

                        @if($urlHora)
                            <div class="chart-box">
                                <img src="{{ $urlHora }}" alt="Gráfica">
                            </div>

                            <table class="data" style="margin-top:6px;">
                                <thead>
                                    <tr>
                                        <th>Rango Horario</th>
                                        <th class="text-center" style="width:70px;">Cantidad</th>
                                        <th class="text-center" style="width:60px;">%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rangos as $rk => $rv)
                                        <tr>
                                            <td>{{ $rk }}</td>
                                            <td class="text-center">{{ $rv }}</td>
                                            <td class="text-center">{{ $totalHora > 0 ? round($rv * 100 / $totalHora, 1) : 0 }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><strong>TOTAL</strong></td>
                                        <td class="text-center"><strong>{{ $totalHora }}</strong></td>
                                        <td class="text-center"><strong>100%</strong></td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="analisis-box" style="margin-top:6px;">
                                <strong>Análisis técnico:</strong>
                                Se registraron <strong>{{ $totalHora }}</strong> respuestas en esta pregunta de hora.
                                El rango horario con mayor concentración de atención es <strong>{{ $rangoMayor }}</strong>
                                con <strong>{{ $maxVal }}</strong> registros
                                ({{ $totalHora > 0 ? round($maxVal * 100 / $totalHora, 1) : 0 }}% del total).
                                Esta distribución permite identificar los picos de demanda del servicio y optimizar
                                la asignación de recursos humanos en los horarios de mayor afluencia.
                            </div>
                        @endif

                    @elseif($info['tipo'] === 'select')
                        @php
                            $opciones     = $info['opciones'];
                            $totalSelect  = $opciones->sum();
                            $urlSelect    = null;
                            $opcionTop    = '';
                            $valTop       = 0;
                            if ($totalSelect > 0) {
                                foreach ($opciones as $ok => $ov) {
                                    if ($ov > $valTop) { $valTop = $ov; $opcionTop = $ok; }
                                }
                                $urlSelect = 'https://quickchart.io/chart?format=png&w=600&h=250&c='
                                    . rawurlencode(json_encode([
                                        'type' => 'bar',
                                        'data' => [
                                            'labels'   => $opciones->keys()->values()->all(),
                                            'datasets' => [[
                                                'backgroundColor' => '#6c3483',
                                                'data'            => $opciones->values()->all(),
                                            ]],
                                        ],
                                        'options' => [
                                            'legend' => ['display' => false],
                                            'scales' => [
                                                'yAxes' => [['ticks' => ['beginAtZero' => true, 'stepSize' => 1]]],
                                            ],
                                        ],
                                    ]));
                            }
                        @endphp

                        @if($urlSelect)
                            <div class="chart-box">
                                <img src="{{ $urlSelect }}" alt="Gráfica">
                            </div>

                            <table class="data">
                                <thead>
                                    <tr>
                                        <th>Respuesta</th>
                                        <th class="text-center" style="width: 80px;">Total</th>
                                        <th class="text-center" style="width: 80px;">%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($opciones as $etiqueta => $total)
                                        <tr>
                                            <td>{{ $etiqueta }}</td>
                                            <td class="text-center">{{ $total }}</td>
                                            <td class="text-center">{{ $totalSelect > 0 ? round($total * 100 / $totalSelect, 1) : 0 }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><strong>TOTAL</strong></td>
                                        <td class="text-center"><strong>{{ $totalSelect }}</strong></td>
                                        <td class="text-center"><strong>100%</strong></td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="analisis-box" style="margin-top:6px;">
                                <strong>Análisis técnico:</strong>
                                Esta pregunta recibió <strong>{{ $totalSelect }}</strong> respuestas en total.
                                La opción predominante fue <strong>"{{ $opcionTop }}"</strong>,
                                seleccionada por <strong>{{ $valTop }}</strong> encuestados
                                ({{ $totalSelect > 0 ? round($valTop * 100 / $totalSelect, 1) : 0 }}% del total).
                                La distribución porcentual mostrada permite comparar el peso relativo de cada
                                opción y orientar la toma de decisiones hacia las categorías con mayor frecuencia.
                            </div>
                        @endif

                    @endif

                </div> <!-- Fin bloque seguro -->
            @endforeach

            {{-- SECCIÓN DE TIEMPOS DE ESPERA --}}
            @if(isset($dia['waitStats']) && $dia['waitStats']['hasData'])
                <div class="page-break"></div>
                <h2>ANÁLISIS DE TIEMPOS DE ESPERA</h2>
                
                <div class="dia-resumen" style="background-color: #fef9e7; border-color: #f1c40f;">
                    <strong>Promedio general de espera:</strong>
                    <span style="font-size: 14px; color: #d35400;">{{ $dia['waitStats']['avgTexto'] }}</span>
                    <br>
                    <small style="color:#555;">
                        Basado en <strong>{{ $dia['waitStats']['totalRespuestas'] }}</strong> registros que contienen
                        hora de ingreso <em>y</em> hora de egreso registradas.<br>
                        <em>Cálculo: se sumó la diferencia (egreso &minus; ingreso) de cada registro
                        y se dividió entre el total de registros válidos.
                        Este valor representa el tiempo promedio que un paciente estuvo desde que ingresó
                        hasta que egrесó del servicio en el período seleccionado.</em>
                    </small>
                </div>

                <div class="bloque-seguro">
                    <h3>Distribución de Tiempos de Espera</h3>
                    @php
                        $rangosWait    = $dia['waitStats']['rangos'];
                        $totalWait     = array_sum($rangosWait);
                        $avgMin        = $dia['waitStats']['avgMin'];
                        $minMin        = $dia['waitStats']['minMin'];
                        $maxMin        = $dia['waitStats']['maxMin'];
                        $totalReg      = $dia['waitStats']['totalRespuestas'];
                        // Rango con mayor concentración
                        $rangoTopWait  = '';
                        $maxWaitVal    = 0;
                        foreach ($rangosWait as $rk => $rv) {
                            if ($rv > $maxWaitVal) { $maxWaitVal = $rv; $rangoTopWait = $rk; }
                        }
                        // Pacientes en rango aceptable (< 60 min)
                        $cntAceptable  = ($rangosWait['< 30 min'] ?? 0) + ($rangosWait['30-60 min'] ?? 0);
                        $cntRegular    = ($rangosWait['1-2 horas'] ?? 0) + ($rangosWait['2-3 horas'] ?? 0);
                        $cntCritico    = $rangosWait['> 3 horas'] ?? 0;
                        $pctAceptable  = $totalWait ? round($cntAceptable * 100 / $totalWait, 1) : 0;
                        $pctRegular    = $totalWait ? round($cntRegular   * 100 / $totalWait, 1) : 0;
                        $pctCritico    = $totalWait ? round($cntCritico   * 100 / $totalWait, 1) : 0;
                        // Formato helpers
                        $fmtMin = function($m) {
                            if ($m >= 60) {
                                $h = floor($m/60); $rm = round($m % 60);
                                return $h.'h '.($rm > 0 ? $rm.'min' : '');
                            }
                            return round($m).' min';
                        };
                        $urlWait = 'https://quickchart.io/chart?format=png&w=600&h=250&c='
                            . rawurlencode(json_encode([
                                'type' => 'bar',
                                'data' => [
                                    'labels'   => array_keys($rangosWait),
                                    'datasets' => [[
                                        'backgroundColor' => ['#27ae60', '#2ecc71', '#f1c40f', '#e67e22', '#e74c3c'],
                                        'data'            => array_values($rangosWait),
                                    ]],
                                ],
                                'options' => [
                                    'legend' => ['display' => false],
                                    'scales' => [
                                        'yAxes' => [['ticks' => ['beginAtZero' => true, 'stepSize' => 1]]],
                                    ],
                                ],
                            ]));
                    @endphp

                    <div class="chart-box">
                        <img src="{{ $urlWait }}" alt="Gráfica de Espera">
                    </div>

                    {{-- Tabla detallada de rangos --}}
                    <table class="data" style="margin-top:6px;">
                        <thead>
                            <tr>
                                <th>Rango de Espera</th>
                                <th class="text-center" style="width:70px;">Pacientes</th>
                                <th class="text-center" style="width:65px;">%</th>
                                <th style="width:130px;">Clasificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background-color:#eafaf1;">
                                <td><span style="color:#27ae60;">&#9632;</span> Menos de 30 minutos</td>
                                <td class="text-center">{{ $rangosWait['< 30 min'] ?? 0 }}</td>
                                <td class="text-center">{{ $totalWait ? round(($rangosWait['< 30 min'] ?? 0)*100/$totalWait,1) : 0 }}%</td>
                                <td style="color:#1e8449;"><strong>&#10003; Óptimo</strong></td>
                            </tr>
                            <tr style="background-color:#eafaf1;">
                                <td><span style="color:#2ecc71;">&#9632;</span> Entre 30 y 60 minutos</td>
                                <td class="text-center">{{ $rangosWait['30-60 min'] ?? 0 }}</td>
                                <td class="text-center">{{ $totalWait ? round(($rangosWait['30-60 min'] ?? 0)*100/$totalWait,1) : 0 }}%</td>
                                <td style="color:#1e8449;"><strong>&#10003; Aceptable</strong></td>
                            </tr>
                            <tr style="background-color:#fef9e7;">
                                <td><span style="color:#f1c40f;">&#9632;</span> Entre 1 y 2 horas</td>
                                <td class="text-center">{{ $rangosWait['1-2 horas'] ?? 0 }}</td>
                                <td class="text-center">{{ $totalWait ? round(($rangosWait['1-2 horas'] ?? 0)*100/$totalWait,1) : 0 }}%</td>
                                <td style="color:#d35400;"><strong>&#9888; Regular</strong></td>
                            </tr>
                            <tr style="background-color:#fef4e7;">
                                <td><span style="color:#e67e22;">&#9632;</span> Entre 2 y 3 horas</td>
                                <td class="text-center">{{ $rangosWait['2-3 horas'] ?? 0 }}</td>
                                <td class="text-center">{{ $totalWait ? round(($rangosWait['2-3 horas'] ?? 0)*100/$totalWait,1) : 0 }}%</td>
                                <td style="color:#d35400;"><strong>&#9888; Prolongado</strong></td>
                            </tr>
                            <tr style="background-color:#fdecea;">
                                <td><span style="color:#e74c3c;">&#9632;</span> Más de 3 horas</td>
                                <td class="text-center">{{ $rangosWait['> 3 horas'] ?? 0 }}</td>
                                <td class="text-center">{{ $totalWait ? round(($rangosWait['> 3 horas'] ?? 0)*100/$totalWait,1) : 0 }}%</td>
                                <td style="color:#922b21;"><strong>&#9888; Crítico</strong></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>TOTAL de registros clasificados</strong></td>
                                <td class="text-center"><strong>{{ $totalWait }}</strong></td>
                                <td class="text-center"><strong>100%</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Promedio general de espera</strong></td>
                                <td colspan="2"><strong>{{ $dia['waitStats']['avgTexto'] }}</strong>
                                    <small style="font-weight:normal; color:#555;">
                                        (suma de tiempos individuales &divide; {{ $totalWait }} registros)
                                    </small>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="analisis-box" style="margin-top:6px;">
                        <strong>Análisis técnico detallado &ndash; Tiempos de Espera:</strong><br>
                        Se analizaron <strong>{{ $totalReg }}</strong> registros que cuentan con hora de
                        ingreso y egreso registrada en el sistema. El <strong>promedio general de espera
                        es {{ $dia['waitStats']['avgTexto'] }}</strong>, calculado sumando el tiempo
                        individual de cada paciente (egreso &minus; ingreso) y dividiéndolo entre los
                        {{ $totalReg }} registros válidos del período.<br><br>
                        La distribución por rango de espera muestra:
                        <ul style="margin:4px 0 4px 15px; padding:0;">
                            <li><strong class="c-verde">Atención óptima (&lt;60 min):</strong>
                                {{ $cntAceptable }} pacientes &mdash; <strong>{{ $pctAceptable }}%</strong> del total.
                                Estos pacientes recibieron atención dentro del tiempo estándar aceptable.
                            </li>
                            <li><strong class="c-naranja">Espera regular (1 a 3 horas):</strong>
                                {{ $cntRegular }} pacientes &mdash; <strong>{{ $pctRegular }}%</strong> del total.
                                Requiere monitoreo y análisis de cuellos de botella en el flujo de atención.
                            </li>
                            <li><strong class="c-rojo">Espera crítica (&gt;3 horas):</strong>
                                {{ $cntCritico }} pacientes &mdash; <strong>{{ $pctCritico }}%</strong> del total.
                                Esta fracción de usuarios experimentó una espera excesiva que afecta directamente
                                la percepción de calidad y la satisfacción del servicio.
                            </li>
                        </ul>
                        El rango con <strong>mayor concentración de pacientes</strong> fue
                        <strong>&ldquo;{{ $rangoTopWait }}&rdquo;</strong> con
                        <strong>{{ $maxWaitVal }}</strong> registros
                        ({{ $totalWait ? round($maxWaitVal*100/$totalWait,1) : 0 }}% del total),
                        lo que indica dónde se concentra la mayor presión sobre el servicio.
                        @if($avgMin > 180)
                            <br><strong class="c-rojo">&#9888; NIVEL CRÍTICO &mdash; Acción Urgente:</strong>
                            El promedio de <strong>{{ $dia['waitStats']['avgTexto'] }}</strong> supera las 3 horas.
                            Se recomienda revisión urgente de flujos de atención, redistribución del personal
                            y apertura de módulos adicionales. Debe escalar al Comité de Calidad con plan de acción.
                        @elseif($avgMin > 120)
                            <br><strong class="c-rojo">&#9888; NIVEL ALTO:</strong>
                            El promedio de <strong>{{ $dia['waitStats']['avgTexto'] }}</strong> supera las 2 horas.
                            Se requiere intervención en los procesos de atención y refuerzo de personal
                            en horarios de alta demanda.
                        @elseif($avgMin > 60)
                            <br><strong class="c-naranja">&#9888; NIVEL REGULAR:</strong>
                            El promedio de <strong>{{ $dia['waitStats']['avgTexto'] }}</strong> está entre 1 y 2 horas.
                            Se recomienda identificar cuellos de botella y establecer metas de reducción
                            progresiva hacia menos de 60 minutos.
                        @elseif($avgMin > 30)
                            <br><strong class="c-naranja">&#10003; NIVEL ACEPTABLE:</strong>
                            El promedio de <strong>{{ $dia['waitStats']['avgTexto'] }}</strong> es manejable.
                            Se sugiere optimizar el flujo de los pacientes en el rango de 30&ndash;60 min.
                        @else
                            <br><strong class="c-verde">&#10003; NIVEL ÓPTIMO:</strong>
                            El promedio de <strong>{{ $dia['waitStats']['avgTexto'] }}</strong> es excelente.
                            La atención se brinda de manera ágil. Se recomienda documentar las buenas
                            prácticas para replicarlas en otras áreas del hospital.
                        @endif
                    </div>
                </div>
            @endif

        @endforeach

        <div class="page-break"></div>
        
        <h2>Resumen Demográfico Total</h2>
        <p>Distribución de los participantes por sexo y edad en el período consultado.</p>

        <!-- Bloque seguro para gráficas demográficas -->
        <div class="bloque-seguro">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    @if(!is_null($sexoChart))
                        <td style="width: 50%; padding: 5px; vertical-align: top;">
                            <div class="chart-box">
                                <img src="{{ $sexoChart }}" alt="Sexo">
                            </div>
                        </td>
                    @endif
                    @if(!is_null($edadChart))
                        <td style="width: 50%; padding: 5px; vertical-align: top;">
                            <div class="chart-box">
                                <img src="{{ $edadChart }}" alt="Edad">
                            </div>
                        </td>
                    @endif
                </tr>
            </table>
        </div>

        @php
            $totalDemo   = $reportData->first()['totalEncuestados'] ?? 0;
            // Sexo
            $sexoM       = $sexoCounts['Masculino'] ?? 0;
            $sexoF       = $sexoCounts['Femenino']  ?? 0;
            $sexoTotal   = $sexoM + $sexoF;
            $pctM        = $sexoTotal ? round($sexoM * 100 / $sexoTotal, 1) : 0;
            $pctF        = $sexoTotal ? round($sexoF * 100 / $sexoTotal, 1) : 0;
            $sexoPredom  = $sexoM >= $sexoF ? 'Masculino' : 'Femenino';
        @endphp

        @if(!is_null($sexoChart) || !is_null($edadChart))
        <div class="analisis-box" style="margin-top:8px;">
            <strong>Análisis técnico – Demografía:</strong>
            @if($sexoTotal > 0)
                Se registraron <strong>{{ $sexoTotal }}</strong> encuestados con dato de sexo:
                <strong>{{ $sexoM }}</strong> masculinos ({{ $pctM }}%) y
                <strong>{{ $sexoF }}</strong> femeninos ({{ $pctF }}%).
                El sexo predominante es <strong>{{ $sexoPredom }}</strong>.
            @endif
            @if(!is_null($edadChart))
                La distribución etaria permite identificar el grupo poblacional con mayor demanda del servicio,
                lo cual es clave para la planificación de recursos y estrategias de atención diferenciada.
            @endif
        </div>
        @endif

        <div class="bloque-seguro">
            <div class="conclusion">
                <h3 style="margin-top: 0; border: none;">CONCLUSIÓN</h3>
                <p>Las encuestas y sus resultados presentados en este documento servirán como base para la implementación de estrategias de mejora continua. La Unidad de Información en Salud (UISAU) provee esta información al Comité de Calidad para garantizar una atención eficiente y humanizada.</p>
            </div>

            <div class="firma">
                <div class="firma-linea">
                    Licda. Vanessa Yureyda Contreras Lázaro<br>
                    <span class="firma-cargo">Coordinadora / UISAU<br>Hospital de El Progreso</span>
                </div>
            </div>
        </div>

    </main>

    <script type="text/php">
        if (isset($pdf)) {
            $text = "Página {PAGE_NUM} / {PAGE_COUNT}";
            $font = $fontMetrics->get_font("DejaVu Sans", "normal");
            $size = 8;
            $color = array(0.4, 0.4, 0.4);
            
            // Posicionar en el centro del footer
            $width = $fontMetrics->get_text_width($text, $font, $size);
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 30;
            
            $pdf->page_text($x, $y, $text, $font, $size, $color);
        }
    </script>

</body>
</html>
