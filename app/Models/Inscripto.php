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
        'torneo_id', 'escuela_id', 'patinador_id', 'categoria_id'
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
}
