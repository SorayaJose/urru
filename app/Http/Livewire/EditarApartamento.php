<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;
use App\Models\Apartamento;

class EditarApartamento extends Component
{
    public $apartamento_id;
    public $nombre;
    public $dormitorios;
    public $tipo;
    public $items = [];
    public $items_origen = [];

    protected $rules = [
        'nombre' => 'required|string',
        'dormitorios' => 'required',
        'tipo' => 'numeric|nullable',
        'items' => 'nullable'
    ];

    public function mount(Apartamento $apartamento) {
        $this->apartamento_id = $apartamento->id;
        $this->nombre = $apartamento->nombre;
        $this->dormitorios = $apartamento->dormitorios;
        $this->tipo = $apartamento->tipo;
        $this->items_origen = $apartamento->items; 
    }

    
    public function editarApartamento() {
        $datos = $this->validate();
//        dd($datos['items']);

        // encontrar la vacante
        $apartamento = Apartamento::find($this->apartamento_id);

        // asignar nuevos valores
        $apartamento->nombre  = $datos['nombre'];
        $apartamento->dormitorios = $datos['dormitorios'];
        //$apartamento->contador_ose = $datos['contador_ose'];       
        
        //echo "items<br>";
        if ($datos['items'] != null) {
            $apartamento->items()->sync($datos['items']); 
        }
        
        // guardar la vacante
        $apartamento->save();

        // armar el mensaje
        session()->flash('mensaje', 'El apartamento se modificó correctamente');

        // redireccionar al usuario
        return redirect()->route('apartamentos.index');
    }
    
    public function render() {
        $items = Item::where('todos', 0)->get();

        return view('livewire.editar-apartamento', [
            'items_base' => $items
        ]);
    }
}

