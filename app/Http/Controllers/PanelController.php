<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Informe;
use App\Models\Eventos;
use App\Models\EventosActividades as EA;
use App\Models\EventosColaboradores as EC;
use App\Models\EventosReporte as ER;
use App\Models\SPEventosCat as ECat;
use App\Models\SPEventos as SPE;
use App\Models\SPEventosImpacto as SPEI;
use App\Models\SPEstadoFuerza as SPEF;
use App\Models\SPDelegaciones as SPD;
use App\Models\SPBarandilla as SPB;
use App\Models\ProyectosAcciones as PA;
use App\Models\Meses;
use App\Models\EstructuraFinanciera as EF;
use App\Models\CalendarioEjecucion as CE;
use App\Models\Gabinete;
use App\Models\EjesRectores as Ejes;
use App\Models\CapitulosGasto as CG;
use App\Models\ConceptosGasto as ConG;
use Illuminate\Support\Facades\Session;
use Redirect;
use Barryvdh\DomPDF\Facade as PDF;

class PanelController extends Controller {

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
    public function panel() {
        $accion = "Ingreso al listado del panel por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $informes = Informe::select(\DB::raw("DATE_FORMAT(fecha,'%Y-%m-%d') as fecha_informe"))->groupBy(\DB::raw("fecha_informe"))->where('estatus', 1)->get();
        $eventos = Eventos::where('estatus', 3)->get();
        $proyAccs = PA::all();
        $meses = Meses::all();
        $totFed = EF::where('estructura',1)->sum('monto');
        $totEst = EF::where('estructura',2)->sum('monto');
        $totMun = EF::where('estructura',3)->sum('monto');
        $totOtros = EF::where('estructura',4)->sum('monto');
        $direcciones = Gabinete::pluck('direccion','id');
        $ejes = Ejes::pluck('eje','id');
        $capitulos = CG::all()->pluck('capDesc','id');
        return view('panel.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Panel']],
            'sTitulo' => 'PANEL',
            'sDescripcion' => 'Pantalla Principal',
            'informes' => $informes,
            'eventos' => $eventos,
            'proyAccs' => $proyAccs,
            'totEst' => $totEst,
            'totFed' => $totFed,
            'totMun' => $totMun,
            'totOtros' => $totOtros,
            'direcciones' => $direcciones,
            'ejes' => $ejes,
            'capitulos' => $capitulos,
            'meses' => $meses
        ]);
    }

    public function showID($fecha) {
        $informes = Informe::where('fecha',$fecha)->where('estatus', 1)->orderBy('orden')->get();
        $accion = "Revisión de informe diario por " . \Auth::User()->id . " con fecha $fecha";
        Bitacora::creaRegistro($accion);
        $idx = Informe::where('fecha',$fecha)->where('estatus', 1)->orderBy('orden')->first()->id;
        return view('panel.fichaID', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Informe Diario']],
            'sTitulo' => 'Revisión del informe del día ' . date('d/m/Y', strtotime($fecha)),
            'sDescripcion' => 'Revisión de Informe',
            'informes' => $informes,
            'idx' => $idx,
        ]);
    }
    
    public function updateID(Request $request) {
        $input = $request->all();
//        dd($input);
        $informe = Informe::find($input['id']);
        $inf = Informe::comentariosRegistro($input);
        if ($inf) {
            $accion = 'Comentarios del informe: ID ' . $input['id'];
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se han enviado exitosamente los comentarios.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se han podido enviar correctamente los comentarios.");
            Session::flash('tipoMsg', 'error');
        }
        $fecha = date('Y-m-d', strtotime($informe->fecha));
 
        $accion = "Actualización de Comentarios de informe diario por " . \Auth::User()->id . " con fecha $fecha";
        Bitacora::creaRegistro($accion);
        return Redirect::to('panel/showID/'.$fecha);
    }

    public function showEV($id) {
        $accion = "Ingreso a la ficha del evento autorizado $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $evento = Eventos::find($id);
        $acciones = EA::where('id_evento', $evento->id)->get();
        $colaboradores = EC::where('id_evento', $evento->id)->get();
        $siglas = $evento->user()->gabinete()->siglas;
        $imagenes = ER::where('id_usuario', $evento->id_usuario)->where('id_evento', $id)->where('tipo', 1)->get();
        $documentos = ER::where('id_usuario', $evento->id_usuario)->where('id_evento', $id)->where('tipo', 2)->get();
        return view('panel.fichaEV', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Ficha de evento autorizado']],
            'sTitulo' => 'Eventos autorizados',
            'sDescripcion' => 'Ficha de evento autorizado',
            'folio' => date('Y-m', strtotime($evento->fecha)) . '-' . $siglas . '-' . str_pad($evento->folio, 3, '0', STR_PAD_LEFT),
            'evento' => $evento,
            'acciones' => $acciones,
            'imagenes' => $imagenes,
            'documentos' => $documentos,
            'colaboradores' => $colaboradores,
            'dias' => $dias,
            'meses' => $meses
        ]);
    }
    
    public function showPOA($id) {
        $proy = PA::find($id);
        $meses = CE::where('id_proyecto',$id)->get();
        $estructura = EF::where('id_proyecto',$id)->get();
        return view('panel.fichaPOA', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Ficha de proyecto']],
            'sTitulo' => 'Proyectos/Acciones',
            'sDescripcion' => 'Ficha de proyecto',
            'proy' => $proy,
            'meses' => $meses,
            'estructura' => $estructura
        ]);
    }
    
    public function getPOA(Request $request) {
        $dir = $request->get('dir');
        $eje = $request->get('eje');
        $cap = $request->get('cap');
        $rub = $request->get('rub');
        $meses = Meses::all();
        if($dir==null && $eje==null && $cap==null){
            $proyAccs = PA::all();
            $meses = Meses::all();
            $totFed = EF::where('estructura',1)->sum('monto');
            $totEst = EF::where('estructura',2)->sum('monto');
            $totMun = EF::where('estructura',3)->sum('monto');
            $totOtros = EF::where('estructura',4)->sum('monto');
            return view('panel.tablePOA', [
                'proyAccs' => $proyAccs,
                'totEst' => $totEst,
                'totFed' => $totFed,
                'totMun' => $totMun,
                'totOtros' => $totOtros,
                'meses' => $meses
            ]);
        }
        else{
            $users = ($dir==null) ? User::pluck('id') : User::where('id_gabinete',$dir)->pluck('id');
            $ejes = ($eje==null) ? Ejes::pluck('id') : [$eje];
            if($cap==null){
                $proyAccs = PA::whereIn('id_usuario',$users)->whereIn('id_eje',$ejes)->get();
                $idP = PA::whereIn('id_usuario',$users)->whereIn('id_eje',$ejes)->pluck('id');
            }
            else{
                $conceptos = ($rub==null) ? ConG::where('id_capitulo',$cap)->pluck('id') : ConG::where('id_rubro',$rub)->pluck('id');               
                $proyAccs = PA::whereIn('id_usuario',$users)->whereIn('id_eje',$ejes)->whereIn('id_concepto',$conceptos)->get();
                $idP = PA::whereIn('id_usuario',$users)->whereIn('id_eje',$ejes)->whereIn('id_concepto',$conceptos)->pluck('id');
            }           
            $totFed = EF::where('estructura',1)->whereIN('id_proyecto',$idP)->sum('monto');
            $totEst = EF::where('estructura',2)->whereIN('id_proyecto',$idP)->sum('monto');
            $totMun = EF::where('estructura',3)->whereIN('id_proyecto',$idP)->sum('monto');
            $totOtros = EF::where('estructura',4)->whereIN('id_proyecto',$idP)->sum('monto');
            return view('panel.tablePOA2', [
                'proyAccs' => $proyAccs,
                'totEst' => $totEst,
                'totFed' => $totFed,
                'totMun' => $totMun,
                'totOtros' => $totOtros,
                'idP' => $idP,
                'meses' => $meses
            ]);
        }
    }

}
