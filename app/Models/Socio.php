<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    use HasFactory;

    protected $fillable = [
        'capital',
        'cochera',
        'luz_cochera',
        'moto',
        'bici',
        'activo',
        'biblioteca',
        'auxiliar',
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

    public function convenios() {     
        return $this->hasMany(Convenio::class)->orderBy('created_at', 'DESC');
    }

    public function recibos() {     
        return $this->hasMany(Recibo::class)->orderBy('created_at', 'DESC');
    }
}
