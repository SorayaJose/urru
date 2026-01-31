<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $rol = auth()->user()->rol;
        
        // Verificar que el usuario tenga rol 0 (administrador)
        if ($rol !== 0) {
            abort(403, 'No tienes permiso para administrar categorías.');
        }
        
        return view('categorias.index');
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
            abort(403, 'No tienes permiso para crear categorías.');
        }
        
        return view('categorias.create');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        // Verificar que el usuario tenga rol 0 (administrador)
        if (auth()->user()->rol !== 0) {
            abort(403, 'No tienes permiso para ver categorías.');
        }
        
        return view('categorias.show', [
            'categoria' => $categoria
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        // Verificar que el usuario tenga rol 0 (administrador)
        if (auth()->user()->rol !== 0) {
            abort(403, 'No tienes permiso para editar categorías.');
        }
        
        return view('categorias.edit', [
            'categoria' => $categoria
        ]);
    }
}

