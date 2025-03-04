<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $table = "locales";
    
    use HasFactory;

    protected $fillable = [
        'moneda',
        'alquiler',
        'contrato_desde',
        'contrato_hasta',
        'recargo',
        'garantia',
        'direccion',
        'clase',
        'persona_id'
    ];

    public function persona() {
        return $this->belongsTo(Persona::class);
    }

    public function esActivo() {
        if ($this->activo == true) {
            return "Activo";
        }
        return "No está activo";
    }
}