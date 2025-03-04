<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    public function index()
    {
        //$this->authorize('viewAny', Apartamento::class);
        return view('gastos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('create', Apartamento::class);
        return view('gastos.create');
    }
    
    public function createIna()
    {
        //$this->authorize('create', Apartamento::class);
        return view('gastos.create-ina');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gasto $gasto)
    {
        return view('gastos.show', [
            'gasto' => $gasto
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gasto $gasto)
    {
        //dd($rubro);
        //$this->authorize('update', $rubro);

        return view('gastos.edit', [
            'gasto' => $gasto
        ]);
    }
}