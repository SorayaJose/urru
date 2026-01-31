<?php

namespace App\Http\Controllers;

use App\Models\Patinador;
use Illuminate\Http\Request;

class PatinadorController extends Controller
{
    public function index()
    {
        return view('patinadores.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patinadores.create');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patinador $patinador)
    {
        $escuela = auth()->user()->rol;

        // Verificar que el patinador pertenece a la escuela del usuario
        if ($patinador->escuela_id !== $escuela) {
            abort(403, 'No tienes permiso para acceder a este patinador.');
        }
        
        return view('patinadores.show', [
            'patinador' => $patinador
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patinador $patinador)
    {
        $escuela = auth()->user()->rol;
        
        // Verificar que el patinador pertenece a la escuela del usuario
        if ($patinador->escuela_id !== $escuela) {
            abort(403, 'No tienes permiso para editar este patinador.');
        }
        
        return view('patinadores.edit', [
            'patinador' => $patinador
        ]);
    }
}