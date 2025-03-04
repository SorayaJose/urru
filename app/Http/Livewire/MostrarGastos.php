<?php

namespace App\Http\Livewire;

use App\Models\Gasto;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarGastos extends Component
{
    protected $listeners = ['eliminarGasto'];
    public $search;
    public $sort = "id";
    public $direction = "desc";
    public $cantidad = 10;
    public $activo = '';
    public $readyToLoad = false;
    public $open = false;

    protected $queryString = [
        'cantidad' => ['except' => 10]
    ];
    use WithPagination;

    public function eliminarGasto(Gasto $gasto) {
        $gasto->delete();
        //dd($gasto);
    }
 
    public function render()
    {
        if($this->readyToLoad) {
            if ($this->activo == '') {
                $gastos = Gasto::orderBy($this->sort, $this->direction)
                ->paginate($this->cantidad);
            } else {
                $gastos = Gasto::where('activo', $this->activo)
                        ->paginate($this->cantidad);
            }            
        } else {
            $gastos = [];
        }

        return view('livewire.mostrar-gastos', compact('gastos'));
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
