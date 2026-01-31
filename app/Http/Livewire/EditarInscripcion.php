<?php

namespace App\Http\Livewire;

use App\Models\Torneo;
use App\Models\Escuela;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Inscripto;
use App\Models\Patinador;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use getID3;

class EditarInscripcion extends Component
{
    use WithFileUploads;

    public $inscripto;
    public $torneo;
    public $patinador;
    public $categoria;
    public $categorias = [];
    
    // Archivos de cancion  
    public $cancion;
    public $cancion2;
    
    // Archivos PDF
    public $archivo;
    public $archivo2;

    public function mount($inscripto)
    {
        $this->inscripto = Inscripto::findOrFail($inscripto);
        
        // Verificar que la inscripción pertenece a la escuela del usuario
        if ($this->inscripto->escuela_id !== auth()->user()->rol) {
            abort(403, 'No tienes permiso para editar esta inscripción.');
        }
        
        $this->torneo = $this->inscripto->torneo;
        $this->patinador = $this->inscripto->patinador;
        $this->categoria = $this->inscripto->categoria_id;
        
        // Filtrar categorías según el tipo de torneo
        $this->categorias = Categoria::where('tipo', $this->torneo->tipo)->get();
    }

    protected function rules()
    {
        $rules = [
            'categoria' => 'required|exists:categorias,id',
        ];

        // Validar condicionalmente según los requisitos del torneo
        if ($this->torneo->cancion && $this->cancion) {
            $rules['cancion'] = 'nullable|file|mimes:mp3,wav,ogg,m4a|max:10240';
        }
        if ($this->torneo->cancion2 && $this->cancion2) {
            $rules['cancion2'] = 'nullable|file|mimes:mp3,wav,ogg,m4a|max:10240';
        }
        if ($this->torneo->archivo && $this->archivo) {
            $rules['archivo'] = 'nullable|file|mimes:pdf|max:5120';
        }
        if ($this->torneo->archivo2 && $this->archivo2) {
            $rules['archivo2'] = 'nullable|file|mimes:pdf|max:5120';
        }

        return $rules;
    }

