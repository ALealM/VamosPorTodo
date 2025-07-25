<?php

namespace App\Http\Controllers\Foros;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Foros\ForoBocas;
use App\Models\DependenciasCopladem as DC;
use Illuminate\Support\Facades\Session;
use Redirect;

class ForoBocasController extends Controller {

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
    public function bocasindex() {
        $invitados = ForoBocas::all();
        $total = ForoBocas::all()->count();
        $asistentes = ForoBocas::where('asistio', 1)->count();
        return view('foros.bocas.index', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados FORO BOCAS']],
            'invitados' => $invitados,
            'total' => $total,
            'asistentes' => $asistentes
        ]);
    }

    public function bocasasistencia(Request $request) {
        $inv = $request->get('id');
        $check = $request->get('check');
        $invitado = ForoBocas::find($inv);
        $invitado->asistio = $check;
        $invitado->save();
        $r['invitados'] = ForoBocas::where('asistio', 1)->count();
        return $r;
    }

    public function create() {
        $accion = "Creación de nuevo asistente del COPLADEM FORO BOCAS por usuario ID: " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        return view('foros.bocas.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de asistente']],
            'sTitulo' => 'COPLADEM Foro Bocas',
            'sDescripcion' => 'Alta de nuevo asistente'
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $inv = ForoBocas::creaRegistro($input);
        if ($inv) {
            $accion = 'Creación de nuevo invitado FORO BOCAS: ID ' . $inv->id;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha dado de alta exitosamente el nuevo asistente.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo asistente.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('bocas/index');
    }
    
    
    public function bocasasistentes() {
         $invitados = ForoBocas::all();
         $asistentes = ForoBocas::where('asistio',1)->get();
         $total = ForoBocas::all()->count();
         $total_asis = ForoBocas::where('asistio',1)->count();
         return view('foros.bocas.asistentes', [//000
                     'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados COPLADEM FORO BOCAS']],
                     'invitados' => $invitados,
                     'asistentes' => $asistentes,
                     'total' => $total,
                     'total_asis' => $total_asis,
                     ]);
     }
     
     public function bocasordendia() {
       $invitados = ForoBocas::all();
        $total = ForoBocas::all()->count();
        $total_asis = ForoBocas::where('asistio',1)->count();
        return view('foros.bocas.ordendia', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Órden de día COPLADEM FORO BOCAS']],
            'invitados' => $invitados,
            'total' => $total,
            'total_asis' => $total_asis,
            ]);
     }

    public function dashboard(){
        $invitados = ForoBocas::get();
        // Invitados
        $female = $invitados->where('genero','F')->count();
        $male = $invitados->where('genero','M')->count();
        
        // Asistentes
        $asistioFemale = $invitados->where('genero','F')->where('asistio',1)->count();
        $asistioMale = $invitados->where('genero','M')->where('asistio',1)->count();
        
        return view('foros.dashboard',compact('invitados','female','male','asistioFemale','asistioMale'))
            ->with('aBreadCrumb',[['link' => 'active', 'label' => 'Dashboard de COPLADEM FORO BOCAS']])
            ->with('sTitulo', 'Dashboard')
            ->with('sDescripcion', 'Invitados y Asistentes')
            ->with('activePage', 'bocasDashboard')
            ->with('mainPage', 'bocas');
    }
}