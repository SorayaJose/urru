<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Apartamento;
use Livewire\WithPagination;

class MostrarApartamentos extends Component
{
    protected $listeners = ['eliminarApartamento'];
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

    public function eliminarApartamento(Apartamento $apartamento) {
        $apartamento->delete();
        //dd($apartamento);
    }
 
    public function render()
    {
        /*
        $apartamentos = Apartamento::all();
        foreach($apartamentos as $apto) {
            echo "Apto: " . $apto->id . "-". $apto->nombre . " OSE " .  $apto->contador_ose . "<br>";
            if ($apto->contador_ose != '') {
                $rubro = Rubro::where('nombre', 'Ose contador: '.trim($apto->contador_ose))->first();
                if ($rubro != '') {
                    $apto->rubros()->attach($rubro->id);
                    echo $rubro->id . "---------------------<br>";
                }
            }
        }
        echo "estoy aca";
        dd("ahora");
        */
        
        if($this->readyToLoad) {
            $apartamentos = Apartamento::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('dormitorios', $this->search)
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cantidad);
        } else {
            $apartamentos = [];
        }

        return view('livewire.mostrar-apartamentos', compact('apartamentos'));
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
