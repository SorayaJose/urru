<?php

namespace App\Http\Livewire;

use App\Models\Torneo;
use App\Models\Escuela;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Inscripto;
use App\Models\Patinador;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use getID3;

class MostrarTorneo extends Component
{
    use WithFileUploads;

    protected $listeners = ['desinscribir'];
    public $torneo;
    public $nombre = '';
    public $categoria = '';
    public $patinadores = [];
    public $mostrarSugerencias = false;
    public $sort = "nombre";
    public $todos = '';
    public $direction = "asc";
    public $cantidad = 10;
    public $readyToLoad = false;
    public $formKey = 0;
    
    // Archivos de cancion  
    public $cancion;
    public $cancion2;
    
    // Archivos PDF
    public $archivo;
    public $archivo2;

    protected function rules()
    {
        $rules = [
            'nombre' => 'required|string',
            'categoria' => 'required|exists:categorias,id',
        ];
        // validar que el patinador no esté ya inscripto en ese torneo, en el modelo Inscript, 
        // no debe estar el nombre del patinador, para ese torneo y en esta escuela
        $rules['nombre'] .= '|unique:patinador_torneo,patinador_id,NULL,id,torneo_id,' . $this->torneo->id . ',escuela_id,' . auth()->user()->rol;  

        // Validar condicionalmente según los requisitos del torneo
        if ($this->torneo->cancion) {
            $rules['cancion'] = 'required|file|mimes:mp3,wav,ogg,m4a|max:10240';
        }
        if ($this->torneo->cancion2) {
            $rules['cancion2'] = 'required|file|mimes:mp3,wav,ogg,m4a|max:10240';
        }
        if ($this->torneo->archivo) {
            $rules['archivo'] = 'required|file|mimes:pdf|max:5120';
        }
        if ($this->torneo->archivo2) {
            $rules['archivo2'] = 'required|file|mimes:pdf|max:5120';
        }

        return $rules;
    }

    protected $messages = [
        'cancion.required' => 'Debe subir el archivo de música',
        'cancion2.required' => 'Debe subir el archivo de música corta',
        'archivo.required' => 'Debe subir la coreografía',
        'archivo2.required' => 'Debe subir la coreografía corta',
    ];

    public function desinscribir($patinador_id)
    {
        $torneo = $this->torneo->id;
        $escuela = auth()->user()->rol;

        // Obtener el inscripto antes de eliminarlo
        $inscripto = Inscripto::where('patinador_id', $patinador_id)
            ->where('torneo_id', $torneo)
            ->where('escuela_id', $escuela)
            ->first();

        if ($inscripto) {
            // Eliminar cada archivo si existe
            if ($inscripto->cancion) {
                Storage::delete($inscripto->cancion);
            }
            if ($inscripto->cancion2) {
                Storage::delete($inscripto->cancion2);
            }
            if ($inscripto->archivo) {
                Storage::delete($inscripto->archivo);
            }
            if ($inscripto->archivo2) {
                Storage::delete($inscripto->archivo2);
            }

            // Eliminar el registro
            $inscripto->delete();
        }
    }

