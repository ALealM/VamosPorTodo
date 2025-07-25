<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CPE;
use App\Models\MetasEG;
use App\Models\Beneficiarios;
use App\Models\Afiliados;
use App\Models\Bitacora;
use App\Models\AccionesGob as AG;
use App\Models\VotosSecciones as VS;


class SeccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($dl=null)
    {
        $dist = ($dl==null) ?0:$dl;
        $dists = ['0'=>'TODOS','2'=>'2','5'=>'5','6'=>'6','7'=>'7','8'=>'8'];
        if($dist==0){
          $secc = VS::where('anio',2018)->whereIn('dl',[2])->get();
          $fallas = AG::select(\DB::raw('falla, count(*) tot'))->where('dl','>',0)->orderBy('tot','desc')->groupBy('falla')->get();
          $colonias = AG::select(\DB::raw('colonia, count(*) tot'))->where('dl','>',0)->orderBy('tot','desc')->groupBy('colonia')->get();
        }
        else{
          $secc = VS::where('anio',2018)->where('dl',$dist)->get();
          $fallas = AG::select(\DB::raw('falla, count(*) tot'))->where('dl',$dist)->orderBy('tot','desc')->groupBy('falla')->get();
          $colonias = AG::select(\DB::raw('colonia, count(*) tot'))->where('dl',$dist)->orderBy('tot','desc')->groupBy('colonia')->get();
        }
        foreach ($secc as $s) {
            $ub = explode(",", $s->ubicacion);
            $arr[] =array("type" => "Feature", "properties" => array("title" => "DL $s->dl\nSección $s->seccion\nLN: ".number_format($s->ln)), "geometry"=> array( "type" => "Point", "coordinates" => $ub ) );
        }
        $coorde=json_encode($arr);

        $acciones = AG::select(\DB::raw('dl, count(*) tot'))->where('dl','>',0)->orderBy('tot','desc')->groupBy('dl')->get();

        return view('secciones.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Acciones']],
            'sTitulo' => 'Acciones finalizadas',
            'sDescripcion' => 'Acciones ciudadanas al 100%',
            'dists' => $dists,
            'dl' => $dl,
            'coorde' => $coorde,
            'acciones' => $acciones,
            'fallas' => $fallas,
            'colonias' => $colonias,
        ]);
        // return view('secciones.index',compact('dists','dl','coorde'));
    }

    public function changeStatus(Request $request)
    {
        ini_set('memory_limit', -1);
    	ini_set('max_execution_time',-1);
        ini_set('proxy_connect_timeout',-1);
        ini_set('proxy_send_timeout',-1);
        ini_set('proxy_read_timeout',-1);
        ini_set('send_timeout',-1);

        $dl = $request->get('dist');
        $gen = $request->get('gen');
        $oc = $request->get('oc');
        $ei = $request->get('ei');
        $ef = $request->get('ef');
        $idS = $request->get('id');
        $reg = VS::find($idS);
        $est = ($reg->estatus==1) ?0:1;
        $reg->estatus = $est;
        $reg->save();

        $ad = ($est==1) ? 'Activación' : 'Desctivación';
        $accion = "$ad de la sección $reg->seccion.";
        Bitacora::creaRegistro($accion);

        $ord = ($ei ==! "" || $ef ==! "" || $oc ==! "" || $gen ==! "") ? "order by tot desc" : "order by vs.votos_ganador desc";
        $ei_ = ($ei ==! "") ? $ei : 0;
        $ef_ = ($ef ==! "") ? $ef : 120;
        $oc_ = ($oc ==! "") ? " AND rg.ocupacion = '$oc' " : '';
        $gen_ = ($gen ==! "") ? " AND rg.genero = '$gen' " : '';

        $query = "select * from votos_secciones vs inner join "
                . "(select rg.id_seccion, count(rg.id)tot from rangos rg where rg.edad between $ei_ and $ef_ $gen_ $oc_ "
                . "group by rg.id_seccion order by tot desc) rgs on rgs.id_seccion = vs.seccion where vs.anio = 2018 and vs.estatus = 0 and vs.dl = $dl $ord";
        $vst = \DB::select( \DB::raw($query) );
        $des = VS::where('dl',$dl)->where('anio',2018)->where('estatus',0)->count();
        $vsa = VS::where('dl',$dl)->where('anio',2018)->where('estatus',1)->orderBy('votos_ganador','desc')->get();
        $act = VS::where('dl',$dl)->where('anio',2018)->where('estatus',1)->count();
        return view('secciones.table_secc',compact('vst','vsa','act','dl','des'));
    }

    public function busqueda(Request $request)
    {
        $dl = $request->get('dist');
        $gen = $request->get('gen');
        $oc = $request->get('oc');
        $ei = $request->get('ei');
        $ef = $request->get('ef');

        $ei_ = ($ei ==! "") ? $ei : 0;
        $ef_ = ($ef ==! "") ? $ef : 120;
        $oc_ = ($oc ==! "") ? " AND rg.ocupacion = '$oc' " : '';
        $gen_ = ($gen ==! "") ? " AND rg.genero = '$gen' " : '';

        $accion = "Filtrado de secciones por Género: $gen, Edad de $ei_ a $ef_ años y Ocupación: $oc.";
        Bitacora::creaRegistro($accion);

        $query = "select * from votos_secciones vs inner join "
                . "(select rg.id_seccion, count(rg.id)tot from rangos rg where rg.edad between $ei_ and $ef_ $gen_ $oc_ "
                . "group by rg.id_seccion order by tot desc) rgs on rgs.id_seccion = vs.seccion where vs.anio = 2018 and vs.estatus = 0 and vs.dl = $dl order by tot desc";
        $vst = \DB::select( \DB::raw($query) );

        $des = VS::where('dl',$dl)->where('anio',2018)->where('estatus',0)->count();
        $vsa = VS::where('dl',$dl)->where('anio',2018)->where('estatus',1)->orderBy('votos_ganador','desc')->get();
        $act = VS::where('dl',$dl)->where('anio',2018)->where('estatus',1)->count();
        return view('secciones.table_secc',compact('vst','vsa','act','dl','des'));
    }

    public function mapaDist(Request $request)
    {
        $dl = $request->get('dist');

        //COORDENADAS PARA DIBUJAR EL DISTRITO LOCAL
        if($dl==0){
          $res['vs'] = VS::where('anio',2018)->select('seccion','base')->get();
          $maps = VS::where('anio',2018)->get();
        }
        else{
          $res['vs'] = VS::where('dl',$dl)->where('anio',2018)->select('seccion','base')->get();
          $maps = VS::where('dl',$dl)->where('anio',2018)->get();
        }
        $res['mapas']=[];
        foreach($maps as $map){
            $seccs=[];
            $arrS = explode(' ', $map->mapa);
            foreach($arrS as $aS){
                $m = explode(',', $aS);
                $seccs[]=$m;
            }
            $res['mapas'][$map->seccion]=$seccs;
        }

        return $res;
    }

    public function mapaSeccAdd(Request $request){
        $s = VS::find($request->get('id'));
//        dd($s);
        $seccs=[];
        $arrS = explode(' ', $s->mapa);
        foreach($arrS as $aS){
            $m = explode(',', $aS);
            $seccs[]=$m;
        }
        $ub = explode(",", $s->ubicacion);
        $res['seccion'] = $s->seccion;
        $res['color'] = $s->color;
        $res['mapa'] = $seccs;
        $res['coords'] = $ub;
        return $res;
    }

    public function sugeridas(){
        if(\Auth::User()->cambio == 0){
            $accion = 'Solicitud de cambio de contraseña.';
            Bitacora::creaRegistro($accion);
            return view('cambio');
        }
        $tipo = \Auth::User()->tipo;
        if($tipo==5 || $tipo==6 ||$tipo==7 ||$tipo==8 ||$tipo==9 ||$tipo==10 ||$tipo==11 ||$tipo==98){
            $accion = "Intento de ingreso al módulo de personas sugeridas.";
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Acceso Denegado!');
            Session::flash('mensaje', "No cuenta con los permisos suficientes para acceder a éste módulo.");
            Session::flash('tipoMsg', 'warning');
            return Redirect::to('/');
        }
        $accion = "ingreso al módulo de personas sugeridas.";
        Bitacora::creaRegistro($accion);
        $dl = VS::where('id',\Auth::User()->seccion)->first()->dl;
        $cpe= CPE::where('dl',$dl)->orderBy('seccion')->get();
        $metas= MetasEG::where('dl',$dl)->orderBy('seccion')->get();
        $beneficiarios= Beneficiarios::where('dl',$dl)->get();
        return view('secciones.sugeridas',compact('cpe','metas','beneficiarios'));
    }

    public function afiliados(){
        if(\Auth::User()->cambio == 0){
            $accion = 'Solicitud de cambio de contraseña.';
            Bitacora::creaRegistro($accion);
            return view('cambio');
        }
        $tipo = \Auth::User()->tipo;
        if($tipo==5 || $tipo==6 ||$tipo==7 ||$tipo==8 ||$tipo==9 ||$tipo==10 ||$tipo==98){
            $accion = "Intento de ingreso al módulo de personas afiliadas.";
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Acceso Denegado!');
            Session::flash('mensaje', "No cuenta con los permisos suficientes para acceder a éste módulo.");
            Session::flash('tipoMsg', 'warning');
            return Redirect::to('/');
        }
        $accion = "ingreso al módulo de personas afiliadas.";
        Bitacora::creaRegistro($accion);
        $dis=[2,5,6,7,8];
        foreach($dis as $d){
            $afiliados[$d]= Afiliados::where('dist_loc',$d)->orderBy('id_seccion')->get();
        }
        return view('secciones.afiliados',compact('afiliados','dis'));
    }

    public function coloniaDatos( Request $request ) {//dd($request->all());
        $datos = AG::where( $request->get('table'), $request->get('data') )->whereNotIn('dl', [0])->where('avance', '>', 99)->orderBy('area')->orderBy('calle')->orderBy('avance','desc')->get();
        $return = '
                <div class="col-md-10 table-responsive" style="min-width: 100%;">
                    <table class="table table-condensed" role="grid" id="'.$request->get('table').'DatosTable">
                        <thead>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Fecha</th>
                            <th>Colonia</th>
                            <th class="text-center">Distrito</th>
                            <th class="text-center">Avance de la Obra</th>
                        </thead>
                        <tbody>
            ';
                            foreach ($datos as $key => $value) {
                                $return .= '
                                    <tr>
                                        <td>' . strval($key+1) . '</td>
                                        <td>' . ( $value->nombre ? $value->nombre . ' ' . $value->ap_paterno . ' ' . $value->ap_materno : 'Sin registro' ) . '</td>
                                        <td>' . $value->telefono . '</td>
                                        <td>' . $value->fecha . '</td>
                                        <td>' . $value->colonia . '</td>
                                        <td class="text-center">' . $value->dl . '</td>
                                        <td class="text-center">' . $value->avance . '%</td>
                                    </tr>
                                ';
                            }
        $return .= '
                        </tbody>
                    </table>
                </div>
        ';
        return $return;
    }
}
