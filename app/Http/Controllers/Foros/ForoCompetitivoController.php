<?php

namespace App\Http\Controllers\Foros;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Foros\ForoCompetitivo;
use App\Models\DependenciasCopladem as DC;
use Illuminate\Support\Facades\Session;
use Redirect;

class ForoCompetitivoController extends Controller {

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
    public function competitivoindex() {
        $invitados = ForoCompetitivo::all();
        $total = ForoCompetitivo::all()->count();
        $asistentes = ForoCompetitivo::where('asistio', 1)->count();
        return view('foros.sanluis_competitivo.index', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados FORO SAN LUIS COMPETITIVO']],
            'invitados' => $invitados,
            'total' => $total,
            'asistentes' => $asistentes
        ]);
    }

    public function competitivoasistencia(Request $request) {
        $inv = $request->get('id');
        $check = $request->get('check');
        $invitado = ForoCompetitivo::find($inv);
        $invitado->asistio = $check;
        $invitado->save();
        $r['invitados'] = ForoCompetitivo::where('asistio', 1)->count();
        return $r;
    }

    public function create() {
        $accion = "Creación de nuevo asistente del COPLADEM FORO COMPETITIVO por usuario ID: " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        return view('foros.sanluis_competitivo.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de asistente']],
            'sTitulo' => 'COPLADEM Foro San Luis Competitivo',
            'sDescripcion' => 'Alta de nuevo asistente'
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $inv = ForoCompetitivo::creaRegistro($input);
        if ($inv) {
            $accion = 'Creación de nuevo invitado FORO COMPETITIVO: ID ' . $inv->id;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha dado de alta exitosamente el nuevo asistente.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo asistente.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('sanluis_competitivo/index');
    }
    
    
    public function competitivoasistentes() {
         $invitados = ForoCompetitivo::all();
         $asistentes = ForoCompetitivo::where('asistio',1)->get();
         $total = ForoCompetitivo::all()->count();
         $total_asis = ForoCompetitivo::where('asistio',1)->count();
         return view('foros.sanluis_competitivo.asistentes', [//000
                     'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados COPLADEM FORO SAN LUIS COMPETITIVO']],
                     'invitados' => $invitados,
                     'asistentes' => $asistentes,
                     'total' => $total,
                     'total_asis' => $total_asis,
                     ]);
     }
     
     public function competitivoordendia() {
       $invitados = ForoCompetitivo::all();
        $total = ForoCompetitivo::all()->count();
        $total_asis = ForoCompetitivo::where('asistio',1)->count();
        return view('foros.sanluis_competitivo.ordendia', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Órden de día COPLADEM FORO SAN LUIS COMPETITIVO']],
            'invitados' => $invitados,
            'total' => $total,
            'total_asis' => $total_asis,
            ]);
     }

    public function dashboard(){
        $invitados = ForoCompetitivo::get();
        // Invitados
        $female = $invitados->where('genero','F')->count();
        $male = $invitados->where('genero','M')->count();
        
        // Asistentes
        $asistioFemale = $invitados->where('genero','F')->where('asistio',1)->count();
        $asistioMale = $invitados->where('genero','M')->where('asistio',1)->count();
        
        return view('foros.dashboard',compact('invitados','female','male','asistioFemale','asistioMale'))
            ->with('aBreadCrumb',[['link' => 'active', 'label' => 'Dashboard de COPLADEM FORO SAN LUIS COMPETITIVO']])
            ->with('sTitulo', 'Dashboard')
            ->with('sDescripcion', 'Invitados y Asistentes')
            ->with('activePage', 'competitivoDashboard')
            ->with('mainPage', 'competitivo');
    }
}