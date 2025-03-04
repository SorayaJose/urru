<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Apartamento;

class Mostrar extends Component
{
    public $search;
    public $sort = "nombre";
    public $direction = "asc";

    public $showEditModal = false;
    public $showNewModal = true;

    /*
    public function mount($name) {
        $this->name = $name;
    }
    */
    public function render()
    {
        $apartamentos = Apartamento::where('nombre', 'like', '%' . $this->search . '%')
                            ->orwhere('dormitorios', $this->search)
                            ->orwhere('contador_ose', 'like', '%' . $this->search . '%')
                            ->orderBy($this->sort, $this->direction)->get();

        return view('livewire.mostrar', compact('apartamentos'));
        // ->layout('layouts.base')
    }

    public function order($sort) {
        
        if ($this->sort == $sort) {
            if ($this->direction == "desc") {
                $this->direction = "asc";
            } else {
                $this->direction = "desc";
            }
        } else {
            $this->sort = $sort;
            $this->direction = "asc";
        }
    }

    public function crear() {
        $this->showNewModal = true;
    }
}
