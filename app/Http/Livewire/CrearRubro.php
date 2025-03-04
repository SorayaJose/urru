<?php

namespace App\Http\Livewire;

use App\Models\Rubro;
use Livewire\Component;

class CrearRubro extends Component
{
    public $nombre;

    protected $rules = [
        'nombre' => 'required|string',
    ];
    
    public function mount() {
        $this->nombre = "";
    }

    public function crearRubro() {
        $datos = $this->validate();

        //dd($datos);
        
        // crear el rubro
        Rubro::create([
            'nombre' => $datos['nombre']   
        ]);

        // crear un mensaje
        session()->flash('mensaje', 'El rubro se publicó correctamente');

        // redireccionar al usuario
        return redirect()->route('rubros.index');
    }

    public function render()
    {
        return view('livewire.crear-rubro');
    }
}
