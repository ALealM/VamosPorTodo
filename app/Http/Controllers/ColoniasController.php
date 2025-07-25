<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Rubros;
use App\Models\ColoniasB;
use App\Models\Solicitudes;
use Illuminate\Support\Facades\Session;
use Redirect;
use Barryvdh\DomPDF\Facade as PDF;

class ColoniasController extends Controller {

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
        $colonias = ColoniasB::pluck('colonia','id');
        return view('colonias.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de colonias']],
            'sTitulo' => 'Colonias - Diagnóstico',
            'sDescripcion' => 'Diagnóstico municipal de las colonias',
            'colonias' => $colonias,
        ]);
    }       

    public function getDatosCol(Request $request) {
        $col = $request->get('col');
        $colonia = ColoniasB::find($col);
        $rubros = Rubros::all();
        foreach($rubros as $rubro){
            $rubro->asuntos = Solicitudes::where('id_colonia',$col)->where('id_tipo',$rubro->id)->get();
//            dd($rubro->asuntos);
        }
        return view('colonias.contenido', [
            'colonia' => $colonia,
            'rubros' => $rubros,
        ]);
    }
    
    public function informeCol($id) {
        $colonia = ColoniasB::find($id);
        $accion = "Generación en PDF de la colonia $colonia->colonia por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $rubros = Rubros::all();
        foreach($rubros as $rubro){
            $rubro->solicitudes = Solicitudes::where('id_colonia',$id)->where('id_tipo',$rubro->id)->get();
        }
        return PDF::loadView('colonias.pdf', compact('colonia', 'dias', 'meses', 'rubros'))->download("Bitácora Colonia $colonia->colonia.pdf");
    }
    
    public function informeColrub($id,$rub) {
        $colonia = ColoniasB::find($id);
        $accion = "Generación en PDF de la colonia $colonia->colonia por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $rubros = Rubros::where('id',$rub)->get();
        $rubroN = Rubros::find($rub)->nombre;
        foreach($rubros as $rubro){
            $rubro->solicitudes = Solicitudes::where('id_colonia',$id)->where('id_tipo',$rubro->id)->get();
        }
        return PDF::loadView('colonias.pdf', compact('colonia', 'dias', 'meses', 'rubros'))->download("Bitácora $colonia->colonia - $rubroN.pdf");
    }
}
