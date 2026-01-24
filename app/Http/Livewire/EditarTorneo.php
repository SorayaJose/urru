<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Pista;
use App\Models\Torneo;
use App\Models\Escuela;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class EditarTorneo extends Component
{
    use WithFileUploads;
    
    public $torneo_id;
    public $nombre;
    public $fecha;
    public $fecha_cierre;
    public $descripcion;
    public $imagen;
    public $pista_id;
    public $escuela_id;
    public $tipo;
    public $imagenDisco;
    //public $categorias_formulario = []; 

    public function rules()
    {
        return [
            'nombre' => 'required|string',
            'fecha' => 'required|date',
            'fecha_cierre' => 'required|date',
            'descripcion' => 'nullable',
            'pista_id' => 'required',
            'escuela_id' => 'required',
            'imagen' => 'nullable|image|max:4096',
            'tipo' => 'nullable',
            ];
    }
        
    public function mount(Torneo $torneo) {
        //dd($torneo->id);
        $this->torneo_id = $torneo->id;
        $this->nombre = $torneo->nombre;
        $this->fecha = Carbon::parse($torneo->fecha)->format('Y-m-d');;
        $this->fecha_cierre = Carbon::parse($torneo->fecha_cierre)->format('Y-m-d');
        $this->descripcion = $torneo->descripcion;
        $this->pista_id = $torneo->pista_id;
        $this->escuela_id = $torneo->escuela_id;
        $this->imagen = null;
        $this->imagenDisco = $torneo->imagen;
        $this->tipo = $torneo->tipo;
    }

    public function editarTorneo() {
        $datos = $this->validate();

        //dd($datos['tipo']);
        // encontrar el rubro
        $torneo = Torneo::find($this->torneo_id);

        $nombre_imagen = '';
        if ($this->imagen != null) {
            $imagen = $this->imagen->store('public/torneos');
            $nombre_imagen = str_replace('public/torneos/', '', $imagen);
        } else {
            $nombre_imagen = $torneo->imagen;
        }

        // asignar nuevos valores
        $torneo->nombre  = $datos['nombre'];
        $torneo->fecha  = $datos['fecha'];
        $torneo->fecha_cierre  = $datos['fecha_cierre'];
        $torneo->slug = Str::slug($datos['nombre']);
        $torneo->descripcion = $datos['descripcion'];
        $torneo->pista_id  = $datos['pista_id'];
        $torneo->escuela_id  = $datos['escuela_id'];
        $torneo->tipo  = $datos['tipo'];
        $torneo->imagen = $nombre_imagen;

        // guardar el registro
        $torneo->save();

        // armar el mensaje
        session()->flash('mensaje', 'El torneo se modificó correctamente');

        // redireccionar al usuario
        return redirect()->route('torneos.index');
    }

    public function render()
    {
        $pistas = Pista::get();
        $escuelas = Escuela::get();
        //$categorias = Categoria::orderBy('nombre', 'asc')->get();
        return view('livewire.editar-torneo', [
            'pistas' => $pistas,
            'escuelas' => $escuelas,
            //'categorias' => $categorias
        ]);
    }
}