    public function actualizarInscripcion()
    {
        $this->validate();

        $escuela = auth()->user()->rol;
        $escuelaObj = Escuela::find($escuela);
        $categoriaObj = Categoria::find($this->categoria);
        
        // Crear carpeta: {aaaammdd}_{nombreTorneo}/{nombreEscuela}/
        $fechaTorneo = $this->torneo->fecha->format('Ymd');
        $nombreTorneo = mb_substr(str_replace(' ', '_', $this->torneo->nombre), 0, 30);
        $nombreEscuela = mb_substr(str_replace(' ', '_', $escuelaObj->nombre), 0, 30);
        $carpetaTorneo = $fechaTorneo . '_' . $nombreTorneo . '/' . $nombreEscuela;
        
        // Nombre base del archivo
        $nombreBase = str_replace(' ', '_', $this->patinador->nombre) . '_' . 
                      str_replace(' ', '_', $categoriaObj->nombre) . '_' . 
                      mb_substr(str_replace(' ', '_', $escuelaObj->nombre), 0, 30);

        $data = [
            'categoria_id' => $this->categoria,
        ];

        // Mantener duraciones existentes si no se actualizan
        if (!$this->cancion && $this->inscripto->duracion) {
            $data['duracion'] = $this->inscripto->duracion;
        }
        if (!$this->cancion2 && $this->inscripto->duracion_larga) {
            $data['duracion_larga'] = $this->inscripto->duracion_larga;
        }

        // Procesar canción 1
        if ($this->cancion) {
            // Eliminar archivo anterior si existe
            if ($this->inscripto->cancion) {
                Storage::delete($this->inscripto->cancion);
            }

            // Obtener duración del MP3
            $getID3 = new getID3();
            $archivoInfo = $getID3->analyze($this->cancion->getRealPath());
            $duracionSegundos = isset($archivoInfo['playtime_seconds']) ? round($archivoInfo['playtime_seconds']) : 0;
            $minutos = floor($duracionSegundos / 60);
            $segundos = $duracionSegundos % 60;
            $duracion = $minutos . 'm' . $segundos . 's';

            $cancionNombreOriginal = $this->cancion->getClientOriginalName();
            $nombreOriginal = mb_substr(pathinfo($cancionNombreOriginal, PATHINFO_FILENAME), 0, 40);
            $extension = $this->cancion->getClientOriginalExtension();
            $nombreArchivo = $nombreBase . '_' . $duracion . '_' . $nombreOriginal . '.' . $extension;
            
            $rutaCancion = $this->cancion->storeAs($carpetaTorneo, $nombreArchivo);
            $data['cancion'] = $rutaCancion;
            $data['cancion_nombre_original'] = $cancionNombreOriginal;
            $data['duracion_larga'] = $duracion;
        }

        // Procesar canción 2
        if ($this->cancion2) {
            if ($this->inscripto->cancion2) {
                Storage::delete($this->inscripto->cancion2);
            }

            $getID3 = new getID3();
            $archivoInfo = $getID3->analyze($this->cancion2->getRealPath());
            $duracionSegundos = isset($archivoInfo['playtime_seconds']) ? round($archivoInfo['playtime_seconds']) : 0;
            $minutos = floor($duracionSegundos / 60);
            $segundos = $duracionSegundos % 60;
            $duracion = $minutos . 'm' . $segundos . 's';

            $cancion2NombreOriginal = $this->cancion2->getClientOriginalName();
            $nombreOriginal = mb_substr(pathinfo($cancion2NombreOriginal, PATHINFO_FILENAME), 0, 40);
            $extension = $this->cancion2->getClientOriginalExtension();
            $nombreArchivo = $nombreBase . '_' . $duracion . '_' . $nombreOriginal . '.' . $extension;
            
            $rutaCancion2 = $this->cancion2->storeAs($carpetaTorneo, $nombreArchivo);
            $data['cancion2'] = $rutaCancion2;
            $data['cancion2_nombre_original'] = $cancion2NombreOriginal;
            $data['duracion_larga'] = $duracion;
        }

        // Procesar archivo 1
        if ($this->archivo) {
            if ($this->inscripto->archivo) {
                Storage::delete($this->inscripto->archivo);
            }

            $archivoNombreOriginal = $this->archivo->getClientOriginalName();
            $nombreOriginal = mb_substr(pathinfo($archivoNombreOriginal, PATHINFO_FILENAME), 0, 40);
            $extension = $this->archivo->getClientOriginalExtension();
            $nombreArchivo = $nombreBase . '_' . $nombreOriginal . '.' . $extension;
            
            $rutaArchivo = $this->archivo->storeAs($carpetaTorneo, $nombreArchivo);
            $data['archivo'] = $rutaArchivo;
            $data['archivo_nombre_original'] = $archivoNombreOriginal;
        }

        // Procesar archivo 2
        if ($this->archivo2) {
            if ($this->inscripto->archivo2) {
                Storage::delete($this->inscripto->archivo2);
            }

            $archivo2NombreOriginal = $this->archivo2->getClientOriginalName();
            $nombreOriginal = mb_substr(pathinfo($archivo2NombreOriginal, PATHINFO_FILENAME), 0, 40);
            $extension = $this->archivo2->getClientOriginalExtension();
            $nombreArchivo = $nombreBase . '_' . $nombreOriginal . '.' . $extension;
            
            $rutaArchivo2 = $this->archivo2->storeAs($carpetaTorneo, $nombreArchivo);
            $data['archivo2'] = $rutaArchivo2;
            $data['archivo2_nombre_original'] = $archivo2NombreOriginal;
        }

        // Actualizar inscripción
        $this->inscripto->update($data);

        session()->flash('mensaje', 'Inscripción actualizada correctamente');
        return redirect()->route('torneos.show', $this->torneo->id);
    }

    public function render()
    {
        return view('livewire.editar-inscripcion');
    }
}
