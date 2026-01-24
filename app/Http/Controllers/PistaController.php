<?php

namespace App\Http\Controllers;

use App\Models\Pista;
use Illuminate\Http\Request;

class PistaController extends Controller
{
    public function index()
    {
        return view('pistas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //dd($pista);
        //$this->authorize('update', $rubro);

        return view('pistas.edit', [
            'pista' => $pista
        ]);
    }
}
