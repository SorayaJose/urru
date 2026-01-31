<?php

namespace App\Http\Livewire;

use App\Models\Torneo;
use App\Models\Escuela;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Inscripto;
use App\Models\Patinador;
use Illuminate\Support\Carbon;
//use Illuminate\Support\Carbon;
//use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Storage;

class MostrarTorneo extends Component
{
    protected $listeners = ['desinscribir'];
    public $torneo;
    public $nombre = '';
    public $categoria = '';
    public $patinadores = [];
    public $mostrarSugerencias = false;
    public $sort = "fecha";
    public $todos = '';
    public $direction = "asc";
    public $cantidad = 10;
    public $readyToLoad = false;
    

    /*
    public function agregarPatinador() {
        //dd($this->nombre . ' cate '. $this->categoria);
        if ($this->nombre != '') {
            $escuela = auth()->user()->rol;

            // doy de alta al patinador
            Patinador::create([
                'nombre' => $this->nombre,
                'descripcion' => '',
                'categoria_id' => $this->categoria,
                'escuela_id' => $escuela
            ]);
    
            $patinador = Patinador::latest('id')->first();
    
            // crear el rubro
            Inscripto::create([
                'torneo_id' => $this->torneo->id,
                'escuela_id' => $escuela,
                'patinador_id' => $patinador->id,
                'categoria_id' => $this->categoria
            ]);    
        }
    }
*/
    public function desinscribir($patinador_id)
    {
        $torneo = $this->torneo->id;
        $escuela = auth()->user()->rol;

        Inscripto::where('patinador_id', $patinador_id)
            ->where('torneo_id', $torneo)
            ->where('escuela_id', $escuela)
            ->delete();
    }

    public function agregarPatinador()
    {
        if ($this->nombre != '' && $this->categoria != '') {
            $escuela = auth()->user()->rol;

            // 1️⃣ Buscamos si el patinador ya existe
            $patinador = Patinador::where('nombre', $this->nombre)
                ->where('escuela_id', $escuela)
                ->first();

            // 2️⃣ Si no existe, lo creamos
            if (!$patinador) {
                $patinador = Patinador::create([
                    'nombre' => $this->nombre,
                    'descripcion' => '',
                    'categoria_id' => $this->categoria,
                    'escuela_id' => $escuela
                ]);
            }

            // 3️⃣ Verificamos si ya está inscripto en ese torneo + categoría
            $yaInscripto = Inscripto::where('torneo_id', $this->torneo->id)
                ->where('patinador_id', $patinador->id)
                ->where('categoria_id', $this->categoria)
                ->exists();

            if (!$yaInscripto) {
                Inscripto::create([
                    'torneo_id' => $this->torneo->id,
                    'patinador_id' => $patinador->id,
                    'escuela_id' => $escuela,
                    'categoria_id' => $this->categoria
                ]);
            }

            // Limpiamos los campos del formulario
            $this->nombre = '';
            $this->categoria = '';
            $this->mostrarSugerencias = false;
        }
    }

    public function updatedNombre($value)
    {
        if (strlen($value) > 1) {
            $escuela = auth()->user()->rol;
            $this->patinadores = Patinador::where('nombre', 'like', "%{$value}%")->where('escuela_id', $escuela)->take(5)->get();
            $this->mostrarSugerencias = true;
        } else {
            $this->mostrarSugerencias = false;
            $this->patinadores = [];
        }
    }

    public function seleccionarPatinador($id)
    {
        $escuela = auth()->user()->rol;
    
        $patinador = Patinador::where('id', $id)
            ->where('escuela_id', $escuela)
            ->first();
    
        if ($patinador) {
            $this->nombre = $patinador->nombre;
            $this->categoria = $patinador->categoria_id;
            $this->mostrarSugerencias = false;
            $this->patinadores = [];
        }
    }

    public function render()
    {
        $escuela = auth()->user()->rol;

        //$ = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        $escuela = auth()->user()->rol;
        $inscriptos = Inscripto::where('torneo_id', $this->torneo->id)
            ->where('escuela_id', $escuela)
            //->with(['patinador', 'categoria'])
            ->get();;

        $categorias = Categoria::all();
        return view('livewire.mostrar-torneo', [
            'categorias' => $categorias,
            'inscriptos' => $inscriptos
        ]);
    }
}
