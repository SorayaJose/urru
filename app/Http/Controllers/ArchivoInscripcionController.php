<?php

namespace App\Http\Controllers;

use App\Models\Inscripto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchivoInscripcionController extends Controller
{
    public function descargar(Request $request, $inscripcionId, $tipo)
    {
        $inscripcion = Inscripto::findOrFail($inscripcionId);
        
        // Verificar que el usuario tiene permiso (pertenece a la escuela)
        if ($inscripcion->escuela_id !== auth()->user()->rol) {
            abort(403, 'No tienes permiso para acceder a este archivo.');
        }
        
        // Validar tipo de archivo
        $tiposPermitidos = ['cancion', 'cancion2', 'archivo', 'archivo2'];
        if (!in_array($tipo, $tiposPermitidos)) {
            abort(404);
        }
        
        // Obtener ruta y nombre original del archivo
        $rutaArchivo = $inscripcion->$tipo;
        $campoNombreOriginal = $tipo . '_nombre_original';
        $nombreOriginal = $inscripcion->$campoNombreOriginal ?? basename($rutaArchivo);
        
        if (!$rutaArchivo || !Storage::exists($rutaArchivo)) {
            abort(404, 'Archivo no encontrado.');
        }
        
        // Determinar tipo de contenido
        $extension = pathinfo($rutaArchivo, PATHINFO_EXTENSION);
        $mimeTypes = [
            'mp3' => 'audio/mpeg',
            'wav' => 'audio/wav',
            'ogg' => 'audio/ogg',
            'm4a' => 'audio/mp4',
            'pdf' => 'application/pdf',
        ];
        
        $mimeType = $mimeTypes[strtolower($extension)] ?? 'application/octet-stream';
        
        // Servir archivo para visualización inline (no descarga)
        return response()->file(Storage::path($rutaArchivo), [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $nombreOriginal . '"'
        ]);
    }
}
