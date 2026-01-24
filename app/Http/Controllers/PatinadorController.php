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
        //dd($escuela);
        //$this->authorize('update', $escuela);
        return view('patinadores.edit', [
            'patinadores' => $patinadores
        ]);
    }
}