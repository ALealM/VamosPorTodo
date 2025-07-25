<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Informe;
use App\Models\Gabinete;
use App\Models\InformeAnexos as IA;
use App\Models\SPEventosCat as ECat;
use App\Models\SPEventos as SPE;
use App\Models\SPEventosImpacto as SPEI;
use App\Models\SPEstadoFuerza as SPEF;
use App\Models\SPDelegaciones as SPD;
use App\Models\SPBarandilla as SPB;
use Illuminate\Support\Facades\Session;
use Redirect;
use Barryvdh\DomPDF\Facade as PDF;

class InformeController extends Controller {

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
        $accion = "Ingreso al listado de informe diario por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $informes = Informe::where('id_usuario', \Auth::User()->id)->get();       
        return view('informes.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de informes diarios']],
            'sTitulo' => 'Informes',
            'sDescripcion' => 'Listado de Informes',
            'informes' => $informes,
        ]);
    }

    public function create() {
        $accion = "Ingreso a creación de nuevo informe diario por " . \Auth::User()->id;
        $ev_fm = ECat::where('tipo',1)->get();
        $ev_pv = ECat::where('tipo',2)->get();
        $ev_911 = ECat::where('tipo',3)->get();
        Bitacora::creaRegistro($accion);
        return view('informes.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta informe']],
            'sTitulo' => 'Informe Diario',
            'sDescripcion' => 'Alta de nuevo informe',
            'ev_fm' => $ev_fm,
            'ev_pv' => $ev_pv,
            'ev_911' => $ev_911,
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $r = Informe::where('id_gabinete',\Auth::User()->id_gabinete)->where('fecha',$input['fecha'])->count();
        if($r>0){
            return Redirect::to('informe/listado');
        }
        $input['orden'] = \Auth::User()->gabinete()->orden;
