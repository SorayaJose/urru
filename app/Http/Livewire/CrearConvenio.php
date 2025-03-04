<?php

namespace App\Http\Livewire;

use App\Models\Rubro;
use App\Models\Socio;
use Livewire\Component;
use App\Models\Convenio;

class CrearConvenio extends Component
{
    public $fecha;
    public $estado;
    public $cuotas;
    public $valor;
    public $total;
    public $pagas;
    public $socio_id;
    public $rubro;
    public $observaciones;

    protected $rules = [
        'fecha' => 'required|date',
        'estado' => 'numeric|nullable',
        'cuotas' => 'required|numeric',
        'valor' => 'required|numeric',
        'total' => 'required|numeric',
        'pagas' => 'required|numeric',
        'observaciones' => 'nullable|string',
        'rubro' => 'required' 
    ];

    public function mount($socio) {
        $this->socio_id = $socio;
    }

    public function crearConvenio() {
        $datos = $this->validate();

        //dd($this->socio_id);
          
        //$apartamento = Apartamento::where('nombre', $datos['apartamento'])->first();
        //$datos['apartamento'] = $apartamento->id;
        
        
        // crear la personas
        Convenio::create([
            'fecha' => $datos['fecha'],
            'estado' => 0,
            'cuotas' => $datos['cuotas'],
            'valor' => $datos['valor'],
            'total' => $datos['total'],
            'pagas' => $datos['pagas'],
            'observaciones' => $datos['observaciones'],
            'socio_id' => $this->socio_id,
            'rubro_id' => $datos['rubro'], 
        ]);

        // crear un mensaje
        session()->flash('mensaje', 'El convenio se publicó correctamente');

        // redireccionar al usuario
        return redirect()->route('convenios.index');
    }

    public function render()
    {
        $socio = Socio::find($this->socio_id);
        //dd(">".$this->socio_id."-");
        $rubros = Rubro::where('todos', 2)->get();
        
        return view('livewire.crear-convenio', [
            'socio' => $socio,
            'rubros' => $rubros ]);
    }
}
