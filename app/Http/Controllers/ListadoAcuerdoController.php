<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Acuerdos;
use App\Models\Archivo;
use App\Models\Gabinete;
use App\Models\Dependencias;
use Illuminate\Support\Facades\Session;
use Redirect;
use Illuminate\Support\Facades\Blade;
use VendorPackage\View\Components\AlertComponent;
    
    

class ListadoAcuerdoController extends Controller {

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct() {
    $this->middleware('auth');
  }
  

    public function listado() {
        $acuerdos = Acuerdos::where('estatus','>=',0)->orderBy('fecha_otorgada', 'DESC')->get();
        //dd($acuerdos);
        return view('peticion.listado.listado', [//000
                    'aBreadCrumb' => [['link' => 'active', 'label' => 'Listados de Peticion de Acuerdo']],
                    'acuerdos' => $acuerdos,
                    ]);
    }
    
    
  public function acuerdolistadoCreate() {
      $dependencias = Dependencias::pluck('dependencia','id');
      $estatus = [0=>'Sin iniciar', 1=>'En proceso', 2=>'Finalizado', 3=>'Enviado', 4=>'Autorizado', 5=>'No autorizado'];
    return view('peticion.listado.listadocreate', [
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta nuevo acuerdo']],
      'dependencias' => $dependencias,
      'estatus' => $estatus,
    ]);
  }

  public function acuerdolistadoEdit($id) {
      $acuerdo = Acuerdos::find($id);/*->where('estatus',3)->get();*/
      //dd($acuerdo);
      $estatus = [4=>'Autorizado', 5=>'No autorizado']; /*[0=>'Sin iniciar', 1=>'En proceso', 2=>'Finalizado'];*/
        return view('peticion.listado.listadoedit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de acuerdo']],
                    'acuerdo' => $acuerdo,
                    'estatus' => $estatus,
        ]);
    }

    public function acuerdolistadoUpdate(Request $request) {
        $input = $request->all();
        //dd($input);
        $ac = Acuerdos::editalistadoRegistro($input);
        $acuerdo = Acuerdos::find($input['id']);

        if ($ac) {
            
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha modificado exitosamente la reunión ");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la reunión.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('peticion/listado');
    }

  public function acuerdolistadoStore(Request $request) {
      $input = $request->all();
      //        $tot = Archivo::count();
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
      
    return Redirect::to('peticion/listado');
  }
  
  
  
 public function acuerdolistadoShow($id) {
      $acuerdo = Acuerdos::find($id);/*->where('estatus',3)->get();*/
      //dd($acuerdo);
      $estatus = [0=>'Sin iniciar', 1=>'En proceso', 2=>'Finalizado', 3=>'Enviado', 4=>'Autorizado', 5=>'No autorizado']; /*[0=>'Sin iniciar', 1=>'En proceso', 2=>'Finalizado'];*/
        return view('peticion.listado.show', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Consulta de reunión']],
                    'acuerdo' => $acuerdo,
                    'estatus' => $estatus,
        ]);
    }

}