    public function agregarPatinador()
    {
        // Validar
        $this->validate();

        $escuela = auth()->user()->rol;

        // 1️⃣ Buscamos si el patinador ya existe
        $patinador = Patinador::where('nombre', $this->nombre)
            ->where('escuela_id', $escuela)
            ->first();

        // 2️⃣ Si no existe, lo creamos
        if (!$patinador) {
            $patinador = Patinador::create([
                'nombre' => $this->nombre,
                'descripcion' => '',
                'categoria_id' => $this->categoria,
                'escuela_id' => $escuela
            ]);
        }

        // 3️⃣ Verificamos si ya está inscripto en ese torneo desde esta escuela (solo una categoría por torneo)
        $yaInscripto = Inscripto::where('torneo_id', $this->torneo->id)
            ->where('patinador_id', $patinador->id)
            ->where('escuela_id', $escuela)
            ->exists();

        if ($yaInscripto) {
            $this->addError('nombre', 'Este patinador ya está inscrito en este torneo. Solo se permite una inscripción por torneo.');
            return;
        }

        // Obtener datos para crear el nombre del archivo
        $escuelaObj = Escuela::find($escuela);
        $categoriaObj = Categoria::find($this->categoria);
        
        // Crear carpeta: {aaaammdd}_{nombreTorneo}/{nombreEscuela}/
        $fechaTorneo = $this->torneo->fecha->format('Ymd');
        $nombreTorneo = mb_substr(str_replace(' ', '_', $this->torneo->nombre), 0, 30);
        $nombreEscuela = mb_substr(str_replace(' ', '_', $escuelaObj->nombre), 0, 30);
        $carpetaTorneo = $fechaTorneo . '_' . $nombreTorneo . '/' . $nombreEscuela;
        
        // Nombre base del archivo: NombrePatinadora_categoria_club
        $nombreBase = str_replace(' ', '_', $this->nombre) . '_' . 
                      str_replace(' ', '_', $categoriaObj->nombre) . '_' . 
                      mb_substr(str_replace(' ', '_', $escuelaObj->nombre), 0, 30);

        // Guardar archivos si existen
        $cancionPath = null;
        $cancion2Path = null;
        $archivoPath = null;
        $archivo2Path = null;

        $cancionNombreOriginal = null;
        if ($this->cancion) {
            // Obtener duración del archivo
            $getID3 = new getID3;
            $audioInfo = $getID3->analyze($this->cancion->getRealPath());
            $duracionSegundos = isset($audioInfo['playtime_seconds']) ? round($audioInfo['playtime_seconds']) : 0;
            
            // Convertir a minutos y segundos
            $minutos = floor($duracionSegundos / 60);
            $segundos = $duracionSegundos % 60;
            $duracion = $minutos . 'm' . $segundos . 's';
            
            $extension = $this->cancion->getClientOriginalExtension();
            $cancionNombreOriginal = $this->cancion->getClientOriginalName();
            $nombreOriginal = mb_substr(pathinfo($cancionNombreOriginal, PATHINFO_FILENAME), 0, 40);
            $nombreArchivo = $nombreBase . '_' . $duracion . '_' . $nombreOriginal . '.' . $extension;
            $cancionPath = $this->cancion->storeAs($carpetaTorneo, $nombreArchivo);
        }

        $cancion2NombreOriginal = null;
        if ($this->cancion2) {
            // Obtener duración del archivo
            $getID3 = new getID3;
            $audioInfo = $getID3->analyze($this->cancion2->getRealPath());
            $duracionSegundos = isset($audioInfo['playtime_seconds']) ? round($audioInfo['playtime_seconds']) : 0;
            
            // Convertir a minutos y segundos
            $minutos = floor($duracionSegundos / 60);
            $segundos = $duracionSegundos % 60;
            $duracion_larga = $minutos . 'm' . $segundos . 's';
            
            $extension = $this->cancion2->getClientOriginalExtension();
            $cancion2NombreOriginal = $this->cancion2->getClientOriginalName();
            $nombreOriginal = mb_substr(pathinfo($cancion2NombreOriginal, PATHINFO_FILENAME), 0, 40);
            $nombreArchivo = $nombreBase . '_corta_' . $duracion_larga . '_' . $nombreOriginal . '.' . $extension;
            $cancion2Path = $this->cancion2->storeAs($carpetaTorneo, $nombreArchivo);
        }

        $archivoNombreOriginal = null;
        if ($this->archivo) {
            $extension = $this->archivo->getClientOriginalExtension();
            $archivoNombreOriginal = $this->archivo->getClientOriginalName();
            $nombreOriginal = mb_substr(pathinfo($archivoNombreOriginal, PATHINFO_FILENAME), 0, 40);
            $nombreArchivo = $nombreBase . '_coreo_' . $nombreOriginal . '.' . $extension;
            $archivoPath = $this->archivo->storeAs($carpetaTorneo, $nombreArchivo);
        }

        $archivo2NombreOriginal = null;
        if ($this->archivo2) {
            $extension = $this->archivo2->getClientOriginalExtension();
            $archivo2NombreOriginal = $this->archivo2->getClientOriginalName();
            $nombreOriginal = mb_substr(pathinfo($archivo2NombreOriginal, PATHINFO_FILENAME), 0, 40);
            $nombreArchivo = $nombreBase . '_coreo_corta_' . $nombreOriginal . '.' . $extension;
            $archivo2Path = $this->archivo2->storeAs($carpetaTorneo, $nombreArchivo);
        }

        Inscripto::create([
            'torneo_id' => $this->torneo->id,
            'patinador_id' => $patinador->id,
            'escuela_id' => $escuela,
            'categoria_id' => $this->categoria,
            'cancion' => $cancionPath,
            'cancion2' => $cancion2Path,
            'archivo' => $archivoPath,
            'archivo2' => $archivo2Path,
            'cancion_nombre_original' => $cancionNombreOriginal,
            'cancion2_nombre_original' => $cancion2NombreOriginal,
            'archivo_nombre_original' => $archivoNombreOriginal,
            'archivo2_nombre_original' => $archivo2NombreOriginal,
            'duracion' => isset($duracion) ? $duracion : null,
            'duracion_larga' => isset($duracion_larga) ? $duracion_larga : null
        ]);

        session()->flash('mensaje', 'Patinador inscrito correctamente');

        // Limpiamos los campos del formulario
        $this->reset(['nombre', 'categoria', 'cancion', 'cancion2', 'archivo', 'archivo2']);
        
        // Incrementar formKey para forzar re-render de inputs de archivos
        $this->formKey++;

        $this->mostrarSugerencias = false;
    }

