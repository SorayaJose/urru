<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripto extends Model
{
    use HasFactory;
    protected $table = "patinador_torneo";

    protected $fillable = [
        'cancion', 'cancion2', 'archivo', 'archivo2', 
        'cancion_nombre_original', 'cancion2_nombre_original', 
        'archivo_nombre_original', 'archivo2_nombre_original',
        'torneo_id', 'escuela_id', 'patinador_id', 'categoria_id',
        'duracion', 'duracion_larga'
    ];

    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }

    public function escuela()
    {
        return $this->belongsTo(Escuela::class);
    }


    public function patinador()
    {
        return $this->belongsTo(Patinador::class);
    }
    
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Verificar si el inscripto tiene todos los archivos requeridos
    public function archivosCargadosCompletos()
    {
        $torneo = $this->torneo;
        
        // Verificar canción principal (siempre requerida)
        if ($torneo->cancion && !$this->cancion) {
            return false;
        }
        
        // Verificar canción 2 si es requerida
        if ($torneo->cancion2 && !$this->cancion2) {
            return false;
        }
        
        // Verificar archivo 1 si es requerido
        if ($torneo->archivo && !$this->archivo) {
            return false;
        }
        
        // Verificar archivo 2 si es requerido
        if ($torneo->archivo2 && !$this->archivo2) {
            return false;
        }
        
        return true;
    }
}
