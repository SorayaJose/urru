<?php

namespace App\Http\Livewire\Apartamentos;

use Livewire\Component;

class MostrarApartamentos extends Component
{
    public $titulo;

    public function mount($title) {
        $this->titulo = $title;
    }

    public function render()
    {
        return view('livewire.apartamentos.mostrar-apartamentos');
    }
}
