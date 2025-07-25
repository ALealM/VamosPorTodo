<?php

namespace App\Http\Controllers\Foros;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Foros\ForoBienestar;
use App\Models\DependenciasCopladem as DC;
use Illuminate\Support\Facades\Session;
use Redirect;

class ForoBienestarController extends Controller {

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
    public function bienestarindex() {
        $invitados = ForoBienestar::all();
        $total = ForoBienestar::all()->count();
        $asistentes = ForoBienestar::where('asistio', 1)->count();
        return view('foros.sanluis_bienestar.index', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados FORO SAN LUIS BIENESTAR']],
            'invitados' => $invitados,
            'total' => $total,
            'asistentes' => $asistentes
        ]);
    }

    public function bienestarasistencia(Request $request) {
        $inv = $request->get('id');
        $check = $request->get('check');
        $invitado = ForoBienestar::find($inv);
        $invitado->asistio = $check;
        $invitado->save();
        $r['invitados'] = ForoBienestar::where('asistio', 1)->count();
        return $r;
    }

    public function create() {
        $accion = "Creación de nuevo asistente del COPLADEM FORO SAN LUIS BIENESTAR por usuario ID: " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        return view('foros.sanluis_bienestar.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de asistente']],
            'sTitulo' => 'COPLADEM Foro San Luis Bienestar',
            'sDescripcion' => 'Alta de nuevo asistente'
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $inv = ForoBienestar::creaRegistro($input);
        if ($inv) {
            $accion = 'Creación de nuevo invitado FORO SAN LUIS BIENESTAR: ID ' . $inv->id;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha dado de alta exitosamente el nuevo asistente.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo asistente.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('sanluis_bienestar/index');
    }
    
    
    public function bienestarasistentes() {
         $invitados = ForoBienestar::all();
         $asistentes = ForoBienestar::where('asistio',1)->get();
         $total = ForoBienestar::all()->count();
         $total_asis = ForoBienestar::where('asistio',1)->count();
         return view('foros.sanluis_bienestar.asistentes', [//000
                     'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados COPLADEM FORO SAN LUIS BIENESTAR']],
                     'invitados' => $invitados,
                     'asistentes' => $asistentes,
                     'total' => $total,
                     'total_asis' => $total_asis,
                     ]);
     }
     
     public function bienestarordendia() {
       $invitados = ForoBienestar::all();
        $total = ForoBienestar::all()->count();
        $total_asis = ForoBienestar::where('asistio',1)->count();
        return view('foros.sanluis_bienestar.ordendia', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Órden de día COPLADEM FORO SAN LUIS BIENESTAR']],
            'invitados' => $invitados,
            'total' => $total,
            'total_asis' => $total_asis,
            ]);
     }
     
    public function dashboard(){
        $invitados = ForoBienestar::get();
        // Invitados
        $female = $invitados->where('genero','F')->count();
        $male = $invitados->where('genero','M')->count();
        
        // Asistentes
        $asistioFemale = $invitados->where('genero','F')->where('asistio',1)->count();
        $asistioMale = $invitados->where('genero','M')->where('asistio',1)->count();
        
        return view('foros.dashboard',compact('invitados','female','male','asistioFemale','asistioMale'))
            ->with('aBreadCrumb',[['link' => 'active', 'label' => 'Dashboard de COPLADEM FORO SAN LUIS BIENESTAR']])
            ->with('sTitulo', 'Dashboard')
            ->with('sDescripcion', 'Invitados y Asistentes')
            ->with('activePage', 'bienestarDashboard')
            ->with('mainPage', 'bienestar');
    }
}