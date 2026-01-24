<?php

namespace App\Http\Livewire;

use App\Models\Torneo;
use App\Models\Escuela;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
//use Illuminate\Support\Carbon;
//use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Storage;

class MostrarTorneosEscuela extends Component
{
    protected $listeners = ['inscribir', 'desinscribir'];
    public $search;
    public $sort = "fecha";
    public $todos = '';
    public $direction = "asc";
    public $cantidad = 10;
    public $readyToLoad = false;
    public $open = false;

    protected $queryString = [
        'cantidad' => ['except' => 10]
    ];
    use WithPagination;


    public function inscribir($escuela_id, $torneo_id)
    {
        //dd($id);
        $escuela = Escuela::find($escuela_id);
        $torneo = Torneo::find($torneo_id);
        $torneo->escuelas()->attach($escuela);
    }

    public function desinscribir($escuela_id, $torneo_id)
    {
        $escuela = Escuela::find($escuela_id);
        $torneo = Torneo::find($torneo_id);
        $torneo->escuelas()->detach($escuela);
    }

    public function render()
    {
        if($this->readyToLoad) {
            $torneos = Torneo::where('nombre', 'like', '%' . $this->search . '%')
            ->where('fecha', '>=', Carbon::today())
            //->orwhereHas('banco', function ($query) {
            //    $query->where('nombre', 'like', '%' . $this->search . '%');
            // })
            //->orwhere('moneda', $this->search)
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cantidad);
        } else {
            $torneos = [];
        }

        /*
        $ids = Auth::user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        
        return view('home', [
            'posts' => $posts
        ] );
        */
        return view('livewire.mostrar-torneos-escuela', compact('torneos'));
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
