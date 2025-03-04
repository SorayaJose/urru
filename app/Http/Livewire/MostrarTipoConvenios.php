<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TipoConvenio;
use Livewire\WithPagination;

class MostrarTipoConvenios extends Component
{
    protected $listeners = ['eliminarTipoConvenios'];
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

    public function eliminarRubro(TipoConvenio $tipoConvenio) {
        $tipoConvenio->delete();
        //dd($rubro);
    }
 
    public function render()
    {
        if($this->readyToLoad) {
            $tipoConvenio = TipoConvenio::where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cantidad);
        } else {
            $tipoConvenio = [];
        }

        return view('livewire.mostrar-tipoconvenios', compact('tipoConvenio'));
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

