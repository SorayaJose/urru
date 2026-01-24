<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Escuela;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class CrearEscuela extends Component
{
    public $nombre;
    public $contacto;
    public $descripcion;
    public $escuela_email;
    public $escuela_clave;
    public $slug;

    protected $rules = [
        'nombre' => 'required|string',
        'contacto' => 'nullable',
        'descripcion' => 'nullable',
        'escuela_email' => 'required|email|unique:users,email',
        'escuela_clave' => 'nullable',
    ];
    
    protected $messages = [
        'escuela_email.email' => 'El correo electrónico no es válido',
        'escuela_email.required' => 'El correo electrónico es obligatorio',
        'escuela_email.unique' => 'Este correo electrónico ya está registrado',
    ];
    
    public function mount() {
        $this->nombre = "";
        $this->contacto = "";
        $this->descripcion = "";
        $this->escuela_email = "";
        $this->escuela_clave = "";
    }

    public function crearEscuela() {
        $datos = $this->validate();

        //dd($datos);
        
        // crear el rubro
        Escuela::create([
            'nombre' => $datos['nombre'],
            'slug' => Str::slug($datos['nombre']),
            'contacto' => $datos['contacto'],
            'descripcion' => $datos['descripcion']
        ]);
        
        $escuela = Escuela::latest('id')->first();

        User::create([
            'name' => $datos['nombre'],
            'email' => $datos['escuela_email'],
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make($datos['escuela_clave']),
            'rol' => $escuela->id,
        ]);

        // crear un mensaje
        session()->flash('mensaje', 'La escuela se publicó correctamente');

        // redireccionar al usuario
        return redirect()->route('escuelas.index');
    }

    public function render()
    {
        //dd($tipo);
        return view('livewire.crear-escuela');
    }
}
