<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gasto extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha', 
        'importe', 
        'rubro_id', 
        'moneda', 
        'estado', 
        'socio_id',
        'descripcion'
    ];

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function socio() {
        return $this->belongsTo(Socio::class, 'socio_id');
    }

    public function mostrarFecha() {
        return Carbon::parse($this->fecha)->format('d-m-Y');
    }
}
