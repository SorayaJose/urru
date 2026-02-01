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
        'tipo',
        'cancion',
        'cancion2',
        'archivo',
        'archivo2'
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'fecha_cierre' => 'datetime',
        'cancion' => 'boolean',
        'cancion2' => 'boolean',
        'archivo' => 'boolean',
        'archivo2' => 'boolean',
    ];
    
    public function mostrarFecha() {
        return $this->fecha->format('d/m/Y');
    }

    public function mostrarTipo() {
        if ($this->tipo == "F") {
            return "Formativas";
        } elseif ($this->tipo == "D") {
            return "Federal";
        } 
        return "-";
    }
    
    // function que valida si se ingresaron los archivos correctos
    public function validarArchivos($inscripto) {
        // Verificar si el inscripto tiene todos los archivos requeridos por el torneo
        $validar = true;
        
        // Validar canción principal (siempre requerida)
        if ($this->cancion && !$inscripto->cancion) {
            $validar = false;
        }
        
        // Validar canción 2 si es requerida
        if ($this->cancion2 && !$inscripto->cancion2) {
            $validar = false;
        }
        
        // Validar archivo 1 si es requerido
        if ($this->archivo && !$inscripto->archivo) {
            $validar = false;
        }
        
        // Validar archivo 2 si es requerido
        if ($this->archivo2 && !$inscripto->archivo2) {
            $validar = false;
        }
        
        return $validar;
    }

    // Contar inscriptos con archivos completos de una escuela
    public function contarInscriptosCompletos($escuela_id = null) {
        if ($escuela_id === null) {
            $escuela_id = auth()->user()->rol;
        }
        
        $inscriptos = $this->inscripciones()->where('escuela_id', $escuela_id)->get();
        $completos = 0;
        
        foreach ($inscriptos as $inscripto) {
            if ($this->validarArchivos($inscripto)) {
                $completos++;
            }
        }
        
        return $completos;
    }

    // Obtener estadísticas de inscripciones de una escuela
    public function estadisticasInscripciones($escuela_id = null) {
        // Si no se pasa escuela_id y el usuario no es admin (rol 0), usar la escuela del usuario
        if ($escuela_id === null && auth()->check() && auth()->user()->rol != 0) {
            $escuela_id = auth()->user()->rol;
        }
        
        $query = $this->inscripciones();
        
        // Solo filtrar por escuela si se proporciona un ID
        if ($escuela_id !== null) {
            $query = $query->where('escuela_id', $escuela_id);
        }
        
        $inscriptos = $query->get();
        $total = $inscriptos->count();
        $completos = 0;
        $incompletos = 0;
        
        foreach ($inscriptos as $inscripto) {
            if ($this->validarArchivos($inscripto)) {
                $completos++;
            } else {
                $incompletos++;
            }
        }
        
        return [
            'total' => $total,
            'completos' => $completos,
            'incompletos' => $incompletos
        ];
    }

    public function buscoCantidadEscuelasInscriptas() {
        return $this->escuelas()->count();
    }   

    public function pedirCargarArchivos() {
        $pedir = false;
        if ($this->cancion2 || $this->archivo || $this->archivo2) {
            $pedir = true;
        }
        return $pedir;
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

    public function inscripciones()
    {
        return $this->hasMany(Inscripto::class);
    }

    public function checkInscripcion($escuela) {
        return $this->escuelas->contains('escuela_id', $escuela);
    }

    // Nuevo método para contar inscriptos de una escuela
    public function buscoCantidadInscriptos() {
        $escuela = auth()->user()->rol;
        return $this->hasMany(Inscripto::class)->where('escuela_id', $escuela)->count();
    }
}