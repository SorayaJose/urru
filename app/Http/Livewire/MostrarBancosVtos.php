<?php

namespace App\Http\Livewire;

use App\Models\Banco;
use Livewire\Component;
use App\Models\Vencimiento;
use Livewire\WithPagination;
//use App\Models\TmpVencimiento;

class MostrarBancosVtos extends Component
{
    protected $listeners = ['moverCosaABanco', 'resetear', 'eliminarCuenta', 'movimiento'];
    public $search;
    public $sort = "fecha";
    public $direction = "desc";
    public $cantidad = 10;
    public $readyToLoad = false;
    public $open = false;
    public $origen;
    public $importe;
    public $moneda;
    public $destino;

    protected $queryString = [
        'cantidad' => ['except' => 10]
    ];
    use WithPagination;

    public function reorder ($orderedIds) {
        dd($orderedIds);
    }

    public function movimiento() {
        //dd('Origen: ' . $this->origen . 'Destino: ' . $this->destino . ' Moneda:' . $this->moneda . ' Importe:' . $this->importe);
        if ($this->moneda == null) {
            $this->moneda = '$';
        }
        TmpVencimiento::create([
            'fecha' => now(),
            'moneda' => $this->moneda,
            'importe' => $this->importe,
            'concepto' => 'mov',
            'rubro_id' => 0,
            'tipo' => cache('modoSivezul'),
            'destino' => $this->origen,
            'banco_id' => $this->destino,
        ]);

        // crear un mensaje
        session()->flash('mensaje', 'El movimiento se publicó correctamente');

    }

    public function moverCosaABanco($vencimiento_id, $cuenta_id)
    {
        //dd('cosa: ' .$vencimiento_id .' y la cuenta ' . $cuenta_id);
        $vencimiento = Vencimiento::find($vencimiento_id);
        $vencimiento->cuenta_id = $cuenta_id;
        $vencimiento->save();
    }

    public function eliminarCuenta($vencimiento_id) {
        $vencimiento = Vencimiento::find($vencimiento_id);
        $vencimiento->cuenta_id = 0;
        $vencimiento->save();
    }

    public function resetear() {
        //dd('entro en resetear');
        $tipo = cache('modoSivezul');
        Vencimiento::where('tipo', $tipo)->update(['cuenta_id' => 0]);
    }
    public function render()
    {    
        $tipo = cache('modoSivezul');
        if($this->readyToLoad) {
            $bancos = Banco::where('tipo', $tipo)
            //->orwhere('moneda', $this->search)
            //->orderBy($this->sort, $this->direction)
            ->paginate($this->cantidad);

            $vencimientos = Vencimiento::where('tipo', $tipo)
            ->where('cuenta_id', 0)
            ->orderBy('fecha', 'asc')
            ->paginate($this->cantidad);
            //var_dump($bancos);

            $tmp_vencimientos = TmpVencimiento::where('tipo', $tipo)
            //->orwhere('moneda', $this->search)
            //->orderBy($this->sort, $this->direction)
            ->paginate($this->cantidad);
            //dd($tmps);
            //dd($tmp_vencimientos);
        } else {
            $bancos = [];
            $vencimientos = [];
            $tmp_vencimientos = [];
        }


        //$tmp_vencimientos = [1, 2, 3];
        //dd($tmp_vencimientos);
        return view('livewire.mostrar-bancos-vtos', compact('bancos', 'vencimientos', 'tmp_vencimientos'));   
    }

    public function loadRegistros() {
        $this->readyToLoad = true;
    }

    public function order($sort) {
        if ($this->sort == $sort) {
            if ($this->direction == "desc") {
                $this->direction = "asc";
            } else {
                $this->direction = "desc";
            }
        } else {
            $this->sort = $sort;
            $this->direction = "asc";
        }
    }
}

