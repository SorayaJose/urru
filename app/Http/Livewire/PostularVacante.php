<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Notifications\nuevoCandidato;

class PostularVacante extends Component
{
    use WithFileUploads;

    public $cv;
    public $vacante;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    public function mount(Vacante $vacante)  {
        $this->vacante = $vacante;
    }

    public function postularme() {
        // validar
        $datos = $this->validate();

        //almacenar cv en disco duro
        $cv = $this->cv->store('public/cv');
        $nombre_cv = str_replace('public/cv/', '', $cv);

        //crear el candidato en la vacante
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $nombre_cv
        ]);

        // crear notificacion y enviar el email
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));

        // mostrar un mensaje de que se envio correctamente
        session()->flash('mensaje', 'Se envio correctamente tu informacion, mucha suerte ');

        return redirect()->back();
    }
 
    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
