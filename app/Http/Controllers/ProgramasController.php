<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Programas;
use App\Models\ProgramasDireccion as PD;
use App\Models\ProgramasBeneficiarios as PB;
use App\Models\DemarcacionSecCol as DSC;
use App\Models\Demarcaciones;
use App\Models\ColoniasB;
use App\Models\Secciones;
use Illuminate\Support\Facades\Session;
use Redirect;

class ProgramasController extends Controller {

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
        $programas = Programas::all();
        foreach($programas as $programa){
            $programa->link = PD::where('id_programa',$programa->id)->where('id_direccion',\Auth::User()->id_gabinete)->count();
        }
        return view('programas.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de programas']],
            'sTitulo' => 'Programas - Listado',
            'sDescripcion' => 'Catálogo de programas sociales',
            'programas' => $programas,
        ]);
    }       

    public function create() {
        return view('programas.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta nuevo programa']],
            'sTitulo' => 'Programas',
            'sDescripcion' => 'Alta de nuevo programa'
        ]);
    }
    
    public function beneficiarios($id) {
        $programa = Programas::find($id);
        $secciones = Secciones::pluck('seccion','id');
        $beneficiarios = PB::where('id_programa',$id)->where('id_direccion',\Auth::User()->id_gabinete)->get();
        return view('programas.beneficiarios', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de beneficiarios']],
            'sTitulo' => 'Programas - Beneficiarios del programa '.$programa->nombre,
            'sDescripcion' => 'Listado de beneficiarios ',
            'beneficiarios' => $beneficiarios,
            'secciones' => $secciones,
            'programa' => $programa
        ]);
    } 

    public function store(Request $request) {
        $input = $request->all();

        $prog = Programas::creaRegistro($input);

        if ($prog) {
            $accion = 'Creación de nuevo programa social: ' . $prog->nombre;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente el nuevo programa.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo programa.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('programas');
    }
    
    public function edit($id) {
        $programa = Programas::find($id);
        $programas = Programas::all();
        return view('programas.edit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de programas']],
            'sTitulo' => 'Programas - Edición',
            'sDescripcion' => 'Catálogo de programas sociales',
            'programa' => $programa,
            'programas' => $programas,
        ]);
    }
    
    public function update(Request $request) {
        $input = $request->all();
        $programa = Programas::find($input['id']);        
        $prog = Programas::editaRegistro($input);
        if ($prog) {
            $accion = 'Edición del programa: ' . $programa->nombre;
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha editado exitosamente el programa.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido editar el programa.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('programas');
    }

    public function delete($id) {
        $programa = Programas::find($id);
        $accion = 'Borrado del programa: ' . $programa->nombre;
        Bitacora::creaRegistro($accion);
        $programa->delete();
        Session::flash('tituloMsg', 'Borrado exitoso!');
        Session::flash('mensaje', "Se ha eliminado exitosamente el programa.");
        Session::flash('tipoMsg', 'success');
        return Redirect::to('programas');
    }
    
    public function vincular($id) {
        $programa = Programas::find($id);
        $accion = 'Vinculación del programa: ' . $programa->nombre. " con la dirección: ". \Auth::User()->dependencia()->direccion;
        Bitacora::creaRegistro($accion);
        PD::creaRegistro($id);
        Session::flash('tituloMsg', 'Vínculo exitoso!');
        Session::flash('mensaje', "Se ha vinculado exitosamente el programa con su dirección. Ya puede agregar beneficiarios al programa.");
        Session::flash('tipoMsg', 'success');
        return Redirect::to('programas');
    }
    
    public function desvincular($id) {
        $programa = Programas::find($id);
        $beneficiarios = PB::where('id_programa',$id)->count();
        if($beneficiarios==0){
            $accion = 'Desvinculación del programa: ' . $programa->nombre. " con la dirección: ". \Auth::User()->dependencia()->direccion;
            Bitacora::creaRegistro($accion);
            $pd = PD::where('id_programa',$id)->where('id_direccion',\Auth::User()->id_gabinete)->first();
            $pd->delete();
            Session::flash('tituloMsg', 'Acción exitosa!');
            Session::flash('mensaje', "Se ha desvinculado exitosamente el programa de su dirección.");
            Session::flash('tipoMsg', 'success');
        }
        else{
            Session::flash('tituloMsg', 'Acción no posible!');
            Session::flash('mensaje', "No se ha podido desvincular el programa de su dirección debido a que ya cuenta con beneficiarios agregados.");
            Session::flash('tipoMsg', 'warning');
        }
        return Redirect::to('programas');
    }     
    
    public function storeBeneficiario(Request $request) {
        $input = $request->all();
        $prog = Programas::find($input['id_programa']);
        $progBen = PB::creaRegistro($input);
        if ($progBen) {
            $accion = 'Creación de nuevo beneficiario: ' .$input['nombre']. ', en el programa: '.$prog->nombre;
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente el nuevo beneficiario.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo beneficiario.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('programa/beneficiarios/'.$input['id_programa']);
    }
    
    public function deleteBeneficiario($id) {
        $beneficiario = PB::find($id);
        $prog = Programas::find($beneficiario->id_programa);
        $accion = 'Borrado del beneficiario: ' . $id;
        Bitacora::creaRegistro($accion);
        $beneficiario->delete();
        Session::flash('tituloMsg', 'Borrado exitoso!');
        Session::flash('mensaje', "Se ha eliminado exitosamente el beneficiario.");
        Session::flash('tipoMsg', 'success');
        return Redirect::to('programa/beneficiarios/'.$prog->id);
    }
    
    public function editBeneficiario($id) {
        $beneficiario = PB::find($id);
        $programa = Programas::find($beneficiario->id_programa);
        $secciones = Secciones::pluck('seccion','id');
        $cols = DSC::where('id_seccion',$beneficiario->id_seccion)->pluck('id_colonia');
        $colonias = ColoniasB::whereIn('id',$cols)->pluck('colonia','id');
        $colonias->put(1000,'Otra');
        $beneficiarios = PB::where('id_programa',$beneficiario->id_programa)->where('id_direccion',\Auth::User()->id_gabinete)->get();
        if($beneficiario->id_demarcacionSC==1000)
        $beneficiario->demarcacion = 'Sin identificar';
        else
        $beneficiario->demarcacion = Demarcaciones::find($beneficiario->id_demarcacionSC)->demarcacion;
        return view('programas.editBeneficiario', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de beneficiarios']],
            'sTitulo' => 'Programas - Beneficiarios del programa '.$programa->nombre,
            'sDescripcion' => 'Listado de beneficiarios ',
            'beneficiarios' => $beneficiarios,
            'beneficiario' => $beneficiario,
            'secciones' => $secciones,
            'colonias' => $colonias,
            'programa' => $programa
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
        return Redirect::to('programa/beneficiarios/'.$beneficiario->id_programa);
    }
    
    public function getColonias(Request $request) {
        $secc = $request->get('secc');
        $cols = DSC::where('id_seccion',$secc)->pluck('id_colonia');
        $colonias = ColoniasB::whereIn('id',$cols)->get();
        return $colonias;
    }
    
    public function getDemarcacion(Request $request) {
        $secc = $request->get('secc');
        $col = $request->get('col');
        $dem = DSC::where('id_seccion',$secc)->where('id_colonia',$col)->first();
        $demarcacion = Demarcaciones::find($dem->id_demarcacion);
        return $demarcacion;
    }
}
