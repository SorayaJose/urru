<?php

namespace App\Http\Livewire;

use App\Models\Torneo;
use App\Models\Escuela;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
//use Illuminate\Support\Carbon;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MostrarTorneosEscuela extends Component
{
    protected $listeners = ['inscribir', 'desinscribir', 'inscribirDesdeUltimoTorneo'];
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

    public function inscribirDesdeUltimoTorneo($escuela_id, $torneo_id)
    {
        //dd('entro desde ultimo' . $escuela_id . ' - ' . $torneo_id);
        $escuela = Escuela::find($escuela_id);
        $torneo = Torneo::find($torneo_id);

        // Buscar el último torneo del mismo tipo en el que la escuela estuvo inscripta
        $ultimoTorneo = Torneo::whereHas('escuelas', function($query) use ($escuela_id) {
            $query->where('escuela_id', $escuela_id);
        })->where('fecha', '<', $torneo->fecha)
          ->where('tipo', $torneo->tipo)
          ->orderBy('fecha', 'desc')
          ->first();

        if ($ultimoTorneo) {
            // Inscribir la escuela en el nuevo torneo
            $torneo->escuelas()->attach($escuela);

            // Construir la carpeta del nuevo torneo
            $fechaTorneo = $torneo->fecha->format('Ymd');
            $nombreTorneo = mb_substr(str_replace(' ', '_', $torneo->nombre), 0, 30);
            $nombreEscuela = mb_substr(str_replace(' ', '_', $escuela->nombre), 0, 30);
            $carpetaNuevoTorneo = $fechaTorneo . '_' . $nombreTorneo . '/' . $nombreEscuela;

            // Copiar los patinadores inscritos del último torneo al nuevo torneo
            $inscripciones = $ultimoTorneo->inscripciones()->where('escuela_id', $escuela_id)
                ->get();

            foreach ($inscripciones as $inscripcion) {
                // Obtener los nombres de archivo originales para construir nuevas rutas
                $cancionPath = null;
                $cancion2Path = null;
                $archivoPath = null;
                $archivo2Path = null;

                // Copiar archivos y generar nuevas rutas
                if ($inscripcion->cancion && Storage::exists($inscripcion->cancion)) {
                    $nombreArchivo = basename($inscripcion->cancion);
                    $cancionPath = $carpetaNuevoTorneo . '/' . $nombreArchivo;
                    Storage::copy($inscripcion->cancion, $cancionPath);
                }

                if ($inscripcion->cancion2 && Storage::exists($inscripcion->cancion2)) {
                    $nombreArchivo = basename($inscripcion->cancion2);
                    $cancion2Path = $carpetaNuevoTorneo . '/' . $nombreArchivo;
                    Storage::copy($inscripcion->cancion2, $cancion2Path);
                }

                if ($inscripcion->archivo && Storage::exists($inscripcion->archivo)) {
                    $nombreArchivo = basename($inscripcion->archivo);
                    $archivoPath = $carpetaNuevoTorneo . '/' . $nombreArchivo;
                    Storage::copy($inscripcion->archivo, $archivoPath);
                }

                if ($inscripcion->archivo2 && Storage::exists($inscripcion->archivo2)) {
                    $nombreArchivo = basename($inscripcion->archivo2);
                    $archivo2Path = $carpetaNuevoTorneo . '/' . $nombreArchivo;
                    Storage::copy($inscripcion->archivo2, $archivo2Path);
                }

                // Crear la nueva inscripción con las rutas actualizadas
                $torneo->inscripciones()->create([
                    'patinador_id' => $inscripcion->patinador_id,
                    'categoria_id' => $inscripcion->categoria_id,
                    'escuela_id' => $escuela_id,
                    'cancion' => $cancionPath,
                    'cancion2' => $cancion2Path,
                    'archivo' => $archivoPath,
                    'archivo2' => $archivo2Path,  
                    'cancion_nombre_original' => $inscripcion->cancion_nombre_original,
                    'cancion2_nombre_original' => $inscripcion->cancion2_nombre_original, 
                    'archivo_nombre_original' => $inscripcion->archivo_nombre_original,
                    'archivo2_nombre_original' => $inscripcion->archivo2_nombre_original,
                    'duracion' => $inscripcion->duracion,
                    'duracion_larga' => $inscripcion->duracion_larga
                ]);
            }
        }
    }

    public function inscribir($escuela_id, $torneo_id)
    {
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
