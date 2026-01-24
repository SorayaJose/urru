<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'slug', 'contacto', 'descripcion'
    ];

    public function inscripciones() {
    //    return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    public function torneos()
    {
        return $this->belongsToMany(Torneo::class);
    }

}
