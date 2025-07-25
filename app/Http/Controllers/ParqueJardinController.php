<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Redirect;
use App\Models\Bitacora;
use App\Models\ParqueJardin as PJ;
use App\Models\Arboles;

class ParqueJardinController extends Controller
{
    public function index() {
        $accion = "Ingreso al listado de solicitud de Parques y Jardines por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $registros = PJ::all();
        return view('parques_jardines.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Solicitudes de Parques y Jardines']],
            'sTitulo' => 'Parques y Jardines',
            'sDescripcion' => 'Listado de Solicitudes',
            'registros' => $registros,
        ]);
    }

    public function create() {
        return view('parques_jardines.solicitud', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Solicitud de Parques y Jardines']],
            'sTitulo' => 'Nueva Solicitud',
            'sDescripcion' => 'Parques y Jardines'
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $new = PJ::new($input);
        if($new){
            $accion = 'Creación de nueva solicitud de Parques y Jardines: ID ' . $new->id;
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente la solicitud.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la solicitud.");
            Session::flash('tipoMsg', 'error');
            return Redirect::back()->withInput($input);
        }
        return Redirect::to('indexParqueJardin');
    }

    public function edit($id) {
        $accion = "Ingreso a la edición de la solicitud de Parques y Jardines $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $pj = PJ::find($id);
        $arbolesInspeccion = Arboles::where('id_parque_jardin', $id)->where('accion', 1)->get();
        $arbolesRestitucion = Arboles::where('id_parque_jardin', $id)->where('accion', 2)->get();
        return view('parques_jardines.edit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de Solicitud de Parques y Jardines']],
            'sTitulo' => 'Parques y Jardines',
            'sDescripcion' => 'Edición de Solicitud'
        ], compact('pj', 'arbolesInspeccion', 'arbolesRestitucion') );
    }

    public function update(Request $request) {
        $input = $request->all();
        $update = PJ::editar($input);
        if ($update) {
            $accion = 'Edición solicitud de Parques y Jardines: ID ' . $input['id'];
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha editado exitosamente la solicitud.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido editar la solicitud.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('indexParqueJardin');
    }
}