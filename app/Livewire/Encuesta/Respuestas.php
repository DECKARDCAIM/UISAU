<?php

namespace App\Livewire\Encuesta;

use App\Models\Encuesta;
use App\Models\EncuestaPregunta;
use App\Models\nivel_satisfaccion;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Respuestas extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $encuesta;
    public $search     = '';
    public $expandedId;
    public $dateFrom;
    public $dateTo;
    public $sexo       = '';   // '' | '1' | '2'

    // Filtros dinámicos: [preguntaId => 'valor_seleccionado']
    public array $questionFilters = [];

    public function mount(Encuesta $encuesta)
    {
        $this->encuesta = $encuesta;
    }

    /* ─── Resetear paginación al cambiar cualquier filtro ─── */

    public function updatingSearch()       { $this->resetPage(); }
    public function updatingDateFrom()     { $this->resetPage(); }
    public function updatingDateTo()       { $this->resetPage(); }
    public function updatingSexo()         { $this->resetPage(); }
    public function updatedQuestionFilters() { $this->resetPage(); }

    /* ─── Toggle de fila expandida ─── */

    public function toggleExpand(int $id): void
    {
        $this->expandedId = ($this->expandedId === $id) ? null : $id;
    }

    /* ─── Limpiar todos los filtros ─── */

    public function clearFilters(): void
    {
        $this->reset(['search', 'dateFrom', 'dateTo', 'sexo', 'questionFilters']);
        $this->resetPage();
    }

    /* ─── Construye la URL del PDF pasando los filtros activos ─── */

    public function getPdfUrlProperty(): ?string
    {
        $params = array_filter([
            'dateFrom' => $this->dateFrom,
            'dateTo'   => $this->dateTo,
            'sexo'     => $this->sexo,
            'search'   => $this->search,
        ]);

        // Serializar filtros de preguntas: solo los no vacíos
        $qf = array_filter($this->questionFilters, fn($v) => $v !== '' && $v !== null);
        if ($qf) {
            $params['qf'] = base64_encode(json_encode($qf));
        }

        return route('informes.encuestas.pdf', $this->encuesta) . '?' . http_build_query($params);
    }

    /* ─── Determina si hay algún filtro activo ─── */

    public function getHasFiltersProperty(): bool
    {
        $qf = array_filter($this->questionFilters, fn($v) => $v !== '' && $v !== null);
        return filled($this->search)
            || filled($this->dateFrom)
            || filled($this->dateTo)
            || filled($this->sexo)
            || !empty($qf);
    }

    /* ─── Determina si puede exportar (Fechas obligatorias) ─── */

    public function getCanExportProperty(): bool
    {
        return (filled($this->dateFrom) && filled($this->dateTo)) || filled($this->search);
    }

    /* ─── Render ─── */

    public function render()
    {
        // Preguntas filtrables: select y nivel_satisfaccion
        $preguntasFiltrables = EncuestaPregunta::where('idEncuesta', $this->encuesta->id)
            ->where('estadoPregunta', 1)
            ->whereIn('tipoPregunta', ['select', 'nivel_satisfaccion'])
            ->with('opciones')
            ->get();

        // Niveles de satisfacción para el dropdown
        $nivelesSelect = nivel_satisfaccion::where('estadoNivelSatisfaccion', 1)
            ->orderBy('id')
            ->get();

        $query = $this->encuesta
            ->respuestas()
            ->with('detalles.pregunta', 'detalles.nivelSatisfaccion')
            // filtro: código
            ->when($this->search, fn($q) =>
                $q->where('codigoEncuestaRespuesta', 'like', "%{$this->search}%")
            )
            // filtro: desde
            ->when($this->dateFrom, fn($q) =>
                $q->whereDate('created_at', '>=', $this->dateFrom)
            )
            // filtro: hasta
            ->when($this->dateTo, fn($q) =>
                $q->whereDate('created_at', '<=', $this->dateTo)
            )
            // filtro: sexo
            ->when($this->sexo !== '', fn($q) =>
                $q->where('sexoPaciente', $this->sexo)
            );

        // Filtros dinámicos por pregunta
        foreach ($this->questionFilters as $preguntaId => $valor) {
            if ($valor === '' || $valor === null) {
                continue;
            }

            $pregunta = $preguntasFiltrables->firstWhere('id', $preguntaId);
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

        $responses = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.encuesta.respuestas', [
            'responses'           => $responses,
            'preguntasFiltrables' => $preguntasFiltrables,
            'nivelesSelect'       => $nivelesSelect,
        ]);
    }
}
