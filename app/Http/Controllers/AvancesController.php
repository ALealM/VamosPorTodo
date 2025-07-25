<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Acuerdos;
use App\Models\AcuerdosActividades;
use App\Models\AcuerdosArchivos;
use App\Models\AcuerdosColaboradores;
use App\Models\Archivo;
use App\Models\Avances;
use App\Models\Dependencias;
use App\Models\Gabinete;
use Illuminate\Support\Facades\Session;
use Redirect;
use Illuminate\Support\Facades\Blade;
use VendorPackage\View\Components\AlertComponent;

class AvancesController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index($id) {
        $acuerdos = AcuerdosActividades::find($id);
        return view('peticion.avance.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de avance']],
            'acuerdos' => $acuerdos,
        ]);
    }
    
    public function avances($id) { 
        $acuerdos = AcuerdosActividades::where('id_responsable',$id)->first();
        //dd($acuerdos);
        //$avances = Avances::find($id);
        
        //$responsable = Acuerdos::pluck('responsable','id');
        //dd($responsable);
        //$direcciones = Gabinete::pluck('direccion', 'id');
        //dd($direcciones);
        return view('peticion.avances.index', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Registro de Avances']],
            //'avances' => $avances,
            'acuerdos' => $acuerdos,
            //'direcciones' => $direcciones,
        ]);
    }

    /*public function avance($id) {
        $avances = AcuerdosActividades::find($id);
        acuerdos = Acuerdos::find($id);
        return view('peticion.avance.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de avance']],
            'avances' => $avances,
        ]);
    }*/

    public function avancesCreate() {
        $avances = Avances::all();
        $acuerdo = Acuerdos::pluck('id_acuerdos', 'id');
        $direcciones = Gabinete::pluck('direccion', 'id');
        return view('peticion.avance.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta nuevo avance']],
            'avances' => $avances,
            'acuerdo' => $acuerdo,
            'direcciones' => $direcciones,
        ]);
    }

    public function avancesEdit($id) {
        $avances = Avances::find($id);
        $acuerdo = Acuerdos::pluck('id_acuerdos', 'id');
        $direcciones = Gabinete::pluck('direccion', 'id');
        return view('peticion.acuerdo.edit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de avance']],
            'avances' => $avances,
            'acuerdo' => $acuerdo,
            'direcciones' => $direcciones,
        ]);
    }

    public function avancesUpdate(Request $request) {
        $input = $request->all();

        return Redirect::to('peticion/acuerdo/ficha_acuerdo');
    }

    public function avancesStore(Request $request) {
        $input = $request->all();
//    dd($input);
        $i = 0;
        foreach ($input['actividad'] as $ac) {
            $data['id_acuerdo'] = $input['id'];
            $data['actividad'] = $ac;
            $data['fecha'] = $input['fecha'][$i];
            $data['id_responsable'] = $input['id_responsable'][$i];
            $data['avance'] = $input['avance'][$i];
            $act = AcuerdosActividades::creaRegistro($data);
//            if (isset($input['archivo'][$input['rand'][$i]])) {
//                foreach ($input['archivo'][$input['rand'][$i]] as $arch) {
//                    $dataA['id_actividad'] = $act->id;
//                    $dataA['id_acuerdo'] = $input['id'];
//                    $file = $arch;
//                    $ext = $file->getClientOriginalExtension();
//                    $name = $file->getClientOriginalName();
//                    $dataA['archivo'] = $act->id . "-" . $name . "." . $ext;
//                    $file->move(public_path() . "/acuerdos/", $dataA['archivo']);
//                    AcuerdosArchivos::creaRegistro($dataA);
//                }
//            }
            if (isset($input['colaboradores'][$input['rand'][$i]])) {
                foreach ($input['colaboradores'][$input['rand'][$i]] as $col) {
                    $dataC['id_actividad'] = $act->id;
                    $dataC['id_gabinete'] = $col;
                    AcuerdosColaboradores::creaRegistro($dataC);
                }
            }
            $i++;
        }
        return Redirect::to('peticion/index');
    }

    public function avancesShow($id) {
//    dd($id);
        $acuerdo = Acuerdos::find($id);
//    dd($acuerdo);
        $ficha = AcuerdosActividades::where('id_acuerdo', $id)->get();
        //dd($ficha);
        $direcciones = Gabinete::pluck('direccion', 'id');
//            dd($ficha);
        return view('peticion.acuerdo.show', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Acuerdo']],
            'acuerdo' => $acuerdo,
            'ficha' => $ficha,
            'direcciones' => $direcciones,
            'fecha_solicitada' => 'fecha_solicitada'
        ]);
    }

    public function avancesDelete($id) {
        $acuerdo = User::where('id', $id)->first();
        $acuerdo->delete();
        Session::flash('tituloMsg', 'Borrado exitoso!');
        Session::flash('mensaje', "Se ha borrado existosamente el registro.");
        Session::flash('tipoMsg', 'success');
        return Redirect::to('peticion/index');
    }

    public function addLineAV(Request $request) {
        //$acuerdos = new \App\Models\Acuerdos();
        $acuerdo = Acuerdos::find($request->get('id'));
        //$responsable = Acuerdos::pluck('responsable','id');
        //dd($responsable);
        $direcciones = Gabinete::pluck('direccion', 'id');
        //dd($direcciones);
        return view('peticion.acuerdo.vista_ficha_acuerdo', [//000
            'acuerdo' => $acuerdo,
            //'responsable' => $responsable,
            'direcciones' => $direcciones,
            'rand' => $request->get('rand'),
        ]);
    }

}
