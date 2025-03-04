<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'mes',
        'estado',
        'debe',
        'haber',
        'total',
        'socio_id'
    ];

    public function socio() {
        return $this->belongsTo(Socio::class);
    }
}
