<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Solicitudes;
use App\Models\ColoniasB;
use App\Models\Rubros;
use App\Models\Programas;
use App\Models\Secciones;
use App\Models\ProgramasBeneficiarios as PB;
use App\Models\DemarcacionSecCol as DSC;
use App\Models\Demarcaciones;
use App\Models\Gabinete;
use App\Models\SolicitudEvidencia as SE;
use Illuminate\Support\Facades\Session;
use Redirect;
use Barryvdh\DomPDF\Facade as PDF;

class SolicitudesController extends Controller {

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
        $accion = "Ingreso al listado de solicitudes por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);        
        $solicitudes = Solicitudes::all();        
        return view('solicitudes.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de solicitudes']],
            'sTitulo' => 'Solicitudes',
            'sDescripcion' => 'Listado de solicitudes',
            'solicitudes' => $solicitudes            
        ]);
    }

    public function create() {
        $accion = "Creación de nueva solicitud por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $colonias = ColoniasB::pluck('colonia','id'); 
        $rubros = Rubros::pluck('nombre','id'); 
        $programas = Programas::pluck('nombre','id'); 
        $direcciones = Gabinete::where('id','<',99)->pluck('direccion','id'); 
        $estatus = [0=>'Reportado',1=>'Iniciado',2=>'En Proceso',3=>'Concluido'];
        return view('solicitudes.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta nueva solicitud']],
            'sTitulo' => 'Solicitudes',
            'sDescripcion' => 'Alta de nueva solicitud',
            'rubros' => $rubros,
            'programas' => $programas,
            'estatus' => $estatus,
            'direcciones' => $direcciones,
            'colonias' => $colonias
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $sol = Solicitudes::creaRegistro($input);
        $err = '';
        if ($sol) {
            if (isset($input['evidencia'])) {
                $aux = 1;
                foreach ($input['evidencia'] as $evidencia) {
                    $file = $evidencia;
                    $ext = $file->getClientOriginalExtension();
                    if($ext == 'JPG' || $ext == 'JPEG' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'PNG' || $ext == 'png'){
                        $input['archivo'] = $sol->id . '_' . $aux . '_' .date('H_i_s'). '.' . $ext;
                        $input['id_solicitud'] = $sol->id;
                        $file->move(public_path() . '/solicitudesEv/', $input['archivo']);
                        $aux++;
                        SE::creaRegistro($input);                    
                    }
                    else{
                        $err = ' Parte de la evidencia no se pudo agregar debido a que no es formato de fotografía.';
                    }
                }
            }
            $accion = 'Creación de nueva solicitud: ID ' . $sol->id;
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente la nueva solicitud.$err");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la nueva solicitud.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('solicitud/show/'.$sol->id);
    }

    public function show($id) {
        $accion = "Ingreso a la ficha de la solicitud $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $solicitud = Solicitudes::find($id);
        $secciones = Secciones::pluck('seccion','id');
        $beneficiarios = PB::where('id_solicitud',$id)->get();
        $evidencia = SE::where('id_solicitud',$id)->get();
        return view('solicitudes.ficha', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Ficha de solicitud']],
            'sTitulo' => 'Solicitudes',
            'sDescripcion' => 'Ficha de solicitud',
            'solicitud' => $solicitud,
            'secciones' => $secciones,
            'beneficiarios' => $beneficiarios,
            'evidencia' => $evidencia,
            'dias' => $dias,
            'meses' => $meses
        ]);
    }

    public function edit($id) {
        $accion = "Ingreso a la edición de la solicitud $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $solicitud = Solicitudes::find($id);
        $rubros = Rubros::pluck('nombre','id'); 
        $programas = Programas::pluck('nombre','id'); 
        $colonias = ColoniasB::pluck('colonia','id');
        $direcciones = Gabinete::where('id','<',99)->pluck('direccion','id'); 
        $estatus = [0=>'Reportado',1=>'Iniciado',2=>'En Proceso',3=>'Concluido'];
        $evidencia = SE::where('id_solicitud',$id)->get();
        return view('solicitudes.edit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de solicitud']],
            'sTitulo' => 'Solicitudes',
            'sDescripcion' => 'Edición de solicitud',
            'solicitud' => $solicitud,
            'rubros' => $rubros,
            'programas' => $programas,
            'estatus' => $estatus,
            'direcciones' => $direcciones,
            'evidencia' => $evidencia,
            'colonias' => $colonias
        ]);
    }

    public function update(Request $request) {
        $input = $request->all();
        $sol = Solicitudes::editaRegistro($input);
        $err = '';
        if ($sol) {
            if (isset($input['imagenes'])) {
                foreach ($input['imagenes'] as $imagen) {
                    $img = SE::find($imagen);
                    $img->delete();
                }
            }
            if (isset($input['evidencia'])) {
                $aux = 1;
                foreach ($input['evidencia'] as $evidencia) {
                    $file = $evidencia;
                    $ext = $file->getClientOriginalExtension();
                    if($ext == 'JPG' || $ext == 'JPEG' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'PNG' || $ext == 'png'){
                        $inputA['archivo'] = $input['id'] . '_' . $aux . '_' .date('H_i_s'). '.' . $ext;
                        $inputA['id_solicitud'] = $input['id'];
                        $file->move(public_path() . '/solicitudesEv/', $inputA['archivo']);
                        $aux++;
                        SE::creaRegistro($inputA);
                    }
                    else{
                        $err = ' Parte de la evidencia no se pudo agregar debido a que no es formato de fotografía.';
                    }
                }
            }
            $accion = 'Edición solicitud: ID ' . $input['id'];
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha editado exitosamente la solicitud.$err");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido editar la solicitud.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('solicitudes');
    }
    
    public function delete($id) {
        $solicitud = Solicitudes::find($id);
        $del = $solicitud->delete();
        if($del){
            $accion = 'Borrado exitoso de solicitud con ID '.$id;            
            Session::flash('tituloMsg', 'Borrado exitoso!');
            Session::flash('mensaje', "Se ha borrado exitosamente la solicitud.");
            Session::flash('tipoMsg', 'success');
        } else {
            $accion = 'Borrado fallido de solicitud con ID '.$id;            
            Session::flash('tituloMsg', 'Borrado fallido!');
            Session::flash('mensaje', "No se ha podido borra la solicitud.");
            Session::flash('tipoMsg', 'error');
        }
        Bitacora::creaRegistro($accion);
        return Redirect::to('solicitudes');
    }
    
    public function solicitudPDF($id) {
        $accion = "Generación en PDF de la solicitud $id por " . \Auth::User()->id;
        $beneficiarios = PB::where('id_solicitud',$id)->get();
        Bitacora::creaRegistro($accion);
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $solicitud = Solicitudes::find($id);
        return PDF::loadView('solicitudes.pdf', compact('solicitud', 'dias', 'meses', 'beneficiarios'))->download("Solicitud " . date('d-m-Y', strtotime($solicitud->fecha_alta)) . "_$solicitud->id.pdf");
    }
    
    public function storeBeneficiario(Request $request) {
        $input = $request->all();
        $prog = Programas::find($input['id_programa']);
        $progBen = PB::creaRegistro($input);
        if ($progBen) {
            $accion = 'Creación de nuevo beneficiario: ' .$input['nombre']. ', en el programa: '.$prog->nombre.' y solicitud '.$input['id_solicitud'];
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente el nuevo beneficiario.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo beneficiario.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('solicitud/show/'.$input['id_solicitud']);
    }

    public function editBeneficiario($id) {
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $beneficiario = PB::find($id);
        $solicitud = Solicitudes::find($beneficiario->id_solicitud);
        $programa = Programas::find($beneficiario->id_programa);
        $secciones = Secciones::pluck('seccion','id');
        $cols = DSC::where('id_seccion',$beneficiario->id_seccion)->pluck('id_colonia');
        $colonias = ColoniasB::whereIn('id',$cols)->pluck('colonia','id');
        $colonias->put(1000,'Otra');
        $beneficiarios = PB::where('id_solicitud',$beneficiario->id_solicitud)->get();
        if($beneficiario->id_demarcacionSC==1000)
        $beneficiario->demarcacion = 'Sin identificar';
        else
        $beneficiario->demarcacion = Demarcaciones::find($beneficiario->id_demarcacionSC)->demarcacion;
        return view('solicitudes.editBeneficiario', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de beneficiarios']],
            'sTitulo' => 'Programas - Beneficiarios del programa '.$programa->nombre,
            'sDescripcion' => 'Listado de beneficiarios ',
            'beneficiarios' => $beneficiarios,
            'beneficiario' => $beneficiario,
            'secciones' => $secciones,
            'colonias' => $colonias,
            'solicitud' => $solicitud,
            'programa' => $programa,
            'dias' => $dias,
            'meses' => $meses
        ]);
    }
    
    public function updateBeneficiario(Request $request) {
        $input = $request->all();
        $beneficiario = PB::find($input['id']);
        $ben = PB::editaRegistro($input);
        if ($ben) {
            $accion = 'Edición del beneficiario: ' . $input['id'];
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha editado exitosamente el beneficiario.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido editar el beneficiario.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('solicitud/show/'.$beneficiario->id_solicitud);
    }
    
    public function deleteBeneficiario($id) {
        $beneficiario = PB::find($id);
        $sol = Solicitudes::find($beneficiario->id_solicitud);
        $accion = 'Borrado del beneficiario: ' . $id;
        Bitacora::creaRegistro($accion);
        $beneficiario->delete();
        Session::flash('tituloMsg', 'Borrado exitoso!');
        Session::flash('mensaje', "Se ha eliminado exitosamente el beneficiario.");
        Session::flash('tipoMsg', 'success');
        return Redirect::to('solicitud/show/'.$sol->id);
    }
    
    public function beneficiarios() {
        $beneficiarios = PB::all();
        return view('solicitudes.beneficiarios', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Padrón de beneficiarios']],
            'sTitulo' => 'Padrón de beneficiarios',
            'sDescripcion' => 'Listado del Padrón de beneficiarios',
            'beneficiarios' => $beneficiarios
        ]);
    }
    
    public function padronBenSol($id) {
        $solicitud = Solicitudes::find($id);
        $evidencia = SE::where('id_solicitud',$id)->get();
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        return view('solicitudes.fichaB', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Ficha de solicitud']],
            'sTitulo' => 'Solicitudes',
            'sDescripcion' => 'Ficha de solicitud por beneficiario',
            'solicitud' => $solicitud,
            'evidencia' => $evidencia,
            'dias' => $dias,
            'meses' => $meses
        ]);
    }
}
