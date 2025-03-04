<?php

namespace App\Http\Controllers;

use App\Models\Parametro;
use Illuminate\Http\Request;

class ParametroController extends Controller
{
    public function index()
    {
        //$this->authorize('viewAny', Parametros::class);
        $parametro = Parametro::find(1);

        return view('parametros.show', [
            'parametro' => $parametro
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('create', Parametro::class);
        return view('parametros.create');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Parametro $parametro)
    {
        return view('parametros.show', [
            'parametro' => $parametro
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Parametro $parametro)
    {
        //dd($parametro);
        //$this->authorize('update', $parametro);

        return view('parametros.edit', [
            'parametro' => $parametro
        ]);
    }
}
