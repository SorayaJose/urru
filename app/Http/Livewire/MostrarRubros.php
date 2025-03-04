<?php

namespace App\Http\Livewire;

use App\Models\Rubro;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarRubros extends Component
{
    protected $listeners = ['eliminarRubro'];
    public $search;
    public $sort = "nombre";
    public $todos = '';
    public $direction = "asc";
    public $cantidad = 10;
    public $readyToLoad = false;
    public $open = false;

    protected $queryString = [
        'cantidad' => ['except' => 10]
    ];
    use WithPagination;

    public function eliminarRubro(Rubro $rubro) {
        $rubro->delete();
        //dd($rubro);
    }
 
    public function render()
    {
        if($this->readyToLoad) {
            $rubros = Rubro::where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cantidad);

        } else {
            $rubros = [];
        }

        return view('livewire.mostrar-rubros', compact('rubros'));
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
