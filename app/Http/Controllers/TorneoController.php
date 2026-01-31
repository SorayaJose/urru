<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use App\Models\Escuela;
use Illuminate\Http\Request;

class TorneoController extends Controller
{
    public function index()
    {
        // Verificar que el usuario tenga rol 0 (administrador)
        if (auth()->user()->rol !== 0) {
            abort(403, 'No tienes permiso para administrar torneos.');
        }
        
        return view('torneos.index');
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
            abort(403, 'No tienes permiso para crear torneos.');
        }
        
        return view('torneos.create');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Torneo $torneo)
    {
        // Verificar que el usuario tenga rol 0 (administrador)
        
        return view('torneos.show', [
            'torneo' => $torneo
        ]);
    }

    public function inscribir($id)
    {
        // Verificar que el usuario tenga rol 0 (administrador)
        if (auth()->user()->rol !== 0) {
            abort(403, 'No tienes permiso para inscribir escuelas a torneos.');
        }
        
        $escuela = Escuela::find($id);
        $this->escuelas()->attach( $escuela );
        return back();
    }

    public function desinscribir($id)
    {
        // Verificar que el usuario tenga rol 0 (administrador)
        if (auth()->user()->rol !== 0) {
            abort(403, 'No tienes permiso para desinscribir escuelas de torneos.');
        }
        
        $escuela = Escuela::find($id);
        $this->escuelas()->detach($escuela);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Torneo $torneo)
    {
        // Verificar que el usuario tenga rol 0 (administrador)
        if (auth()->user()->rol !== 0) {
            abort(403, 'No tienes permiso para editar torneos.');
        }
        
        return view('torneos.edit', [
            'torneo' => $torneo
        ]);
    }
}