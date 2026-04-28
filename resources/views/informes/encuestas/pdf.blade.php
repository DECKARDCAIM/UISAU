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

            <h2>Fecha: {{ strtoupper($dia['fecha']) }}</h2>
            <div class="dia-resumen">
                Total encuestados este día: {{ $dia['totalEncuestados'] }}
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

                            $total  = array_sum($niveles);
                            $pctSat = $total ? round(($niveles[3] + $niveles[4]) * 100 / $total, 1) : 0;
                        @endphp

                        <div class="chart-box">
                            <img src="{{ $urlNiv }}" alt="Gráfica">
                        </div>

                        <div class="analisis-box">
                            <strong>Análisis:</strong> El nivel de satisfacción es 
                            @if($pctSat >= 80) <strong class="c-verde">ALTO ({{ $pctSat }}%)</strong>
                            @elseif($pctSat >= 60) <strong class="c-naranja">MEDIO ({{ $pctSat }}%)</strong>
                            @else <strong class="c-rojo">BAJO ({{ $pctSat }}%)</strong>
                            @endif
                            . Los resultados se comparten con el Comité de Calidad para evaluación.
                        </div>

                    @elseif($info['tipo'] === 'hora')
                        @php
                            $rangos  = $info['rangos'];
                            $urlHora = null;
                            if (array_sum($rangos) > 0) {
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
                        @endif

                    @elseif($info['tipo'] === 'select')
                        @php
                            $opciones  = $info['opciones'];
                            $urlSelect = null;
                            if ($opciones->sum() > 0) {
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
                                            <td class="text-center">{{ $opciones->sum() > 0 ? round($total * 100 / $opciones->sum(), 1) : 0 }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>TOTAL</td>
                                        <td class="text-center">{{ $opciones->sum() }}</td>
                                        <td class="text-center">100%</td>
                                    </tr>
                                </tfoot>
                            </table>
                        @endif

                    @endif

                </div> <!-- Fin bloque seguro -->
            @endforeach
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
