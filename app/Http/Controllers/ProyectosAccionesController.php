<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Acciones;
use App\Models\Secretarias;
use App\Models\Responsables;
use App\Models\Colonias;
use App\Models\ResponsablesProyecto as RP;
use App\Models\BeneficiariosProyecto as BP;
use App\Models\TipoAcciones as TA;
use App\Models\TipoBeneficiarios as TB;
use App\Models\EjesPlanDM as Ejes;
use App\Models\ProyectosAcciones as PA;
use App\Models\Meses;
use App\Models\EstructuraFinanciera as EF;
use App\Models\CapitulosGasto as CG;
use App\Models\FuentesFinanciamiento as FF;
use App\Models\EjesRectores as ER;
use App\Models\RubrosGasto as RG;
use App\Models\ConceptosGasto as ConG;
use App\Models\CalendarioEjecucion as CE;
use App\Models\ObjetivosDesarrolloSostenible as ODS;
use Illuminate\Support\Facades\Session;
use Redirect;
use Barryvdh\DomPDF\Facade as PDF;

class ProyectosAccionesController extends Controller {

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
        $meses = Meses::all();
        if(\Auth::User()->tipo == 0){
            $proyAccs = PA::all();
            $meses = Meses::all();
            $totFed = EF::where('estructura',1)->sum('monto');
            $totEst = EF::where('estructura',2)->sum('monto');
            $totMun = EF::where('estructura',3)->sum('monto');
            $totOtros = EF::where('estructura',4)->sum('monto');
            return view('proyectosAcciones.index', [
                'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de proyectos y acciones']],
                'sTitulo' => 'Proyectos y Acciones',
                'sDescripcion' => 'Listado de proyectos y acciones',
                'proyAccs' => $proyAccs,
                'totEst' => $totEst,
                'totFed' => $totFed,
                'totMun' => $totMun,
                'totOtros' => $totOtros,
                'meses' => $meses
            ]);
        }
        else{
            $proyAccs = PA::where('id_usuario',\Auth::User()->id)->get();
            $idP = PA::where('id_usuario',\Auth::User()->id)->pluck('id');
            $totFed = EF::where('estructura',1)->whereIN('id_proyecto',$idP)->sum('monto');
            $totEst = EF::where('estructura',2)->whereIN('id_proyecto',$idP)->sum('monto');
            $totMun = EF::where('estructura',3)->whereIN('id_proyecto',$idP)->sum('monto');
            $totOtros = EF::where('estructura',4)->whereIN('id_proyecto',$idP)->sum('monto');
            return view('proyectosAcciones.index2', [
                'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de proyectos y acciones']],
                'sTitulo' => 'Proyectos y Acciones',
                'sDescripcion' => 'Listado de proyectos y acciones',
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

    public function create() {
        $meses = Meses::all();
        $fuentes = FF::pluck('fuente', 'id');
        $ejes = ER::pluck('eje', 'id');
        $capitulos = CG::all()->pluck('capDesc', 'id');
        return view('proyectosAcciones.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de nuevo proyecto o acción']],
            'sTitulo' => 'Proyectos y Acciones',
            'sDescripcion' => 'Alta de nuevo proyecto o acción',
            'meses' => $meses,
            'fuentes' => $fuentes,
            'capitulos' => $capitulos,
            'ejes' => $ejes
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();
//        dd($input);
        $proy = PA::creaRegistro($input);

        if ($proy) {
            $accion = 'Creación de nuevo proyecto: ' . $proy->nombre;
            $i = 1;
            foreach ($input['estructura'] as $est) {
                $dataEF['monto'] = $est;
                $dataEF['estructura'] = $i;
                $dataEF['id_proyecto'] = $proy->id;
                EF::creaRegistro($dataEF);
                $i++;
            }
            $i = 1;
            foreach ($input['mes'] as $mes) {
                $dataEF['monto'] = $mes;
                $dataEF['mes'] = $i;
                $dataEF['id_proyecto'] = $proy->id;
                CE::creaRegistro($dataEF);
                $i++;
            }

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente el nuevo proyecto.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo proyecto.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('proyectoAccion/listado');
    }

    public function show($id) {
        $proy = PA::find($id);
        $meses = CE::where('id_proyecto',$id)->get();
        $estructura = EF::where('id_proyecto',$id)->get();
        return view('proyectosAcciones.ficha', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Ficha de proyecto']],
            'sTitulo' => 'Proyectos/Acciones',
            'sDescripcion' => 'Ficha de proyecto',
            'proy' => $proy,
            'meses' => $meses,
            'estructura' => $estructura
        ]);
    }

    public function getObjetivos(Request $request) {
        $eje = $request->get('eje');
        $r = ODS::where('id_eje', $eje)->get();
        return $r;
    }

    public function getRubros(Request $request) {
        $cap = $request->get('cap');
        $r = RG::where('id_capitulo', $cap)->get();
        return $r;
    }

    public function getConceptos(Request $request) {
        $rub = $request->get('rubro');
        $r = ConG::where('id_rubro', $rub)->get();
        return $r;
    }
    
    
    public function edit($id) {
        $proyAcc = PA::find($id);
        $concepto = ConG::find($proyAcc->id_concepto);
        $meses = Meses::all();
        foreach($meses as $mes){
            $mes->monto = CE::where('mes',$mes->id)->where('id_proyecto',$id)->first()->monto;
        }
        $fuentes = FF::pluck('fuente', 'id');
        $ejes = ER::pluck('eje', 'id');
        $capitulos = CG::all()->pluck('capDesc', 'id');
        $rubros = RG::where('id_capitulo',$concepto->id_capitulo)->pluck('rubro', 'id');
        $conceptos = ConG::where('id_rubro',$concepto->id_rubro)->pluck('concepto', 'id');
        $objetivos = ODS::where('id_eje',$proyAcc->id_eje)->select(\DB::raw('concat(objetivo," - ",descripcion) odesc,id'))->pluck('odesc', 'id');
        $proyAcc->capitulo = $concepto->id_capitulo;
        $proyAcc->rubro = $concepto->id_rubro;
        $proyAcc->federal = EF::where('id_proyecto', $id)->where('estructura',1)->first()->monto;
        $proyAcc->estatal = EF::where('id_proyecto', $id)->where('estructura',2)->first()->monto;
        $proyAcc->municipal = EF::where('id_proyecto', $id)->where('estructura',3)->first()->monto;
        $proyAcc->otros = EF::where('id_proyecto', $id)->where('estructura',4)->first()->monto;
        $proyAcc->diferencia = EF::where('id_proyecto', $id)->where('estructura',4)->first()->monto;
        return view('proyectosAcciones.edit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de proyecto o acción']],
            'sTitulo' => 'Proyectos y Acciones',
            'sDescripcion' => 'Edición',
            'proyAcc' => $proyAcc,
            'meses' => $meses,
            'fuentes' => $fuentes,
            'capitulos' => $capitulos,
            'rubros' => $rubros,
            'conceptos' => $conceptos,
            'objetivos' => $objetivos,
            'ejes' => $ejes
        ]);
    }

    
    public function update(Request $request) {
        $input = $request->all();
//        dd($input);
        $proy = PA::editaRegistro($input);

        if ($proy) {
            $accion = 'Edición de proyecto: ' . $input['id'];
            $ests = EF::where('id_proyecto',$input['id'])->get();
            foreach ($ests as $es) {
                $es->delete();
            }
            $i = 1;
            foreach ($input['estructura'] as $est) {
                $dataEF['monto'] = $est;
                $dataEF['estructura'] = $i;
                $dataEF['id_proyecto'] = $input['id'];
                EF::creaRegistro($dataEF);
                $i++;
            }
            $meses = CE::where('id_proyecto',$input['id'])->get();
            foreach ($meses as $ms) {
                $ms->delete();
            }
            $i = 1;
            foreach ($input['mes'] as $mes) {
                $dataEF['monto'] = $mes;
                $dataEF['mes'] = $i;
                $dataEF['id_proyecto'] = $input['id'];
                CE::creaRegistro($dataEF);
                $i++;
            }

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha editado exitosamente el proyecto.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido editar el proyecto.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('proyectoAccion/listado');
    }
    
    public function delete($id) {
        $proyAcc = PA::find($id);
        $del = $proyAcc->delete();
        if($del){
            $ests = EF::where('id_proyecto',$id)->get();
            foreach ($ests as $es) {
                $es->delete();
            }
            $meses = CE::where('id_proyecto',$id)->get();
            foreach ($meses as $ms) {
                $ms->delete();
            }
            $accion = 'Borrado exitoso de proyecto: ' . $proyAcc->nombre. ' con ID '.$id;            
            Session::flash('tituloMsg', 'Borrado exitoso!');
            Session::flash('mensaje', "Se ha borrado exitosamente el proyecto.");
            Session::flash('tipoMsg', 'success');
        } else {
            $accion = 'Borrado fallido de proyecto: ' . $proyAcc->nombre. ' con ID '.$id;            
            Session::flash('tituloMsg', 'Borrado fallido!');
            Session::flash('mensaje', "No se ha podido borra el proyecto.");
            Session::flash('tipoMsg', 'error');
        }
        Bitacora::creaRegistro($accion);
        return Redirect::to('proyectoAccion/listado');
    }
    
    public function proyectoPDF($id) {
        $accion = "Generación en PDF de proyecto $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $proy = PA::find($id);
        $dep = $proy->usuario()->gabinete()->direccion;
        $meses = CE::where('id_proyecto',$id)->get();
        $estructura = EF::where('id_proyecto',$id)->get();
        return PDF::loadView('proyectosAcciones.pdf', compact('proy', 'estructura','meses'))->setPaper('a4', 'landscape')->download("Proyecto de " . $dep . ".pdf");
    }
}
