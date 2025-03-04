<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Convenio;
use Livewire\WithPagination;

class MostrarConvenios extends Component
{
    protected $listeners = ['eliminarConvenio'];
    public $search;
    public $relacion;
    public $sort = "id";
    public $direction = "desc";
    public $cantidad = 10;
    public $readyToLoad = false;
    public $open = false;

    protected $queryString = [
        'cantidad' => ['except' => 10]
    ];
    use WithPagination;

    public function eliminarConvenio(Convenio $convenio) {
        $convenio->delete();
        //dd($convenio);
    }
 
    public function render()
    {
        if($this->readyToLoad) {
            // PENDIENTE arreglar la busqueda
            $convenios = Convenio::
            orderBy($this->sort, $this->direction)
            ->paginate($this->cantidad);                
        } else {
            $convenios = [];
        }
        
        return view('livewire.mostrar-convenios', compact('convenios'));
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
