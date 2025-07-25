<?php

namespace App\Http\Controllers\Foros;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Foros\ForoLapila;
use App\Models\DependenciasCopladem as DC;
use Illuminate\Support\Facades\Session;
use Redirect;

class ForoLapilaController extends Controller {

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
    public function lapilaindex() {
        $invitados = ForoLapila::all();
        $total = ForoLapila::all()->count();
        $asistentes = ForoLapila::where('asistio', 1)->count();
        return view('foros.lapila.index', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados FORO LA PILA']],
            'invitados' => $invitados,
            'total' => $total,
            'asistentes' => $asistentes
        ]);
    }

    public function lapilaasistencia(Request $request) {
        $inv = $request->get('id');
        $check = $request->get('check');
        $invitado = ForoLapila::find($inv);
        $invitado->asistio = $check;
        $invitado->save();
        $r['invitados'] = ForoLapila::where('asistio', 1)->count();
        return $r;
    }

    public function create() {
        $accion = "Creación de nuevo asistente del COPLADEM FORO LA PILA por usuario ID: " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        return view('foros.lapila.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de asistente']],
            'sTitulo' => 'COPLADEM Foro Bocas',
            'sDescripcion' => 'Alta de nuevo asistente'
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $inv = ForoLapila::creaRegistro($input);
        if ($inv) {
            $accion = 'Creación de nuevo invitado FORO LA PILA: ID ' . $inv->id;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha dado de alta exitosamente el nuevo asistente.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo asistente.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('lapila/index');
    }
    
    
    public function lapilaasistentes() {
         $invitados = ForoLapila::all();
         $asistentes = ForoLapila::where('asistio',1)->get();
         $total = ForoLapila::all()->count();
         $total_asis = ForoLapila::where('asistio',1)->count();
         return view('foros.lapila.asistentes', [//000
                     'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados COPLADEM FORO LA PILA']],
                     'invitados' => $invitados,
                     'asistentes' => $asistentes,
                     'total' => $total,
                     'total_asis' => $total_asis,
                     ]);
     }
     
     public function lapilaordendia() {
       $invitados = ForoLapila::all();
        $total = ForoLapila::all()->count();
        $total_asis = ForoLapila::where('asistio',1)->count();
        return view('foros.lapila.ordendia', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Órden de día COPLADEM FORO LA PILA']],
            'invitados' => $invitados,
            'total' => $total,
            'total_asis' => $total_asis,
            ]);
     }

    public function dashboard(){
        $invitados = ForoLapila::get();
        // Invitados
        $female = $invitados->where('genero','F')->count();
        $male = $invitados->where('genero','M')->count();
        
        // Asistentes
        $asistioFemale = $invitados->where('genero','F')->where('asistio',1)->count();
        $asistioMale = $invitados->where('genero','M')->where('asistio',1)->count();
        
        return view('foros.dashboard',compact('invitados','female','male','asistioFemale','asistioMale'))
            ->with('aBreadCrumb',[['link' => 'active', 'label' => 'Dashboard de COPLADEM FORO LA PILA']])
            ->with('sTitulo', 'Dashboard')
            ->with('sDescripcion', 'Invitados y Asistentes')
            ->with('activePage', 'pilaDashboard')
            ->with('mainPage', 'lapila');
    }
}