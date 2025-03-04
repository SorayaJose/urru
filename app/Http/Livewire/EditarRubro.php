<?php

namespace App\Http\Livewire;

use App\Models\Rubro;
use Livewire\Component;

class EditarRubro extends Component
{
    public $rubro_id;
    public $nombre;

    protected $rules = [
        'nombre' => 'required|string'
    ];
    
    public function mount(Rubro $rubro) {
        $this->rubro_id = $rubro->id;
        $this->nombre = $rubro->nombre;
    }

    // OJO FALTA OCULTAR OPCION CANTIDAD SEGUN EL TIPO DE RUBRO
    public function editarRubro() {
        //dd($this->rubro_id);
        $datos = $this->validate();

        // encontrar la persona
        $rubro = Rubro::find($this->rubro_id);

        // asignar nuevos valores
        $rubro->nombre  = $datos['nombre'];
        
        // guardar el registro
        $rubro->save();

        // armar el mensaje
        session()->flash('mensaje', 'El rubro se modificó correctamente');

        // redireccionar al usuario
        return redirect()->route('rubros.index');
    }

    public function render()
    {
        return view('livewire.editar-rubro');
    }
}
