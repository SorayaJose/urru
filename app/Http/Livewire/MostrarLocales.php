<?php

namespace App\Http\Livewire;

use App\Models\Local;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarLocales extends Component
{
    protected $listeners = ['eliminarLocal'];
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

    public function eliminarLocal(Local $local) {
        $local->delete();
        //dd($persona);
    }
 
    public function render()
    {
        if($this->readyToLoad) {
            if ($this->activo == '') {
                $locales = Local::
                /*whereHas('apartamento', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->search . '%');
                })
                orderBy($this->sort, $this->direction)*/
                paginate($this->cantidad);
            } else {
                $locales = Local::where('activo', $this->activo)
                        ->paginate($this->cantidad);
            }
        } else {
            $locales = [];
        }

        return view('livewire.mostrar-locales', compact('locales'));
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
