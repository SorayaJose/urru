<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MostrarSocioApartamento extends Component
{
    public $socio;
    
    public function render()
    {
        return view('livewire.mostrar-socio-apartamento');
    }
}
