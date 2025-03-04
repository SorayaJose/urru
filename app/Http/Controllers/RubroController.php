<?php

namespace App\Http\Controllers;

use App\Models\Rubro;
use Illuminate\Http\Request;

class RubroController extends Controller
{
    public function index()
    {
        //$this->authorize('viewAny', Apartamento::class);
        return view('rubros.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('create', Apartamento::class);
        return view('rubros.create');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Rubro $rubro)
    {
        return view('rubros.show', [
            'rubro' => $rubro
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Rubro $rubro)
    {
        //dd($rubro);
        //$this->authorize('update', $rubro);

        return view('rubros.edit', [
            'rubro' => $rubro
        ]);
    }
}
