<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class FichaIndicadores extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'ficha_indicadores';
    public $timestamps = false;
    protected $fillable = [
        'id_dependencia',
        'id_unidad',
        'id_eje_estrategico',
        'id_eje_transversal',
        'id_programa',
        'id_ods',
        'id_meta',
        'programa_presupuestario',
        'resultado',
        'clave',
        'nombre_indicador',
        'nombre_responsable',
        'id_tipo_indicador',
        'id_dimension_indicador',
        'unidad_medida',
        'linea_base',
        'id_sentido_indicador',
        'formula',
        'descripcion',
        'variable',
        'descripcion_variable',
        'fuentes_info',
        'meta_trimestral1',
        'meta_trimestral2',
        'meta_trimestral3',
        'meta_trimestral4',
        'valor1_semaforo',
        'valor2_semaforo',
        'meta_semaforo',
        'semaforo',
        'glosario',
        'observaciones',
        'nombre_enlace_institucion',
        'cargo_enlace_institucion',
        'nombre_titular',
        'cargo_titular',
        'cuestionario',
        'fecha_alta',
        'id_user',
        'fecha_update',
        'id_user_update',
        'activo',
    ];

    public static function newRegistro($data) {
        $newRegistro = FichaIndicadores::create([
            'id_dependencia' => $data['dependencia'],
            'id_unidad' => @$data['unidad'],
            'id_eje_estrategico' => $data['eje_estrategico'],
            'id_eje_transversal' => $data['eje_transversal'],
            'id_programa' => $data['progEjeEstrat'],
            'id_ods' => $data['objDesarSosten'],
            'id_meta' => $data['meta'],
            'programa_presupuestario' => $data['nombreProgramaPresupuest'],
            'resultado' => $data['resultClave'],
            'clave' => $data['clave'],
            'nombre_indicador' => $data['nombreIndicador'],
            'nombre_responsable' => $data['nameResponsable'],
            'id_tipo_indicador' => $data['indicador2'],
            'id_dimension_indicador' => $data['dimension2'],
            'unidad_medida' => $data['unidad_medida'],
            'linea_base' => $data['lineaBase'],
            'id_sentido_indicador' => $data['sentidoIndicador'],
            'formula' => $data['formula'],
            'descripcion' => $data['descripcion'],
            'variable' => $data['variable'],
            'descripcion_variable' => $data['descVariable'],
            'fuentes_info' => implode(",", $data['fuente_info']),
            'meta_trimestral1' => $data['meta_trimestral0'],
            'meta_trimestral2' => $data['meta_trimestral1'],
            'meta_trimestral3' => $data['meta_trimestral2'],
            'meta_trimestral4' => $data['meta_trimestral3'],
            'valor1_semaforo' => $data['rangeSemaforo'],//explode(";", $data['rangeSemaforo'])[0],
            'valor2_semaforo' => $data['rangeSemaforo2'],
            'meta_semaforo' => $data['metaSemaforo'],
            'semaforo' => $data['semaforoId'],
            'glosario' => @$data['glosario'],
            'observaciones' => @$data['observaciones'],
            'nombre_enlace_institucion' => $data['name_enlaceInst'],
            'cargo_enlace_institucion' => $data['cargo_enlaceInst'],
            'nombre_titular' => $data['name_titularUnitResp'],
            'cargo_titular' => $data['cargo_titularUnitResp'],
            'cuestionario' => implode(",", $data['validacionIndicador']),
            'fecha_alta' => date('Y-m-d H:i:s'),
            'id_user' => \Auth::User()->id,
        ]);

        return $newRegistro;
    }

    public static function editar($data){
        $registro = FichaIndicadores::find( $data['id'] );
        $registro->id_dependencia = $data['dependencia'];
        $registro->id_unidad = @$data['unidad'];
        $registro->id_eje_estrategico = $data['eje_estrategico'];
        $registro->id_eje_transversal = $data['eje_transversal'];
        $registro->id_programa = $data['progEjeEstrat'];
        $registro->id_ods = $data['objDesarSosten'];
        $registro->id_meta = $data['meta'];
        $registro->programa_presupuestario = $data['nombreProgramaPresupuest'];
        $registro->resultado = $data['resultClave'];
        $registro->clave = $data['clave'];
        $registro->nombre_indicador = $data['nombreIndicador'];
        $registro->nombre_responsable = $data['nameResponsable'];
        $registro->id_tipo_indicador = $data['indicador2'];
        $registro->id_dimension_indicador = $data['dimension2'];
        $registro->unidad_medida = $data['unidad_medida'];
        $registro->linea_base = $data['lineaBase'];
        $registro->id_sentido_indicador = $data['sentidoIndicador'];
        $registro->formula = $data['formula'];
        $registro->descripcion = $data['descripcion'];
        $registro->variable = $data['variable'];
        $registro->descripcion_variable = $data['descVariable'];
        $registro->fuentes_info = implode(",", $data['fuente_info']);
        $registro->meta_trimestral1 = $data['meta_trimestral0'];
        $registro->meta_trimestral2 = $data['meta_trimestral1'];
        $registro->meta_trimestral3 = $data['meta_trimestral2'];
        $registro->meta_trimestral4 = $data['meta_trimestral3'];
        $registro->valor1_semaforo = $data['rangeSemaforo'];
        $registro->valor2_semaforo = $data['rangeSemaforo2'];
        $registro->meta_semaforo = $data['metaSemaforo'];
        $registro->semaforo = $data['semaforoId'];
        $registro->glosario = @$data['glosario'];
        $registro->observaciones = @$data['observaciones'];
        $registro->nombre_enlace_institucion = $data['name_enlaceInst'];
        $registro->cargo_enlace_institucion = $data['cargo_enlaceInst'];
        $registro->nombre_titular = $data['name_titularUnitResp'];
        $registro->cargo_titular = $data['cargo_titularUnitResp'];
        $registro->cuestionario = implode(",", $data['validacionIndicador']);
        $registro->fecha_update = date('Y-m-d H:i:s');
        $registro->id_user_update = \Auth::User()->id;
        $registro->save();
        return true;
    }

    public function dependencia() {
        return \DB::table('direcciones')->find( $this->attributes['id_dependencia'] )->direccion;
    }

    public function unidad() {
        return \DB::table('subdirecciones')->find( $this->attributes['id_unidad'] )->subdirecciones;
    }

    public function ejeEstrategico( $columna ) {
        return \DB::table('catalogo_ejes')->find( $this->attributes['id_eje_estrategico'] )->$columna;
    }

    public function ejeTransversal( $columna ) {
        return \DB::table('catalogo_ejetransversal')->find( $this->attributes['id_eje_transversal'] )->$columna;
    }

    public function programa( $columna ) {
        if($columna = 'programa' )
            return \DB::table('programas_ejestransversales')->find( $this->attributes['id_programa'] )->$columna;
        else return \DB::table('plan_eje_estrategico')->find( $this->attributes['id_programa'] )->$columna;
    }

    public function ods( $columna ) {
        return \DB::table('objetivos_desarrollo_sostenible')->find( $this->attributes['id_ods'] )->$columna;
    }

    public function meta() {
        return \DB::table('metas_objetivos_desarrollo')->find( $this->attributes['id_meta'] )->metas_objetivos;
    }

    public function programaPresupuestario() {
        switch ( $this->attributes['programa_presupuestario'] ) {
            case 1:
                return 'Capital Segura con Equidad de Género.';
            case 2:
                return 'Cultura, Turismo, Deporte y Bienestar Social en la Capital.';
            case 3:
                return 'Capital Sostenible.';
            case 4:
                return 'Capital Confiable e Innovadora.';
            case 5:
                return 'Capital Competitiva.';
        }
    }

    public function objProgramaPresupuestario() {
        switch ( $this->attributes['programa_presupuestario'] ) {
            case 1:
                return 'Mantener la seguridad pública en la Capital, reestructurando y capacitando la fuerza operativa, haciendo participe a la ciudadanía, siendo esta última quien pueda percibir la confiabilidad, proactividad y resultados, proteger la integridad física y bienes patrimoniales de las personas a través de operativos coordinados entre los tres órdenes de gobierno. Promover en todo caso la equidad de género y el respeto a los derechos humanos.';
            case 2:
                return 'Ofrecer para la ciudadanía de manera gratuita, universal y con calidad, actividades deportivas, artísticas, culturales, turisticas, de asistencia social en especial para la población más vulnerable, generando condiciones para una correcta participación ciudadana y ayudando a combatir las carencias sociales.';
            case 3:
                return 'Procurar que la población del municipio viva en un medio ambiente adecuado y armónico, con servicios municipales de calidad, promoviendo el desarrollo sustentable y sostenible a través de la concientización entre la población de mantener la ciudad limpia, fomentando y aplicando el uso de energías limpias.';
            case 4:
                return 'Fomentar la educación y el aprendizaje como detonante de innovación y mejora de la calidad de vida de las personas, usando de manera eficiente las tecnologías y medios digitales, dando paso a un gobierno más confiable y con mejores evaluaciones.';
            case 5:
                return 'Fomentar la relación entre los actores empresariales para generar espacios de negocio eficientes, incluyentes, con tecnología de punta y de seguridad, dando preferencia a los empresarios locales, apoyando el crecimiento de las PYMES y fortaleciendo el tejido social y familiar, mejorando también las vialidades e imagen urbana.';
        }
    }

    public function indicador( $columna, $tipo ) {
        if($tipo == 1){
            if( in_array( self::indicador('id', 2), [3, 4] ) )
                return \DB::table('tipo_indicador')->find( 1 )->$columna;
            else
                return \DB::table('tipo_indicador')->find( 2 )->$columna;
        }
        else
            return \DB::table('tipo_indicador')->find( $this->attributes['id_tipo_indicador'] )->$columna;
    }

    public function dimension( $columna, $tipo ) {
        if($tipo == 1){
           return \DB::table('categoria_dimension_indicadores')->find( self::dimension('id_categ_dimension', 2) )->$columna;
        }
        else return \DB::table('dimension_indicadores')->find( $this->attributes['id_dimension_indicador'] )->$columna;
    }

    public function sentidoIndicador( $columna ) {
        if ($columna == 'comportamiento')
            switch ( $this->attributes['id_sentido_indicador'] ) {
                case 1:
                    return '1. Ascendente';
                case 2:
                    return '2. Descendente';
                case 3:
                    return '3. Regular';
                case 4:
                    return '4. Nominal';
            }
        else
            switch ( $this->attributes['id_sentido_indicador'] ) {
                case 1:
                    return '1. Si el resultado a lograr significa INCREMENTAR el valor del indicador.';
                case 2:
                    return '2. Si el resultado a lograr significa DISMINUIR el valor del indicador.';
                case 3:
                    return '3. Si el resultado a lograr significa MANTENER el valor del indicador dentro de determinado rango.';
                case 4:
                    return '4. Se tomará como un resultado INDEPENDIENTE del historial del indicador.';
            }
    }

    public function fuentesInfo() {
        $fuente = array();
        foreach ( explode(",", $this->attributes['fuentes_info'] ) as $f) {
            switch ($f) {
                case '1':
                    array_push($fuente, '1. Documento digital');
                    break;
                case '2':
                    array_push($fuente, '2. Sistema');
                    break;
                case '3':
                    array_push($fuente, '3. Archivo físico');
                    break;
            }
        }
        return $fuente;
    }

    public function semaforo() {
        switch( $this->attributes['semaforo'] ){
            case 3: // verde
                return '#28a745';
            case 2: // naranja
                return '#ffc107';
            case 1: // rojo
                return '#dc3545';
            default:
                return '#ffffff';
        }
    }

    public function variable( $columna ) {
        return \DB::table('')->find( $this->attributes[''] )->$columna;
    }

    public function cuestionario( $index ) {
        if ( is_numeric($index) )
            return str_contains( $this->attributes['cuestionario'], $index );
        else {
            $questions = [
                1 =>'1. El indicador tienen claramente un producto relevante o estratégico con el cual se vincula y un objetivo asociado.',
                2 =>'2. El indicador tiene claramente una meta o referente para ser medido su resultado.',
                3 =>'3. El resultado del indicador explica de forma precisa y clara el grado de cumplimiento de la meta o el resultado es ambiguo.',
                4 =>'4. Muestra o expresa el indicador de forma clara el resultado para poder ser analizado por el responsable.',
                5 =>'5. Se ha definido la frecuencia de medición del indicador.',
                6 =>'6. La unidad de medición es adecuada para la meta que se espera medir.',
                7 =>'7. En la construcción del indicador han participado el enlace institucional y el titular de la unidad responsable.',
                8 =>'8. Los indicadores han sido validados por la unidad responsable del desempeño del área o calidad institucional.'
            ];
            if( $index == 'selected' ){
                $selected = array();
                foreach ( explode(",", $this->attributes['cuestionario'] ) as $value ) {
                    array_push($selected, $questions[$value]);
                }//dd($this->attributes['cuestionario'],$value,$selected);
                return $selected;
            }
            else
                return $questions;
        }
    }
}