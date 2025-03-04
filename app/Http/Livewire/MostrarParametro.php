<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Parametro;

class MostrarParametro extends Component
{
    public function render()
    {
        $parametro = Parametro::find(1);
        return view('livewire.mostrar-parametro', [
            'parametro' => $parametro
        ]);
    }
}
