<?php

namespace App\Http\Livewire;

use App\Models\Parametro;
use Livewire\Component;

class CrearParametro extends Component
{
    public $ipc;
    public $ur;
    public $ur_anterior;
    public $dorm_1;
    public $dorm_2;
    public $dorm_3;
    public $dorm_4;
    public $dorm_5;

    protected $rules = [
        'ipc' => 'numeric|required',
        'ur' => 'numeric|required',
        'ur_anterior' => 'numeric|required',        
        'dorm_1' => 'numeric|required',
        'dorm_2' => 'numeric|required',
        'dorm_3' => 'numeric|required', 
        'dorm_4' => 'numeric|required', 
        'dorm_5' => 'numeric|required',   
    ];
    
    public function mount() {
        $this->ipc = 1;
        $this->ur = 1;
        $this->ur_anterior = 1;
        $this->dorm_1 = 1;
        $this->dorm_2 = 1;
        $this->dorm_3 = 1;
        $this->dorm_4 = 1;
        $this->dorm_5 = 1;
    }

    public function crearParametro() {
        $datos = $this->validate();

        //dd($datos);
        
        // crear el parametro
        Parametro::create([
            'ipc' => $datos['ipc'],
            'ur' => $datos['ur'],
            'ur_anterior' => $datos['ur_anterior'],
            'dorm_1' => $datos['dorm_1'],
            'dorm_2' => $datos['dorm_2'],
            'dorm_3' => $datos['dorm_3'],
            'dorm_4' => $datos['dorm_4'],
            'dorm_5' => $datos['dorm_5'],     
        ]);

        // crear un mensaje
        session()->flash('mensaje', 'Los parametros se publicaron correctamente');

        // redireccionar al usuario
        return redirect()->route('parametros.index');
    }

    public function render()
    {
        return view('livewire.crear-parametros');
    }
}
