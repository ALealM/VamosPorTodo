<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Acuerdos;
use App\Models\Archivo;
use App\Models\Dependencias;
use App\Models\Gabinete;
use Illuminate\Support\Facades\Session;
use Redirect;
use Illuminate\Support\Facades\Blade;
use VendorPackage\View\Components\AlertComponent;
    
    

class PeticionAcuerdoController extends Controller {

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct() {
    $this->middleware('auth');
  }
    

    
  public function index() {
      $acuerdos = Acuerdos::where('id_usuario', \Auth::User()->id)->orderBy('fecha_otorgada','DESC')->get();
      //dd($acuerdos);
    return view('peticion.index', [//000
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Reuniones para solicitud de acuerdos']],
      'acuerdos' => $acuerdos,
    ]);
  }
    
    public function acuerdo() {
        $acuerdos = Acuerdos::all();
        return view('peticion.acuerdo', [//000
                    'aBreadCrumb' => [['link' => 'active', 'label' => 'Peticion Acuerdo']],
                    'acuerdos' => $acuerdos,
                    ]);
    }
    

    public function listado() {
        $acuerdos = Acuerdos::all();
        return view('peticion.listado', [//000
                    'aBreadCrumb' => [['link' => 'active', 'label' => 'Listados de Peticion de Acuerdo']],
                    'acuerdos' => $acuerdos,
                    ]);
    }
    
    
  public function acuerdoCreate() {
      $acuerdos = Acuerdos::all();
      $dependencias = Dependencias::pluck('dependencia','id');
      $estatus = [0=>'Sin iniciar', 1=>'En proceso', 2=>'Finalizado', 3=>'Enviado'];
    return view('peticion.acuerdo', [
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta nuevo acuerdo']],
      'acuerdos' => $acuerdos,
      'dependencias' => $dependencias,
      'estatus' => $estatus,
    ]);
  }

  public function acuerdoEdit($id) {
      $acuerdo = Acuerdos::find($id);
      //$estatus = [0=>'Sin iniciar', 1=>'En proceso', 2=>'Finalizado'];
        return view('peticion.edit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de reunión']],
                    'acuerdo' => $acuerdo,
        ]);
    }


public function acuerdoUpdate(Request $request) {
    $input = $request->all();
        //dd($input);
        $acuerdo = Acuerdos::find($input['id']);
        $arc = Acuerdos::editaRegistro($input);
        //dd($arc);
        if ($arc) {
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha modificado exitosamente la reunión'");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la reunión.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('peticion/index');
    }    
    
    
    public function acuerdoUpdate2(Request $request) {
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
      return Redirect::to('peticion/index');

    }

   
  public function acuerdoStore(Request $request) {
    $input = $request->all();
      $input['id_dependencia']=\Auth::User()->id_gabinete; 
      $arc = Acuerdos::creaRegistro($input);
      if ($arc) {
          Session::flash('tituloMsg', 'Guardado exitoso!');
          Session::flash('mensaje', "Se ha guardado existosamente la reunión.");
          Session::flash('tipoMsg', 'success');
      } else {
          Session::flash('tituloMsg', 'Guardado fallido!');
          Session::flash('mensaje', "No se ha podido guardar la reunión.");
          Session::flash('tipoMsg', 'error');
      }
      
    return Redirect::to('peticion/index');
  }

  
    
    
    
  public function acuerdoStore2(Request $request) {
    $input = $request->all();
      //        $tot = Archivo::count();
      $input['id_dependencia']=\Auth::User()->id_gabinete; 
      $fecha = explode('-',$input['fecha']);
      $tot = Acuerdos::whereYear('fecha',$fecha[0])->whereMonth('fecha',$fecha[1])->count();
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
      
      $arc = Acuerdos::creaRegistro($input);
      if ($arc) {
          $accion = 'Se dió de alta un nuevo documento: '.$fecha[0].'-'.$fecha[1].'-'.$input['consecutivo'].'.';
          Bitacora::creaRegistro($accion);

          Session::flash('tituloMsg', 'Guardado exitoso!');
          Session::flash('mensaje', "Se ha guardado existosamente el archivo.");
          Session::flash('tipoMsg', 'success');
      } else {
          Session::flash('tituloMsg', 'Guardado fallido!');
          Session::flash('mensaje', "No se ha podido guardar el archivo.");
          Session::flash('tipoMsg', 'error');
      }
      
    return Redirect::to('peticion/index');
  }


    public function acuerdoShow($id) {
    $acuerdo = Acuerdos::find($id);
    $dependencias = Dependencias::pluck('dependencia','id');
    //        dd($responsables);
    return view('peticion.show', [
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Acuerdo']],
      'acuerdo' => $acuerdo,
      'dependencias' => $dependencias,
    ]);
  }

public function acuerdoDelete($id) {
    $acuerdo = Acuerdos::where('id', $id)->first();
    $acuerdo->delete();
    Session::flash('tituloMsg', 'Borrado exitoso!');
    Session::flash('mensaje', "Se ha borrado existosamente el registro.");
    Session::flash('tipoMsg', 'success');
    return Redirect::to('peticion/index');
}

  
public function eventoEnviar(Request $request) {
        $accion = "Envío del evento ".$request->get('id')." por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $evento = Acuerdos::find($request->get('id'));
        $evento->estatus = 3;
        $evento->save();
        $e['estatus'] = 'PENDIENTE';
        return $e;
    }


  }




