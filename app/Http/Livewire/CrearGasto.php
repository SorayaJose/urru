<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Gasto;
use App\Models\Rubro;
use Livewire\Component;

class CrearGasto extends Component
{
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
    
    public function mount() {
        $this->moneda = '$';
    }

    public function crearGasto() {
        $datos = $this->validate();

        //dd($datos);
        
        // crear el gasto
        Gasto::create([
            'fecha' => $datos['fecha'],
            'estado' => 0,
            'importe' => $datos['importe'],
            'moneda' => $datos['moneda'],
            'descripcion' => $datos['descripcion'],
            'item_id' => $datos['item']  
        ]);

        // crear un mensaje
        session()->flash('mensaje', 'El gasto se publicó correctamente');

        // redireccionar al usuario
        return redirect()->route('gastos.index');
    }

    public function render()
    {
        $items = Item::where('todos', '<', 2)->get();
        return view('livewire.crear-gasto', [
            'items' => $items
        ]);
    }
}

