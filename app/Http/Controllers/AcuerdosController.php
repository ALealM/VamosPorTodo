<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Acuerdos;
use App\Models\AcuerdosActividades;
use App\Models\Archivo;
use App\Models\Dependencias;
use Illuminate\Support\Facades\Session;
use Redirect;
use Illuminate\Support\Facades\Blade;
use VendorPackage\View\Components\AlertComponent;



class AcuerdosController extends Controller {

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct() {
    $this->middleware('auth');
  }



    /**
     * Bootstrap your package's services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('package-alert', AlertComponent::class);
        Blade::component('package-alert', Alert::class);
    }


  public function index() {
      $acuerdos = Acuerdos::all();
      $acuerdos_actividades = AcuerdosActividades::all();
      $reunionresp = AcuerdosActividades::where('id_acuerdo',$acuerdos->id)->get();
      dd('$reunionresp');
    return view('peticion.acuerdos_actividades.index', [//000
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Peticion Acuerdo']],
      'acuerdos' => $acuerdos,
    ]);
  }

    public function acuerdo() {
        $acuerdos = Acuerdos::all();
        return view('peticion.acuerdos_actividades.acuerdo', [//000
                    'aBreadCrumb' => [['link' => 'active', 'label' => 'Peticion Acuerdo']],
                    'acuerdos' => $acuerdos,
                    ]);
    }


    public function listado() {
        $acuerdos = Acuerdos::all();
        return view('peticion.acuerdos_actividades.listado', [//000
                    'aBreadCrumb' => [['link' => 'active', 'label' => 'Listados de Peticion de Acuerdo']],
                    'acuerdos' => $acuerdos,
                    ]);
    }


  public function acuerdoCreate() {
      $acuerdos = Acuerdos::all();
      $dependencias = Dependencias::pluck('dependencia','id');
      $estatus = [0=>'Sin iniciar', 1=>'En proceso', 2=>'Finalizado'];
    return view('peticion.acuerdos_actividades.acuerdo', [
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta nuevo acuerdo']],
      'acuerdos' => $acuerdos,
      'dependencias' => $dependencias,
      'estatus' => $estatus,
    ]);
  }

  public function acuerdoEdit($id) {
      $acuerdo = Acuerdos::find($id);
      $dependencias = Dependencias::pluck('dependencia','id');
      $estatus = [0=>'Sin iniciar', 1=>'En proceso', 2=>'Finalizado'];
        return view('peticion.acuerdos_actividades.edit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de acuerdo']],
                    'acuerdo' => $acuerdo,
                    'dependencias' => $dependencias,
                    'estatus' => $estatus,
        ]);
    }

    public function acuerdoUpdate(Request $request) {
        $input = $request->all();
        $acuerdoAnt = Acuerdos::find($input['id']);
        $acuerdo = Acuerdos::editaRegistro($input);

        if ($acuerdo) {
            $acuerdoN = Acuerdos::find($input['id']);
            $accion = "Edición de petición de acuerdo'" . $acuerdoAnt->acuerdo ."' por: ". $acuerdoN->acuerdo;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha modificado exitosamente la petición de acuerdo '" . $acuerdoAnt->acuerdo."' por: ". $acuerdoN->acuerdo);
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la petición de acuerdo.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('peticion/acuerdos_actividades/index');
    }

  public function acuerdoStore(Request $request) {
      $input = $request->all();
      //dd($input);
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

    return Redirect::to('peticion/acuerdos_actividades/index');
  }



  public function acuerdo_actividades() {
      $acuerdos_actividades = AcuerdosActividades::where('id_responsable', \Auth::User()->id_gabinete)->get();
      //dd($acuerdos_actividades);


      //dd('$reunionresp');
    return view('peticion.acuerdos_actividades.index', [//000
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Peticion Acuerdo']],
      //'acuerdos' => $acuerdos,
      'acuerdos_actividades' => $acuerdos_actividades,
    ]);
  }


}
