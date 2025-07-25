<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Acciones;
use App\Models\Secretarias;
use App\Models\Responsables;
use App\Models\ResponsablesProyecto as RP;
use App\Models\BeneficiariosProyecto as BP;
use App\Models\TipoAcciones as TA;
use App\Models\TipoBeneficiarios as TB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        $user = \Auth::User();
        return view('home', compact('user'));
    }

    public function cubo()
    {
        return view('cubo');
    }
}
