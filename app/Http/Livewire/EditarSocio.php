<?php

namespace App\Http\Livewire;

use App\Models\Socio;
use App\Models\Persona;
use Livewire\Component;
use App\Models\Apartamento;

class EditarSocio extends Component
{
    public $socio_id;
    public $capital;
    public $cochera;
    public $luz_cochera;
    public $moto;
    public $bici;
    public $biblioteca;
    public $activo;
    public $persona;

    protected $rules = [
        'capital' => 'nullable',
        'cochera' => 'nullable',
        'luz_cochera' => 'nullable',
        'moto' => 'numeric|nullable',
        'bici' => 'numeric|nullable',
        'activo' => 'nullable',
        'biblioteca' => 'numeric|nullable',        
        //'persona' => 'exists:personas,nombre' //unique:apartamento 
    ];

    public function mount(Socio $socio)
    {       
        $this->socio_id = $socio->id;
//        $this->persona = $socio->persona->nombre;
        $this->capital = $socio->capital;
        $this->cochera = $socio->cochera;
        $this->luz_cochera = $socio->luz_cochera;
        $this->moto = $socio->moto;
        $this->bici = $socio->bici;
        //$this->subvencionado = $socio->subvencionado;

        $this->biblioteca = $socio->biblioteca;
        $this->activo = $socio->activo;
    }


    public function editarSocio()
    {
        //dd($this->socio_id);
        $datos = $this->validate();

        // encontrar la persona
        $socio = Socio::find($this->socio_id);

        //$apartamento = Apartamento::where('nombre', $datos['apartamento'])->first();
        //$datos['apartamento'] = $apartamento->id;

        // validar que el apartamento tenga un titular. 
        //$persona = Persona::where('apartamento_id', $apartamento->id)
        //             ->where('relacion', 1)->first();
        /*
        if ($persona === null) {
            session()->flash('error', 'El apartamento no tiene un titular asociado.');
            //dd($apartamento);
            return redirect()->route('socios.edit', $socio->id);
        }
        */

        // asignar nuevos valores
        $socio->capital = $datos['capital'];
        $socio->cochera = $datos['cochera'];
        $socio->luz_cochera = $datos['luz_cochera'];
        $socio->moto = $datos['moto'];
        $socio->bici = $datos['bici'];
        $socio->biblioteca = $datos['biblioteca'];
        $socio->activo = $datos['activo'];
        //$socio->persona_id = $persona->id;

        // guardar la pesona
        $socio->save();

        // armar el mensaje
        session()->flash('mensaje', 'El socio se modificó correctamente');

        // redireccionar al usuario
        return redirect()->route('socios.index');
    }

    public function render()
    {
        return view('livewire.editar-socio');
    }
}
