<?php

namespace App\Http\Controllers;

use App\Models\Escuela;
use Illuminate\Http\Request;

class EscuelaController extends Controller
{
    public function index()
    {
        // Verificar que el usuario tenga rol 0 (administrador)
        if (auth()->user()->rol !== 0) {
            abort(403, 'No tienes permiso para administrar escuelas.');
        }
        
        return view('escuelas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Verificar que el usuario tenga rol 0 (administrador)
        if (auth()->user()->rol !== 0) {
            abort(403, 'No tienes permiso para crear escuelas.');
        }
        
        return view('escuelas.create');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Escuela $escuela)
    {
        // Verificar que el usuario tenga rol 0 (administrador)
        if (auth()->user()->rol !== 0) {
            abort(403, 'No tienes permiso para ver escuelas.');
        }
        
        return view('escuelas.show', [
            'escuela' => $escuela
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Escuela $escuela)
    {
        // Verificar que el usuario tenga rol 0 (administrador)
        if (auth()->user()->rol !== 0) {
            abort(403, 'No tienes permiso para editar escuelas.');
        }
        
        return view('escuelas.edit', [
            'escuela' => $escuela
        ]);
    }
}

