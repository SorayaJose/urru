<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Apartamento;
use App\Models\Item;

class CrearApartamento extends Component
{
    public $nombre;
    public $dormitorios;
    public $tipo;
    public $items = [];

    public $open = false;

    protected $rules = [
        'nombre' => 'required|string',
        'dormitorios' => 'required',
        'contador_ose' => 'numeric|nullable',
        'rubros' => 'nullable'
    ];

    public function crearApartamento() {
        $datos = $this->validate();

        // crear el apartamento
        
        $apartamento = Apartamento::create([
            'nombre' => $datos['nombre'],
            'dormitorios' => $datos['dormitorios'],
            'tipo' => $datos['tipo'],     
        ]);
        
        //echo "Rubros<br>";
        if ($datos['items'] != null) {
            $apartamento->items()->attach($datos['items']); //detach 
        }

        // crear un mensaje
        session()->flash('mensaje', 'El apartamente se publicó correctamente');

        //redireccionar al usuario
        return redirect()->route('apartamentos.index');
    }

    public function save()
    {
        dump($this->companies);
    }
    
    public function render()
    {
        $items = Item::where('todos', 0)->get();
        //dd($items);
        return view('livewire.crear-apartamento', [
            'items_base' => $items
        ]);
    }
}
