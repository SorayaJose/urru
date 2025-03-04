<?php

namespace App\Http\Livewire;

use App\Models\Socio;
use Livewire\Component;

class MostrarSocio extends Component
{
    public $socio;
    protected $listeners = ['eliminarSocio'];

    public function eliminarSocio(Socio $socio) {
        $this->socio = $socio;
        $socio = Socio::find($socio->id);

        // asignar nuevos valores
        $socio->activo = !($socio->activo);

        // guardar la pesona
        $socio->save();

        // armar el mensaje
        session()->flash('mensaje', 'El socio se modificó correctamente');

        // redireccionar al usuario
        return redirect()->route('socios.show', $socio->id);
    }
    
    public function render()
    {
        return view('livewire.mostrar-socio');
    }
}
