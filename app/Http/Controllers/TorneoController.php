<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use App\Models\Escuela;
use Illuminate\Http\Request;

class TorneoController extends Controller
{
    public function index()
    {
        return view('torneos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('torneos.create');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Torneo $torneo)
    {
        return view('torneos.show', [
            'torneo' => $torneo
        ]);
    }

    public function inscribir($id)
    {
        $escuela = Escuela::find($id);
        $this->escuelas()->attach( $escuela );
        return back();
    }

    public function desinscribir($id)
    {
        $escuela = Escuela::find($id);
        $this->escuelas()->detach($escuela);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Torneo $torneo)
    {
        //dd($torneo);
        //$this->authorize('update', $escuela);

        return view('torneos.edit', [
            'torneo' => $torneo
        ]);
    }
}