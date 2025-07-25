<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Models\MediosRecepcion as MR;
use App\Models\AreasAtencion as AA;
use App\Models\Reportes;
use App\Models\Bitacora;
use Redirect;

class AreasAtencionController extends Controller
{
    public function portada() {
        $areas = AA::all();
        $medios = MR::where('act',1)->pluck('medio','id');
        foreach($areas as $a){
            $a->countArea = Reportes::where('area', $a->id)->groupBy('area')->count();
            $temp = [];
            foreach($medios as $key => $m)
                $temp[$m] = Reportes::where('area', $a->id)->where('medio', $key)->where('vo_bo_director', '>', 0)->groupBy('medio')->count();
            $a->countMedio = $temp;//dd($areas,$medios, str_pad( $key.':', 50, " " ));
        }
        $time_unit = \DB::table('tiempo_unidad')->pluck('unidad', 'id');
        return view('areas_atencion.portada', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Áreas de atención']]
        ], compact('areas', 'time_unit'));
    }

    public function areaIndex( $id ){
        $reportes = Reportes::where('area', $id)->get();
        return view('areas_atencion.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición por Dirección']]
        ], compact('reportes'));
    }

    public function respDirectivos(Request $request) {
        $input = $request->all();
        $reporte = Reportes::find( $input['id'] );
        
        if( @$input['prioridad'] && $reporte->prioridad != 1 ) {
            $reporte->prioridad = 1;
            $reporte->id_user_prioridad = \Auth::User()->id;
            $reporte->fecha_prioridad = date('Y-m-d H:i:s');
        }
        if( @$input['vo_bo_director'] ) {
            $reporte->vo_bo_director = 1;
            $reporte->user_vo_bo_director = \Auth::User()->id;
            $reporte->fecha_vo_bo_director = date('Y-m-d H:i:s');
        }

        if ( $reporte->save() ) {
            $accion = 'Creación de nueva agenda: ID ' . $reporte->id;
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha marcado como prioritario exitosamente el reporte.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido marcar como prioritario.");
            Session::flash('tipoMsg', 'error');
            return Redirect::back()->withInput($input);
        }
        return Redirect::to('areaAtencionIndex/'.$reporte->area);
    }

    public function changeTimeResponse(Request $request) {
        $input = $request->all();
        $change = AA::find($input['id']);
        $change->tiempo_respuesta = $input['time'];
        $change->id_unidad_time = $input['unidad'];
        if ( $change->save() ) {
            $accion = 'Asignación del tiempo de respuesta del área de atención con ID ' . $change->id;
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha asignado exitosamente el tiempo de respuesta.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido asignar el tiempo de respuesta.");
            Session::flash('tipoMsg', 'error');
            return Redirect::back()->withInput($input);
        }
        return Redirect::to('portadaAreasAtencion');
    }

    public function seguimiento( $id ){
        $reporte = Reportes::find($id);
        $ubicacion = "http://maps.google.com/maps/place/$reporte->latitud+$reporte->longitud/@$reporte->latitud, $reporte->longitud,18z";
        $time_unit = AA::find($reporte->area )->timeResponse();//dd($reporte->area);
        return view('respuesta.ficha', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Ficha de reporte ciudadano']],
            'sTitulo' => 'Ficha de informe ciudadano',
            'sDescripcion' => 'Ficha de Reporte de Atención Ciudadana',
        ], compact('reporte', 'ubicacion', 'time_unit') );
    }

    public function show($id) {
        $reporte = Reportes::find($id);
        /*$accion = "Ingreso a la ficha de reporte ciudadano por el solicitante para el reporte con ID " . $id;
        Bitacora::creaRegistro($accion);*/
        $ubicacion = "http://maps.google.com/maps/place/$reporte->latitud+$reporte->longitud/@$reporte->latitud,$reporte->longitud,18z";
        return view('respuesta.ficha', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Ficha de reporte ciudadano']],
            'sTitulo' => 'Ficha de informe ciudadano',
            'sDescripcion' => 'Ficha de Reporte de Atención Ciudadana',
            'reporte' => $reporte,
            'ubicacion' => $ubicacion,
        ]);
    }
    
    public function storeVoBoSolicitante(Request $request) {
        $input = $request->all();
        $reporte = Reportes::find( $input['id'] );
        $reporte->vo_bo_solicitante = 1;
        $reporte->fecha_vo_bo_solicitante = date('Y-m-d H:i:s');
        if ( $reporte->save() ) {
            //$accion = 'Creación de nueva agenda: ID ' . $reporte->id;
            //Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha confirmado correctamente la solicitud.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido marcar como visto bueno, inténtelo más tarde.");
            Session::flash('tipoMsg', 'error');
            return Redirect::back()->withInput($input);
        }
        return Redirect::to('respuestaShow/'.$reporte->id);
    }

    public function delete($id) {
        $reporte = Reportes::find($id);
        $reporte->cancelado = 1;
        $reporte->fecha_cancelacion = date('Y-m-d H:i:s');
        $reporte->id_user_cancelado = \Auth::User()->id;
        if ( $reporte->save() ) {
            $accion = 'Cancelación de reporte con ID ' . $reporte->id;
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Acción exitosa!');
            Session::flash('mensaje', "Se ha cancelado correctamente el reporte.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Acción fallida!');
            Session::flash('mensaje', "No se ha podido cancelar el reporte, inténtelo más tarde.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('areaAtencionIndex/'.$reporte->area);
    }

    public function pdf($tipo) {
        $accion = "Generación en PDF de los reportes " . $tipo == 1 ? 'atendidos' : ( $tipo == 2 ? 'en espera' : 'cancelados' ) . " por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        switch ($tipo) {
            case 1:
                $tipo = 'Solicitudes Atendidas';
                $reportes = Reportes::where('vo_bo_director', 1)->orWhere('vo_bo_solicitante', 1)->where('cancelado', 0)->orderBy('area')->get();
                break;
            case 2:
                $tipo = 'Solicitudes en Espera';
                $reportes = Reportes::whereNull('vo_bo_director')->whereNull('vo_bo_solicitante')->where('cancelado', 0)->orderBy('area')->get();
                break;
            case 3:
                $tipo = 'Solicitudes Canceladas';
                $reportes = Reportes::where('cancelado', 1)->orderBy('area')->get();
                break;
        }
        return PDF::loadView('areas_atencion.pdf', compact('reportes', 'tipo', 'dias', 'meses'))->download($tipo . "_" . date('d-m-Y') . ".pdf");
    }
}