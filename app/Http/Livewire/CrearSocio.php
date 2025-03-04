<?php

namespace App\Http\Livewire;

use App\Models\Socio;
use App\Models\Persona;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Apartamento;

class CrearSocio extends Component
{
    public $capital;
    public $cochera;
    public $luz_cochera;
    public $moto;
    public $bici;
    public $biblioteca;
    public $persona;
    public $activo;

    protected $rules = [
        'capital' => 'nullable',
        'cochera' => 'nullable',
        'luz_cochera' => 'nullable',
        'moto' => 'numeric|nullable',
        'bici' => 'numeric|nullable',
        'activo' => 'nullable',
        'biblioteca' => 'numeric|nullable', 
        'persona' => 'exists:personas,cedula' //unique:apartamento     
    ];

    public function crearSocio() {
        $datos = $this->validate();

        //dd($datos);
        
        //$apartamento = Apartamento::where('nombre', $datos['apartamento'])->first();
        //$datos['apartamento'] = $apartamento->id;

        // PENDIENTE traer a medida que va ingresando el nombre los posibles apartamentos y personas
        $persona = Persona::where('cedula', $datos['persona'])->first();
        $datos['persona'] = $persona->id;        
        
        // crear la personas
        Socio::create([
            'capital' => $datos['capital'],
            //'cuota_convenio' => $datos['cuota_convenio'],
            //'imm_convenio' => $datos['imm_convenio'],
            //'imm_cuotas' => $datos['imm_cuotas'],
            //'total_convenio_vs' => $datos['total_convenio_vs'],
            //'cuota_convenio_vs' => $datos['cuota_convenio_vs'],
    
            'cochera' => $datos['cochera'],
            'luz_cochera' => $datos['luz_cochera'],
            'moto' => $datos['moto'],
            'bici' => $datos['bici'],
            //'mora_convenio' => $datos['mora_convenio'],
            //'subvencionado' => $datos['subvencionado'],
    
            'biblioteca' => $datos['biblioteca'],
            //'moneda_biblioteca' => $datos['moneda_biblioteca'],
            
            'activo' => $datos['activo'],
            'persona_id' => $datos['persona']
        ]);

        // OJO FALTA validar que el apto no tenga ya otro socio
        
        // crear un mensaje
        session()->flash('mensaje', 'El socio se publicó correctamente');

        // redireccionar al usuario
        return redirect()->route('socios.index');
    }

    public function render()
    {
        return view('livewire.crear-socio');
    }
}
