<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Switch_;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'sexo',
        'cedula',
        'nacimiento',
        'telefono',
        'email',
        'jubilado',
        'relacion',
        'apartamento_id'
    ];

    public function apartamento() {
        return $this->belongsTo(Apartamento::class);
    }
    
    public function muestroRelacion() {
        switch ($this->relacion) {
            case 1: return "Titular"; break;
            case 2: return "Esposo/a"; break;
            case 3: return "Concubino/a"; break;
            case 4: return "Hermano/a"; break;
            case 5: return "Hijo/a"; break;
            case 6: return "Padre/madre"; break;
            case 7: return "Inquilino/a"; break;
            case 8: return "Representante"; break;
            case 9: return "Otro"; break;                                                  
        }
        return "-";
    }
}
