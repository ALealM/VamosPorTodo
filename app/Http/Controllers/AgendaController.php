<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\EjesRectores as ER;
use App\Models\Gabinete;
use App\Models\GruposObjetivo as GO;
use App\Models\MediosComunicacion as MC;
use App\Models\InvitadosAgenda as IA;
use App\Models\Riesgos;
use App\Models\Agenda;
use App\Models\InteresadoAgenda as IntAg;
use Illuminate\Support\Facades\Session;
use Redirect;
use Barryvdh\DomPDF\Facade as PDF;

class AgendaController extends Controller {

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
        $accion = "Ingreso al listado de registros para agenda estratégica por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $agendaRegistros = Agenda::get();
        return view('agenda.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Agenda estratégica / Listado']],
            'sTitulo' => 'Agenda Estratégica',
            'sDescripcion' => 'Listado de registros para agenda estratégica',
            'agendaRegistros' => $agendaRegistros,
        ]);
    }

    public function create() {
        $accion = "Creación de nueva agenda estratégica por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $ejes = ER::where('id','<',6)->get();
        $direcciones = Gabinete::where('agenda',1)->orderBy('direccion')->pluck('direccion', 'id');
        $go[1] = GO::where('tipo',1)->get();
        $go[2] = GO::where('tipo',2)->get();
        $go[3] = GO::where('tipo',3)->get();
        $go[4] = GO::where('tipo',4)->get();
        $go[5] = GO::where('tipo',5)->get();
        $go[6] = GO::where('tipo',6)->get();
        $mc[1] = MC::where('tipo',1)->get();
        $mc[2] = MC::where('tipo',2)->get();
        $mc[3] = MC::where('tipo',3)->get();
        $mc[4] = MC::where('tipo',4)->get();
        $mc[5] = MC::where('tipo',5)->get();
        $ia[1] = IA::where('tipo',1)->get();
        $ia[2] = IA::where('tipo',2)->get();
        $riesgos = Riesgos::all();
        $interesados = IntAg::pluck('nombre', 'id');
        return view('agenda.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Agenda Estratégica / Alta']],
            'sTitulo' => 'Agenda Estratégica',
            'sDescripcion' => 'Alta de nueva Agenda Estratégica',
            'ejes' => $ejes,
            'go' => $go,
            'mc' => $mc,
            'ia' => $ia,
            'riesgos' => $riesgos,
            'direcciones' => $direcciones,
            'interesados' => $interesados
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $evt = Agenda::newRegistro($input);
        if ($evt) {
            $accion = 'Creación de nueva agenda: ID ' . $evt->id;
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente la nueva agenda.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la nueva agenda.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('agenda/create');
    }

    public function show($id) {
        $accion = "Ingreso a la ficha de la agenda $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $agenda = Agenda::getRegistroAgenda($id);
        return view('agenda.ficha', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Agenda Estratégica / Ficha']],
            'sTitulo' => 'Agenda Estratégica',
            'sDescripcion' => 'Ficha de agenda estratégica',
            'agenda' => $agenda
        ]);
    }

    public function edit($id) {
        $accion = "Ingreso a la edición de la agenda $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $agenda = Agenda::getAgenda($id);
        $ejes = ER::where('id','<',6)->get();
        $direcciones = Gabinete::where('agenda',1)->orderBy('direccion')->pluck('direccion', 'id');
        $go[1] = GO::where('tipo',1)->get();
        $go[2] = GO::where('tipo',2)->get();
        $go[3] = GO::where('tipo',3)->get();
        $go[4] = GO::where('tipo',4)->get();
        $go[5] = GO::where('tipo',5)->get();
        $go[6] = GO::where('tipo',6)->get();
        $mc[1] = MC::where('tipo',1)->get();
        $mc[2] = MC::where('tipo',2)->get();
        $mc[3] = MC::where('tipo',3)->get();
        $mc[4] = MC::where('tipo',4)->get();
        $mc[5] = MC::where('tipo',5)->get();
        $ia[1] = IA::where('tipo',1)->get();
        $ia[2] = IA::where('tipo',2)->get();
        $riesgos = Riesgos::all();unset($direcciones[1]);
        $interesados = IntAg::pluck('nombre', 'id');
        $direcciones2 = array();
        foreach ($direcciones as $key => $value) {
            if( count($agenda->enfoques->where('tabla_provienen',2)->where('id_enfoque', $key)) > 0){//dd($direcciones,$key,$value);
                $direcciones2[$key] = $value;
                unset($direcciones[$key]);
            }
        }
        return view('agenda.editar', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de evento']],
            'sTitulo' => 'Eventos',
            'sDescripcion' => 'Edición de evento',
            'agenda' => $agenda,
            'ejes' => $ejes,
            'go' => $go,
            'mc' => $mc,
            'ia' => $ia,
            'riesgos' => $riesgos,
            'direcciones' => $direcciones,
            'direcciones2' => $direcciones2,
            'interesados' => $interesados
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

    public function agendaPDF($id) {
        $accion = "Generación en PDF de la agenda $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $agenda = Agenda::getRegistroAgenda($id);
        return PDF::loadView('agenda.pdf', compact('agenda', 'dias', 'meses'))->download("Agenda_" . date('d-m-Y', strtotime($agenda->fecha_alta)) . "_Folio_$agenda->folio.pdf");
    }

    public function update(Request $request) {
        $input = $request->all();//dd($input);

        $evt = Agenda::editaRegistro($input);

        if ($evt) {
            $accion = 'Edición de la agenda: ID ' . $input['id_agenda'];

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha editado exitosamente el registro agendado.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido editar el registro agendado.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('agenda/listado');
    }
}