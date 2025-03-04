<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;
use Illuminate\Http\Request;

class ApartamentoController extends Controller
{
    public function index()
    {
        //$this->authorize('viewAny', Apartamento::class);
        return view('apartamentos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('create', Apartamento::class);
        return view('apartamentos.create');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartamento $apartamento)
    {
        return view('apartamentos.show', [
            'apartamento' => $apartamento
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartamento $apartamento)
    {
        //dd($apartamento);
        //$this->authorize('update', $apartamento);

        return view('apartamentos.edit', [
            'apartamento' => $apartamento
        ]);
    }
}
