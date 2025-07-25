<?php

namespace App\Http\Controllers\Foros;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Foros\ForoColonia;
use App\Models\DependenciasCopladem as DC;
use Illuminate\Support\Facades\Session;
use Redirect;

class ForoColoniaController extends Controller {

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
    public function coloniaindex() {
        $invitados = ForoColonia::all();
        $total = ForoColonia::all()->count();
        $asistentes = ForoColonia::where('asistio', 1)->count();
        return view('foros.sanluis_colonia.index', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados FORO SAN LUIS EN TU COLONIA']],
            'invitados' => $invitados,
            'total' => $total,
            'asistentes' => $asistentes
        ]);
    }

    public function coloniaasistencia(Request $request) {
        $inv = $request->get('id');
        $check = $request->get('check');
        $invitado = ForoColonia::find($inv);
        $invitado->asistio = $check;
        $invitado->save();
        $r['invitados'] = ForoColonia::where('asistio', 1)->count();
        return $r;
    }

    public function create() {
        $accion = "Creación de nuevo asistente del COPLADEM FORO SAN LUIS EN TU COLONIA por usuario ID: " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        return view('foros.sanluis_colonia.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de asistente']],
            'sTitulo' => 'COPLADEM Foro San Luis en tu Colonia',
            'sDescripcion' => 'Alta de nuevo asistente'
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $inv = ForoColonia::creaRegistro($input);
        if ($inv) {
            $accion = 'Creación de nuevo invitado FORO SAN LUIS EN TU COLONIA: ID ' . $inv->id;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha dado de alta exitosamente el nuevo asistente.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo asistente.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('sanluis_colonia/index');
    }
    
    
    public function coloniaasistentes() {
         $invitados = ForoColonia::all();
         $asistentes = ForoColonia::where('asistio',1)->get();
         $total = ForoColonia::all()->count();
         $total_asis = ForoColonia::where('asistio',1)->count();
         return view('foros.sanluis_colonia.asistentes', [//000
                     'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Invitados COPLADEM FORO SAN LUIS EN TU COLONIA']],
                     'invitados' => $invitados,
                     'asistentes' => $asistentes,
                     'total' => $total,
                     'total_asis' => $total_asis,
                     ]);
     }
     
     public function coloniaordendia() {
       $invitados = ForoColonia::all();
        $total = ForoColonia::all()->count();
        $total_asis = ForoColonia::where('asistio',1)->count();
        return view('foros.sanluis_colonia.ordendia', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Órden de día COPLADEM FORO SAN LUIS EN TU COLONIA']],
            'invitados' => $invitados,
            'total' => $total,
            'total_asis' => $total_asis,
            ]);
     }

    public function dashboard(){
        $invitados = ForoColonia::get();
        // Invitados
        $female = $invitados->where('genero','F')->count();
        $male = $invitados->where('genero','M')->count();
        
        // Asistentes
        $asistioFemale = $invitados->where('genero','F')->where('asistio',1)->count();
        $asistioMale = $invitados->where('genero','M')->where('asistio',1)->count();
        
        return view('foros.dashboard',compact('invitados','female','male','asistioFemale','asistioMale'))
            ->with('aBreadCrumb',[['link' => 'active', 'label' => 'Dashboard de COPLADEM FORO SAN LUIS EN TU COLONIA']])
            ->with('sTitulo', 'Dashboard')
            ->with('sDescripcion', 'Invitados y Asistentes')
            ->with('activePage', 'coloniaDashboard')
            ->with('mainPage', 'colonia');
    }
}