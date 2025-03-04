<?php

namespace App\Http\Livewire;

use App\Models\TipoConvenio;
use Livewire\Component;

class CrearTipoConvenio extends Component
{
    public $nombre;

    protected $rules = [
        'nombre' => 'required|string',  
    ];
    
    public function mount() {
    }

    public function crearTipoConvenio() {
        $datos = $this->validate();

        //dd($tipoConvenio);
        
        // crear el rubro
        TipoConvenio::create([
            'nombre' => $datos['nombre']  
        ]);

        // crear un mensaje
        session()->flash('mensaje', 'El tipo de convenio se publicó correctamente');

        // redireccionar al usuario
        return redirect()->route('tipoConvenios.index');
    }

    public function render()
    {
        return view('livewire.crear-tipoConvenios');
    }
}
