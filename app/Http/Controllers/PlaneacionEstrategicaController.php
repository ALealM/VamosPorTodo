<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Secretarias;
use App\Models\ResponsablesIndicador as RI;
use App\Models\EjesPlanDM as Ejes;
use App\Models\EstrategiasPlanDM as Estrategias;
use App\Models\IndicadoresPlanDM as Indicadores;
use App\Models\UnidadesIndicadores as Unidades;
use App\Models\FrecuenciasIndicadores as Frecuencias;
use Illuminate\Support\Facades\Session;
use Redirect;

class PlaneacionEstrategicaController extends Controller {

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct() {
    $this->middleware('auth');
  }

  public function index() {
    return view('planeacion.index', [//000
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Planeación estratégica']],
      'sTitulo' => 'Planeación estratégica',
      'sDescripcion' => 'Menú de planeación estratégica',
    ]);
  }

  public function mapaEstrategico() {
    return view('planeacion.mapa.index', [//000
      'aBreadCrumb' => [['link' => 'planeacionE', 'label' => 'Planeación estratégica'],['link' => 'active', 'label' => 'Mapra estratégico']],
      'sTitulo' => 'Mapa estratégico',
      'sDescripcion' => 'Mapa desplegado',
    ]);
  }

  public function ejesPlanDMIndex() {
    $ejes = Ejes::all();
    return view('planeacion.ejes.index', [//000
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Planeción Estratégica']],
      'sTitulo' => 'Planeación Estratégica',
      'sDescripcion' => 'Ejes',
      'ejes' => $ejes,
    ]);
  }

  public function ejesPlanDMCreate() {
    return view('planeacion.ejes.create', [
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta nuevo eje']],
      'sTitulo' => 'Planeación Estratégica',
      'sDescripcion' => 'Alta de nuevo eje de desarrollo municipal'
    ]);
  }

