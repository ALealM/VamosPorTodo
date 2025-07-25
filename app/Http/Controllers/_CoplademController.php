<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Foros\Invitados;
use App\Models\DependenciasCopladem as DC;
use Illuminate\Support\Facades\Session;
use Redirect;

class CoplademController extends Controller {

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
    public function index() {
        $invitados = Invitados::all();
        $total = Invitados::all()->count();
        $asistentes = Invitados::where('asistio', 1)->count();
        $integrantes = Invitados::where('asistio', 1)->where('integrante', 1)->count();
        //dd($invitados);
        return view('foros.invitados.index', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados COPLADEM']],
            'invitados' => $invitados,
            'total' => $total,
            'asistentes' => $asistentes,
            'integrantes' => $integrantes,
        ]);
    }

    public function mapa() {
        $invitados = Invitados::all();
        $total = Invitados::all()->count();
        $total_asis = Invitados::where('asistio',1)->count();
        $total_integ = Invitados::where('asistio', 1)->where('integrante', 1)->count();
        return view('foros.invitados.mapa', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Mapa de Invitados COPLADEM']],
            'invitados' => $invitados,
            'total' => $total,
            'total_asis' => $total_asis,
            'total_integ' => $total_integ,
        ]);
    }

    public function asistencia(Request $request) {
        $inv = $request->get('id');
        $check = $request->get('check');
        $invitado = Invitados::find($inv);
        $invitado->asistio = $check;
        $invitado->save();
        $r['invitados'] = Invitados::where('asistio', 1)->count();
        $r['integrantes'] = Invitados::where('asistio', 1)->where('integrante', 1)->count();
        return $r;
    }

    public function invitadosStore(Request $request) {
        $input = $request->all();
        $asistio = $input['asistio'];
        $asistio = Invitados::creaRegistro($input);
        if ($asistio) {
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha guardado existosamente la reunión.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la reunión.");
            Session::flash('tipoMsg', 'error');
        }

        return Redirect::to('invitados/index');
    }

    public function create() {
        $accion = "Creación de nuevo asistente del COPLADEM por usuario ID: " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $dependencias = DC::pluck('dependencia', 'id');
        return view('foros.invitados.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de asistente']],
            'sTitulo' => 'COPLADEM',
            'sDescripcion' => 'Alta de nuevo asistente',
            'dependencias' => $dependencias
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $input['dependencia'] = DC::find($input['dependencia'])->dependencia;
        $inv = Invitados::creaRegistro($input);
        if ($inv) {
            $accion = 'Creación de nuevo invitado: ID ' . $inv->id;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha dado de alta exitosamente el nuevo asistente.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo asistente.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('addAsistente');
    }
    
    
    public function asistentes() {
         $invitados = Invitados::all();
         $asistentes = Invitados::where('asistio',1)->get();
         $total = Invitados::all()->count();
         $total_asis = Invitados::where('asistio',1)->count();
         $total_integ = Invitados::where('asistio', 1)->where('integrante', 1)->count();
         //dd($asistentes);
         return view('foros.invitados.asistentes', [//000
                     'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados COPLADEM']],
                     'invitados' => $invitados,
                     'asistentes' => $asistentes,
                     'total' => $total,
                     'total_asis' => $total_asis,
                     'total_integ' => $total_integ,
                     ]);
     }
     
     public function ordendia() {
       $invitados = Invitados::all();
        $total = Invitados::all()->count();
        $total_asis = Invitados::where('asistio',1)->count();
        $total_integ = Invitados::where('asistio', 1)->where('integrante', 1)->count();
        return view('foros.invitados.ordendia', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Órden de día COPLADEM']],
            'invitados' => $invitados,
            'total' => $total,
            'total_asis' => $total_asis,
            'total_integ' => $total_integ,
            ]);
     }

    public function dashboard(){
        $invitados = Invitados::get();
        // Invitados
        $female = $invitados->where('genero','F')->count();
        $male = $invitados->where('genero','M')->count();
        $integrante = $invitados->where('integrante',1)->count();
        $noIntegrante = $invitados->where('integrante',0)->count();
        
        // Asistentes
        $asistioIntegrante = $invitados->where('integrante',1)->where('asistio',1)->count();
        $asistioNoIntegrante = $invitados->where('integrante',0)->where('asistio',0)->count();
        $asistioFemale = $invitados->where('genero','F')->where('asistio',1)->count();
        $asistioMale = $invitados->where('genero','M')->where('asistio',1)->count();
        
        return view('foros.invitados.dashboard',compact('invitados','female','male','integrante','noIntegrante','asistioIntegrante','asistioNoIntegrante','asistioFemale','asistioMale'))->with('aBreadCrumb',[['link' => 'active', 'label' => 'Dashboard Invitados y Asistentes']])->with('sTitulo', 'Dashboard',)->with('sDescripcion', 'Invitados e Integrantes Asistentes');
    }
}