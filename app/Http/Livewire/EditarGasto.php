<?php

namespace App\Http\Livewire;

use App\Models\Gasto;
use App\Models\Item;
use Livewire\Component;

class EditarGasto extends Component
{
    public $gasto_id;
    public $fecha;
    public $importe;
    public $moneda;
    public $item;
    public $estado;
    public $descripcion;

    protected $rules = [
        'fecha' => 'required|date',
        'estado' => 'numeric|nullable',
        'moneda' => 'required|string',
        'importe' => 'required|numeric',
        'descripcion' => 'nullable|string',
        'item' => 'required' 
    ];
    
    public function mount(Gasto $gasto) {
        $this->gasto_id = $gasto->id;
        $this->fecha = $gasto->fecha;
        $this->estado = $gasto->estado;
        $this->moneda = $gasto->moneda;
        $this->importe = $gasto->importe;
        $this->descripcion = $gasto->descripcion;
        $this->item = $gasto->item_id;
    }

    public function editarGasto() {
        //dd($this->rubro_id);
        $datos = $this->validate();

        // encontrar la persona
        $gasto = Gasto::find($this->gasto_id);

        // asignar nuevos valores
        $gasto->estado  = $datos['estado'];
        $gasto->fecha = $datos['fecha'];
        $gasto->moneda = $datos['moneda'];
        $gasto->importe = $datos['importe'];
        $gasto->descripcion = $datos['descripcion'];
        $gasto->item_id = $datos['item'];
        
        // guardar el registro
        $gasto->save();

        // armar el mensaje
        session()->flash('mensaje', 'El gasto se modificó correctamente');

        // redireccionar al usuario
        return redirect()->route('gastos.index');
    }

    public function render()
    {
        $items = Item::where('todos', '!=', 2)->get();
        return view('livewire.editar-gasto', [
            'items' => $items ]);
    }
}
