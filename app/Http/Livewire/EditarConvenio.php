<?php

namespace App\Http\Livewire;

use App\Models\Rubro;
use Livewire\Component;
use App\Models\Convenio;
use Illuminate\Support\Carbon;

class EditarConvenio extends Component
{
    public $convenio_id;
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
        'total' => 'required|nullable',
        'pagas' => 'required|numeric',
        'observaciones' => 'nullable|string',
        'rubro' => 'required' 
    ];

    public function mount(Convenio $convenio) {
        $this->convenio_id = $convenio->id;
        $this->socio_id = $convenio->socio->id;
        if ($convenio->fecha != '0000-00-00')
            $this->fecha = Carbon::parse($convenio->fecha)->format('Y-m-d');
        $this->estado = $convenio->estado;
        $this->cuotas = $convenio->cuotas;
        $this->valor = $convenio->valor;
        $this->total = $convenio->total;
        $this->pagas = $convenio->pagas;
        $this->observaciones = $convenio->observaciones;
        $this->rubro = $convenio->rubro_id;

    }

    public function editarConvenio() {
        //dd($this->persona_id);
        $datos = $this->validate();

        // encontrar el convenio
        $convenio = Convenio::find($this->convenio_id);
        
        // asignar nuevos valores       
        $convenio->fecha = $datos['fecha'];
        $convenio->estado = $datos['estado'];
        $convenio->cuotas = $datos['cuotas'];
        $convenio->valor = $datos['valor'];
        $convenio->total = $datos['total'];
        $convenio->pagas = $datos['pagas'];
        $convenio->observaciones = $datos['observaciones'];
        $convenio->socio_id = $this->socio_id;
        $convenio->rubro_id = $datos['rubro']; 
        
        // guardar la pesona
        $convenio->save();

        // armar el mensaje
        session()->flash('mensaje', 'El convenio se modificó correctamente');

        // redireccionar al usuario
        return redirect()->route('convenios.index');
    }
   
    public function render()
    {
        $rubros = Rubro::where('todos', 2)->get();
        return view('livewire.editar-convenio', [
            'rubros' => $rubros ]);
    }
}
