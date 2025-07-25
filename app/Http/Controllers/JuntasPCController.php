<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\JuntasPC as JPC;
use Illuminate\Support\Facades\Session;
use Redirect;
use Barryvdh\DomPDF\Facade as PDF;

class JuntasPCController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listado() {
        $juntas = JPC::all();
        $juntasT = JPC::select(\DB::raw('c1,c2,count(*) tot'))->groupBy('c1','c2')->orderBy('c2')->get();
        $col[1] = JPC::where('color',1)->count();
        $col[2] = JPC::where('color',2)->count();
        $col[3] = JPC::where('color',3)->count();
        $col[4] = JPC::where('color',4)->count();
        $col[5] = JPC::where('color',5)->count();
        return view('juntasPC.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Juntas de Participación Ciudadana']],
            'sTitulo' => 'Juntas de Participación Ciudadana - Cargo de Presidente',
            'sDescripcion' => 'Listado de Juntas de Participación Ciudadana',
            'juntas' => $juntas,
            'juntasT' => $juntasT,
            'col' => $col,
        ]);
    }
    
    public function cambiaColJunta(Request $request) {
        $id= $request->get('id');
        $c= $request->get('col');
        $junta = JPC::find($id);
        $junta->color = $c;
        $junta->save();
        $col[1] = JPC::where('color',1)->count();
        $col[2] = JPC::where('color',2)->count();
        $col[3] = JPC::where('color',3)->count();
        $col[4] = JPC::where('color',4)->count();
        $col[5] = JPC::where('color',5)->count();
        return $col;
    }
}