  public function ejePlanDMEdit($id) {
        $eje = Ejes::find($id);
        return view('planeacion.ejes.edit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de eje']],
            'sTitulo' => 'Planeación Estratégica',
            'sDescripcion' => 'Edición de eje de plan de desarrollo municipal',
            'eje' => $eje,
        ]);
    }

    public function ejePlanDMUpdate(Request $request) {
        $input = $request->all();
        $ejeAnt = Ejes::find($input['id']);
        $eje = Ejes::editaRegistro($input);

        if ($eje) {
            $ejeN = Ejes::find($input['id']);
            $accion = "Edición de eje del plan de desarrollo municipal '" . $ejeAnt->eje ."' por: ". $ejeN->eje;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha modificado exitosamente el eje del plan de desarrollo municipal '" . $ejeAnt->eje."' por: ". $ejeN->eje);
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar el eje del plan de desarrollo municipal.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('planeacionE/ejes');
    }

  public function ejePlanDMStore(Request $request) {
    $input = $request->all();

    $eje = Ejes::creaRegistro($input);

    if ($eje) {
      $accion = 'Creación de nuevo eje del plan de desarrollo municipal: ' . $eje->eje;

      Bitacora::creaRegistro($accion);
      Session::flash('tituloMsg', 'Guardado exitoso!');
      Session::flash('mensaje', "Se ha creado exitosamente el nuevo eje del plan de desarrollo municipal: $eje->eje.");
      Session::flash('tipoMsg', 'success');
    } else {
      Session::flash('tituloMsg', 'Guardado fallido!');
      Session::flash('mensaje', "No se ha podido guardar el nuevo eje del plan de desarrollo municipal.");
      Session::flash('tipoMsg', 'error');
    }
    return Redirect::to('planeacionE/ejes');
  }

  public function estrategiasIndex() {
    $estrategias = Estrategias::all();
    return view('planeacion.estrategias.index', [//000
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Planeción Estratégica']],
      'sTitulo' => 'Planeación Estratégica',
      'sDescripcion' => 'Estrategias',
      'estrategias' => $estrategias,
    ]);
  }

  public function estrategiaCreate() {
    $ejes = Ejes::pluck('eje','id');
    return view('planeacion.estrategias.create', [
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta nueva estrategia']],
      'sTitulo' => 'Planeación Estratégica',
      'sDescripcion' => 'Alta de nueva estrategia',
      'ejes' => $ejes,
    ]);
  }

  public function estrategiaEdit($id) {
        $ejes = Ejes::pluck('eje', 'id');
        $estrategia = Estrategias::find($id);
        return view('planeacion.estrategias.edit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de estrategia']],
            'sTitulo' => 'Planeación Estratégica',
            'sDescripcion' => 'Edición de Estrategia',
            'ejes' => $ejes,
            'estrategia' => $estrategia,
        ]);
    }

  public function estrategiaStore(Request $request) {
    $input = $request->all();
    $eje = Ejes::find($input['id_eje']);
    $estMax = Estrategias::where('id_eje',$input['id_eje'])->orderBy('id','desc')->first()->numero;
    $input['numero'] = $estMax + 1;
    $est = Estrategias::creaRegistro($input);

    if ($est) {
      $accion = "Creación de nueva estrategia: '" . $est->estrategia ."' en el eje $eje->eje.";

      Bitacora::creaRegistro($accion);
      Session::flash('tituloMsg', 'Guardado exitoso!');
      Session::flash('mensaje', "Se ha creado exitosamente la nueva estrategia: '$est->estrategia' en el eje $eje->eje.");
      Session::flash('tipoMsg', 'success');
    } else {
      Session::flash('tituloMsg', 'Guardado fallido!');
      Session::flash('mensaje', "No se ha podido guardar la nueva estrategia.");
      Session::flash('tipoMsg', 'error');
    }
    return Redirect::to('planeacionE/estrategias');
  }

    public function estrategiaUpdate(Request $request) {
        $input = $request->all();
        $estAnt = Estrategias::find($input['id']);
        $est = Estrategias::editaRegistro($input);

        if ($est) {
            $estN = Estrategias::find($input['id']);
            $accion = "Edición de estrategia '" . $estAnt->estrategia ."' por: ".$estN->estrategia;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha modificado exitosamente la estrategia '" . $estAnt->estrategia ."' por: ".$estN->estrategia);
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la estrategia.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('planeacionE/estrategias');
    }

  public function indicadoresIndex() {
    $indicadores = Indicadores::all()->sortBy('id_estrategia');
    return view('planeacion.indicadores.index', [//000
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Planeción Estratégica']],
      'sTitulo' => 'Planeación Estratégica',
      'sDescripcion' => 'Indicadores',
      'indicadores' => $indicadores,
    ]);
  }

  public function indicadorCreate() {
    $opcionesS = '';
    $ejes = Ejes::select(\DB::raw('id,concat(id,".- ",eje) idEje'))->pluck('idEje','id');
    $unidades = Unidades::pluck('unidad','id');
    $frecuencias = Frecuencias::orderBy('orden')->pluck('frecuencia','id');
    $secrets = Secretarias::pluck('siglas', 'id');
    $i = 1;
    foreach ($secrets as $s) {
      $opcionesS .= "<option value=$i>$s</option>";
      $i++;
    }
    return view('planeacion.indicadores.create', [
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta nuevo indicador']],
      'sTitulo' => 'Planeación Estratégica',
      'sDescripcion' => 'Alta de nuevo indicador',
      'ejes' => $ejes,
      'unidades' => $unidades,
      'frecuencias' => $frecuencias,
      'opcionesS' => $opcionesS,
      'secrets' => $secrets,
    ]);
  }

  public function indicadorStore(Request $request) {
    $input = $request->all();
    $indMax = Indicadores::where('id_estrategia',$input['id_estrategia'])->orderBy('id','desc')->first()->numero;
    $input['numero'] = $indMax + 1;
    $ind = Indicadores::creaRegistro($input);

    if ($ind) {
      $accion = "Creación de nuevo indicador: $ind->indicador.";
      foreach ($input['respon'] as $resp) {
        $dataR['id_indicador'] = $ind->id;
        $dataR['id_responsable'] = $resp;
        RI::creaRegistro($dataR);
      }
      Bitacora::creaRegistro($accion);
      Session::flash('tituloMsg', 'Guardado exitoso!');
      Session::flash('mensaje', "Se ha creado exitosamente el nuevo indicador: $ind->indicador.");
      Session::flash('tipoMsg', 'success');
    } else {
      Session::flash('tituloMsg', 'Guardado fallido!');
      Session::flash('mensaje', "No se ha podido guardar el nuevo indicador.");
      Session::flash('tipoMsg', 'error');
    }
    return Redirect::to('planeacionE/indicadores');
  }

  public function indicadorShow($id) {
    $indicador = Indicadores::find($id);
    $responsables = RI::where('id_indicador',$id)->get();
    //        dd($responsables);
    return view('planeacion.indicadores.ficha', [
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Ficha de indicador']],
      'sTitulo' => 'Indicador',
      'sDescripcion' => 'Ficha de indicador',
      'indicador' => $indicador,
      'responsables' => $responsables
    ]);
  }

    public function indicadorEdit($id) {
        $indicador = Indicadores::find($id);
        $responsables = RI::where('id_indicador', $id)->get();
        $opcionesS = '';
        $ejes = Ejes::select(\DB::raw('id,concat(id,".- ",eje) idEje'))->pluck('idEje', 'id');
        $estrategias = Estrategias::select(\DB::raw('id,concat(id_eje,".",numero," ",estrategia) idNumEst'))->where('id_eje',$indicador->estrategia()->id_eje)->pluck('idNumEst','id');
        $unidades = Unidades::pluck('unidad', 'id');
        $frecuencias = Frecuencias::orderBy('orden')->pluck('frecuencia', 'id');
        $secrets = Secretarias::pluck('siglas', 'id');
        $i = 1;
        foreach ($secrets as $s) {
            $opcionesS .= "<option value=$i>$s</option>";
            $i++;
        }
        return view('planeacion.indicadores.edit', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de Indicador (KPI)']],
            'sTitulo' => 'Planeación Estratégica',
            'sDescripcion' => 'Edición de Indicador (KPI)',
            'ejes' => $ejes,
            'unidades' => $unidades,
            'frecuencias' => $frecuencias,
            'opcionesS' => $opcionesS,
            'secrets' => $secrets,
            'estrategias' => $estrategias,
            'indicador' => $indicador,
            'responsables' => $responsables
        ]);
    }

  public function getEstrategias(Request $request) {
    $eje = $request->get('eje');
    $ests = Estrategias::where('id_eje',$eje)->get();
    return $ests;
  }

}
