<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patinador extends Model
{
    use HasFactory;

    protected $table = 'patinadores';

    protected $fillable = [
        'nombre', 'federado', 'vigencia', 'descripcion', 'categoria_id', 'escuela_id'
    ];

    public function escuela()
    {
        return $this->belongsTo(Escuela::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
