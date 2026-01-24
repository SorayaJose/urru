<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\User;
use App\Models\Pista;
use App\Models\Torneo;
use App\Models\Escuela;
use Livewire\Component;
use Faker\Provider\Image;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CrearTorneo extends Component
{
    use WithFileUploads;
    
    public $nombre;
    public $fecha;
    public $fecha_cierre;
    public $descripcion;
    public $imagen;
    public $pista_id;
    public $escuela_id;
    public $tipo;
    //public $categorias_formulario = []; 

    protected $rules = [
        'nombre' => 'required|string',
        'fecha' => 'required|date',
        'fecha_cierre' => 'required|date',
        'descripcion' => 'nullable',
        'pista_id' => 'required',
        'escuela_id' => 'required',
        'imagen' => 'nullable|image|max:4096',
        'tipo' => 'nullable',
    ];

    public function mount() {
        $this->nombre = "";
        $this->fecha = "";
        $this->fecha_cierre = "";
        $this->descripcion = "";
        $this->tipo = "";
    }

    public function crearTorneo() {
        $datos = $this->validate();

        //dd($datos);
        // guarda en storage/app/public/torneos
        $nombre_imagen = '';
        if ($this->imagen != null) {
            $imagen = $this->imagen->store('public/torneos');
            $nombre_imagen = str_replace('public/torneos/', '', $imagen);
        }
        // crear el torneo
        Torneo::create([
            'nombre' => $datos['nombre'],
            'slug' => Str::slug($datos['nombre']),
            'fecha' => $datos['fecha'],
            'imagen' => $nombre_imagen,
            'fecha_cierre' => $datos['fecha_cierre'],
            'descripcion' => $datos['descripcion'],
            'pista_id' => $datos['pista_id'],
            'escuela_id' => $datos['escuela_id'],
            'tipo' => $datos['tipo']
        ]);

        dd($datos['tipo']);
        /*
        $torneo = Torneo::latest('id')->first();

        if ($datos['socios_formulario'] != null) {
            foreach($datos['categorias_formulario'] as $categoria) {
                
            }
        }
        */

        // crear un mensaje
        session()->flash('mensaje', 'El torneo se publicó correctamente');

        // redireccionar al usuario
        return redirect()->route('torneos.index');
    }

    public function render()
    {
        $pistas = Pista::get();
        $escuelas = Escuela::get();
        //$categorias = Categoria::orderBy('nombre', 'asc')->get();
        return view('livewire.crear-torneo', [
            'pistas' => $pistas,
            'escuelas' => $escuelas,
            //'categorias' => $categorias
        ]);
    }
}
