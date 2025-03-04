<?php

namespace App\Http\Livewire;

use App\Models\Persona;
use Livewire\Component;
use App\Models\Apartamento;
use Illuminate\Support\Carbon;

class EditarPersona extends Component
{
    public $persona_id;
    public $nombre;
    public $sexo;
    public $cedula;
    public $nacimiento;
    public $telefono;
    public $email;
    //public $jubilado;
    public $relacion;
    public $apartamento;

    protected $rules = [
        'nombre' => 'required|string',
        'sexo' => 'nullable',
        'cedula' => 'numeric|nullable',
        'nacimiento' => 'date|nullable',
        'telefono' => 'nullable',
        'email' => 'nullable|email',
        //'email' => 'nullable|email|unique:personas,email,'.$persona_id,
        //'jubilado' => 'nullable',
        'relacion' => 'nullable|numeric',
        'apartamento' => 'exists:apartamentos,nombre',
    ];

    public function mount(Persona $persona) {
        $this->persona_id = $persona->id;
        $this->nombre = $persona->nombre;
        $this->sexo = $persona->sexo;
        $this->cedula = $persona->cedula;
        if ($persona->nacimiento != '0000-00-00')
            $this->nacimiento = Carbon::parse($persona->nacimiento)->format('Y-m-d');
        $this->telefono = $persona->telefono;
        $this->email = $persona->email;
        //$this->jubilado = $persona->jubilado;
        $this->relacion = $persona->relacion;
        $this->apartamento = $persona->apartamento->nombre;
    }

    
    public function editarPersona() {
        //dd($this->persona_id);
        $datos = $this->validate();

        // encontrar la persona
        $persona = Persona::find($this->persona_id);

        $apartamento = Apartamento::where('nombre', $datos['apartamento'])->first();
        $datos['apartamento'] = $apartamento->id;

        // asignar nuevos valores
        $persona->nombre  = $datos['nombre'];
        $persona->sexo = $datos['sexo'];
        $persona->cedula = $datos['cedula'];
        $persona->nacimiento = $datos['nacimiento'];
        $persona->telefono = $datos['telefono'];
        $persona->email = $datos['email'];
        //$persona->jubilado = $datos['jubilado'];
        $persona->relacion = $datos['relacion'];
        $persona->apartamento_id = $datos['apartamento']; 
        
        // guardar la pesona
        $persona->save();

        // armar el mensaje
        session()->flash('mensaje', 'La persona se modificó correctamente');

        // redireccionar al usuario
        return redirect()->route('personas.index');
    }
    
    public function render() {

        return view('livewire.editar-persona');
    }
}

