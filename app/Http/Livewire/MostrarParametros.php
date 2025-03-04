<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Parametro;
use Livewire\WithPagination;

class MostrarParametros extends Component
{
    protected $listeners = ['eliminarParametro'];
    public $search;
    public $sort = "nombre";
    public $direction = "asc";
    public $cantidad = 10;
    public $readyToLoad = false;
    public $open = false;

    protected $queryString = [
        'cantidad' => ['except' => 10]
    ];
    use WithPagination;

    public function eliminarRubro(Parametro $parametro) {
        $parametro->delete();
        //dd($parametro);
    }
 
    public function render()
    {
        if($this->readyToLoad) {
            $parametro = Parametro::where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cantidad);
        } else {
            $parametro = [];
        }

        return view('livewire.mostrar-parametro', compact('parametro'));
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
