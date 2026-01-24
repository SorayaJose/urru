<?php

namespace App\Http\Controllers;

use App\Models\Dolar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //dd('dentro del invoke');
        //$modo = Config::get('app.modo');
        //if (Auth::check()) {
        // return view('home.index');           
        //} else {
        //    dd('sin login');
        //}

    }

    public function index()
    {
        //dd('aca');
        return view('home.index');
    }


}
