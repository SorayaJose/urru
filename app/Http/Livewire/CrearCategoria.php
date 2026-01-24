<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categoria; 
use Illuminate\Support\Str;

class CrearCategoria extends Component
{
    public $nombre;
    public $tipo;

    protected $rules = [
        'nombre' => 'required|string',
        'tipo' => 'nullable',
    ];
    
    public function mount() {
        $this->nombre = "";
        $this->tipo = "";
    }

    public function crearCategoria() {
        $datos = $this->validate();

        //dd($datos);
        
        // crear el rubro
        Categoria::create([
            'nombre' => $datos['nombre'],
            'slug' => Str::slug($datos['nombre']),
            'tipo' => $datos['tipo']
        ]);

        // crear un mensaje
        session()->flash('mensaje', 'La categoría se publicó correctamente');

        // redireccionar al usuario
        return redirect()->route('categorias.index');
    }

    public function render()
    {
        //dd($tipo);

        return view('livewire.crear-categoria');
    }
}
