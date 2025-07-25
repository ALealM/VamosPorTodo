<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Foros\PrimerForo;
use App\Models\DependenciasCopladem as DC;
use Illuminate\Support\Facades\Session;
use Redirect;

class PrimerForoController extends Controller {

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
    public function primerindex() {
        $invitados = PrimerForo::all();
        $total = PrimerForo::all()->count();
        $asistentes = PrimerForo::where('asistio', 1)->count();
        //$integrantes = PrimerForo::where('asistio', 1)->where('integrante', 1)->count();
        //dd($invitados);
        return view('foros.primer_foro.index', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados PRIMER FORO SEGURO']],
            'invitados' => $invitados,
            'total' => $total,
            'asistentes' => $asistentes,
            //'integrantes' => $integrantes,
        ]);
    }

    public function primermapa() {
        $invitados = PrimerForo::all();
        $total = PrimerForo::all()->count();
        $total_asis = PrimerForo::where('asistio',1)->count();
        //$total_integ = PrimerForo::where('asistio', 1)->where('integrante', 1)->count();
        return view('foros.primer_foro.mapa', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Mapa de Invitados COPLADEM']],
            'invitados' => $invitados,
            'total' => $total,
            'total_asis' => $total_asis,
            //'total_integ' => $total_integ,
        ]);
    }

    public function primerasistencia(Request $request) {
        $inv = $request->get('id');
        $check = $request->get('check');
        $invitado = PrimerForo::find($inv);
        $invitado->asistio = $check;
        $invitado->save();
        $r['invitados'] = PrimerForo::where('asistio', 1)->count();
        //$r['integrantes'] = Invitados::where('asistio', 1)->where('integrante', 1)->count();
        return $r;
    }

    public function invitadosStore(Request $request) {
        $input = $request->all();
        $asistio = $input['asistio'];
        $asistio = PrimerForo::creaRegistro($input);
        if ($asistio) {
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha guardado existosamente la reunión.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la reunión.");
            Session::flash('tipoMsg', 'error');
        }

        return Redirect::to('primer_foro/index');
    }

    public function create() {
        $accion = "Creación de nuevo asistente del COPLADEM Primer Foro Seguro por usuario ID: " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        return view('foros.primer_foro.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de asistente']],
            'sTitulo' => 'COPLADEM Primer Foro',
            'sDescripcion' => 'Alta de nuevo asistente'
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $inv = PrimerForo::creaRegistro($input);
        if ($inv) {
            $accion = 'Creación de nuevo invitado primer foro: ID ' . $inv->id;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha dado de alta exitosamente el nuevo asistente.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo asistente.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('primer_foro/index');
    }
    
    
    public function primerasistentes() {
         $invitados = PrimerForo::all();
         $asistentes = PrimerForo::where('asistio',1)->get();
         $total = PrimerForo::all()->count();
         $total_asis = PrimerForo::where('asistio',1)->count();
         //dd($asistentes);
         return view('foros.primer_foro.asistentes', [//000
                     'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados COPLADEM']],
                     'invitados' => $invitados,
                     'asistentes' => $asistentes,
                     'total' => $total,
                     'total_asis' => $total_asis,
                     ]);
     }
     
     public function primerordendia() {
       $invitados = PrimerForo::all();
        $total = PrimerForo::all()->count();
        $total_asis = PrimerForo::where('asistio',1)->count();
        return view('foros.primer_foro.ordendia', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Órden de día COPLADEM Primer Foro Seguro']],
            'invitados' => $invitados,
            'total' => $total,
            'total_asis' => $total_asis,
            ]);
     }

}
