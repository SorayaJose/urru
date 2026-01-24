<?php

namespace App\Http\Livewire;

use App\Models\Pista;
use Livewire\Component;

class CrearPista extends Component
{
    public $nombre;
    public $descripcion;
    public $direccion;

    protected $rules = [
        'nombre' => 'required|string',
        'descripcion' => 'nullable',
        'direccion' => 'nullable'
    ];
    
    public function mount() {
        $this->nombre = "";
        $this->descripcion = "";
        $this->direccion = "";
    }

    public function crearPista() {
        $datos = $this->validate();

        //dd($datos);
        
        // crear la pista
        Pista::create([
            'nombre' => $datos['nombre'],
            'direccion' => $datos['direccion'],
            'descripcion' => $datos['descripcion']
        ]);

        // crear un mensaje
        session()->flash('mensaje', 'La pista se publicó correctamente');

        // redireccionar al usuario
        return redirect()->route('pistas.index');
    }

    public function render()
    {
        return view('livewire.crear-pista');
    }
}
