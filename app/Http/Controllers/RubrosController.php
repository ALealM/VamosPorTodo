<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Rubros;
use Illuminate\Support\Facades\Session;
use Redirect;

class RubrosController extends Controller {

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
        $rubros = Rubros::all();
        return view('rubros.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de rubros']],
            'sTitulo' => 'Rubros - Listado',
            'sDescripcion' => 'Catálogo de rubros',
            'rubros' => $rubros,
        ]);
    }       

    public function create() {
        return view('rubros.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta nuevo rubro']],
            'sTitulo' => 'Rubros',
            'sDescripcion' => 'Alta de nuevo rubro'
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

        $rubro = Rubros::creaRegistro($input);

        if ($rubro) {
            $accion = 'Creación de nuevo rubro: ' . $rubro->nombre;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente el nuevo rubro municipal.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo rubro municipal.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('rubros');
    }
    
    public function edit($id) {
        $rubro = Rubros::find($id);
        return view('rubros.edit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de rubros']],
            'sTitulo' => 'Rubros - Edición',
            'sDescripcion' => 'Catálogo de rubros municipales',
            'rubro' => $rubro
        ]);
    }
    
    public function update(Request $request) {
        $input = $request->all();
        $rubro = Rubros::find($input['id']);        
        $rub = Rubros::editaRegistro($input);
        if ($rub) {
            $accion = 'Edición del rubro: ' . $rubro->nombre;
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha editado exitosamente el rubro.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido editar el rubro.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('rubros');
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
