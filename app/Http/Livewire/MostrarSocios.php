<?php

namespace App\Http\Livewire;

use App\Models\Socio;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarSocios extends Component
{
    protected $listeners = ['eliminarSocio'];
    public $search;
    public $sort = "nombre";
    public $direction = "asc";
    public $cantidad = 10;
    public $activo = '';
    public $readyToLoad = false;
    public $open = false;

    protected $queryString = [
        'cantidad' => ['except' => 10]
    ];
    use WithPagination;

    public function eliminarSocio(Socio $socio) {
        $socio->delete();
        //dd($persona);
    }
 
    public function render()
    {
        if($this->readyToLoad) {
            if ($this->activo == '') {
                /*
                $socios = \App\Models\Socio::where('socios.activo', true)
                ->where('apartamentos.nombre', 'like',ççç≈)
                ->where('persona.nombre', 'like', '%' . $this->search . '%')
                ->join('personas', 'socios.persona_id', '=', 'personas.id')
                ->join('apartamentos', 'personas.apartamento_id', '=', 'apartamentos.id')
                ->select('socios.id', 'socios.persona_id', 'persona.nombre', 'apartamentos.nombre')
                ->orderBy('apartamentos.nombre')
                //orderBy($this->sort, $this->direction)*/
                $socios = \App\Models\Socio::with(['persona.apartamento'])
                ->where('activo', true)
                ->whereHas('persona', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->search . '%');
                })
                ->orwhereHas('persona.apartamento', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->search . '%');
                })
                ->join('personas', 'socios.persona_id', '=', 'personas.id')
                ->join('apartamentos', 'personas.apartamento_id', '=', 'apartamentos.id')
                ->select('socios.id', 'socios.persona_id', 'personas.nombre as persona_nombre', 'apartamentos.nombre as apto_nombre')
                ->orderBy('apartamentos.nombre')
                ->paginate($this->cantidad);
            } else {
                $socios = Socio::where('activo', $this->activo)
                        ->paginate($this->cantidad);
            }
        } else {
            $socios = [];
        }

        return view('livewire.mostrar-socios', compact('socios'));
        // ->layout('layouts.base')
    }

    public function loadRegistros() {
        $this->readyToLoad = true;
    }

    public function order($sort) {        
        if ($this->sort == $sort) {
            if ($this->direction == "desc") {
                $this->direction = "asc";
            } else {
                $this->direction = "desc";
            }
        } else {
            $this->sort = $sort;
            $this->direction = "asc";
        }
    }
}
