<div class="flex justify-center py-10 px-4">
    <div class="bg-white/90 backdrop-blur-md rounded-[36px] shadow ring-1 ring-slate-200/50 w-full max-w-[1100px] mx-auto px-10 py-12 space-y-8">
  
        {{-- Cabecera --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <h2 class="text-2xl font-bold">Respuestas: {{ $encuesta->tituloEncuesta }}</h2>
                @if($encuesta->estadoEncuesta)
                    <x-badge flat green label="Activo" />
                @else
                    <x-badge flat red label="Inactivo" />
                @endif

                {{-- Botón exportar PDF: condicional a fechas --}}
                @if($this->canExport)
                    <a
                        href="{{ $this->pdfUrl }}"
                        target="_blank"
                        title="Exportar a PDF con los filtros aplicados"
                        class="text-red-600 hover:text-red-800 transition-colors"
                    >
                        <x-icon name="document-arrow-down" class="h-6 w-6" />
                    </a>
                @else
                    <button
                        onclick="window.$wireui.notify({title: 'Filtros requeridos', description: 'Debe seleccionar un rango de fechas o ingresar un código de respuesta para generar el reporte.', icon: 'info'})"
                        title="Seleccione fechas o código primero"
                        class="text-gray-300 cursor-not-allowed"
                    >
                        <x-icon name="document-arrow-down" class="h-6 w-6" />
                    </button>
                @endif
            </div>

            {{-- Botón limpiar filtros --}}
            @if($this->hasFilters)
                <button
                    wire:click="clearFilters"
                    class="flex items-center gap-1.5 text-sm text-slate-500 hover:text-red-500 transition-colors border border-slate-200 hover:border-red-300 rounded-lg px-3 py-1.5"
                >
                    <x-icon name="x-mark" class="h-4 w-4" />
                    Limpiar filtros
                </button>
            @endif
        </div>

        {{-- ════ SECCIÓN DE FILTROS ════ --}}
        <div class="rounded-2xl border border-slate-200 bg-slate-50/60 p-6 space-y-4">
            <p class="text-xs font-semibold uppercase tracking-widest text-slate-400">Filtros</p>

            {{-- Fila 1: código, fechas --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 items-end">
                <div>
                    <x-input
                        label="Buscar código"
                        placeholder="ER-00001"
                        wire:model.live="search"
                    />
                </div>

                <div>
                    <x-input
                        type="date"
                        label="Desde"
                        wire:model.live="dateFrom"
                    />
                </div>

                <div>
                    <x-input
                        type="date"
                        label="Hasta"
                        wire:model.live="dateTo"
                    />
                </div>
            </div>

            {{-- Fila 2: filtros dinámicos por pregunta (select y nivel_satisfaccion) --}}
            @if($preguntasFiltrables->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 items-end">
                    @foreach($preguntasFiltrables as $pregunta)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                {{ $pregunta->tituloPregunta }}
                            </label>

                            @if($pregunta->tipoPregunta === 'select')
                                <select
                                    wire:model.live="questionFilters.{{ $pregunta->id }}"
                                    class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                    <option value="">Todos</option>
                                    @foreach($pregunta->opciones as $opcion)
                                        <option value="{{ $opcion->etiqueta }}">{{ $opcion->etiqueta }}</option>
                                    @endforeach
                                </select>

                            @elseif($pregunta->tipoPregunta === 'nivel_satisfaccion')
                                <select
                                    wire:model.live="questionFilters.{{ $pregunta->id }}"
                                    class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                    <option value="">Todos</option>
                                    @foreach($nivelesSelect as $nivel)
                                        <option value="{{ $nivel->id }}">{{ $nivel->emojiSatisfaccion }} {{ $nivel->nombreNivelSatisfaccion }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Tabla de respuestas --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Código</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Edad</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Sexo</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Fecha</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Detalle</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($responses as $resp)
                        <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $resp->codigoEncuestaRespuesta }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $resp->edadPaciente }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">
                                {{ $resp->sexoPaciente == 1 ? 'Masculino' : 'Femenino' }}
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-800">
                                {{ $resp->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                <button
                                    wire:click="toggleExpand({{ $resp->id }})"
                                    class="p-1 rounded hover:bg-gray-200"
                                >
                                    @if($expandedId === $resp->id)
                                        <x-icon name="chevron-up" class="h-5 w-5 text-blue-600" />
                                    @else
                                        <x-icon name="chevron-down" class="h-5 w-5 text-blue-600" />
                                    @endif
                                </button>
                            </td>
                        </tr>
        
                        @if($expandedId === $resp->id)
                            <tr class="bg-gray-100">
                                <td colspan="5" class="px-4 py-4">
                                    <ul class="divide-y divide-gray-200 space-y-4">
                                        @foreach($resp->detalles as $det)
                                            <li>
                                                <p class="font-semibold text-slate-800">
                                                    {{ $det->pregunta->tituloPregunta }}
                                                </p>
                                                <div class="flex items-center space-x-2 mt-1">
                                                    @if ($det->nivelSatisfaccion)
                                                        <span class="text-2xl">{{ $det->nivelSatisfaccion->emojiSatisfaccion }}</span>
                                                        <span class="text-sm text-gray-700">{{ $det->nivelSatisfaccion->nombreNivelSatisfaccion }}</span>
                                                    @elseif ($det->respuestaTexto)
                                                        <span class="text-sm text-gray-800">{{ $det->respuestaTexto }}</span>
                                                    @elseif ($det->respuestaEntero !== null)
                                                        <span class="text-sm text-gray-800">{{ $det->respuestaEntero }}</span>
                                                    @elseif ($det->respuestaFecha)
                                                        <span class="text-sm text-gray-800">{{ \Carbon\Carbon::parse($det->respuestaFecha)->format('d/m/Y') }}</span>
                                                    @elseif ($det->respuestaHora)
                                                        <span class="text-sm text-gray-800">{{ \Carbon\Carbon::parse($det->respuestaHora)->format('H:i') }}</span>
                                                    @elseif ($det->respuestaFechaHora)
                                                        <span class="text-sm text-gray-800">{{ \Carbon\Carbon::parse($det->respuestaFechaHora)->format('d/m/Y H:i') }}</span>
                                                    @elseif ($det->respuestaOpcion)
                                                        <span class="text-sm text-gray-800">{{ $det->respuestaOpcion }}</span>
                                                    @else
                                                        <span class="text-sm text-gray-500 italic">Sin respuesta</span>
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-sm text-gray-400 italic">
                                No se encontraron respuestas con los filtros aplicados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
  
        {{-- Paginación --}}
        <div class="mt-4">
            {{ $responses->links() }}
        </div>
    </div>
</div>