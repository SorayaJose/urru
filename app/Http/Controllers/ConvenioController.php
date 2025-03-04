<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
use App\Models\Socio;
use Illuminate\Http\Request;

class ConvenioController extends Controller
{
    public function index()
    {
        return view('convenios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($socio)
    {
        //dd($socio);
        return view('convenios.create', [
            'socio' => $socio
        ]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Convenio $convenio)
    {
        return view('convenios.show', [
            'convenio' => $convenio
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Convenio $convenio)
    {
        //dd($convenio);

        return view('convenios.edit', [
            'convenio' => $convenio
        ]);
    }
}
