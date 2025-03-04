<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    use HasFactory;

    protected $fillable = [
        'ur',
        'ipc',
        'ur_anterior',
        'dorm_1',
        'dorm_2',
        'dorm_3',
        'dorm_4',
        'dorm_5',
        'valor_auto',
        'valor_moto',
        'valor_bici',
        'mensaje_recibo',
        'fondo_servicio',
        'fondo_1',
        'fondo_2',
        'fondo_3',
        'fondo_4',
        'fondo_5',
        'fondo_cooperativo',
        'fondo_socorro',
        'reserva',
        'valor_inasistencia'
    ];
}
