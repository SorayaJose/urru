<?php

namespace App\Http\Livewire;

use App\Models\Apartamento;
use App\Models\Persona;
use Livewire\Component;

class CrearPersona extends Component
{
    public $nombre;
    public $sexo;
    public $cedula;
    public $nacimiento;
    public $telefono;
    public $email;
    //public $jubilado;
    public $relacion;
    public $apartamento;

    protected $rules = [
        'nombre' => 'required|string',
        'sexo' => 'nullable',
        'cedula' => 'numeric|nullable',
        'nacimiento' => 'date|nullable',
        'telefono' => 'nullable',
        'email' => 'nullable|email|unique:personas',
        //'jubilado' => 'nullable',
        'relacion' => 'nullable|numeric',
        'apartamento' => 'exists:apartamentos,nombre'     
    ];

    public function crearPersona() {
        $datos = $this->validate();

        //dd($datos);
        
        $apartamento = Apartamento::where('nombre', $datos['apartamento'])->first();
        $datos['apartamento'] = $apartamento->id;
        
        // crear la personas
        Persona::create([
            'nombre' => $datos['nombre'],
            'sexo' => $datos['sexo'],
            'cedula' => $datos['cedula'],
            'nacimiento' => $datos['nacimiento'],
            'telefono' => $datos['telefono'],
            'email' => $datos['email'],
            //'jubilado' => $datos['jubilado'],
            'relacion' => $datos['relacion'],
            'apartamento_id' => $datos['apartamento']      
        ]);

        // crear un mensaje
        session()->flash('mensaje', 'La persona se publicó correctamente');

        // redireccionar al usuario
        return redirect()->route('personas.index');
    }

    public function render()
    {
        return view('livewire.crear-persona');
    }
}
