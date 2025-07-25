<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Eventos;
use App\Models\EventosActividades as EA;
use App\Models\EventosColaboradores as EC;
use App\Models\EventosReporte as ER;
use App\Models\Secretarias;
use App\Models\Responsables;
use App\Models\Colonias;
use App\Models\ResponsablesProyecto as RP;
use App\Models\BeneficiariosProyecto as BP;
use App\Models\TipoAcciones as TA;
use App\Models\TipoBeneficiarios as TB;
use App\Models\EjesPlanDM as Ejes;
use App\Models\Gabinete;
use App\Models\EventoDiario as ED;
use Illuminate\Support\Facades\Session;
use Redirect;
use Barryvdh\DomPDF\Facade as PDF;

class EventosController extends Controller {

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
        $accion = "Ingreso al listado de eventos por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        if (\Auth::User()->tipo == 1) {
            $eventos['p'] = Eventos::where('estatus', 1)->get();
            $eventos['r'] = Eventos::where('estatus', 2)->get();
            $eventos['na'] = Eventos::where('estatus', 4)->get();
        } else {
            $eventos = Eventos::where('id_usuario', \Auth::User()->id)->where('estatus', '<>', 3)->get();
        }
        return view('eventos.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de eventos']],
            'sTitulo' => 'Eventos',
            'sDescripcion' => 'Listado de eventos',
            'eventos' => $eventos,
        ]);
    }

    public function listadoColaboracion() {
        $accion = "Ingreso al listado de eventos en colaboración por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $cols = EC::where('id_gabinete', \Auth::User()->id_gabinete)->pluck('id_evento');
        $eventos = Eventos::whereIn('id', $cols)->where('estatus', 3)->get();
        return view('eventos.indexColaboracion', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de eventos en colaboración']],
            'sTitulo' => 'Eventos en colaboración',
            'sDescripcion' => 'Listado de eventos en colaboración',
            'eventos' => $eventos,
        ]);
    }

    public function listadoAutorizado() {
        $accion = "Ingreso al listado de eventos autorizados por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        if (\Auth::User()->tipo == 1)
            $eventos = Eventos::where('estatus', 3)->get();
        else
            $eventos = Eventos::where('id_usuario', \Auth::User()->id)->where('estatus', 3)->get();
        return view('eventos.indexAutorizados', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de eventos autorizados']],
            'sTitulo' => 'Eventos autorizados',
            'sDescripcion' => 'Listado de eventos autorizados',
            'eventos' => $eventos,
        ]);
    }

    public function create() {
        $accion = "Creación de nuevo evento por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $direcciones = Gabinete::pluck('direccion', 'id');
        return view('eventos.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta evento']],
            'sTitulo' => 'Eventos',
            'sDescripcion' => 'Alta de nuevo evento',
            'direcciones' => $direcciones
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $input['folio'] = Eventos::where('fecha_alta', 'like', date('Y') . '%')->where('fecha_alta', 'like', '%-' . date('m') . '-%')->where('id_usuario', \Auth::User()->id)->count() + 1;
        if($input['ubicacion']==null){
            Session::flash('tituloMsg', 'Ingrese la información requerida');
            Session::flash('mensaje', "Seleccione la ubicación del evento.");
            Session::flash('tipoMsg', 'warning');
            return Redirect::back()->withInput($input);
        }
        $ubic = explode(', ',$input['ubicacion']);
        $input['ubicacion'] = str_replace("]","",$ubic[1]).','.str_replace("[","",$ubic[0]);
        $evt = Eventos::creaRegistro($input);
        if ($evt) {
            $accion = 'Creación de nuevo evento: ID ' . $evt->id;
            $i = 0;
            foreach ($input['hInicio'] as $hi) {
                $dataA['id_evento'] = $evt->id;
                $dataA['hora_inicio'] = $hi;
                $dataA['hora_fin'] = $input['hFin'][$i];
                $dataA['actividad'] = $input['act'][$i];
                $dataA['observaciones'] = $input['obs'][$i];
                EA::creaRegistro($dataA);
                $i++;
            }
            if(isset($input['colaboradores'])){
                foreach ($input['colaboradores'] as $col) {
                    $dataA['id_evento'] = $evt->id;
                    $dataA['id_gabinete'] = $col;
                    EC::creaRegistro($dataA);
                    $i++;
                }
            }

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente el nuevo evento.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el nuevo evento.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('eventos/listado');
    }

    public function show($id) {
        $accion = "Ingreso a la ficha del evento $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $evento = Eventos::find($id);
        $ubic = explode(',',$evento->ubicacion);
        $evento->ubic = str_replace("[","",$ubic[0]).'+'.str_replace("]","",$ubic[1]);
        $acciones = EA::where('id_evento', $evento->id)->get();
        $colaboradores = EC::where('id_evento', $evento->id)->get();
        $siglas = $evento->user()->gabinete()->siglas;
        return view('eventos.ficha', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Ficha de evento']],
            'sTitulo' => 'Eventos',
            'sDescripcion' => 'Ficha de evento',
            'folio' => date('Y-m', strtotime($evento->fecha)) . '-' . $siglas . '-' . str_pad($evento->folio, 3, '0', STR_PAD_LEFT),
            'evento' => $evento,
            'acciones' => $acciones,
            'colaboradores' => $colaboradores,
            'dias' => $dias,
            'meses' => $meses
        ]);
    }

    public function showColaboracion($id) {
        $accion = "Ingreso a la ficha del evento en colaboración $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $evento = Eventos::find($id);
        $ubic = explode(',',$evento->ubicacion);
        $evento->ubic = $ubic[0].'+'.$ubic[1];
        $acciones = EA::where('id_evento', $evento->id)->get();
        $colaboradores = EC::where('id_evento', $evento->id)->get();
        $siglas = $evento->user()->gabinete()->siglas;
        $anexos = ER::where('id_usuario', $evento->id_usuario)->where('id_evento', $id)->get();
        return view('eventos.fichaColaboracion', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Ficha de evento en colaboración']],
            'sTitulo' => 'Eventos en colaboración',
            'sDescripcion' => 'Ficha de evento en colaboración',
            'folio' => date('Y-m', strtotime($evento->fecha)) . '-' . $siglas . '-' . str_pad($evento->folio, 3, '0', STR_PAD_LEFT),
            'evento' => $evento,
            'acciones' => $acciones,
            'anexos' => $anexos,
            'colaboradores' => $colaboradores,
            'dias' => $dias,
            'meses' => $meses
        ]);
    }

    public function showAutorizado($id) {
        $accion = "Ingreso a la ficha del evento autorizado $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $evento = Eventos::find($id);
        $ubic = explode(',',$evento->ubicacion);
        $evento->ubic = $ubic[0].'+'.$ubic[1];
        $acciones = EA::where('id_evento', $evento->id)->get();
        $colaboradores = EC::where('id_evento', $evento->id)->get();
        $siglas = $evento->user()->gabinete()->siglas;
        $imagenes = ER::where('id_usuario', $evento->id_usuario)->where('id_evento', $id)->where('tipo', 1)->get();
        $documentos = ER::where('id_usuario', $evento->id_usuario)->where('id_evento', $id)->where('tipo', 2)->get();
        return view('eventos.fichaAutorizado', [
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

    public function edit($id) {
        $accion = "Ingreso a la edición del evento $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $evento = Eventos::find($id);
        $ubic = explode(',',$evento->ubicacion);
        $evento->ubicacion = '['.$ubic[1].','.$ubic[0].']';
        $acciones = EA::where('id_evento', $evento->id)->get();
        $direcciones = Gabinete::pluck('direccion', 'id');
        $colaboradores = EC::where('id_evento', $id)->pluck('id_gabinete');
        return view('eventos.edit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de evento']],
            'sTitulo' => 'Eventos',
            'sDescripcion' => 'Edición de evento',
            'evento' => $evento,
            'acciones' => $acciones,
            'colaboradores' => $colaboradores,
            'direcciones' => $direcciones
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

    public function eventoPDF($id) {
        $accion = "Generación en PDF del evento $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $evento = Eventos::find($id);
        $acciones = EA::where('id_evento', $evento->id)->get();
        $colaboradores = EC::where('id_evento', $evento->id)->get();
        $siglas = $evento->user()->gabinete()->siglas;
        $folio = date('Y-m', strtotime($evento->fecha)) . '-' . $siglas . '-' . str_pad($evento->folio, 3, '0', STR_PAD_LEFT);
        return PDF::loadView('eventos.pdf', compact('evento', 'acciones', 'dias', 'meses', 'folio', 'colaboradores'))->download("Evento " . date('d-m-Y', strtotime($evento->fecha)) . " Folio $folio.pdf");
    }

    public function eventoEnviar(Request $request) {
        $accion = "Envío del evento ".$request->get('id')." por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $evento = Eventos::find($request->get('id'));
        $evento->estatus = 1;
        $evento->save();
        $e['estatus'] = 'PENDIENTE';
        return $e;
    }

    public function observaciones($id) {
        $accion = "Ingreso a observaciones del evento $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $evt = Eventos::find($id);
        if ($evt->estatus == 1) {
            $evt->estatus = 2;
            $evt->save();
        }
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $evento = Eventos::find($id);
        $acciones = EA::where('id_evento', $evento->id)->get();
        $siglas = $evento->user()->gabinete()->siglas;
        return view('eventos.observaciones', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Ficha de evento']],
            'sTitulo' => 'Eventos',
            'sDescripcion' => 'Ficha de evento',
            'evento' => $evento,
            'folio' => date('Y-m', strtotime($evento->fecha)) . '-' . $siglas . '-' . str_pad($evento->folio, 3, '0', STR_PAD_LEFT),
            'acciones' => $acciones,
            'dias' => $dias,
            'meses' => $meses
        ]);
    }

    public function storeObservaciones(Request $request) {
        $accion = "Guardado de observaciones del evento ".$request->get('id')." por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $input = $request->all();
        $evt = Eventos::find($input['id']);
        $evt->observaciones = $input['observaciones'];
        $evt->estatus = $input['estatus'];
        $evt->save();

        if ($evt) {
            $accion = 'Observaciones del evento: ID ' . $evt->id;
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se han agregado las observaciones exitosamente al evento.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la información.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('eventos/listado');
    }

    public function update(Request $request) {
        $input = $request->all();
        $ubic = explode(',',$input['ubicacion']);
        $input['ubicacion'] = str_replace("]","",$ubic[1]).','.str_replace("[","",$ubic[0]);
        $evt = Eventos::editaRegistro($input);

        if ($evt) {
            $acciones = EA::where('id_evento', $input['id'])->get();
            foreach ($acciones as $acc) {
                $acc->delete();
            }
            $accion = 'Edición evento: ID ' . $input['id'];
            $i = 0;
            foreach ($input['hInicio'] as $hi) {
                $dataA['id_evento'] = $input['id'];
                $dataA['hora_inicio'] = $hi;
                $dataA['hora_fin'] = $input['hFin'][$i];
                $dataA['actividad'] = $input['act'][$i];
                $dataA['observaciones'] = $input['obs'][$i];
                EA::creaRegistro($dataA);
                $i++;
            }
            $cols = EC::where('id_evento', $input['id'])->get();
            foreach ($cols as $col) {
                $col->delete();
            }
            foreach ($input['colaboradores'] as $col) {
                $dataA['id_evento'] = $input['id'];
                $dataA['id_gabinete'] = $col;
                EC::creaRegistro($dataA);
            }

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha editado exitosamente el evento.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido editar el evento.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('eventos/listado');
    }

    public function reporte($id) {
        $accion = "Ingreso a generación de reporte del evento $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $evento = Eventos::find($id);
        $acciones = EA::where('id_evento', $evento->id)->get();
        $siglas = $evento->user()->gabinete()->siglas;
        return view('eventos.reporte', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Ficha de evento']],
            'sTitulo' => 'Eventos',
            'sDescripcion' => 'Ficha de evento',
            'evento' => $evento,
            'folio' => date('Y-m', strtotime($evento->fecha)) . '-' . $siglas . '-' . str_pad($evento->folio, 3, '0', STR_PAD_LEFT),
            'acciones' => $acciones,
            'dias' => $dias,
            'meses' => $meses
        ]);
    }

    public function storeReporte(Request $request) {
        $accion = "Guardado del reporte del evento ".$request->get('id')." por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $input = $request->all();
//        dd($input);
        $evt = Eventos::find($input['id']);
        $evt->reporte = $input['reporte'];
        $evt->fecha_reporte = date('Y-m-d H:i:s');
        $evt->save();
        if (isset($input['archivos'])) {
            $aux = 1;
            foreach ($input['archivos'] as $archivo) {
                $file = $archivo;
                $ext = $file->getClientOriginalExtension();
                $name = substr($file->getClientOriginalName(), 0, 80);
                $input['tipo'] = ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'JPG' || $ext == 'JPEG' || $ext == 'PNG' ) ? 1 : 2;
                $input['anexo'] = $input['id'] . '-' . $aux . '-' . $name;
                $input['id_evento'] = $input['id'];
                $file->move(public_path() . '/anexos/', $input['anexo']);
                $aux++;
                ER::creaRegistro($input);
            }
        }
        if ($evt) {
            $accion = 'Reporte del evento: ID ' . $evt->id;
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha agregado el reporte exitosamente al evento.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la información.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('eventos/listadoAutorizado');
    }

    public function reporteColaboracion($id) {
        $accion = "Ingreso a generación de reporte del evento en colaboración $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $evento = Eventos::find($id);
        $acciones = EA::where('id_evento', $evento->id)->get();
        $siglas = $evento->user()->gabinete()->siglas;
        return view('eventos.reporteColaboracion', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Reporte de evento en colaboración']],
            'sTitulo' => 'Eventos en colaboración',
            'sDescripcion' => 'Reporte de evento en colaboración',
            'evento' => $evento,
            'folio' => date('Y-m', strtotime($evento->fecha)) . '-' . $siglas . '-' . str_pad($evento->folio, 3, '0', STR_PAD_LEFT),
            'acciones' => $acciones,
            'dias' => $dias,
            'meses' => $meses
        ]);
    }

    public function storeReporteColaboracion(Request $request) {
        $accion = "Guardado del reporte del evento ".$request->get('id')." por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $input = $request->all();
        $evt = EC::where('id_evento', $input['id'])->where('id_gabinete', \Auth::User()->id_gabinete)->first();
        $evt->reporte = $input['reporte'];
        $evt->fecha_reporte = date('Y-m-d H:i:s');
        $evt->save();
        if (isset($input['archivos'])) {
            $aux = 1;
            foreach ($input['archivos'] as $archivo) {
                $file = $archivo;
                $ext = $file->getClientOriginalExtension();
                $name = substr($file->getClientOriginalName(), 0, 80);
                $input['tipo'] = ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'JPG' || $ext == 'JPEG' || $ext == 'PNG') ? 1 : 2;
                $input['anexo'] = $input['id'] . '-' . $aux . '-' . $name;
                $input['id_evento'] = $input['id'];
                $file->move(public_path() . '/anexos/', $input['anexo']);
                $aux++;
                ER::creaRegistro($input);
            }
        }
        if ($evt) {
            $accion = 'Reporte del evento: ID ' . $evt->id;
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha agregado el reporte exitosamente al evento.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la información.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('eventosColaboracion/listado');
    }
    
    
    public function calendario(){
        $eventos = ED::get();//dd($eventos);
        foreach ($eventos as $evento){
            $evento->color = Gabinete::find($evento->id_direccion)->color;
        }
        return view('eventos.calendar', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Calendario de eventos']],
            'sTitulo' => 'Eventos Diarios',
            'eventos' => $eventos
        ]);
    }

    public function getEventoDiario(Request $request) {
        $evento = ED::find( $request->get('id') );
        $evento->lugar = Gabinete::where('id', $evento->id_direccion)->value('direccion');        
        return $evento;
    }

}
