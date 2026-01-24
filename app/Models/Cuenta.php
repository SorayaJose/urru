<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cuenta extends Model
{
    use HasFactory;
    private $saldo;
    private $color = "blue";

    protected $fillable = [
        'banco_id',
        'tipo',
        'moneda',
        'saldo',
        'saldo_tmp',
        'numero'
    ];

    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }

    public function vencimientos() {     
        return $this->hasMany(Vencimiento::class)->orderBy('created_at', 'DESC');
    }
    
    public function buscarSaldo() {
        $importe = 0;

        $this->saldo = Saldo::where('cuenta_id', $this->id)
        ->whereDate('fecha', '<=', Carbon::today())
        ->orderBy('fecha', 'desc')
        ->value('importe') ?? 0;

        $sumaPesos = Vencimiento::where('cuenta_id', $this->id)
        ->where('moneda', '$')
        ->sum('importe');

        $sumaDolares = Vencimiento::where('cuenta_id', $this->id)
        ->where('moneda', 'U$S')
        ->sum('importe');

        if ($this->moneda == '$') {
            $this->saldo -= $sumaPesos;
            if ($sumaDolares != 0) {
                $this->saldo -= $this->pasoAPesos($sumaDolares);
            }
        } else {
            $this->saldo -= $sumaDolares;
            if ($sumaPesos != 0) {
                $this->saldo -= $this->pasoADolares($sumaPesos);
            }
        }
        
        if ($this->saldo < 0) {
            $this->color = "red";
        }
        if ($this->saldo > 0) {
            if ($this->color != 'red') {
                $this->color = "green";
            }
        } 

        return;
    }

    public function buscarSaldoDebug() {
        $salida = '';
        $importe = 0;

        $this->saldo = Saldo::where('cuenta_id', $this->id)
        ->whereDate('fecha', '<=', Carbon::today())
        ->orderBy('fecha', 'desc')
        ->value('importe') ?? 0;

        $salida .= 'Saldo en DB: ' . $this->saldo;
        $sumaPesos = Vencimiento::where('cuenta_id', $this->id)
        ->where('moneda', '$')
        ->sum('importe');

        $sumaDolares = Vencimiento::where('cuenta_id', $this->id)
        ->where('moneda', 'U$S')
        ->sum('importe');

        $salida .= '<br> Vencimientos en $: ' . $sumaPesos;
        $salida .= '<br> Vencimientos en U$: ' . $sumaDolares;

        if ($this->moneda == '$') {
            $this->saldo -= $sumaPesos;
            if ($sumaDolares != 0) {
                $tmp = $this->pasoAPesos($sumaDolares);
                $this->saldo -= $tmp;
                $salida .= '<br> temp $: ' . $tmp;
            }
            $salida .= '<br> Nuevo saldo en $: ' . $this->saldo;
        } else {
            $this->saldo -= $sumaDolares;
            if ($sumaPesos != 0) {
                $tmp = $this->pasoADolares($sumaPesos);
                $this->saldo -= $tmp;
                $salida .= '<br> temp $: ' . $tmp;
            }
            $salida .= '<br> Nuevo saldo en $: ' . $this->saldo;
        }
        
        $salida .= '<br> Final: ' . $this->saldo;
        if ($this->saldo < 0) {
            $this->color = "red";
        }
        if ($this->saldo > 0) {
            if ($this->color != 'red') {
                $this->color = "green";
            }
        } 
        return $salida;
    }

    public function buscarVencimientos() {
        //if (!$this->banco_id) {
        //    return collect(); // o throw new \Exception('Falta banco_id');
        // }
        //$vencimientos = Vencimiento::whereHas('cuenta', function ($q) {
        //    $q->where('banco_id', $this->banco_id);
        //})->get();
        return 0; //$vencimientos;
    }

    public function saldo() {
        return $this->saldo;
    }


    public function color() {
        return $this->color;
    }

    public function tmpPago() {
        return $this->hasMany(TmpPago::class);
    }

    public function pasoAPesos($importe) {
        $dolar = Dolar::whereDate('fecha', '<=', Carbon::today())
        ->orderBy('fecha', 'desc')
        ->orderBy('id', 'desc')
        ->first();
        return $importe * $dolar->brou;
    }

    public function pasoADolares($importe) {
        $dolar = Dolar::whereDate('fecha', '<=', Carbon::today())
        ->orderBy('fecha', 'desc')
        ->orderBy('id', 'desc')
        ->first();
        return $importe / $dolar->brou;
    }


    public function mostrarSaldoHome() {
        //$this->saldo = $this->saldo();
        //$suma = TuModelo::where('cuenta_id', $cuentaId)
        //        ->where('moneda', $moneda)
        //        ->sum('importe');
        return $this->moneda . ' ' . number_format($this->saldo, 2, ',', '.');
    }

    public function buscarMostrarSaldo() {
        //$this->saldo = $this->saldo();
        $this->buscarSaldo();
        return $this->moneda . ' ' . number_format($this->saldo, 2, ',', '.');
    }

    public function mostrarTipoTexto() {
        if ($this->tipo == 'P') {
            return "Personal";
        } elseif ($this->tipo == 'S') {
            return "Sivezul";
        } 
        return "-";
    }
}
