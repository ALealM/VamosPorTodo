<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\FichaIndicadores as FI;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use Redirect;

class FichaIndicadoresController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $fichas = FI::where('activo', 1)->get();
        return view('ficha_indicadores.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de Fichas de Indicadores de Desempeño']],
            'sTitulo' => 'Fichas de Indicadores de Desempeño',
            'sDescripcion' => 'Listado de fichas',
            'fichas' => $fichas
        ]);
    }


    public function create() {
        $dependencias = \DB::table('direcciones')->pluck(\DB::raw('CONCAT(id, ". ", direccion) as direccion'),'id');
        $ejesEstrategicos = \DB::table('catalogo_ejes')->pluck(\DB::raw('CONCAT(id, ". ", eje) as eje'),'id');
        $ejesTransversales = \DB::table('catalogo_ejetransversal')->pluck(\DB::raw('CONCAT(id, ". ", eje) as eje'),'id');

        $ejesTransvPrograma = \DB::table('programas_ejestransversales')->where('id_ejetransversal',1)->pluck(\DB::raw('CONCAT(id, ". ", programa) as programa'),'id');

        $objDesarrolloSostenible = \DB::table('objetivos_desarrollo_sostenible')->where('objetivo','>',0)->pluck(\DB::raw('CONCAT(objetivo, ". ", descripcion) as descripcion'),'objetivo');

        $tipoIndicador = \DB::table('tipo_indicador')->whereIn('id', [1,2])->pluck(\DB::raw('CONCAT(id, ". ", tipo_indicador) as tipo_indicador'), 'id');
        $dimension = \DB::table('categoria_dimension_indicadores')->pluck(\DB::raw('CONCAT(id, ". ", categoria) as categoria'),'id');

        return view(
            'ficha_indicadores.create',
            [
                'aBreadCrumb' => [['link' => 'active', 'label' => 'Nuevo indicador']],
                'sTitulo' => 'Indicadores de Desempeño',
                'sDescripcion' => 'Ficha de Indicador de Desempeño'
            ],
            compact('dependencias', 'ejesEstrategicos', 'ejesTransversales', 'objDesarrolloSostenible', 'tipoIndicador', 'dimension')
        );
    }

    public function store(Request $request) {
        $input = $request->all();
        switch( $input['semaforo'] ){
            case '#28a745': // verde
                $input['semaforoId'] = 3;
                break;
            case '#ffc107': // naranja
                $input['semaforoId'] = 2;
                break;
            default: // rojo
                $input['semaforoId'] = 1;
                break;
        }
        $newRegister = FI::newRegistro($input);
        if ($newRegister) {
            $accion = 'Creación de nueva ficha indicadores de desempeño: ' . $newRegister->id;
            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Operación exitosa!');
            Session::flash('mensaje', "Se ha creado exitosamente la nueva ficha.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', '‚¡Ha ocurrido un error!');
            Session::flash('mensaje', "No se ha podido guardar la nueva ficha.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('indexFichaIndicadores');
    }

    public function edit($id) {
        $ficha = FI::find($id);//$ficha->cuestionario('selected');
        $dependencias = \DB::table('direcciones')->pluck(\DB::raw('CONCAT(id, ". ", direccion) as direccion'),'id');
        $unidades = \DB::table('subdirecciones')->where('id_direccion', $ficha->id_dependencia)->pluck('subdirecciones','id');
        $ejesEstrategicos = \DB::table('catalogo_ejes')->pluck(\DB::raw('CONCAT(id, ". ", eje) as eje'),'id');
        $ejesTransversales = \DB::table('catalogo_ejetransversal')->pluck(\DB::raw('CONCAT(id, ". ", eje) as eje'),'id');
        $programas = \DB::table('programas_ejestransversales')->where('id_ejetransversal', $ficha->id_eje_estrategico)->pluck('programa','id');
        $objDesarrolloSostenible = \DB::table('objetivos_desarrollo_sostenible')->where('objetivo','>',0)->pluck(\DB::raw('CONCAT(objetivo, ". ", descripcion) as descripcion'),'objetivo');
        $metas = \DB::table('metas_objetivos_desarrollo')->where('id_objetivo', $ficha->id_ods)->pluck('metas_objetivos','id');
        $indicadores = \DB::table('tipo_indicador')->whereIn('id', [1,2])->pluck(\DB::raw('CONCAT(id, ". ", tipo_indicador) as tipo_indicador'), 'id');
        $indicadores2 = \DB::table('tipo_indicador')->whereIn('id', $ficha->indicador('id', 1) == 1 ? [3, 4] : [5, 6] )->pluck(\DB::raw('tipo_indicador'), 'id');
        $dimension = \DB::table('categoria_dimension_indicadores')->pluck(\DB::raw('CONCAT(id, ". ", categoria) as categoria'),'id');
        
        $dimension2 = \DB::table('dimension_indicadores')->where('id_categ_dimension', $ficha->dimension('id_categ_dimension', 2))->pluck('dimension','id');
//dd($ficha,$ficha->id_eje_transversal,$programas,$ficha->programa('estrategia'));
        return view('ficha_indicadores.edit', [
                'aBreadCrumb' => [['link' => 'active', 'label' => 'Edición de ficha de indicadores']],
                'sTitulo' => 'Indicadores',
                'sDescripcion' => 'Listado de indicadores',
            ],
            compact('ficha', 'dependencias', 'unidades', 'ejesEstrategicos', 'ejesTransversales', 'programas', 'objDesarrolloSostenible', 'metas', 'indicadores', 'indicadores2', 'dimension', 'dimension2')
        );
    }

    public function update(Request $request) {
        $input = $request->all();
        switch( $input['semaforo'] ){
            case '#28a745': // verde
                $input['semaforoId'] = 3;
                break;
            case '#ffc107': // naranja
                $input['semaforoId'] = 2;
                break;
            default: // rojo
                $input['semaforoId'] = 1;
                break;
        }
        $edicion = FI::editar($input);
        if( $edicion ){
            $accion = 'Ficha modificada con ID '.$input['id'];
            Session::flash('tituloMsg', 'Edición exitosa!');
            Session::flash('mensaje', "Se ha modificado exitosamente la ficha.");
            Session::flash('tipoMsg', 'success');
        } else {
            $accion = 'La edición de la ficha: con ID '.$input['id'].' no se pudó realizar';            
            Session::flash('tituloMsg', 'Error en la edición!');
            Session::flash('mensaje', "No se ha podido modificar la ficha.");
            Session::flash('tipoMsg', 'error');
        }
        Bitacora::creaRegistro($accion);
        return Redirect::to('indexFichaIndicadores');
    }
    
    public function delete($id) {
        $ficha = FI::find($id);
        $ficha->activo = 2;
        $del = $ficha->save();
        if( $del ){
            $accion = 'Ficha con ID '.$id.' eliminada exitosamente.';            
            Session::flash('tituloMsg', 'Eliminación exitosa!');
            Session::flash('mensaje', "Se ha borrado exitosamente la ficha.");
            Session::flash('tipoMsg', 'success');
        } else {
            $accion = 'La eliminación de la ficha con ID '.$id.' no se pudó realizar';            
            Session::flash('tituloMsg', 'Borrado fallido!');
            Session::flash('mensaje', "No se ha podido eliminar la ficha.");
            Session::flash('tipoMsg', 'error');
        }
        Bitacora::creaRegistro($accion);
        return Redirect::to('indexFichaIndicadores');
    }

    public function getInfo(Request $request){
        $input = $request->all();
        switch($input['name']) {
            case 'dependencia':
                    $subdirecciones = \DB::table('subdirecciones')->where('id_direccion', $input['id'])->pluck('subdirecciones','id');
                    $options = "";
                    foreach ($subdirecciones as $key => $value) {
                        $options .= '<option value = "'.$key.'">'.$value.'</option>';
                    }
                    return ['unidadDiv',( $options == "" ? '' :
                        '<select id="unidad" class="form-control" required name="unidad"> <option selected value>Seleccionar...</option>'.$options.'</select> <i class="form-group__bar"></i>'
                    )];
                break;
            case 'eje_estrategico':
                    $data = \DB::table('catalogo_ejes')->where('id', $input['id'])->first();
                    $options = "";
                    $progEjeEstrat = \DB::table('programas_ejestransversales')->where('id_ejetransversal', $input['id'])->pluck('programa','id');
                    foreach ($progEjeEstrat as $key => $value) {
                        $options .= '<option value = "'.$key.'">'.$value.'</option>';
                    }
                    return [
                        'eje_estrategicoImg', '<img src = "/logos'.$data->logo.'" style = "height: 100%;">',
                        'objetivoEjeEstrategico', $data->objetivo,
                        'estrategiaEjeEstrategico', $data->estrategia,
                        'progEjeEstratDiv', ( $options == "" ? '' :
                            '<select class="form-control" required onchange="changeInfo(this)" name="progEjeEstrat"> <option selected value>Seleccionar...</option>'.$options.'</select> <i class="form-group__bar"></i>'),
                        'objetivoEspecificoProgram', '',
                        'estratEspecificaProgram', ''
                    ];
                break;
            case 'eje_transversal':
                    $data = \DB::table('catalogo_ejetransversal')->where('id', $input['id'])->first();
                    return [
                        'eje_transvImg', '<img src = "/logos'.$data->logo.'" style = "height: 60%;">',
                        'objetivoEjeTransversal', $data->objetivo
                    ];
                break;
            case 'progEjeEstrat':
                    $data = \DB::table('plan_eje_estrategico')->where('id', $input['id'])->first();
                    return [
                        'objetivoEspecificoProgram', $data->objetivo,
                        'estratEspecificaProgram', $data->estrategia
                    ];
                break;
            case 'objDesarSosten':
                    $data = \DB::table('objetivos_desarrollo_sostenible')->where('id', $input['id'])->first();
                    $options = "";
                    $metas = \DB::table('metas_objetivos_desarrollo')->where('id_objetivo', $input['id'])->pluck('metas_objetivos','id');
                    foreach ($metas as $key => $value) {
                        $options .= '<option value = "'.$key.'">'.$value.'</option>';
                    }
                    return [
                        'odsImg', '<img src = "/logos'.$data->logo.'" style = "height: 60%;">',
                        'odsText', $data->descripcion_larga,
                        'metaDiv', ( $options == "" ? '' :
                            '<select class="form-control" required name="meta" style="white-space: pre-line; height: fit-content;"> <option selected value>Seleccionar...</option>'.$options.'</select> <i class="form-group__bar"></i>')
                    ];
                break;
            case 'indicador':
                    $data = \DB::table('tipo_indicador')->where('id', $input['id'])->first();
                    $data = $data->id.'. '.$data->descripcion;
                    $options = "";
                    if ( $input['id'] == 1 ) $id_in = [3, 4];
                    if ( $input['id'] == 2 ) $id_in = [5, 6];
                    $indicadores = \DB::table('tipo_indicador')->whereIn('id', $id_in )->pluck('tipo_indicador','id');
                    foreach ($indicadores as $key => $value) {
                        $options .= '<option value = "'.$key.'">'.$value.'</option>';
                    }
                    return [
                        'indicadorText', $data,
                        'indicador2Div', ( $options == "" ? '' :
                            '<select class="form-control" required onchange="changeInfo(this)" name="indicador2" style = "width: 85%"> <option selected value>Seleccionar...</option>'.$options.'</select> <i class="form-group__bar"></i>'),
                        'indicador2Text', ''
                    ];
                break;
            case 'indicador2':
                    $data = \DB::table('tipo_indicador')->where('id', $input['id'])->first()->descripcion;
                    return [ 'indicador2Text', $data ];
                break;
            case 'dimension':
                    $data = \DB::table('categoria_dimension_indicadores')->where('id', $input['id'])->first()->descripcion;
                    $options = "";
                    $newSelect = \DB::table('dimension_indicadores')->where('id_categ_dimension', $input['id'])->pluck('dimension','id');
                    foreach ($newSelect as $key => $value) {
                        $options .= '<option value = "'.$key.'">'.$value.'</option>';
                    }
                    return [
                        'dimensionText', $data,
                        'dimension2Div', ( $options == "" ? '' :
                            '<select class="form-control" required onchange="changeInfo(this)" name="dimension2" style = "width: 85%"> <option selected value>Seleccionar...</option>'.$options.'</select> <i class="form-group__bar"></i>'),
                        'dimension2Text', ''
                    ];
                break;
            case 'dimension2':
                    $data = \DB::table('dimension_indicadores')->where('id', $input['id'])->first()->descripcion;
                    return [ 'dimension2Text', $data ];
                break;
            case 'sentidoIndicador':
                    switch( $input['id'] ){
                        case 1:
                                $data = '1. Si el resultado a lograr significa INCREMENTAR el valor del indicador.';
                            break;
                        case 2:
                                $data = '2. Si el resultado a lograr significa DISMINUIR el valor del indicador.';
                            break;
                        case 3:
                                $data = '3. Si el resultado a lograr significa MANTENER el valor del indicador dentro de determinado rango.';
                            break;
                        case 4:
                                $data = '4. Se tomará como un resultado INDEPENDIENTE del historial del indicador.';
                            break;
                    }
                    return [ 'sentidoIndicadorText', $data ];
                break;
            case 'nombreProgramaPresupuest':
                    switch( $input['id'] ){
                        case 1: // Capital Segura con Equidad de Género
                                $data = 'Mantener la seguridad pública en la Capital, reestructurando y capacitando la fuerza operativa, haciendo participe a la ciudadanía, siendo esta última quien pueda percibir la confiabilidad, proactividad y resultados, proteger la integridad física y bienes patrimoniales de las personas a través de operativos coordinados entre los tres órdenes de gobierno. Promover en todo caso la equidad de género y el respeto a los derechos humanos.';
                            break;
                        case 2: // Cultura, Turismo, Deporte y Bienestar Social en la Capital
                                $data = 'Ofrecer para la ciudadanía de manera gratuita, universal y con calidad, actividades deportivas, artísticas, culturales, turisticas, de asistencia social en especial para la población más vulnerable, generando condiciones para una correcta participación ciudadana y ayudando a combatir las carencias sociales.';
                            break;
                        case 3: // Capital Sostenible
                                $data = 'Procurar que la población del municipio viva en un medio ambiente adecuado y armónico, con servicios municipales de calidad, promoviendo el desarrollo sustentable y sostenible a través de la concientización entre la población de mantener la ciudad limpia, fomentando y aplicando el uso de energías limpias.';
                            break;
                        case 4: // Capital Confiable e Innovadora
                                $data = 'Fomentar la educación y el aprendizaje como detonante de innovación y mejora de la calidad de vida de las personas, usando de manera eficiente las tecnologías y medios digitales, dando paso a un gobierno más confiable y con mejores evaluaciones.';
                            break;
                        case 5: // Capital Competitiva
                                $data = 'Fomentar la relación entre los actores empresariales para generar espacios de negocio eficientes, incluyentes, con tecnología de punta y de seguridad, dando preferencia a los empresarios locales, apoyando el crecimiento de las PYMES y fortaleciendo el tejido social y familiar, mejorando también las vialidades e imagen urbana.';
                            break;
                    }
                    return [ 'objProgramaPresupuest', $data ];
                break;
        }
    }

    public function pdf($id) {
        $accion = "Generación en PDF de la ficha de indicadores $id por " . \Auth::User()->id;
        Bitacora::creaRegistro($accion);
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $ficha = FI::find($id);
        
        return PDF::loadView('ficha_indicadores.pdf', compact('ficha', 'meses', 'dias'))->download("FichaIndicadores_" . date('d-m-Y', strtotime($ficha->fecha_alta)) . $ficha->id.".pdf");
    }
}