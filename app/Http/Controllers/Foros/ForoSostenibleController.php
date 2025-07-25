<?php

namespace App\Http\Controllers\Foros;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Foros\ForoSostenible;
use App\Models\DependenciasCopladem as DC;
use Illuminate\Support\Facades\Session;
use Redirect;

class ForoSostenibleController extends Controller {

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
    public function sostenibleindex() {
        $invitados = ForoSostenible::all();
        $total = ForoSostenible::all()->count();
        $asistentes = ForoSostenible::where('asistio', 1)->count();
        //$integrantes = PrimerForo::where('asistio', 1)->where('integrante', 1)->count();
        //dd($invitados);
        return view('foros.sanluis_sostenible.index', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados FORO SOSTENIBLE']],
            'invitados' => $invitados,
            'total' => $total,
            'asistentes' => $asistentes,
            //'integrantes' => $integrantes,
        ]);
    }

    public function sosteniblemapa() {
        $invitados = PrimerForo::all();
        $total = PrimerForo::all()->count();
        $total_asis = PrimerForo::where('asistio',1)->count();
        //$total_integ = PrimerForo::where('asistio', 1)->where('integrante', 1)->count();
        return view('foros.primer_foro.mapa', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Mapa de Invitados COPLADEM FORO SOSTENIBLE']],
            'invitados' => $invitados,
            'total' => $total,
            'total_asis' => $total_asis,
            //'total_integ' => $total_integ,
        ]);
    }

    public function sostenibleasistencia(Request $request) {
        $inv = $request->get('id');
        $check = $request->get('check');
        $invitado = ForoSostenible::find($inv);
        $invitado->asistio = $check;
        $invitado->save();
        $r['invitados'] = ForoSostenible::where('asistio', 1)->count();
        //$r['integrantes'] = Invitados::where('asistio', 1)->where('integrante', 1)->count();
        return $r;
    }

    public function sostenibleStore(Request $request) {
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
        $accion = "Creación de nuevo asistente del COPLADEM Foro Sostenible por usuario ID: " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        return view('foros.sanluis_sostenible.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de asistente']],
            'sTitulo' => 'COPLADEM Foro Sostenible',
            'sDescripcion' => 'Alta de nuevo asistente'
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $inv = ForoSostenible::creaRegistro($input);
        if ($inv) {
            $accion = 'Creación de nuevo invitado foro sostenible: ID ' . $inv->id;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha dado de alta exitosamente el nuevo asistente.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo asistente.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('sanluis_sostenible/index');
    }
    
    
    public function sostenibleasistentes() {
         $invitados = ForoSostenible::all();
         $asistentes = ForoSostenible::where('asistio',1)->get();
         $total = ForoSostenible::all()->count();
         $total_asis = ForoSostenible::where('asistio',1)->count();
         //dd($asistentes);
         return view('foros.sanluis_sostenible.asistentes', [//000
                     'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados COPLADEM FORO SOSTENIBLE']],
                     'invitados' => $invitados,
                     'asistentes' => $asistentes,
                     'total' => $total,
                     'total_asis' => $total_asis,
                     ]);
     }
     
     public function sostenibleordendia() {
       $invitados = ForoSostenible::all();
        $total = ForoSostenible::all()->count();
        $total_asis = ForoSostenible::where('asistio',1)->count();
        return view('foros.sanluis_sostenible.ordendia', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Órden de día COPLADEM FORO SOSTENIBLE']],
            'invitados' => $invitados,
            'total' => $total,
            'total_asis' => $total_asis,
            ]);
     }

    public function dashboard(){
        $invitados = ForoSostenible::get();
        // Invitados
        $female = $invitados->where('genero','F')->count();
        $male = $invitados->where('genero','M')->count();
        
        // Asistentes
        $asistioFemale = $invitados->where('genero','F')->where('asistio',1)->count();
        $asistioMale = $invitados->where('genero','M')->where('asistio',1)->count();
        
        return view('foros.dashboard',compact('invitados','female','male','asistioFemale','asistioMale'))
            ->with('aBreadCrumb',[['link' => 'active', 'label' => 'Dashboard de COPLADEM FORO SOSTENIBLE']])
            ->with('sTitulo', 'Dashboard')
            ->with('sDescripcion', 'Invitados y Asistentes')
            ->with('activePage', 'sostenibleDashboard')
            ->with('mainPage', 'sostenible');
    }
}