<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;

class EditarItem extends Component
{
    public $item_id;
    public $nombre;
    public $mostrar;
    public $moneda;
    public $todos;
    public $cantidad;

    protected $rules = [
        'nombre' => 'required|string',
        'todos' => 'required',
        'moneda' => 'required',        
        'mostrar' => 'required',  
        'cantidad' => 'numeric|nullable' 
    ];
    
    public function mount(Item $item) {
        $this->item_id = $item->id;
        $this->nombre = $item->nombre;
        $this->todos = $item->todos;
        $this->moneda = $item->moneda;
        $this->mostrar = $item->mostrar;
        $this->cantidad = $item->cantidad;
    }

    // OJO FALTA OCULTAR OPCION CANTIDAD SEGUN EL TIPO DE item
    public function editarItem() {
        //dd($this->item_id);
        $datos = $this->validate();

        // encontrar la persona
        $item = Item::find($this->item_id);

        // asignar nuevos valores
        $item->nombre  = $datos['nombre'];
        $item->todos = $datos['todos'];
        $item->moneda = $datos['moneda'];
        $item->mostrar = $datos['mostrar'];
        $item->cantidad = $datos['cantidad'];
        
        // guardar el registro
        $item->save();

        // armar el mensaje
        session()->flash('mensaje', 'El item se modificó correctamente');

        // redireccionar al usuario
        return redirect()->route('items.index');
    }

    public function render()
    {
        return view('livewire.editar-item');
    }
}
