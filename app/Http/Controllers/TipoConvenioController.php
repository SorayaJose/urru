<?php

namespace App\Http\Controllers;

use App\Models\TipoConvenio;
use Illuminate\Http\Request;

class TipoConvenioController extends Controller
{
    public function index()
    {
        //$this->authorize('viewAny', TipoConvenio::class);
        return view('tipoConvenios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('create', TipoConvenio::class);
        return view('tipoConvenios.create');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TipoConvenio $tipoConvenios)
    {
        return view('tipoConvenios.show', [
            'tipoConvenios' => $tipoConvenios
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoConvenio $tipoConvenios)
    {
        //dd($tipoConvenios);
        //$this->authorize('update', $tipoConvenios);

        return view('tipoConvenios.edit', [
            'tipoConvenios' => $tipoConvenios
        ]);
    }
}