    public function updatedNombre($value)
    {
        if (strlen($value) > 1) {
            $escuela = auth()->user()->rol;
            
            // Obtener IDs de patinadores ya inscritos en este torneo
            $patinadoresInscritos = Inscripto::where('torneo_id', $this->torneo->id)
                ->where('escuela_id', $escuela)
                ->pluck('patinador_id');
            
            $this->patinadores = Patinador::where('nombre', 'like', "%{$value}%")
                ->where('escuela_id', $escuela)
                ->whereNotIn('id', $patinadoresInscritos)
                ->take(5)
                ->get();
            $this->mostrarSugerencias = true;
        } else {
            $this->mostrarSugerencias = false;
            $this->patinadores = [];
        }
    }

    public function seleccionarPatinador($id)
    {
        $escuela = auth()->user()->rol;
    
        $patinador = Patinador::where('id', $id)
            ->where('escuela_id', $escuela)
            ->first();
    
        if ($patinador) {
            $this->nombre = $patinador->nombre;
            $this->categoria = $patinador->categoria_id;
            $this->mostrarSugerencias = false;
            $this->patinadores = [];
        }
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            // Si ya estamos ordenando por este campo, cambiar la dirección
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            // Si es un campo nuevo, ordenar ascendente por defecto
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function render()
    {
        $escuela = auth()->user()->rol;
        
        // Obtener inscriptos con ordenamiento
        $inscriptosQuery = Inscripto::where('patinador_torneo.torneo_id', $this->torneo->id)
            ->where('patinador_torneo.escuela_id', $escuela)
            ->join('patinadores', 'patinador_torneo.patinador_id', '=', 'patinadores.id')
            ->join('categorias', 'patinador_torneo.categoria_id', '=', 'categorias.id')
            ->select('patinador_torneo.*');

        // Aplicar ordenamiento
        if ($this->sort == 'nombre') {
            $inscriptosQuery->orderBy('patinadores.nombre', $this->direction);
        } elseif ($this->sort == 'categoria') {
            $inscriptosQuery->orderBy('categorias.nombre', $this->direction);
        }

        $inscriptos = $inscriptosQuery->get();

        // Filtrar categorías según el tipo del torneo
        $categorias = Categoria::where('tipo', $this->torneo->tipo)->get();
        
        return view('livewire.mostrar-torneo', [
            'categorias' => $categorias,
            'inscriptos' => $inscriptos
        ]);
    }
}