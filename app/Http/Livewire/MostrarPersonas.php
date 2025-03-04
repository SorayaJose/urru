<?php

namespace App\Http\Livewire;

use App\Models\Socio;
use App\Models\Tempo;
use App\Models\Persona;
use Livewire\Component;
use App\Models\Apartamento;
use Livewire\WithPagination;

class MostrarPersonas extends Component
{
    protected $listeners = ['eliminarPersona'];
    public $search;
    public $relacion;
    public $sort = "nombre";
    public $direction = "asc";
    public $cantidad = 10;
    public $readyToLoad = false;
    public $open = false;

    protected $queryString = [
        'cantidad' => ['except' => 10]
    ];
    use WithPagination;

    public function eliminarPersona(Persona $persona) {
        $persona->delete();
        //dd($persona);
    }
 
    public function render()
    {
        /*
        $personas = Persona::where('relacion', 1)->get();
        $perso = 1;
        foreach($personas as $persona) {
            echo "Persona: " . $persona->id . "-". $persona->nombre . " Apartamento " .  $persona->apartamento->nombre . "<br>";
            $tempo = Tempo::where('apto', $persona->apartamento->nombre)->first();
            if ($tempo != null) {
                $perso = $persona->id;
                $cochera = 1;
                if ($tempo->cochera == 'FALSO') {
                    $cochera = 0;
                }
                $luz = 1;
                if ($tempo->luz == 'FALSO') {
                    $luz = 0;
                }
                $capital = str_replace ( ',', '.', $tempo->capital);
                $capital = (float)$capital;
                $auxiliar = str_replace("\r", "", $tempo->auxiliar);
                
                $socio = Socio::create([
                    'capital' => $capital,
                    'cochera' => $cochera,
                    'luz_cochera' => $luz,
                    'moto' => $tempo->motos,
                    'bici' => $tempo->bici,
                    'biblioteca' => $tempo->biblio,
                    'auxiliar' => $auxiliar,
                    'persona_id' => $perso
                ]);
                
                echo "------------------------<br>";
                echo $tempo . "<br>";
                echo "------------------------<br>";
                echo $socio . "<br>";
                echo "++++++++++++++++++++++++<br><br><br>";
            }            
        }
        echo "estoy aca";
        dd("ahora");
        */
        /*
        $personas = Persona::where('apartamento_id', 1)->get();
        foreach($personas as $persona) {
            $ci = str_replace("-", "", $persona->cedula);
            $ci = str_replace(".", "", $ci);
            $apto = $persona->email;
            //$apartamento = Apartamento::where('nombre', 'like', '%' . $apto . '%')->get();
            $apartamento = Apartamento::where('nombre', $apto)->first();
            
            if ($apartamento != null) {
                echo "Persona: " . $persona->id . " CI: " . $ci . " nombre: " . $apartamento["id"] ." apto: " . $persona->apartamento->id . "-" . $persona->apartamento->nombre . "<br>";
                $persona = Persona::find($persona->id);
                $persona->cedula = $ci;
                $persona->email = "";
                $persona->apartamento_id = $apartamento["id"];
                $persona->save();
            }
        }
        echo "estoy aca";
        dd("ahora");
        */
    
        if($this->readyToLoad) {
            // PENDIENTE arreglar la busqueda
            if ($this->relacion != '') {
                $personas = Persona::where('relacion', $this->relacion)
                ->where(function ($query) {
                    $query->where('nombre', 'like', '%' . $this->search . '%')
                        ->orwhere('email', 'like', '%' . $this->search . '%')
                        ->orwhere('telefono', 'like', '%' . $this->search . '%');
                })                   
                ->orwhereHas('apartamento', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->search . '%');
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cantidad);
                //$this->search =  $this->relacion;
            } else {
                $personas = Persona::where('nombre', 'like', '%' . $this->search . '%')
                ->orwhere('email', 'like', '%' . $this->search . '%')
                ->orwhere('telefono', 'like', '%' . $this->search . '%')
                ->orwhereHas('apartamento', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->search . '%');
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cantidad);     
                //$this->search =  "relacion" . $this->relacion;           
            }
        } else {
            $personas = [];
        }
        return view('livewire.mostrar-personas', compact('personas'));
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
