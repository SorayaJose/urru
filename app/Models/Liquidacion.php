<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    //protected $table = "liquidaciones";

    use HasFactory;

    protected $fillable = [
        'ur',
        'ipc',
        'fecha',
        'mes',
        'recibo_desde',
        'recibo_hasta',
        'fondo_servicio',
        'fondo_1',
        'fondo_2',
        'fondo_3',
        'fondo_4',
        'fondo_5',
        'fondo_cooperativo',
        'fondo_socorro',
        'reserva',
        'observaciones'
    ];
}
