<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categoria;
use App\Models\Patinador;

class EditarPatinador extends Component
{
    public $patinador_id;
    public $nombre;
    public $categoria;
    public $descripcion;
    public $user_id;

    public function rules()
    {
        return [
            'nombre' => 'required|string',
            'descripcion' => 'nullable',
            'categoria' => 'nullable',
        ];
    }
        
    public function mount(Patinador $patinador) {
        $this->patinador_id = $patinador->id;
        $this->nombre = $patinador->nombre;
        $this->descripcion = $patinador->descripcion;
        $this->categoria = $patinador->categoria_id;
    }

    public function editarPatinador() {
        //dd($this->rubro_id);
        $datos = $this->validate();

        // encontrar el rubro
        $patinador = Patinador::find($this->patinador_id);

        // asignar nuevos valores
        $patinador->nombre  = $datos['nombre'];
        $patinador->categoria_id  = $datos['categoria'];
        $patinador->descripcion = $datos['descripcion'];   

        // guardar el registro
        $patinador->save();

        // armar el mensaje
        session()->flash('mensaje', 'El patinador se modificó correctamente');

        // redireccionar al usuario
        return redirect()->route('patinadores.index');
    }

    public function render()
    {
        //dd($bancos);
        $categorias = Categoria::all();
        $patinador = Patinador::find($this->patinador_id);
        $inscripciones = $patinador->inscripciones;
        
        return view('livewire.editar-patinador', [
            'categorias' => $categorias,
            'inscripciones' => $inscripciones
        ]);
    }
}
