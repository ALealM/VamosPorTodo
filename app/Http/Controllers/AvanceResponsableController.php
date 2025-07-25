<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Acuerdos;
use App\Models\AcuerdosActividades;
use App\Models\AcuerdosColaboradores;
use App\Models\EvidenciaResponsable;
use App\Models\Archivo;
use App\Models\ResponsablesArchivos;
use App\Models\Dependencias;
use App\Models\Gabinete;
//use App\Models\Colaborador;
use Illuminate\Support\Facades\Session;
use Redirect;
use Illuminate\Support\Facades\Blade;
use VendorPackage\View\Components\AlertComponent;



class AvanceResponsableController extends Controller {

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct() {
    $this->middleware('auth');
  }




  public function index() {
      $responsable = AcuerdosActividades::where('id_responsable',\Auth::User()->id_gabinete)->get();
      $i=0;
foreach ($responsable as $resp) {
      $avance = EvidenciaResponsable::where('id_actividad',$responsable[$i]->id)->pluck('avance')->first();
      $i++;
}

      //dd($avance);
      //$id_responsable = AcuerdosColaboradores::where('id_actividad',$responsable->id)->get();
      //dd($id_responsable);
    return view('peticion.responsable.index', [//000
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Avances en las actividades de acuerdos']],
      'responsable' => $responsable,
      'avance' => @$avance,
    ]);
  }


  public function responsableEdit($id) {
      $responsable = AcuerdosActividades::find($id);
      //dd($responsable);
      $acuerdo = Acuerdos::where('id',$responsable->id_acuerdo)->get();
      //dd($acuerdo);
        return view('peticion.responsable.edit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Actualización de actividades de acuerdos']],
            'responsable' => $responsable,
            'acuerdo' => $acuerdo,
        ]);
    }


public function responsableUpdate(Request $request) {
    $input = $request->all();
        //dd($input);
        $actividadesresp = AcuerdosActividades::find($input['id']);
        //dd($actividadesresp);

            $input['id_acuerdo'] = $actividadesresp->id_acuerdo;
            $input['id_responsable'] = $actividadesresp->id_responsable;
            if (isset($input['archivo'])) {
                $fecha = explode('-', $actividadesresp->fecha);
                //dd($fecha);
                $file = $request->file('archivo');
                $nombre = $fecha[0] . '-' . $input['id'] . '_' . $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                $tmp_archivo = $_FILES['archivo']['tmp_name'];
                $archivador = public_path() . '/archivos/responsable/' . $nombre;
                move_uploaded_file($tmp_archivo, $archivador);
                $input['archivo'] = $nombre;
            } else {
                $input['archivo'] = $actividadesresp->archivo;
            }

        $evidencia = EvidenciaResponsable::creaRegistro($input);
        //dd($arc);
        if ($evidencia) {
        /*$fecha = explode('-',$input['fecha']);
          $accion = 'Se dió de alta un nuevo documento: '.$fecha[0].'-'.$fecha[1].'-'.$input['consecutivo'].'.';
          Bitacora::creaRegistro($accion);*/

            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha guardado exitosamente el avance'");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el avance.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('peticion/responsable/index');
    }


    public function responsableShow($id) {
    $responsable = AcuerdosActividades::find($id);
    $evidencia = EvidenciaResponsable::find($id);
    //dd($responsable);
    return view('peticion.responsable.show', [
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Acuerdo']],
      'responsable' => $responsable,
      'evidencia' => $evidencia,
        ]);
  }



public function responsableDelete($id) {
    $responsable = EvidenciaResponsable::where('id', $id)->first();
    $responsable->delete();
    Session::flash('tituloMsg', 'Borrado exitoso!');
    Session::flash('mensaje', "Se ha borrado existosamente el registro.");
    Session::flash('tipoMsg', 'success');
    return Redirect::to('peticion/responsable/index');
}





  }