//        dd($input);
        $inf = Informe::creaRegistro($input);
        if ($inf) {
            if(isset($input['evento'])){
                $i=0;
                foreach ($input['evento'] as $evt) {
                    $dataE['id_evento_cat'] = $i+1;
                    $dataE['cantidad'] = $evt;
                    $dataE['id_informe'] = $inf->id;
                    $dataE['tipo'] = ($i<11) ? 1 : (($i<23) ? 2 : 3);
                    SPE::creaRegistro($dataE);
                    $i++;
                }
                $i=0;
                foreach ($input['ei_cant'] as $ei_cant) {
                    $dataEI['evento'] = $input['ei_desc'][$i];
                    $dataEI['cantidad'] = $ei_cant;
                    $dataEI['id_informe'] = $inf->id;
                    SPEI::creaRegistro($dataEI);
                    $i++;
                }
                $count = [1,2,3];
                foreach ($count as $c) {
                    $dataEF['pc'] = $input['pc'][$c];
                    $dataEF['pn'] = $input['pn'][$c];
                    $dataEF['pp'] = $input['pp'][$c];
                    $dataEF['ps'] = $input['ps'][$c];
                    $dataEF['po'] = $input['po'][$c];
                    $dataEF['dc'] = $input['dc'][$c];
                    $dataEF['dn'] = $input['dn'][$c];
                    $dataEF['dp'] = $input['dp'][$c];
                    $dataEF['ds'] = $input['ds'][$c];
                    $dataEF['do'] = $input['do'][$c];
                    $dataEF['fc'] = $input['fc'][$c];
                    $dataEF['fn'] = $input['fn'][$c];
                    $dataEF['fp'] = $input['fp'][$c];
                    $dataEF['fs'] = $input['fs'][$c];
                    $dataEF['fo'] = $input['fo'][$c];
                    $dataEF['pv'] = 0;
                    $dataEF['dv'] = 0;
                    $dataEF['fv'] = 0;
                    $dataEF['id_informe'] = $inf->id;
                    $dataEF['tipo'] = $c;
                    if($c==3){
                        $dataEF['pv'] = $input['pv'][$c];
                        $dataEF['dv'] = $input['dv'][$c];
                        $dataEF['fv'] = $input['fv'][$c];
                    }
                    SPEF::creaRegistro($dataEF);
                }
                $dataD['fb'] = $input['fb'];
                $dataD['fpz'] = $input['fpz'];
                $dataD['flp'] = $input['flp'];
                $dataD['vb'] = $input['vb'];
                $dataD['vpz'] = $input['vpz'];
                $dataD['vlp'] = $input['vlp'];
                $dataD['id_informe'] = $inf->id;
                SPD::creaRegistro($dataD);
                $dataB['pjc'] = $input['pjc'];
                $dataB['pof'] = $input['pof'];
                $dataB['djc'] = $input['djc'];
                $dataB['dof'] = $input['dof'];
                $dataB['fjc'] = $input['fjc'];
                $dataB['fof'] = $input['fof'];
                $dataB['id_informe'] = $inf->id;
                SPB::creaRegistro($dataB);
            }
            $accion = 'Creación de nuevo informe: ID ' . $inf->id;
            if (isset($input['archivos'])) {
                $aux = 1;
                foreach ($input['archivos'] as $archivo) {
                    $file = $archivo;
                    $ext = $file->getClientOriginalExtension();
                    $name = substr($file->getClientOriginalName(), 0, 80);
                    $input['tipo'] = ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'JPG' || $ext == 'JPEG' || $ext == 'PNG') ? 1 : 2;
                    $input['anexo'] = $inf->id . '-' . $aux . '-' . $name;
                    $input['id_informe'] = $inf->id;
                    $file->move(public_path() . '/informes/', $input['anexo']);
                    $aux++;
                    IA::creaRegistro($input);
                }
            }
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente el nuevo informe.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo informe.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('informe/listado');
    }

    public function show($id) {
        $accion = "Ingreso a la ficha de informe diario $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $informe = Informe::find($id);
        $imagenes = IA::where('id_informe', $id)->where('tipo', 1)->get();
        $documentos = IA::where('id_informe', $id)->where('tipo', 2)->get();
        $ev_fm = SPE::where('id_informe',$id)->where('tipo',1)->get();
        $ev_pv = SPE::where('id_informe',$id)->where('tipo',2)->get();
        $ev_911 = SPE::where('id_informe',$id)->where('tipo',3)->get();
        $eventosI = SPEI::where('id_informe',$id)->get();
        $ef1 = SPEF::where('id_informe',$id)->where('tipo',1)->first();
        $ef2 = SPEF::where('id_informe',$id)->where('tipo',2)->first();
        $ef3 = SPEF::where('id_informe',$id)->where('tipo',3)->first();
        $del = SPD::where('id_informe',$id)->first();
        $bar = SPB::where('id_informe',$id)->first();
//        dd($eventos);
        return view('informes.ficha', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Ficha de informe']],
            'sTitulo' => 'Ficha de informe del día ' . date('d/m/Y', strtotime($informe->fecha)),
            'sDescripcion' => 'Ficha de informe',
            'informe' => $informe,
            'imagenes' => $imagenes,
            'ev_fm' => $ev_fm,
            'ev_pv' => $ev_pv,
            'ev_911' => $ev_911,
            'eventosI' => $eventosI,
            'del' => $del,
            'bar' => $bar,
            'ef1' => $ef1,
            'ef2' => $ef2,
            'ef3' => $ef3,
            'documentos' => $documentos
        ]);
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
        return Redirect::to('informe/listado');
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
        $direcciones = Gabinete::where('id','<',99)->whereNotIn('id',[37])->pluck('direccion','id');
        $accion = "Ingreso al resumen de informe diario por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        return view('informes.resumen', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Resumen de informes diarios']],
            'sTitulo' => 'Informes Diarios',
            'sDescripcion' => 'Resumen de Informes',
            'direcciones' => $direcciones
        ]);
    }
    
    public function generaResumen(Request $request) {
        $input = $request->all(); 
        $fi = $input['fechaI'];
        $ff = $input['fechaF'];
        $dir = $input['id_direccion'];
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
        if($dir==null){
            $accion = "Generación de reporte de informe diario por " . \Auth::User()->id;
            Bitacora::creaRegistro($accion);
            $informaron = Informe::whereBetween('fecha',$fechas)->where('estatus', 1)->orderBy('orden')->pluck('id_gabinete');
            $areasSi = Gabinete::whereIn('id',$informaron)->get();
            $areasNo = Gabinete::whereNotIn('id',$informaron)->where('id','<',99)->whereNotIn('id',[37,2,5,23,25,29,33])->get();
            return PDF::loadView('informes.pdfResumen', compact('areasSi','areasNo','rango'))->download("Resumen de informes diarios del $rango.pdf");        
        }
        else{
            set_time_limit(600);
            $direccion = Gabinete::find($dir)->direccion;
            $accion = "Generación de informes diarios en PDF por " . \Auth::User()->id . " del $rango";
            Bitacora::creaRegistro($accion);
            $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            $informes = Informe::whereBetween('fecha',$fechas)->where('id_gabinete', $dir)->get();
            return PDF::loadView('informes.pdfDet', compact('informes', 'rango', 'meses', 'direccion'))->download("Informe de $direccion del $rango.pdf");
        }
    }

}
