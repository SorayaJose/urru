<?php

namespace App\Http\Livewire;

use App\Models\Torneo;
use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarTorneoAdmin extends Component
{
    use WithPagination;

    public $torneo;
    public $buscar = '';
    public $categoriaFiltro = '';
    public $escuelaFiltro = '';
    public $estadoFiltro = '';
    public $cantidad = 25;

    protected $queryString = [
        'buscar' => ['except' => ''],
        'categoriaFiltro' => ['except' => ''],
        'escuelaFiltro' => ['except' => ''],
    ];

    public function mount(Torneo $torneo)
    {
        $this->torneo = $torneo;
    }

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function updatingCategoriaFiltro()
    {
        $this->resetPage();
    }

    public function updatingEscuelaFiltro()
    {
        $this->resetPage();
    }

    public function updatingEstadoFiltro()
    {
        $this->resetPage();
    }

    public function limpiarFiltros()
    {
        $this->buscar = '';
        $this->categoriaFiltro = '';
        $this->escuelaFiltro = '';
        $this->estadoFiltro = '';
        $this->resetPage();
    }

    public function render()
    {
        // Obtener todas las inscripciones con filtros básicos
        $query = $this->torneo->inscripciones()
            ->with(['patinador', 'categoria', 'escuela'])
            ->when($this->buscar, function ($q) {
                $q->whereHas('patinador', function ($subQ) {
                    $subQ->where('nombre', 'like', '%' . $this->buscar . '%');
                });
            })
            ->when($this->categoriaFiltro, function ($q) {
                $q->where('categoria_id', $this->categoriaFiltro);
            })
            ->when($this->escuelaFiltro, function ($q) {
                $q->where('escuela_id', $this->escuelaFiltro);
            })
            ->orderBy('categoria_id')
            ->orderBy('created_at');

        // Si hay filtro por estado, obtener todos y filtrar en memoria
        if ($this->estadoFiltro) {
            $todasInscripciones = $query->get();
            
            if ($this->estadoFiltro === 'completo') {
                $inscripcionesFiltradas = $todasInscripciones->filter(function ($inscripcion) {
                    return $this->torneo->validarArchivos($inscripcion);
                });
            } else {
                $inscripcionesFiltradas = $todasInscripciones->filter(function ($inscripcion) {
                    return !$this->torneo->validarArchivos($inscripcion);
                });
            }
            
            // Paginar manualmente
            $page = request()->get('page', 1);
            $inscripciones = new \Illuminate\Pagination\LengthAwarePaginator(
                $inscripcionesFiltradas->forPage($page, $this->cantidad),
                $inscripcionesFiltradas->count(),
                $this->cantidad,
                $page,
                ['path' => request()->url()]
            );
        } else {
            $inscripciones = $query->paginate($this->cantidad);
        }

        // Estadísticas generales
        $estadisticas = $this->torneo->estadisticasInscripciones();
        
        // Estadísticas por categoría
        $estatsPorCategoria = $this->torneo->inscripciones()
            ->selectRaw('categoria_id, COUNT(*) as total')
            ->groupBy('categoria_id')
            ->with('categoria')
            ->get()
            ->pluck('total', 'categoria.nombre');

        // Estadísticas por escuela
        $estatsPorEscuela = $this->torneo->inscripciones()
            ->selectRaw('escuela_id, COUNT(*) as total')
            ->groupBy('escuela_id')
            ->with('escuela')
            ->get();

        // Listas para filtros
        $categorias = Categoria::where('tipo', $this->torneo->tipo)->get();
        $escuelas = $this->torneo->inscripciones()
            ->select('escuela_id')
            ->distinct()
            ->with('escuela')
            ->get()
            ->pluck('escuela');

        return view('livewire.mostrar-torneo-admin', [
            'inscripciones' => $inscripciones,
            'estadisticas' => $estadisticas,
            'estatsPorCategoria' => $estatsPorCategoria,
            'estatsPorEscuela' => $estatsPorEscuela,
            'categorias' => $categorias,
            'escuelas' => $escuelas,
        ]);
    }
}
