<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\CargosMunicipales as CM;
use Illuminate\Support\Facades\Session;
use Redirect;
use Barryvdh\DomPDF\Facade as PDF;

class CargosMunicipalesController extends Controller {

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
        $cargos = CM::where('tipo',1)->get();
        $hombres = CM::where('genero','H')->count();
        $mujeres = CM::where('genero','M')->count();
        return view('cargosMunicipales.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de cargos municipales']],
            'sTitulo' => 'Cargos Municipales',
            'sDescripcion' => 'Listado',
            'cargos' => $cargos,
            'hombres' => $hombres,
            'mujeres' => $mujeres,
        ]);
    }

    public function show($id) {
        $cargo = CM::find($id);
        return view('cargosMunicipales.ficha', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Cargo Municipal']],
            'sTitulo' => 'Cargo Municipal',
            'sDescripcion' => 'Detalles',
            'cargo' => $cargo
        ]);
    }
    
    public function edit($id) {
        $cargo = CM::find($id);
        return view('cargosMunicipales.edit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Cargo Municipal']],
            'sTitulo' => 'Cargo Municipal',
            'sDescripcion' => 'Edición',
            'cargo' => $cargo
        ]);
    }
    
    public function update(Request $request) {
        $input = $request->all();
        $cargo = CM::find($input['id']);        
        if(isset($input['fotografia'])){
            $file = $request->file('fotografia');
            $ext = $file->getClientOriginalExtension();
            $input['fotografia'] = $cargo->id.'.'.$ext;
            $tmp_archivo = $_FILES['fotografia']['tmp_name'];
            $archivador = public_path() . '/img/cargosMunicipales/' . $input['fotografia'];
            move_uploaded_file($tmp_archivo, $archivador);
        }
        else{
            $input['fotografia'] = $cargo->fotografia;
        }
        $edit = CM::editaRegistro($input);
        if ($edit) {
            $accion = "Modificación de cargo municipal '" . $cargo->cargo;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha modificado exitosamente el cargo municipal.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el cargo municipal.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('cargosMunicipales');
    }

    public function showCargo(Request $request) {
        $cargo = CM::find($request->get('id'));
        return view('cargosMunicipales.ficha', ['cargo'=>$cargo]);
    }
    
    public function editCargo(Request $request) {
        $cargo = CM::find($request->get('id'));
        return view('cargosMunicipales.edit', ['cargo'=>$cargo]);
    }
    
    public function cargosPDF()
    {
        $cargos = CM::all();
        return PDF::loadView('cargosMunicipales.pdf',compact('cargos'))->download("Cargos Municipales SLP.pdf");
    }
}
