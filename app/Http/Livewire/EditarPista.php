<?php

namespace App\Http\Livewire;

use App\Models\Pista;
use Livewire\Component;

class EditarPista extends Component
{
    public $pista_id;
    public $nombre;
    public $descripcion;
    public $direccion;

    protected $rules = [
        'nombre' => 'required|string',
        'descripcion' => 'nullable',
        'direccion' => 'nullable'
    ];
 
    public function mount(Pista $pista) {
        $this->pista_id = $pista->id;
        $this->nombre = $pista->nombre;
        $this->descripcion = $pista->descripcion;
        $this->direccion = $pista->direccion;

    }

    public function editarPista() {
        //dd($this->pista_id);
        $datos = $this->validate();

        // encontrar la pista
        $pista = Pista::find($this->pista_id);

        // asignar nuevos valores
        $pista->nombre  = $datos['nombre'];
        $pista->descripcion  = $datos['descripcion'];
        $pista->direccion = $datos['direccion'];
        
        // guardar el registro
        $pista->save();

        // armar el mensaje
        session()->flash('mensaje', 'La pista se modificó correctamente');

        // redireccionar al usuario
        return redirect()->route('pistas.index');
    }

    public function render()
    {
        //dd($bancos);
        return view('livewire.editar-pista');
    }
}
