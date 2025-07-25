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
use App\Models\Dependencias;
use App\Models\Gabinete;
use Illuminate\Support\Facades\Session;
use Redirect;
use Illuminate\Support\Facades\Blade;
use VendorPackage\View\Components\AlertComponent;

class FichaAcuerdoController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function fichaacuerdo($id) {
        //$acuerdos = new \App\Models\Acuerdos();
        $acuerdo = Acuerdos::find($id);
        //$responsable = Acuerdos::pluck('responsable','id');
        //dd($responsable);
        $direcciones = Gabinete::pluck('direccion', 'id');
        //dd($direcciones);
        return view('peticion.acuerdo.ficha_acuerdo', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Peticion Acuerdo']],
            'acuerdo' => $acuerdo,
            //'responsable' => $responsable,
            'direcciones' => $direcciones,
        ]);
    }
    
    

    public function avance($id) {
        $avance = Acuerdos::find($id);
        return view('peticion.avance.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de avance']],
            'avance' => $avance,
        ]);
    }

    public function fichaacuerdoCreate() {
        $acuerdos = Acuerdos::all();
        $dependencias = Dependencias::pluck('dependencia', 'id');
        $estatus = [0 => 'Enviado', 4 => 'Autorizado', 5 => 'No Autorizado'];
        return view('peticion.acuerdo.ficha_acuerdo', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta nuevo acuerdo']],
            'acuerdos' => $acuerdos,
            'dependencias' => $dependencias,
            'estatus' => $estatus,
        ]);
    }

    public function fichaacuerdoEdit($id) {
        $acuerdo = Acuerdos::find($id);
        return view('peticion.acuerdo.edit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de acuerdo']],
            'acuerdo' => $acuerdo,
        ]);
    }

    public function fichaacuerdoUpdate(Request $request) {
        $input = $request->all();

        return Redirect::to('peticion/acuerdo/ficha_acuerdo');
    }

    public function fichaacuerdoStore(Request $request) {
        $input = $request->all();
 //   dd($input);
        $i = 0;
        foreach ($input['actividad'] as $ac) {
            $avance=0;
            $data['id_acuerdo'] = $input['id'];
            $data['actividad'] = $ac;
            $data['fecha'] = $input['fecha'][$i];
            $data['id_responsable'] = $input['id_responsable'][$i];
            //$data['avance'] = $avance[$i];
            $act = AcuerdosActividades::creaRegistroFicha($data);
            if ($act) {
                //dd($act);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente los acuerdos'");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el acuerdo.");
            Session::flash('tipoMsg', 'error');
        }
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

    public function fichaacuerdoShow($id) {
//    dd($id);
        $acuerdo = Acuerdos::find($id);
    //dd($acuerdo);
        $ficha = AcuerdosActividades::where('id_acuerdo', $id)->get();
        //dd($ficha);
        $direcciones = Gabinete::pluck('direccion', 'id');
        $colaboradores = AcuerdosColaboradores::where('id_actividad',$id)->get();
            //dd($colaboradores);
        return view('peticion.acuerdo.show', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Acuerdo']],
            'acuerdo' => $acuerdo,
            'ficha' => $ficha,
            'direcciones' => $direcciones,
            'fecha_solicitada' => 'fecha_solicitada'
        ]);
    }
    
   
    
    

    public function delete($id) {
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
    
    
      public function acuerdos_actividadesShow($id) {
        $acuerdoAct = AcuerdosActividades::find($id);

        return view('peticion.acuerdos_actividades.show', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Acuerdos']],
            'acuerdoAct' => $acuerdoAct
        ]);
    }
    
    

}
