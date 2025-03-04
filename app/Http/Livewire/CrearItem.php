<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;

class CrearItem extends Component
{
    public $nombre;
    public $todos;
    public $moneda;
    public $mostrar;
    public $cantidad;

    protected $rules = [
        'nombre' => 'required|string',
        'todos' => 'nullable',
        'moneda' => 'nullable',        
        'mostrar' => 'nullable',
        'cantidad' => 'numeric|nullable'
    ];
    
    public function mount() {
        $this->todos = 1;
        $this->moneda = '$';
        $this->mostrar = 1;
    }

    public function crearItem() {
        $datos = $this->validate();

        //dd($datos);
        
        // crear el item
        Item::create([
            'nombre' => $datos['nombre'],
            'mostrar' => $datos['mostrar'],
            'todos' => $datos['todos'],
            'moneda' => $datos['moneda'],
            'cantidad' => $datos['cantidad']     
        ]);

        // crear un mensaje
        session()->flash('mensaje', 'El item se publicó correctamente');

        // redireccionar al usuario
        return redirect()->route('items.index');
    }

    public function render()
    {
        return view('livewire.crear-item');
    }
}
