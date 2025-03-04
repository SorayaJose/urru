<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarItems extends Component
{
    protected $listeners = ['eliminarItem'];
    public $search;
    public $sort = "nombre";
    public $todos = '';
    public $direction = "asc";
    public $cantidad = 10;
    public $readyToLoad = false;
    public $open = false;

    protected $queryString = [
        'cantidad' => ['except' => 10]
    ];
    use WithPagination;

    public function eliminarItem(Item $item) {
        $item->delete();
        //dd($Item);
    }
 
    public function render()
    {
        if($this->readyToLoad) {
            if ($this->todos == '') {
                $items = Item::where('nombre', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cantidad);
            } else {
                $items = Item::where('nombre', 'like', '%' . $this->search . '%')
                ->where('todos', $this->todos)
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cantidad);
            }
        } else {
            $items = [];
        }

        return view('livewire.mostrar-items', compact('items'));
        // ->layout('layouts.base')
    }

    public function loadRegistros() {
        $this->readyToLoad = true;
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
}
