<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Escuela;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Carbon;
//use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Storage;

class MostrarEscuelas extends Component
{
    protected $listeners = ['eliminarEscuela'];
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

    public function eliminarEscuela(Escuela $escuela) {
        $escuela->delete();
        //dd($escuela);
    }
 
    public function render()
    {
        /*
        $filePath = 'escuelas.csv';
        
        if (file_exists($filePath)) {
            $handle = fopen($filePath, 'r');
        
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    // Procesa cada línea
                    $valores = str_getcsv($line, ';');
                    
                    //print_r($valores);
                    //$fecha = Carbon::createFromFormat('d/m/y', $valores[0])->format('Y-m-d');
                    $zona = $valores[0];
                    $nombre = $valores[1];
                    $email = $valores[2];
                    echo "Zona: $zona <BR>";
                    echo "Nombre $nombre <BR>";
                    echo "Email $email <BR>";

                    Escuela::create([
                        'nombre' => $nombre,
                        'slug' => Str::slug($nombre),
                        'contacto' => "-"
                    ]);
                    
                    $escuela = Escuela::latest('id')->first();
            
                    User::create([
                        'name' => $nombre,
                        'email' => $email,
                        'email_verified_at' => Carbon::now(),
                        'password' => Hash::make("123456"),
                        'rol' => $escuela->id,
                    ]);
                    echo "$escuela->id<BR>";
                }

                fclose($handle);
            } else {
                // Error al abrir el archivo
                echo "No se pudo abrir el archivo. [$filePath]";
            }
        } else {
            echo "Archivo no encontrado. [$filePath]";
        }
        */

        if($this->readyToLoad) {
            $escuelas = Escuela::where('nombre', 'like', '%' . $this->search . '%')
            //->orwhereHas('banco', function ($query) {
            //    $query->where('nombre', 'like', '%' . $this->search . '%');
            // })
            //->orwhere('moneda', $this->search)
            ->orwhere('contacto', 'like', '%' . $this->search . '%')
            ->orwhere('descripcion', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cantidad);
        } else {
            $escuelas = [];
        }

        return view('livewire.mostrar-escuelas', compact('escuelas'));

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
