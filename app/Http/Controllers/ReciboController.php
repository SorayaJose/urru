<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use Illuminate\Http\Request;

class ReciboController extends Controller
{
    public function index()
    {
        //$this->authorize('viewAny', Apartamento::class);
        return view('recibos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('create', Apartamento::class);
        return view('recibos.create');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Recibo $recibo)
    {
        return view('recibos.show', [
            'recibo' => $recibo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Recibo $recibo)
    {
        //dd($rubro);
        //$this->authorize('update', $rubro);

        return view('recibos.edit', [
            'recibo' => $recibo
        ]);
    }
}
