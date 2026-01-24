<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banco extends Model
{
    use HasFactory;
    private $saldo;
    private $color = "blue";

    protected $fillable = [
        'nombre',
        'tipo',
        'moneda',
        'numero'
    ];

    public function cuentas() {
        return $this->hasMany(Cuenta::class)->orderBy('moneda', 'DESC');
    }

    public function buscarSaldo() {
        $saldos = DB::table('saldos as s')
        ->join('cuentas as c', 'c.id', '=', 's.cuenta_id')
        ->where('c.banco_id', $this->id)
        ->select('s.importe as importe', 'c.moneda as moneda', 'c.id as cuenta_id')
        ->get();
        $this->color = "blue";
        foreach($saldos as $saldo) {
            //dd($saldos);
            // buscar todos los vencimientos marcados para pagar
            $sumaPesos = Vencimiento::where('cuenta_id', $saldo->cuenta_id)
            ->where('moneda', '$')
            ->sum('importe');
            $sumaDolares = Vencimiento::where('cuenta_id', $saldo->cuenta_id)
            ->where('moneda', 'U$S')
            ->sum('importe');
            if ($saldo->moneda == '$') {
                $saldo->importe -= $sumaPesos;
                if ($sumaDolares != 0) {
                    $saldo->importe -= $this->pasoAPesos($sumaDolares);
                }
            } else {
                $saldo->importe -= $sumaDolares;
                if ($sumaPesos != 0) {
                    $saldo->importe -= $this->pasoADolares($sumaPesos);
                }
            }
            // buscar todos los movimientos
            if ($saldo->moneda == '$') {
                $sumaPesos = TmpVencimiento::where('banco_id', $this->id)
                ->where('moneda', '$')
                ->sum('importe');
                $sumaDolares = TmpVencimiento::where('destino', $this->id)
                ->where('moneda', '$')
                ->sum('importe');
                if ($saldo->moneda == '$') {
                    $saldo->importe -= $sumaPesos;
                    if ($sumaDolares != 0) {
                        $saldo->importe -= $this->pasoAPesos($sumaDolares);
                    }
                } else {
                    $saldo->importe -= $sumaDolares;
                    if ($sumaPesos != 0) {
                        $saldo->importe -= $this->pasoADolares($sumaPesos);
                    }
                }
            } else {
                $sumaPesos = TmpVencimiento::where('banco_id', $this->id)
                ->where('moneda', 'U$S')
                ->sum('importe');
                $sumaDolares = TmpVencimiento::where('destino', $this->id)
                ->where('moneda', 'U$S')
                ->sum('importe');
                if ($saldo->moneda == '$') {
                    $saldo->importe -= $sumaPesos;
                    if ($sumaDolares != 0) {
                        $saldo->importe -= $this->pasoAPesos($sumaDolares);
                    }
                } else {
                    $saldo->importe -= $sumaDolares;
                    if ($sumaPesos != 0) {
                        $saldo->importe -= $this->pasoADolares($sumaPesos);
                    }
                }

            }
        }
        return;
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

    public function color() {
        return $this->color;
    }

    public function mostrarSaldo() {
        $this->saldo = $this->saldo();
        return $this->moneda . ' ' . number_format($this->saldo, 2, ',', '.');;
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
