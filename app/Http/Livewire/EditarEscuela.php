<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Escuela;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EditarEscuela extends Component
{
    public $escuela_id;
    public $nombre;
    public $slug;
    public $contacto;
    public $descripcion;
    public $user_id;
    public $escuela_email;
    public $escuela_clave;

    public function rules()
    {
        return [
            'nombre' => 'required|string',
            'contacto' => 'nullable',
            'descripcion' => 'nullable',
            'escuela_email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user_id),
            ],
            'escuela_clave' => 'nullable',
        ];
    }

    protected $messages = [
        'escuela_email.email' => 'El correo electrónico no es válido',
        'escuela_email.required' => 'El correo electrónico es obligatorio',
        'escuela_email.unique' => 'Este correo electrónico ya está registrado',
    ];
        
    public function mount(Escuela $escuela) {
        $this->escuela_id = $escuela->id;
        $this->nombre = $escuela->nombre;
        $this->contacto = $escuela->contacto;
        $this->descripcion = $escuela->descripcion;
        $user = User::where('rol', $escuela->id)->first();
        $this->user_id = $user->id;
        $this->escuela_email = $user->email;
    }

    public function editarEscuela() {
        //dd($this->rubro_id);
        $datos = $this->validate();

        // encontrar el rubro
        $escuela = Escuela::find($this->escuela_id);

        if ($escuela->nombre != $datos['nombre']) {
            $user = User::where('rol', $escuela->id)->first();
            $user->name  = $datos['nombre'];
            $user->save();
            //session()->flash('mensaje1', 'Se modificó el email de la escuela correctamente');
        }

        // asignar nuevos valores
        $escuela->nombre  = $datos['nombre'];
        $escuela->contacto  = $datos['contacto'];
        $escuela->slug = Str::slug($datos['nombre']);
        $escuela->descripcion = $datos['descripcion'];

        // modificó el email
        if ($escuela->email != $datos['escuela_email']) {
            $user = User::where('rol', $escuela->id)->first();
            $user->email  = $datos['escuela_email'];
            $user->save();
            //session()->flash('mensaje1', 'Se modificó el email de la escuela correctamente');
        }
        
        // modificó la clave
        if ($datos['escuela_clave'] != '') {
            $user = User::where('rol', $escuela->id)->first();
            $user->password  = Hash::make($datos['escuela_clave']);
            //session()->flash('mensaje2', 'Se modificó la clave de ingreso de la escuela correctamente');
            $user->save();
        }      

        // guardar el registro
        $escuela->save();

        // armar el mensaje
        session()->flash('mensaje', 'La escuela se modificó correctamente');

        // redireccionar al usuario
        return redirect()->route('escuelas.index');
    }

    public function render()
    {
        //dd($bancos);
        return view('livewire.editar-escuela');
    }
}
