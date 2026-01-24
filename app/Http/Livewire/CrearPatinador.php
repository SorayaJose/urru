<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\User;
use App\Models\Patinador;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class CrearPatinador extends Component
{
    public $nombre;
    public $descripcion;
    public $escuela;
    public $categoria;

    protected $rules = [
        'nombre' => 'required|string',
        'descripcion' => 'nullable',
        'categoria' => 'required|numeric',
    ];
    
    public function mount() {
        $this->nombre = "";
        $this->descripcion = "";
        $this->categoria = "";
    }

    public function crearPatinador() {
        $datos = $this->validate();

        //dd($datos);
        $escuela = auth()->user()->rol;

        // crear el rubro
        Patinador::create([
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'categoria_id' => $datos['categoria'],
            'escuela_id' => $escuela
        ]);
        
        // crear un mensaje
        session()->flash('mensaje', 'El patinador se publicó correctamente');

        // redireccionar al usuario
        return redirect()->route('patinadores.index');
    }

    public function render()
    {
        //dd($tipo);
        $categorias = Categoria::all();
        return view('livewire.crear-patinador', [
            'categorias' => $categorias
        ]);
    }
}
