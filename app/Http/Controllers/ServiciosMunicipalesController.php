<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\ServicioMunicipal as SM;
use App\Models\ServicioMunicipalDescripcion as SMD;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use Redirect;

class ServiciosMunicipalesController extends Controller {

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
    public function index() {
        $servMun = SM::where('activo', 1)->get();
        return view('servicios_municipales.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Servicios Municipales']],
            'sTitulo' => 'Servicios Municipales',
            'sDescripcion' => 'Listado de servicios',
            'servMun' => $servMun
        ]);
    }


    public function create() {
        $supervisores = \DB::table('supervisor')->pluck('name','id');
        $unidades = \DB::table('temp_serv_municipal')->where('tipo', 1)->pluck('name','id');
        $ubicaciones = \DB::table('temp_serv_municipal')->where('tipo', 2)->pluck('name','id');
        $trabajos = \DB::table('temp_serv_municipal')->where('tipo', 3)->pluck('name','id');

        return view(
            'servicios_municipales.create',
            [
                'aBreadCrumb' => [['link' => 'active', 'label' => 'Nuevo Servicio']],
                'sTitulo' => 'Nuevo Servicio Municipal',
                'sDescripcion' => 'Nuevo registro'
            ], compact( 'supervisores', 'unidades', 'ubicaciones', 'trabajos' )
        );
    }

    public function store(Request $request) {
        $input = $request->all();
        $newRegister = SM::newRegistro($input);
        if ($newRegister) {
            $accion = 'Creación de nuevo Servicio Municipal, id: ' . $newRegister->id;
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Operación exitosa!');
            Session::flash('mensaje', "Se ha creado exitosamente el nuevo servicio.");
            Session::flash('tipoMsg', 'success');
            return Redirect::to('indexServiciosMunicipales');
        } else {
            Session::flash('tituloMsg', '¡Ha ocurrido un error!');
            Session::flash('mensaje', "No se ha podido registrar el servicio.");
            Session::flash('tipoMsg', 'error');
            return Redirect::back()->withInput($input);
        }
    }

    public function edit($id) {
        $supervisores = \DB::table('supervisor')->pluck('name','id');
        $unidades = \DB::table('temp_serv_municipal')->where('tipo', 1)->pluck('name','id');
        $ubicaciones = \DB::table('temp_serv_municipal')->where('tipo', 2)->pluck('name','id');
        $trabajos = \DB::table('temp_serv_municipal')->where('tipo', 3)->pluck('name','id');
        $sm = SM::find($id);
        $sm->detalles = SMD::where('id_servicio_municipal', $sm->id)->get();
        
        return view('servicios_municipales.edit', [
                'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de Servicio Municipal']],
                'sTitulo' => 'Servicio Municipal',
                'sDescripcion' => 'Edicioón de Servicio Municipal',
            ], compact('sm', 'supervisores', 'unidades', 'ubicaciones', 'trabajos')
        );
    }

    public function update(Request $request) {
        $input = $request->all();
        $edicion = SM::editar($input);
        if( $edicion ){
            $accion = 'Servicio Municipal modificado con ID '.$input['id'];
            Session::flash('tituloMsg', 'Edición exitosa!');
            Session::flash('mensaje', "Se ha modificado exitosamente el servicio.");
            Session::flash('tipoMsg', 'success');
        } else {
            $accion = 'La edición del servicio: con ID '.$input['id'].' no se pudó realizar';            
            Session::flash('tituloMsg', 'Error en la edición!');
            Session::flash('mensaje', "No se ha podido modificar el servicio.");
            Session::flash('tipoMsg', 'error');
        }
        Bitacora::creaRegistro($accion);
        return Redirect::to('indexServiciosMunicipales');
    }
    
    public function delete($id) {
        $sm = SM::find($id);
        $sm->activo = 2;
        $del = $sm->save();
        if( $del ){
            $accion = 'Servicio Municipal con ID '.$id.' eliminada exitosamente.';            
            Session::flash('tituloMsg', 'Eliminación exitosa!');
            Session::flash('mensaje', "Se ha borrado exitosamente el servicio.");
            Session::flash('tipoMsg', 'success');
        } else {
            $accion = 'La eliminación del Servicio Municipal con ID '.$id.' no se pudó realizar';            
            Session::flash('tituloMsg', 'Borrado fallido!');
            Session::flash('mensaje', "No se ha podido eliminar el servicio.");
            Session::flash('tipoMsg', 'error');
        }
        Bitacora::creaRegistro($accion);
        return Redirect::to('indexServiciosMunicipales');
    }

    public function getInfo(Request $request){
        $input = $request->all();
        $data = \DB::table('supervisor')->find( $input['id'] )->tel;
        return $data;
    }

    public function show($id) {
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $sm = SM::find($id);
        switch ($sm->day) {
            case 1:
                    $tipo = 'SÁBADO';
                break;
            case 2:
                    $tipo = 'DOMINGO';
                break;
            case 3:
                    $tipo = 'PARQUES';
                break;
        }
        $sm->detalles = SMD::where('id_servicio_municipal', $sm->id)->get();
        $accion = "Generación en PDF del Servicio Municipal con ID ".$id." por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        return PDF::loadView('servicios_municipales.pdf', compact('sm', 'meses', 'dias', 'tipo'))->download("ServicioMunicipal_" . $sm->id.date('dmY').\Auth::User()->id.".pdf");
    }

    public function pdf($tipo) {
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        switch ($tipo) {
            case 1:
                    $servicios = SM::where('day', 3)->get();
                    $tipo = 'PARQUES';
                break;
            case 2:
                    $servicios = SM::where('day', 1)->get();
                    $tipo = 'SÁBADO';
                break;
            case 3:
                    $servicios = SM::where('day', 2)->get();
                    $tipo = 'DOMINGO';
                break;
        }
        foreach ($servicios as $sm) {
            $sm->detalles = SMD::where('id_servicio_municipal', $sm->id)->get();
        }
        $accion = "Generación en PDF del Servicio Municipal de ".$tipo." por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        /*return view('servicios_municipales.pdf', [
                'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de Servicio Municipal']],
                'sTitulo' => 'Servicio Municipal',
                'sDescripcion' => 'Edicioón de Servicio Municipal',
            ], compact('servicios', 'meses', 'dias', 'tipo')
        );*/
        return PDF::loadView('servicios_municipales.pdf', compact('servicios', 'meses', 'dias', 'tipo'))->download("ServiciosMunicipales_" . $tipo. '_' .date('dmY').\Auth::User()->id.".pdf");
    }
}