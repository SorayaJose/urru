<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'fecha',
        'fecha_cierre',
        'descripcion',
        'imagen',
        'pista_id',
        'escuela_id', 
        'tipo'
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'fecha_cierre' => 'datetime',
    ];
    
    public function mostrarTipo() {
        if ($this->tipo == "F") {
            return "Formativas";
        } elseif ($this->tipo == "D") {
            return "Federal";
        } 
        return "-";
    }
    
    public function pista()
    {
        return $this->belongsTo(Pista::class);
    }

    public function escuela()
    {
        return $this->belongsTo(Escuela::class);
    }
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class);
    }

    public function escuelas()
    {
        return $this->belongsToMany(Escuela::class);
    }

    public function checkInscripcion($escuela) {
        return $this->escuelas->contains('escuela_id', $escuela);
    }
}
