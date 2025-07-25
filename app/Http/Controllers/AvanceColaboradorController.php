<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Acuerdos;
use App\Models\AcuerdosActividades;
use App\Models\AcuerdosColaboradores;
use App\Models\EvidenciaColaborador;
use App\Models\Archivo;
use App\Models\Dependencias;
use App\Models\Gabinete;
//use App\Models\Colaborador;
use Illuminate\Support\Facades\Session;
use Redirect;
use Illuminate\Support\Facades\Blade;
use VendorPackage\View\Components\AlertComponent;
    
    

class AvanceColaboradorController extends Controller {

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct() {
    $this->middleware('auth');
  }
    

    

  public function index() {
      $dep = \Auth::User()->id_gabinete;
      $gabinete = AcuerdosColaboradores::where('id_gabinete', $dep)->pluck('id_actividad');
      $colaborador = AcuerdosActividades::where('id',$gabinete)->get();
    return view('peticion.colaborador.index', [//000
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Avances en las actividades de acuerdos']],
      'colaborador' => $colaborador,
    ]);
  }

  
  public function colaboradorEdit($id) {
      $actividadescol = AcuerdosActividades::find($id);
      //dd($actividadescol);
      $acuerdo = Acuerdos::where('id',$actividadescol->id_acuerdo)->get();
      //dd($acuerdo);
        return view('peticion.colaborador.edit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Actualización de actividades de acuerdos']],
            'actividadescol' => $actividadescol,
            'acuerdo' => $acuerdo,
        ]);
    }


    public function colaboradorUpdate(Request $request) {
        $input = $request->all();
        $i = 0;
        //dd($input);
        $actividadescol = AcuerdosActividades::find($input['id']);
        //$colaborador = AcuerdosColaboradores::where('id_actividad', $input['id'])->pluck('id_gabinete');
        $colaborador = \Auth::User()->dependencia()->id;
        //dd($colaborador);

            $input['id_acuerdo'] = $actividadescol->id_acuerdo;
            $input['id_colaborador'] = $colaborador;
            if (isset($input['archivo'])) {
                $fecha = explode('-', $actividadescol->fecha);
                //dd($fecha);
                $file = $request->file('archivo');
                $nombre = $fecha[0] . '-' . $input['id'] . '_' . $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                $tmp_archivo = $_FILES['archivo']['tmp_name'];
                $archivador = public_path() . '/archivos/colaborador/' . $nombre;
                move_uploaded_file($tmp_archivo, $archivador);
                $input['archivo'] = $nombre;
            } else {
                $input['archivo'] = $actividadescol->archivo;
            }
            $evidencia = EvidenciaColaborador::creaRegistro($input);
            //dd($evidencia);
            if ($evidencia) {
                /*$fecha = explode('-',$input['fecha']);
                $accion = 'Se dió de alta un nuevo documento: '.$fecha[0].'-'.$fecha[1].'-'.$input['consecutivo'].'.';
                Bitacora::creaRegistro($accion);*/
                
                Session::flash('tituloMsg', 'Guardado exitoso!');
                Session::flash('mensaje', "Se ha modificado exitosamente la actividad'");
                Session::flash('tipoMsg', 'success');
            } else {
                Session::flash('tituloMsg', 'Guardado fallido!');
                Session::flash('mensaje', "No se ha podido guardar la actividad.");
                Session::flash('tipoMsg', 'error');
            }
            
        return Redirect::to('peticion/colaborador/index');
    }

    
    
    
    public function colaboradorUpdate2(Request $request) {
        $input = $request->all();
        //dd($input);
        $acuerdo = Acuerdos::find($input['id']);
        //dd($input->archivo);
        if(isset($input['archivo'])){
          $fecha = explode('-',$input['fecha_solicitada']);
          //dd($fecha);
          $tot = Acuerdos::whereYear('fecha_solicitada',$fecha[0])->whereMonth('fecha_solicitada',$fecha[1])->count();
          $file = $request->file('archivo');
          $input['consecutivo'] = $tot+1;
          $nombre = $fecha[0].'-'.$fecha[1].'-'.$input['consecutivo'].'_'.$file->getClientOriginalName();
          $ext = $file->getClientOriginalExtension();
          $tmp_archivo = $_FILES['archivo']['tmp_name'];
          $archivador = public_path() . '/archivos/' . $nombre;
          move_uploaded_file($tmp_archivo, $archivador);
          $input['archivo'] = $nombre;
          $input['anio'] = $fecha[0];
          $input['mes'] = $fecha[1];
        }else{
          $input['archivo'] = $acuerdo->archivo;
        }

      $arc = Acuerdos::editaRegistro($input);
      //dd($arc);
      if ($arc) {
          $fecha = explode('-',$input['fecha_solicitada']);
          $accion = 'Se dió de alta un nuevo documento: '.$fecha[0].'-'.$fecha[1].'-'.$input['consecutivo'].'.';
          Bitacora::creaRegistro($accion);

          Session::flash('tituloMsg', 'Guardado exitoso!');
          Session::flash('mensaje', "Se ha modificado exitosamente la petición de acuerdo '" . $arc->acuerdo);
          Session::flash('tipoMsg', 'success');
      } else {
          Session::flash('tituloMsg', 'Guardado fallido!');
          Session::flash('mensaje', "No se ha podido guardar la petición de acuerdo.");
          Session::flash('tipoMsg', 'error');
      }
      return Redirect::to('peticion/colaborador/index');

    }

   
    public function colaboradorShow($id) {
    $colaborador = AcuerdosActividades::find($id);
    $evidencia = EvidenciaColaborador::find($id);
    //dd($colaborador);
    return view('peticion.colaborador.show', [
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Acuerdo']],
      'colaborador' => $colaborador,
      'evidencia' => $evidencia,
        ]);
  }
   

public function colaboradorDelete($id) {
    $colaborador = EvidenciaColaborador::where('id_actividad', $id)->first();
    $colaborador->delete();
    Session::flash('tituloMsg', 'Borrado exitoso!');
    Session::flash('mensaje', "Se ha borrado existosamente el registro.");
    Session::flash('tipoMsg', 'success');
    return Redirect::to('peticion/colaborador/index');
}

  



  }




