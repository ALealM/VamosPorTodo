<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\TipoAcciones as TA;
use App\Models\TipoBeneficiarios as TB;
use App\Models\Colonias;
use App\Models\Secretarias;
use App\Models\Responsables;
use App\Models\UnidadesIndicadores as UI;
use App\Models\FrecuenciasIndicadores as FI;
use App\Models\UnidadesAc;
use Illuminate\Support\Facades\Session;
use Redirect;

class CatalogosController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function unidadesIndex() {
        $unidades = UnidadesAc::all();
        return view('catalogos.unidades.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Unidades de Medida']],
            'sTitulo' => 'Unidades de Medida',
            'sDescripcion' => 'Listado',
            'unidades' => $unidades,
        ]);
    }

    public function unidadCreate() {

        return view('catalogos.unidades.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de Unidad de Medida']],
            'sTitulo' => 'Unidad de Medida',
            'sDescripcion' => 'Alta de nueva Unidad de Medida'
        ]);
    }

    public function unidadStore(Request $request) {
        $input = $request->all();

        $unidad = UnidadesAc::creaRegistro($input);

        if ($unidad) {
            $accion = 'Creación de nueva Unidad de Medida: ' . $unidad->unidad;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente la nueva Unidad de Medida: " . $unidad->unidad);
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la nueva Unidad de Medida.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('catalogos/unidades');
    }

    public function index() {
        return view('catalogos.index', [//000
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Catálogos']],
            'sTitulo' => 'Catálogos',
            'sDescripcion' => 'Listado',
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tipoAccionesIndex() {
        $tipoAcciones = TA::all();
        return view('catalogos.tipoAcciones.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de tipos de acciones']],
            'sTitulo' => 'Tipos de Acciones',
            'sDescripcion' => 'Listado',
            'tipoAcciones' => $tipoAcciones,
        ]);
    }

    public function tipoAccionCreate() {

        return view('catalogos.tipoAcciones.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta tipo de acción']],
            'sTitulo' => 'Tipos de Acciones',
            'sDescripcion' => 'Alta de nuevo tipo de acción'
        ]);
    }

    public function tipoAccionStore(Request $request) {
        $input = $request->all();

        $tAcc = TA::creaRegistro($input);

        if ($tAcc) {
            $accion = 'Creación de nuevo tipo de acción: ' . $tAcc->tipo;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente el nuevo tipo de acción.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo tipo de acción.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('catalogos/tipoAcciones');
    }

    public function tipoBeneficiariosIndex() {
        $tipoBeneficiarios = TB::all();
        return view('catalogos.tipoBeneficiarios.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de tipos de beneficiarios']],
            'sTitulo' => 'Tipos de Beneficiarios',
            'sDescripcion' => 'Listado',
            'tipoBeneficiarios' => $tipoBeneficiarios,
        ]);
    }

    public function tipoBeneficiarioCreate() {

        return view('catalogos.tipoBeneficiarios.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta tipo de beneficiario']],
            'sTitulo' => 'Tipos de Beneficiarios',
            'sDescripcion' => 'Alta de nuevo tipo de beneficiario'
        ]);
    }

    public function tipoBeneficiarioStore(Request $request) {
        $input = $request->all();

        $tBen = TB::creaRegistro($input);

        if ($tBen) {
            $accion = 'Creación de nuevo tipo de beneficiario: ' . $tBen->tipo;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente el nuevo tipo de beneficiario.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo tipo de beneficiario.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('catalogos/tipoBeneficiarios');
    }

    public function coloniasIndex() {
        $colonias = Colonias::all();
        return view('catalogos.colonias.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de colonias']],
            'sTitulo' => 'Tipos de Colonias',
            'sDescripcion' => 'Listado',
            'colonias' => $colonias,
        ]);
    }

    public function coloniaCreate() {

        return view('catalogos.colonias.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de colonia']],
            'sTitulo' => 'Colonias',
            'sDescripcion' => 'Alta de nueva colonia'
        ]);
    }

    public function coloniaStore(Request $request) {
        $input = $request->all();

        $colonia = Colonias::creaRegistro($input);

        if ($colonia) {
            $accion = 'Creación de nueva colonia: ' . $colonia->nombre;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente la nueva colonia.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la nueva colonia.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('catalogos/colonias');
    }

    public function secretariasIndex() {
        $secretarias = Secretarias::all();
        return view('catalogos.secretarias.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de secretarías']],
            'sTitulo' => 'Tipos de Secretarías',
            'sDescripcion' => 'Listado',
            'secretarias' => $secretarias,
        ]);
    }

    public function secretariaCreate() {

        return view('catalogos.secretarias.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de secretaría']],
            'sTitulo' => 'Secretarías',
            'sDescripcion' => 'Alta de nueva secretaría'
        ]);
    }

    public function secretariaStore(Request $request) {
        $input = $request->all();

        $secretaria = Secretarias::creaRegistro($input);

        if ($secretaria) {
            $accion = 'Creación de nueva secretaría: ' . $secretaria->siglas;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente la nueva secretaría.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la nueva secretaría.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('catalogos/secretarias');
    }

    public function responsablesIndex() {
        $responsables = Responsables::all();
        return view('catalogos.responsables.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de responsables']],
            'sTitulo' => 'Tipos de Responsables',
            'sDescripcion' => 'Listado',
            'responsables' => $responsables,
        ]);
    }

    public function responsableCreate() {

        return view('catalogos.responsables.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de responsable']],
            'sTitulo' => 'Responsables',
            'sDescripcion' => 'Alta de nuevo responsable'
        ]);
    }

    public function responsableStore(Request $request) {
        $input = $request->all();

        $responsable = Responsables::creaRegistro($input);

        if ($responsable) {
            $accion = 'Creación de nuevo responsable: ' . $responsable->nombre;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente el nuevo responsables.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo responsables.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('catalogos/responsables');
    }
    
    public function unidadesKPIIndex() {
        $unidades = UI::all();
        return view('catalogos.unidadesKPI.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Unidades de Medida (KPI)']],
            'sTitulo' => 'Unidades de Medida (KPI)',
            'sDescripcion' => 'Listado',
            'unidades' => $unidades,
        ]);
    }

    public function unidadKPICreate() {

        return view('catalogos.unidadesKPI.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de Unidad de Medida (KPI)']],
            'sTitulo' => 'Unidad de Medida (KPI)',
            'sDescripcion' => 'Alta de nueva Unidad de Medida (KPI)'
        ]);
    }

    public function unidadKPIStore(Request $request) {
        $input = $request->all();

        $unidad = UI::creaRegistro($input);

        if ($unidad) {
            $accion = 'Creación de nueva Unidad de Medida (KPI): ' . $unidad->unidad;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente la nueva Unidad de Medida (KPI): " . $unidad->unidad);
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la nueva Unidad de Medida (KPI).");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('catalogos/unidadesKPI');
    }
    
    public function frecuenciasKPIIndex() {
        $frecuencias = FI::all();
        return view('catalogos.frecuenciasKPI.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Frecuencias (KPI)']],
            'sTitulo' => 'Frecuencias (KPI)',
            'sDescripcion' => 'Listado',
            'frecuencias' => $frecuencias,
        ]);
    }

    public function frecuenciaKPICreate() {

        return view('catalogos.frecuenciasKPI.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta de Frecuencia (KPI)']],
            'sTitulo' => 'Frecuencia (KPI)',
            'sDescripcion' => 'Alta de nueva Frecuencias (KPI)'
        ]);
    }

    public function frecuenciaKPIStore(Request $request) {
        $input = $request->all();

        $frecuencia = FI::creaRegistro($input);

        if ($frecuencia) {
            $accion = 'Creación de nueva Frecuencia (KPI): ' . $frecuencia->frecuencia;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente la nueva Frecuencia (KPI): " . $frecuencia->frecuencia);
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la nueva Frecuencia (KPI).");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('catalogos/frecuenciasKPI');
    }
}
