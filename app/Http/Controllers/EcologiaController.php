<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use App\User;
use App\Models\Bitacora;
use App\Models\Ecologia;
use App\Models\EcologiaActividades as EA;
use Redirect;

class EcologiaController extends Controller {

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
    public function index() {
        $ecologia = Ecologia::where('activo', 1)->get();
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        return view('ecologia.index', [
                'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Plantillas']],
                'sTitulo' => 'Actividades Ecologistas',
                'sDescripcion' => 'Listado de actividades'
            ],
            compact('ecologia', 'dias', 'meses')
        );
    }


    public function create() {
        return view(
            'ecologia.create',
            [
                'aBreadCrumb' => [['link' => 'active', 'label' => 'Nueva Plantilla']],
                'sTitulo' => 'Nueva Plantilla',
                'sDescripcion' => 'Creación de una nuevo informe de ecología'
            ]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $acc = Ecologia::new($input);

        if ($acc) {
            $accion = 'Creación de nuevo informe de ecología: ' . $acc->nombre;
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente el nuevo informe de ecología.");
            Session::flash('tipoMsg', 'success');
            return Redirect::to('indexEcologia');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo informe.");
            Session::flash('tipoMsg', 'error');
            return Redirect::back()->withInput($input);
        }
    }

    public function edit($id) {
        $ecologia = Ecologia::find($id);
        $ecologia->listaActividad = EA::where('id_ecologia', $ecologia->id)->get();

        return view('ecologia.edit', [
                'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de informe de ecología']],
                'sTitulo' => 'Ecología',
                'sDescripcion' => 'Edición del informe',
            ],
            compact('ecologia')
        );
    }

    public function update(Request $request) {
        $input = $request->all();
        $edicion = Ecologia::editar($input);
        if( $edicion ){
            $accion = 'Informe de ecología modificado con ID '.$input['id'];
            Session::flash('tituloMsg', 'Edición exitosa!');
            Session::flash('mensaje', "Se ha modificado exitosamente el informe de ecología.");
            Session::flash('tipoMsg', 'success');
        } else {
            $accion = 'La edición del informe de ecología: con ID '.$input['id'].' no se pudó realizar';            
            Session::flash('tituloMsg', 'Error en la edición!');
            Session::flash('mensaje', "No se ha podido modificar el informe de ecología.");
            Session::flash('tipoMsg', 'error');
        }
        Bitacora::creaRegistro($accion);
        return Redirect::to('indexEcologia');
    }
    
    public function delete($id) {
        $ecologia = Ecologia::find($id);
        $ecologia->activo = 2;
        $del = $ecologia->save();
        if( $del ){
            $accion = 'Informe de ecología con ID '.$id.' eliminado exitosamente.';            
            Session::flash('tituloMsg', 'Eliminación exitosa!');
            Session::flash('mensaje', "Se ha borrado exitosamente el informe de ecología.");
            Session::flash('tipoMsg', 'success');
        } else {
            $accion = 'La eliminación del informe de ecología con ID '.$id.' no se pudó realizar';            
            Session::flash('tituloMsg', 'Borrado fallido!');
            Session::flash('mensaje', "No se ha podido eliminar el informe de ecología.");
            Session::flash('tipoMsg', 'error');
        }
        Bitacora::creaRegistro($accion);
        return Redirect::to('indexEcologia');
    }

    public function pdf($id) {
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $ecologia = Ecologia::find($id);
        $ecologia->actividades = EA::where('id_ecologia', $ecologia->id)->get();
        $accion = "Generación en PDF del informe de ecología ".$ecologia->titulo." con ID $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);

        /*return view('ecologia.pdf', [
                'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de ficha de indicadores']],
                'sTitulo' => 'Indicadores',
                'sDescripcion' => 'Listado de indicadores',
            ],
            compact('ecologia', 'dias', 'meses')
        );*/
        return PDF::loadView('ecologia.pdf', compact('ecologia', 'meses', 'dias'))
            ->setPaper('a4', 'landscape') // cambiar orientación de la hoja
            ->download("InformeEcologia_" . date('d-m-Y', strtotime($ecologia->fecha_init)) . '-' . date('d-m-Y', strtotime($ecologia->fecha_init)) .'_'. $ecologia->id.".pdf");
    }
}