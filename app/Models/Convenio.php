<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Convenio extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'estado',
        'cuotas',
        'valor',
        'total',
        'pagas',
        'socio_id',
        'rubro_id',
        'observaciones'
    ];

    public function socio() {
        return $this->belongsTo(Socio::class);
    }
    
    public function rubro() {
        return $this->belongsTo(Rubro::class);
    }

    public function mostrarFecha() {
        return Carbon::parse($this->fecha)->format('d-m-Y');
    }
}
