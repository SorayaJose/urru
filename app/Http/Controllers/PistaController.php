<?php

namespace App\Http\Controllers;

use App\Models\Pista;
use Illuminate\Http\Request;

class PistaController extends Controller
{
    public function index()
    {
        // Verificar que el usuario tenga rol 0 (administrador)
        if (auth()->user()->rol !== 0) {
            abort(403, 'No tienes permiso para administrar pistas.');
        }
        
        return view('pistas.index');
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
            abort(403, 'No tienes permiso para crear pistas.');
        }
        
        return view('pistas.create');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pista $pista)
    {
        // Verificar que el usuario tenga rol 0 (administrador)
        if (auth()->user()->rol !== 0) {
            abort(403, 'No tienes permiso para ver pistas.');
        }
        
        return view('pistas.show', [
            'pista' => $pista
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pista $pista)
    {
        // Verificar que el usuario tenga rol 0 (administrador)
        if (auth()->user()->rol !== 0) {
            abort(403, 'No tienes permiso para editar pistas.');
        }
        
        return view('pistas.edit', [
            'pista' => $pista
        ]);
    }
}
