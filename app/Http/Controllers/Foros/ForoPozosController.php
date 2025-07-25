<?php

namespace App\Http\Controllers\Foros;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Foros\ForoPozos;
use App\Models\DependenciasCopladem as DC;
use Illuminate\Support\Facades\Session;
use Redirect;

class ForoPozosController extends Controller {

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
    public function pozosindex() {
        $invitados = ForoPozos::all();
        $total = ForoPozos::all()->count();
        $asistentes = ForoPozos::where('asistio', 1)->count();
        return view('foros.pozos.index', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados FORO VILLA DE POZOS']],
            'invitados' => $invitados,
            'total' => $total,
            'asistentes' => $asistentes
        ]);
    }

    public function pozosasistencia(Request $request) {
        $inv = $request->get('id');
        $check = $request->get('check');
        $invitado = ForoPozos::find($inv);
        $invitado->asistio = $check;
        $invitado->save();
        $r['invitados'] = ForoPozos::where('asistio', 1)->count();
        return $r;
    }

    public function create() {
        $accion = "Creación de nuevo asistente del COPLADEM FORO VILLA DE POZOS por usuario ID: " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        return view('foros.pozos.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de asistente']],
            'sTitulo' => 'COPLADEM Foro Villa de Pozos',
            'sDescripcion' => 'Alta de nuevo asistente'
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $inv = ForoPozos::creaRegistro($input);
        if ($inv) {
            $accion = 'Creación de nuevo invitado FORO VILLA DE POZOS: ID ' . $inv->id;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha dado de alta exitosamente el nuevo asistente.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo asistente.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('pozos/index');
    }
    
    
    public function pozosasistentes() {
         $invitados = ForoPozos::all();
         $asistentes = ForoPozos::where('asistio',1)->get();
         $total = ForoPozos::all()->count();
         $total_asis = ForoPozos::where('asistio',1)->count();
         return view('foros.pozos.asistentes', [//000
                     'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados COPLADEM FORO VILLA DE POZOS']],
                     'invitados' => $invitados,
                     'asistentes' => $asistentes,
                     'total' => $total,
                     'total_asis' => $total_asis,
                     ]);
     }
     
     public function pozosordendia() {
       $invitados = ForoPozos::all();
        $total = ForoPozos::all()->count();
        $total_asis = ForoPozos::where('asistio',1)->count();
        return view('foros.pozos.ordendia', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Órden de día COPLADEM FORO VILLA DE POZOS']],
            'invitados' => $invitados,
            'total' => $total,
            'total_asis' => $total_asis,
            ]);
     }

    public function dashboard(){
        $invitados = ForoPozos::get();
        // Invitados
        $female = $invitados->where('genero','F')->count();
        $male = $invitados->where('genero','M')->count();
        
        // Asistentes
        $asistioFemale = $invitados->where('genero','F')->where('asistio',1)->count();
        $asistioMale = $invitados->where('genero','M')->where('asistio',1)->count();
        
        return view('foros.dashboard',compact('invitados','female','male','asistioFemale','asistioMale'))
            ->with('aBreadCrumb',[['link' => 'active', 'label' => 'Dashboard de COPLADEM FORO VILLA DE POZOS']])
            ->with('sTitulo', 'Dashboard')
            ->with('sDescripcion', 'Invitados y Asistentes')
            ->with('activePage', 'pozosDashboard')
            ->with('mainPage', 'pozos');
    }
}