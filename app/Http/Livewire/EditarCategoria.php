<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categoria;
use Illuminate\Support\Str;

class EditarCategoria extends Component
{
    public $categoria_id;
    public $nombre;
    public $tipo;

    protected $rules = [
        'nombre' => 'required|string',
        'tipo' => 'nullable'
    ];
  
    public function mount(Categoria $categoria) {
        $this->categoria_id = $categoria->id;
        $this->nombre = $categoria->nombre;
        $this->tipo = $categoria->tipo;
    }

    public function editarCategoria() {
        //dd($this->categoria_id);
        $datos = $this->validate();

        // encontrar la categoria
        $categoria = Categoria::find($this->categoria_id);

        // asignar nuevos valores
        $categoria->nombre = $datos['nombre'];
        $categoria->slug = Str::slug($datos['nombre']);
        $categoria->tipo = $datos['tipo'];
        
        // guardar el registro
        $categoria->save();

        // armar el mensaje
        session()->flash('mensaje', 'La categoría se modificó correctamente');

        // redireccionar al usuario
        return redirect()->route('categorias.index');
    }

    public function render()
    {
        return view('livewire.editar-categoria');
    }
}
