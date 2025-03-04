<?php

namespace App\Http\Livewire;

use App\Models\Gasto;
use App\Models\Item;
use App\Models\Socio;
use Livewire\Component;

class CrearGastoIna extends Component
{
    public $socios_formulario = [];
    public $fecha;
    public $item;
    public $descripcion;

    protected $rules = [
        'fecha' => 'required|date',
        'descripcion' => 'nullable|string',
        'socios_formulario' => 'nullable',
        'item' => 'required'
    ];

    public function crearGastoIna() {
        $datos = $this->validate();

        $importe = 100;
        
        if ($datos['socios_formulario'] != null) {
            foreach($datos['socios_formulario'] as $socio) {
                Gasto::create([
                    'fecha' => $datos['fecha'],
                    'estado' => 0,
                    'importe' => $importe,
                    'moneda' => '$',
                    'descripcion' => $datos['descripcion'],
                    'item_id' => $datos['item'],
                    'socio_id' => $socio  
                ]);
        
            }
        }

        //dd($datos);
        // crear un mensaje
        session()->flash('mensaje', 'Se cargaron los gastos masivos correctamente');

        //redireccionar al usuario
        return redirect()->route('gastos.index');
    }

    public function render()
    {
        $socios = Socio::where('socios.activo', true)
        ->join('personas', 'socios.persona_id', '=', 'personas.id')
        ->join('apartamentos', 'personas.apartamento_id', '=', 'apartamentos.id')
        ->select('socios.id as id', 'socios.persona_id as persona', 'personas.nombre as nombre', 'apartamentos.nombre as apartamento')
        ->orderBy('apartamentos.nombre')
        ->get();
        $items = Item::where('todos', '=', 3)->get();
        return view('livewire.crear-gasto-ina', [
            'socios' => $socios,
            'items' => $items
        ]);
    }
}
