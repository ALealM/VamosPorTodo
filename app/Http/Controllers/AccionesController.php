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
use Illuminate\Support\Facades\Session;
use Redirect;

class AccionesController extends Controller {

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
        $acciones = Acciones::all();
        return view('acciones.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de acciones']],
            'sTitulo' => 'Acciones',
            'sDescripcion' => 'Listado de acciones',
            'acciones' => $acciones,
        ]);
    }

    public function create() {
        $opciones = '';
        $opcionesS = '';
        $i = 1;
        $user = \Auth::User();
        $acciones = TA::pluck('tipo', 'id');
        $ejes = Ejes::pluck('eje', 'id');
        $colonias = Colonias::orderBy('nombre')->pluck('nombre', 'id');
        $tiposB = TB ::pluck('tipo', 'id');
        $secrets = Secretarias::pluck('siglas', 'id');
        foreach ($tiposB as $tb) {
            $opciones .= "<option value=$i>$tb</option>";
            $i++;
        }
        $i = 1;
        foreach ($secrets as $s) {
            $opcionesS .= "<option value=$i>$s</option>";
            $i++;
        }
//        dd($opciones);
        return view('acciones.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta acción']],
            'sTitulo' => 'Acciones',
            'sDescripcion' => 'Alta de nueva acción',
            'user' => $user,
            'acciones' => $acciones,
            'colonias' => $colonias,
            'opciones' => $opciones,
            'opcionesS' => $opcionesS,
            'secrets' => $secrets,
            'ejes' => $ejes,
            'tiposB' => $tiposB
        ]);
    }

    public function getResp(Request $request) {
        $idS = $request->get('idS');
        $r = Responsables::where('id_secretaria', $idS)->get();
        return $r;
    }

    public function getColonias() {
        $cols = Colonias::all();
        return $cols;
    }
    
    public function buscador_colonia(Request $request)
  {
    $aInput = $request->all();
    $sBusqueda = $aInput['palabra'];
    $aColonias = Colonias::where('nombre','like','%'.$aInput['palabra'].'%')
    ->take(5)->get()->toArray();
    return response()->json([
      'estatus' => 1,
      'mensaje' => 'Consulta exitosa.',
      'resultado' => $aColonias
    ]);
  }

    public function store(Request $request) {
        $input = $request->all();

        $acc = Acciones::creaRegistro($input);

        if ($acc) {
            $accion = 'Creación de nuevo proyecto: ' . $acc->nombre;
            foreach ($input['respon'] as $resp) {
                $dataR['id_accion'] = $acc->id;
                $dataR['id_responsable'] = $resp;
                RP::creaRegistro($dataR);
            }
            $i = 0;
            foreach ($input['coloniaB'] as $col) {
                $dataB['id_accion'] = $acc->id;
                $dataB['colonia'] = $col;
                $dataB['id_tipo_beneficiario'] = $input['tipoB'][$i];
                $dataB['beneficiarios'] = $input['numeroB'][$i];
                BP::creaRegistro($dataB);
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
        return Redirect::to('acciones/listado');
    }

    public function show($id) {
        $accion = Acciones::find($id);
        $beneficiarios = BP::where('id_accion',$id)->get();
        $responsables = RP::where('id_accion',$id)->get();
        return view('acciones.ficha', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Ficha de acción']],
            'sTitulo' => 'Acciones',
            'sDescripcion' => 'Ficha de acción',
            'accion' => $accion,
            'beneficiarios' => $beneficiarios,
            'responsables' => $responsables
        ]);
    }

    public function dashboard() {
        $acciones = Acciones::all();
        $beneficiarios = BP::all();
        return view('dashboard.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Dashboard']],
            'sTitulo' => 'Dashboard',
            'sDescripcion' => '',
            'acciones' => $acciones,
            'beneficiarios' => $beneficiarios
        ]);
    }

}
