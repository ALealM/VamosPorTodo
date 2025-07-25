<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\CallesRR;
use App\Models\ColoniasRR;
use App\Models\Reportes;
use App\Models\MediosRecepcion as MR;
use App\Models\AreasAtencion as AA;
use App\Models\FallasAtencion as FA;
use App\Models\AvancesReporte as AR;
use Illuminate\Support\Facades\Session;
use Redirect;
use Barryvdh\DomPDF\Facade as PDF;
use App\Mail\EmailNotifica;
use Illuminate\Support\Facades\Mail;

class RespuestaRapidaController extends Controller {

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
    public function listado() {
        $accion = "Ingreso al listado de reportes de atención ciudadana por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        // $reportes = Reportes::where('id_usuario', \Auth::User()->id)->get();
        $reportes = Reportes::all();
        return view('respuesta.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Reportes']],
            'sTitulo' => 'Reportes',
            'sDescripcion' => 'Listado de Reportes de Atención Ciudadana',
            'reportes' => $reportes,
        ]);
    }

    public function create2() {

        return view('respuesta.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta informe']],
            'sTitulo' => 'Informe Diario',
            'sDescripcion' => 'Alta de nuevo informe'
        ]);
    }

    public function create3() {

        return view('respuesta.create2', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta informe']],
            'sTitulo' => 'Informe Diario',
            'sDescripcion' => 'Alta de nuevo informe'
        ]);
    }

    public function create() {
        $colonias = ColoniasRR::pluck('d_asenta','id_cp');
        // $calles = CallesRR::pluck('d_calle','id_cc');
        $medios = MR::where('act',1)->pluck('medio','id');
        $areas = AA::pluck('area','id');
        return view('respuesta.guardar', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Reporte de fallas']],
            'sTitulo' => 'Atención Ciudadana',
            'sDescripcion' => 'Alta de reporte de atención ciudadana',
            'colonias' => $colonias,
            // 'calles' => $calles,
            'medios' => $medios,
            'areas' => $areas,

        ]);
    }

    public function getFallas(Request $request) {
        $area = $request->get('idA');
        $fallas = FA::where('id_area',$area)->get();
        return $fallas;
    }

    public function getCalles(Request $request) {
        $calle = $request->get('q');
        $calles = CallesRR::where('d_calle','like',"%$calle%")->get();
        return $calles;
    }

    public function getColonias(Request $request) {
        $colonia = $request->get('q');
        $colonias = ColoniasRR::where('d_asenta','like',"%$colonia%")->get();
        return $colonias;
    }

    public function store(Request $request) {
        $input = $request->all();
        if(\Auth::User()){
            $input['id_usuario'] = \Auth::User()->id;
        }
        else {
          $input['id_usuario'] = null;
          $input['medio'] = 3;
        }

        if(!is_numeric($input['tipofalla'])){
            $datFA['id_area'] = $input['area'];
            $datFA['falla'] = $input['tipofalla'];
            $fa = FA::creaRegistro($datFA);
            $input['tipofalla'] = $fa->id;
        }

        $area = AA::find($input['area'])->siglas;
        $cons = Reportes::where('area',$input['area'])->count()+1;
        $input['folio'] = $area.str_pad($cons, 5, "0", STR_PAD_LEFT);
        if (isset($input['evidencia'])){
            $file = $input['evidencia'];
            $ext = $file->getClientOriginalExtension();
            $input['evidencia'] = $input['folio'].".$ext";
            $file->move(public_path() . '/reportes/', $input['evidencia']);
        }
        else {
          $input['evidencia'] = null;
        }

        $rep = Reportes::creaRegistro($input);
        //Mail::to( $input['email'] )->queue( new EmailNotifica($rep) );
        if($rep){
            Bitacora::create([
                'id_usuario' => (\Auth::User()) ? \Auth::User()->id : 0,
                'fecha' => date("Y-m-d H:i:s"),
                'accion' => 'Creación de nuevo reporte de atención ciudadana: ID ' . $rep->id
            ]);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente el nuevo reporte.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo reporte.");
            Session::flash('tipoMsg', 'error');
        }
        if(\Auth::User()){
            return Redirect::to('respuesta');
        }
        else {
          return Redirect::to('respuesta/create');
        }

    }

    public function ficha($id) {
        $accion = "Ingreso a la ficha de reporte ciudadano $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $reporte = Reportes::find($id);
        // $ubicacion = "https://www.google.com/maps/search/?api=1&query=$reporte->latitud,$reporte->longitud/";
        $ubicacion = "http://maps.google.com/maps/place/$reporte->latitud+$reporte->longitud/@$reporte->latitud,$reporte->longitud,18z";
        // $ubicacion = "https://www.google.com/maps/place/".$reporte->calle()->d_calle."+".$reporte->numext.",+".$reporte->colonia()->d_asenta.",+san+luis,+S.L.P./@".$reporte->latitud.",".$reporte->longitud.",17z/!3d".$reporte->latitud."!4d".$reporte->longitud;
        return view('respuesta.ficha', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Ficha de reporte ciudadano']],
            'sTitulo' => 'Ficha de reporte ciudadano',
            'sDescripcion' => 'Ficha de Reporte de Atención Ciudadana',
            'reporte' => $reporte,
            'ubicacion' => $ubicacion,
        ]);
    }

    public function show($id) {
        $accion = "Ingreso al seguimiento del reporte ciudadano $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $reporte = Reportes::find($id);
        $avances = AR::where('id_reporte',$id)->get();
        return view('respuesta.seguimiento', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Seguimiento de reporte ciudadano']],
            'sTitulo' => 'Seguimiento del reporte ciudadano con folio '.$reporte->folio,
            'sDescripcion' => 'Seguimiento de reporte ciudadano',
            'reporte' => $reporte,
            'avances' => $avances,
        ]);
    }

    public function storeAvance(Request $request) {
        $input = $request->all();
        // dd($input);
        $accion = 'Registro de avances de reporte: ID ' . $input['id'];
        $i = $totalPorcentaje = 0;
        foreach ($input['fecha'] as $fecha) {
            $data['id_reporte'] = $input['id'];
            $data['fecha'] = $fecha." ".$input['hora'][$i];
            $data['actividad'] = $input['act'][$i];
            $data['avance'] = $input['porc'][$i];
            $new = AR::creaRegistro($data);
            $totalPorcentaje += $input['porc'][$i];
            $i++;
        }//dd($totalPorcentaje, AR::where('id_reporte', $input['id'])->get()->sum('avance'), $totalPorcentaje + AR::where('id_reporte', $input['id'])->get()->sum('avance'), $new->reporte()->email );
        if( $totalPorcentaje == 100 || ( $totalPorcentaje + AR::where('id_reporte', $input['id'])->get()->sum('avance') ) >= 100 )
            Mail::to( [ $new->reporte()->email, 'karen@cieet.org' ] )->queue( new EmailNotifica( $new->reporte() ) );
        Bitacora::creaRegistro($accion);
        Session::flash('tituloMsg', 'Guardado exitoso!');
        Session::flash('mensaje', "Se ha guardado exitosamente el seguiiento del reporte.");
        Session::flash('tipoMsg', 'success');
        return Redirect::to('respuesta/show/'.$input['id']);
    }

    public function edit($id) {
        $accion = "Ingreso a la edición de informe diario $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $informe = Informe::find($id);
        $imagenes = IA::where('id_informe', $id)->where('tipo', 1)->get();
        $documentos = IA::where('id_informe', $id)->where('tipo', 2)->get();
        return view('informes.edit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de informe']],
            'sTitulo' => 'Edición de informe del día ' . date('d/m/Y', strtotime($informe->fecha)),
            'sDescripcion' => 'Edición de informe',
            'informe' => $informe,
            'imagenes' => $imagenes,
            'documentos' => $documentos
        ]);
    }

    public function informePDF($fecha) {
        $accion = "Generación de informe diario en PDF por " . \Auth::User()->id . " con fecha $fecha";
        Bitacora::creaRegistro($accion);
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $informes = Informe::where('fecha',$fecha)->where('estatus', 1)->orderBy('orden')->get();
        return PDF::loadView('informes.pdf', compact('informes', 'fecha', 'meses'))->download("Informe del " . date('j', strtotime($fecha)) . " de " . $meses[date('n', strtotime($fecha)) - 1] . " de " . date('Y', strtotime($fecha)) . ".pdf");
    }

    public function informeEnviar(Request $request) {
        $accion = "Envío de informe diario " . $request->get('id') . " por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $informe = Informe::find($request->get('id'));
        $informe->estatus = 1;
        $informe->save();
        $e['estatus'] = 'Enviado';
        return $e;
    }

    public function update(Request $request) {
        $input = $request->all();
//        dd($input);
        $inf = Informe::editaRegistro($input);
        if ($inf) {
            if (isset($input['imagenes'])) {
                foreach ($input['imagenes'] as $imagen) {
                    $img = IA::find($imagen);
                    $img->delete();
                }
            }
            if (isset($input['documentos'])) {
                foreach ($input['documentos'] as $documento) {
                    $doc = IA::find($documento);
                    $doc->delete();
                }
            }
            if (isset($input['archivos'])) {
                $aux = 1;
                foreach ($input['archivos'] as $archivo) {
                    $file = $archivo;
                    $ext = $file->getClientOriginalExtension();
                    $name = substr($file->getClientOriginalName(), 0, 80);
                    $input['tipo'] = ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'JPG' || $ext == 'JPEG' || $ext == 'PNG') ? 1 : 2;
                    $input['anexo'] = $input['id'] . '-' . $aux . '-' . $name;
                    $input['id_informe'] = $input['id'];
                    $file->move(public_path() . '/informes/', $input['anexo']);
                    $aux++;
                    IA::creaRegistro($input);
                }
            }
            $accion = 'Edición informe: ID ' . $input['id'];
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha editado exitosamente el evento.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido editar el evento.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('informeDiario');
    }

    public function listadoRevision() {
        $accion = "Ingreso al listado de revisión de informe diario por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $informes = Informe::select(\DB::raw("DATE_FORMAT(fecha,'%Y-%m-%d') as fecha_informe"))->groupBy(\DB::raw("fecha_informe"))->where('estatus', 1)->get();
        return view('informes.revision.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de informes diarios']],
            'sTitulo' => 'Informes',
            'sDescripcion' => 'Listado de Informes',
            'informes' => $informes,
        ]);
    }

    public function revisar($fecha) {
        $informes = Informe::where('fecha',$fecha)->where('estatus', 1)->orderBy('orden')->get();
        if($informes->count()==0){
            return Redirect::to('informe/listadoRevision');
        }
        else{
            $accion = "Revisión de informe diario por " . \Auth::User()->id . " con fecha $fecha";
            Bitacora::creaRegistro($accion);
            $idx = Informe::where('fecha',$fecha)->where('estatus', 1)->orderBy('orden')->first()->id;
            return view('informes.revision.revision', [
                'aBreadCrumb' => [['link' => 'active', 'label' => 'Informe en Revisión']],
                'sTitulo' => 'Revisión del informe del día ' . date('d/m/Y', strtotime($fecha)),
                'sDescripcion' => 'Revisión de Informe',
                'informes' => $informes,
                'idx' => $idx,
            ]);
        }
    }

    public function showRevision($fecha) {
        $accion = "Ficha de revisión de informe diario por " . \Auth::User()->id . " con fecha $fecha";
        Bitacora::creaRegistro($accion);
        $informes = Informe::where('fecha',$fecha)->where('estatus', 1)->orderBy('orden')->get();
        return view('informes.revision.ficha', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Ficha de informe']],
            'sTitulo' => 'Ficha de informe del día ' . date('d/m/Y', strtotime($fecha)),
            'sDescripcion' => 'Ficha de informe',
            'informes' => $informes
        ]);
    }

    public function updateAll(Request $request) {
        $input = $request->all();
        $informe = Informe::find($input['id']);
        $input['estatus'] = (isset($input['estatus'])) ? $input['estatus'] : $informe->estatus;
//        dd($input);
        $inf = Informe::revisaRegistro($input);
        if ($inf) {
            $accion = 'Edición informe en revisión: ID ' . $input['id'];
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha editado exitosamente el informe.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido editar el informe.");
            Session::flash('tipoMsg', 'error');
        }
        $fecha = date('Y-m-d', strtotime($informe->fecha));

        $informes = Informe::where('fecha',$fecha)->where('estatus', 1)->orderBy('orden')->get();
//        dd($informes);
        if($informes->count()==0){
            return Redirect::to('informe/listadoRevision');
        }

        $accion = "Actualización de revisión de informe diario por " . \Auth::User()->id . " con fecha $fecha";
        Bitacora::creaRegistro($accion);
        return Redirect::to('informe/revisar/'.$fecha);
    }


    public function verificaFecha(Request $request) {
        $fecha = $request->get('fecha');
        $r = Informe::where('id_gabinete',\Auth::User()->id_gabinete)->where('fecha',$fecha)->count();
        return $r;
    }

    public function resumen() {
        $accion = "Ingreso al resumen de informe diario por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        return view('informes.resumen', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Resumen de informes diarios']],
            'sTitulo' => 'Informes Diarios',
            'sDescripcion' => 'Resumen de Informes'
        ]);
    }

    public function generaResumen(Request $request) {
        $input = $request->all();
        $fi = $input['fechaI'];
        $ff = $input['fechaF'];
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        if($ff == null || $ff == $fi){
            $fechas = [$fi. " 00:00:00",$fi." 23:59:59"];
            $f_i = explode('-', $fi);
            $rango = $f_i[2] . " de " . $meses[($f_i[1]*1)-1] . " de " . $f_i[0];
        }
        else{
            $fechas = [$fi. " 00:00:00",$ff." 23:59:59"];
            $f_i = explode('-', $fi);
            $f_f = explode('-', $ff);
            $rango = $f_i[2] . " de " . $meses[($f_i[1]*1)-1] . " de " . $f_i[0] ." al " . $f_f[2] . " de " . $meses[($f_f[1]*1)-1] . " de " . $f_f[0];
        }
//        dd($rango);
        $accion = "Generación de reporte de informe diario por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $informaron = Informe::whereBetween('fecha',$fechas)->where('estatus', 1)->orderBy('orden')->pluck('id_gabinete');
        $areasSi = Gabinete::whereIn('id',$informaron)->get();
        $areasNo = Gabinete::whereNotIn('id',$informaron)->where('id','<',99)->whereNotIn('id',[37,2,5])->get();
        return PDF::loadView('informes.pdfResumen', compact('areasSi','areasNo','rango'))->download("Resumen de informes diarios del $rango.pdf");
    }

}
