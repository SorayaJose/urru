<?php

namespace App\Http\Livewire;

use App\Models\Parametro;
use Livewire\Component;

class EditarParametro extends Component
{
    public $parametro_id;
    public $ipc;
    public $ur;
    public $ur_anterior;
    public $dorm_1;
    public $dorm_2;
    public $dorm_3;
    public $dorm_4;
    public $dorm_5;
    public $valor_auto;
    public $valor_moto;
    public $valor_bici;
    public $mensaje_recibo;
    public $fondo_servicio;
    public $fondo_1;
    public $fondo_2;
    public $fondo_3;
    public $fondo_4;
    public $fondo_5;
    public $fondo_cooperativo;
    public $fondo_socorro;
    public $reserva;
    public $valor_inasistencia;


    protected $rules = [
        'ipc' => 'numeric|required',
        'ur' => 'numeric|required',
        'ur_anterior' => 'numeric|required',        
        'dorm_1' => 'numeric|required',
        'dorm_2' => 'numeric|required',
        'dorm_3' => 'numeric|required', 
        'dorm_4' => 'numeric|required', 
        'dorm_5' => 'numeric|required',   
        'valor_auto' => 'numeric|required',   
        'valor_moto' => 'numeric|required',   
        'valor_bici' => 'numeric|required',   
        'mensaje_recibo' => 'nullable',   
        'fondo_servicio' => 'numeric|required',
        'fondo_1' => 'numeric|required',
        'fondo_2' => 'numeric|required',
        'fondo_3' => 'numeric|required',
        'fondo_4' => 'numeric|required',
        'fondo_5' => 'numeric|required',
        'fondo_cooperativo' => 'numeric|required',
        'fondo_socorro' => 'numeric|required',
        'reserva' => 'numeric|required',
        'valor_inasistencia' => 'numeric|required',
    ];
    
    public function mount(Parametro $parametro) {
        $this->parametro_id = $parametro->id;
        $this->ipc = $parametro->ipc;
        $this->ur = $parametro->ur;
        $this->ur_anterior = $parametro->ur_anterior;
        $this->dorm_1 = $parametro->dorm_1;
        $this->dorm_2 = $parametro->dorm_2;
        $this->dorm_3 = $parametro->dorm_3;
        $this->dorm_4 = $parametro->dorm_4;
        $this->dorm_5 = $parametro->dorm_5;
        $this->valor_auto = $parametro->valor_auto;
        $this->valor_moto = $parametro->valor_moto;
        $this->valor_bici = $parametro->valor_bici;
        $this->mensaje_recibo = $parametro->mensaje_recibo;
        $this->fondo_servicio = $parametro->fondo_servicio;
        $this->fondo_1 = $parametro->fondo_1;
        $this->fondo_2 = $parametro->fondo_2;
        $this->fondo_3 = $parametro->fondo_3;
        $this->fondo_4 = $parametro->fondo_4;
        $this->fondo_5 = $parametro->fondo_5;
        $this->fondo_cooperativo = $parametro->fondo_cooperativo;
        $this->fondo_socorro = $parametro->fondo_socorro;
        $this->reserva = $parametro->reserva;
        $this->valor_inasistencia = $parametro->valor_inasistencia;
    }

    public function editarParametro() {
        //dd($this->parametro);
        $datos = $this->validate();

        // encontrar la persona
        $parametro = Parametro::find($this->parametro_id);

        // asignar nuevos valores
        $parametro->ipc  = $datos['ipc'];
        $parametro->ur = $datos['ur'];
        $parametro->ur_anterior = $datos['ur_anterior'];
        $parametro->dorm_1 = $datos['dorm_1'];
        $parametro->dorm_2 = $datos['dorm_2'];
        $parametro->dorm_3 = $datos['dorm_3'];
        $parametro->dorm_4 = $datos['dorm_4'];
        $parametro->dorm_5 = $datos['dorm_5'];
        $parametro->valor_auto = $datos['valor_auto'];
        $parametro->valor_moto = $datos['valor_moto'];
        $parametro->valor_bici = $datos['valor_bici'];
        $parametro->mensaje_recibo = $datos['mensaje_recibo'];
        $parametro->fondo_servicio = $datos['fondo_servicio'];
        $parametro->fondo_1 = $datos['fondo_1'];
        $parametro->fondo_2 = $datos['fondo_2'];
        $parametro->fondo_3 = $datos['fondo_3'];
        $parametro->fondo_4 = $datos['fondo_4'];
        $parametro->fondo_5 = $datos['fondo_5'];
        $parametro->fondo_cooperativo = $datos['fondo_cooperativo'];
        $parametro->fondo_socorro = $datos['fondo_socorro'];
        $parametro->reserva = $datos['reserva']; 
        $parametro->valor_inasistencia =  $datos['valor_inasistencia']; 
        
        // guardar el registro
        $parametro->save();

        // armar el mensaje
        session()->flash('mensaje', 'Los parámetros se modificaron correctamente');

        // redireccionar al usuario
        return redirect()->route('parametros.index');
    }

    public function render()
    {
        return view('livewire.editar-parametro');
    }
}
