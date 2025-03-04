<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 
        'dormitorios', 
        'contador_ose',
        'tipo'
    ];

    // relacion muchos a muchos
    public function items() {
        return $this->belongsToMany(Item::class);
    }
}
