<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Patinador;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Carbon;
//use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Storage;

class MostrarPatinadores extends Component
{
    protected $listeners = ['eliminarPatinador'];
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

    public function eliminarPatinador(Patinador $patinador) {
        $patinador->delete();
        //dd($patinador);
    }
 
    public function render()
    {
         if($this->readyToLoad) {
            $escuela = auth()->user()->rol;
            $patinadores = Patinador::where('nombre', 'like', '%' . $this->search . '%')
            ->where('escuela_id', $escuela)
            //->orwhereHas('banco', function ($query) {
            //    $query->where('nombre', 'like', '%' . $this->search . '%');
            // })
            //->orwhere('moneda', $this->search)
            //->orwhere('contacto', 'like', '%' . $this->search . '%')
            //->orwhere('descripcion', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cantidad);
        } else {
            $patinadores = [];
        }

        return view('livewire.mostrar-patinadores', compact('patinadores'));

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
