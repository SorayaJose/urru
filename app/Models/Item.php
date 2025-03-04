<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 
        'mostrar', 
        'moneda',
        'todos',
        'cantidad'
    ];

    // relacion muchos a muchos
    public function apartamentos() {
        return $this->belongsToMany(Apartamento::class);
    }

    // relacion muchos a muchos
    public function gastos() {
        return $this->belongsToMany(Gasto::class);
    }
    public function mostrarItem() {
        if ($this->todos == 1) {
            return "Lo pagan entre todos";
        } elseif ($this->todos == 0) {
            return "Solo lo pagan los seleccionados";
        } elseif ($this->todos == 2) {
            return "Es un convenio";
        } elseif ($this->todos == 3) {
            return "Es un gasto";
        } 
        return "Es un error";
    }
}
