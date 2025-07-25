<!-- pdf Ficha de Indicadores-->
<style>
    #header,
    #footer {
        position: fixed;
        left: 0;
        right: 0;
        color: #aaa;
        font-size: 0.9em;
    }

    #header {
        top: 0;
        border-bottom: 0.1pt solid #aaa;
    }

    #footer {
        bottom: 0;
        border-top: 0.1pt solid #aaa;
    }

    .page-number:before {
        content: "Hoja " counter(page);
    }

    @page {
        margin: 50px !important;
        padding: 0px 0px 0px 0px !important;
    }
</style>

<div id="footer">
    <div class="page-number"></div>
</div>

<div style="font-size: 13px;">
    <div class="row pb-15">
        <div class="col-md-8 mr-auto ml-auto" style="padding-top: 5px">
            <table style="width: 100%">
                <tbody>
                    <tr>
                        <td style="width: 450px"><h4>{{date('d')}}/{{ $meses[date('n', strtotime(date('m')*1))-3] }}/{{date('Y')}} V1</h4></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px; background-color: #77a5ee;">
            <h1 style="text-align: center;">FICHA TÉCNICA DE INDICADORES DE DESEMPEÑO</h1>
        </div>
    </div>

    <br>

    <div class="row pb-15">
        <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
            <table class="table-hover" style="width: 100%;">
                <tbody>
                    <tr>
                        <th style="text-align: center; background-color:#ddd;">DEPENDENCIA O ENTIDAD</th>
                        <td style="text-align: center; font-size: larger; font-weight: bold;">{{ $ficha->dependencia() }}</td>
                            @if( @$ficha->id_unidad )
                        <th style="text-align: center; background-color:#ddd;">UNIDAD RESPONSABLE</th>
                        <td style="text-align: center; font-size: larger; font-weight: bold;">{{ $ficha->unidad() }}</td>
                            @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br>

    <div class="row pb-15">
        <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
            <h2 style="text-align: center; font-weight: bold; background-color: #a9c7f4;">{!! __('ALINEACIÓN CON EL PLAN MUNICIPAL DE DESARROLLO 2021-2024 Y SUS PROGRAMAS') !!}</h2><br><br>
            <table class="table-hover" style="width: 100%;">
                <tbody>
                    <tr style="background-color: #c9daf8;">
                        <th rowspan="2"><h5>EJE ESTRATÉGICO</h5></th>
                        <th style="text-align: center;">EJE ESTRÁTEGICO DEL PMD 2021-2024</th>
                        <th></th>
                        <th style="text-align: center;">OBJETIVO DENTRO DEL EJE ESTRATÉGICO AL QUE CONTRIBUYE DEL PLAN</th>
                        <th style="text-align: center;">ESTRATEGIA GENERAL DEL EJE ESTRATÉGICO AL QUE CONTRIBUYE DEL PLAN</th>
                    </tr>
                    <tr>
                        <th style="text-align: center; color: white; background-color: {!! $ficha->ejeEstrategico('color') !!}"> {!! $ficha->ejeEstrategico('id').'. '.$ficha->ejeEstrategico('eje') !!} </th>
                        <td style="width: 5%; text-align: center;"><img src = "{{asset('logos')}}/{{$ficha->ejeEstrategico('logo')}}" style = "width: 100%;"></td>
                        <td style="padding-left: 1em;"> {!! $ficha->ejeEstrategico('objetivo') !!} </td>
                        <td style="padding-left: 1em;"> {!! $ficha->ejeEstrategico('estrategia') !!} </td>
                    </tr>
                    <tr style="height: 2em;"><td colspan="5"><br><br></td></tr>
                    <tr style="background-color: #c9daf8;">
                        <th rowspan="2"><h5>EJE TRANSVERSAL</h5></th>
                        <th style="text-align: center;">EJE TRANSVERSAL DEL PMD 2021-2024</th>
                        <th></th>
                        <th colspan="2" style="text-align: center;">OBJETIVO DENTRO DEL EJE TRANSVERSAL AL QUE CONTRIBUYE DEL PLAN</th>
                    </tr>
                    <tr>
                        <th style="text-align: center; color: white; background-color: {!! $ficha->ejeTransversal('color') !!}">{!! $ficha->ejeTransversal('id').'. '.$ficha->ejeTransversal('eje') !!}</th>
                        <td style="text-align: center;"><img src = "{{asset('logos')}}/{{$ficha->ejeTransversal('logo')}}"></td>
                        <td colspan="2" style="padding-left: 1em;"> {!! $ficha->ejeTransversal('objetivo') !!} </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div style="page-break-after: always"></div>

    <div class="row pb-15">
        <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
            <table class="table-hover" style="width: 100%;">
                <tbody>
                    <tr style="background-color: #c9daf8;">
                        <th rowspan="2"><h5>PROGRAMA</h5></th>
                        <th style="text-align: center;">PROGRAMA DEL EJE ESTRATÉGICO AL QUE CONTRIBUYE DEL PLAN</th>
                        <th colspan="2" style="text-align: center;">OBJETIVO ESPECÍFICO DENTRO DEL PROGRAMA AL QUE CONTRIBUYE DEL PLAN</th>
                        <th colspan="2" style="text-align: center;">ESTRATEGIA ESPECÍFICA DEL PROGRAMA AL QUE CONTRIBUYE DEL PLAN</th>
                    </tr>
                    <tr>
                        <td style="text-align: center;"> {!! $ficha->programa('programa') !!} </td>
                        <td colspan="2" style="padding-left: 1em;"> {!! $ficha->programa('objetivo') !!} </td>
                        <td colspan="2" style="padding-left: 1em;"> {!! $ficha->programa('estrategia') !!} </td>
                    </tr>
                    <tr style="height: 2em;"><td colspan="5"><br><br></td></tr>
                    <tr style="background-color: #c9daf8;">
                        <th rowspan="2"><h5>OBJETIVO DE DESARROLLO SOSTENIBLE</h5></th>
                        <th style="text-align: center;">OBJETIVO DE DESARROLLO SOSTENIBLE DE MAYOR IMPACTO</th>
                        <th style="text-align: center;">ODS</th>
                        <th style="text-align: center;">DESCRIPCIÓN DEL OBJETIVO DE DESARROLLO SOSTENIBLE</th>
                        <th colspan="2" style="text-align: center;">META RELEVANTE PARA GOBIERNOS LOCALES</th>
                    </tr>
                    <tr>
                        <td style="padding-left: 2em;"> {!! $ficha->ods('id').'. '.$ficha->ods('descripcion') !!} </td>
                        <td style="width: 15%; text-align: center;"> <img src = "{{asset('logos')}}/{{$ficha->ods('logo')}}" style = "width: 100%"> </td>
                        <td style="padding-left: 1em;"> {!! $ficha->ods('descripcion_larga') !!} </td>
                        <td colspan="2" style="padding-left: 1em;"> {!! $ficha->meta() !!} </td>
                    </tr>
                    <tr style="height: 2em;"><td colspan="5"><br><br></td></tr>
                    <tr style="background-color: #c9daf8;">
                        <th rowspan="3"><h5>PROGRAMA PRESUPUESTARIO</h5></th>
                        <th style="text-align: center;">NOMBRE DEL PROGRAMA PRESUPUESTARIO</th>
                        <th colspan="2" style="text-align: center;">OBJETIVO DEL PROGRAMA PRESUPUESTARIO</th>
                        <th colspan="2" style="text-align: center;">RESULTADO CLAVE</th>
                    </tr>
                    <tr>
                        <td rowspan="2" style="padding-left: 1em;"> {!! $ficha->programaPresupuestario() !!} </td>
                        <td colspan="2" rowspan="2" style="padding-left: 0.5em; padding-right: 0.5em;"> {!! $ficha->objProgramaPresupuestario() !!} </td>
                        <td colspan="2" style="padding-left: 1em;"> {!! $ficha->resultado !!} </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-left: 0.5em; background-color: #d9e3f5; text-indent: 0.5em;">
                            El resultado que debe ocurrir para considerar que el objetivo del programa se ha alcanzado de manera satisfactoria.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div style="page-break-after: always"></div>
    
    <div class="row pb-15">
        <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
            <h2 style="text-align: center; background-color: #a9c7f4;">{!! __('DATOS DE IDENTIFICACIÓN DEL INDICADOR') !!}</h2><br><br>
            <table class="table-hover" style="width: 100%;">
                <tbody>
                    <tr style="background-color: #c9daf8;">
                        <th colspan="2" style="text-align: center;">CLAVE</th>
                        <th colspan="4" style="text-align: center;">NOMBRE DEL INDICADOR</th>
                        <th style="text-align: center; text-transform: uppercase;">Fecha de elaboración de la ficha</th>
                        <th style="text-align: center;">NOMBRE DEL RESPONSABLE DE LLENADO</th>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-left: 1em;">
                            La forma alfanumérica determinada para el Presupuesto de Egresos, apartado de indicadores, del ejercicio que corresponda.
                        </td>
                        <td colspan="4" style="padding-left: 1em;">
                            Enunciado breve con el cual se denomina el algoritmo empleado para evaluar el cumplimiento de un resultado clave, pudiendo ser este un índice, tasa, razón o proporción.
                        </td>
                        <td style="text-transform: uppercase; text-align: center;">{{ $dias[date('w', strtotime( $ficha->fecha_alta ))] }} {{ date('j', strtotime($ficha->fecha_alta)) }} de {{ $meses[date('n', strtotime($ficha->fecha_alta))-1] }} del {{ date('Y', strtotime($ficha->fecha_alta)) }}</td>
                        <td style="text-align: center;"> {!! $ficha->nombre_responsable !!} </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;"> {!! $ficha->clave !!} </td>
                        <td colspan="4" style="padding-left: 1em;"> {!! $ficha->nombre_indicador !!} </td>
                        <th style="background-color: #c9daf8;"> Firma </th>
                        <td style="border: #000000 solid thin; min-height: 5em; height: 5em;"></td>
                    </tr>
                    <tr style="height: 2em;"><td colspan="5"><br><br></td></tr>
                    <tr style="background-color: #c9daf8;">
                        <th style="text-align: center; text-transform: uppercase;">Tipo de Indicador</th>
                        <th style="text-align: center; text-transform: uppercase;">Descripción del tipo de indicador</th>
                        <th style="text-align: center; text-transform: uppercase;">Dimensión</th>
                        <th colspan="3" style="text-align: center; text-transform: uppercase;">Descripción de la dimensión </th>
                        <th colspan="2" style="text-align: center; text-transform: uppercase;">Unidad de Medida</th>
                    </tr>
                    <tr>
                        <td style="text-align: center;"> {!! $ficha->indicador('id', 1).'. '.$ficha->indicador('tipo_indicador', 1) !!} </td>
                        <td style="padding-left: 1em;"> {!! $ficha->indicador('descripcion', 1) !!} </td>
                        <td style="text-align: center;"> {!! $ficha->dimension('id', 1).'. '.$ficha->dimension('categoria', 1) !!} </td>
                        <td colspan="3" style="padding-left: 1em;"> {!! $ficha->dimension('descripcion', 1) !!} </td>
                        <td colspan="2" style="padding-left: 1em;">
                            La forma en que se expresa el resultado de la aplicación del indicador.
                            <div class="listgroup-example2">
                                <ul class="list-style-disc">
                                    <li> En las proporciones e índices de variación proporcional la unidad de medida siempre es porcentaje. </li>
                                    <li> En las razones y las tasas, la unidad de medida del numerador suele ser la misma que la que se expresa el indicador. </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"> {!! $ficha->indicador('tipo_indicador', 2) !!} </td>
                        <td style="padding-left: 1em;"> {!! $ficha->indicador('descripcion', 2) !!} </td>
                        <td style="text-align: center;"> {!! $ficha->dimension('dimension', 2) !!} </td>
                        <td colspan="3" style="padding-left: 1em;"> {!! $ficha->dimension('descripcion', 2) !!} </td>
                        <td colspan="2" style="text-align: center; padding-left: 1em;"> {!! $ficha->unidad_medida !!} </td>
                    </tr>
                    <tr style="height: 2em;"><td colspan="5"><br><br></td></tr>
                    <tr style="background-color: #c9daf8;">
                        <th colspan="2" style="text-align: center; text-transform: uppercase;">Frecuencia de evaluación </th>
                        <th colspan="4" style="text-align: center; text-transform: uppercase;">Calendarización de evaluación del Indicador </th>
                        <th colspan="2" style="text-align: center; text-transform: uppercase;">Línea Base</th>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-left: 1em; background-color: #d9e3f5;">
                            Es el periodo de tiempo en el cual se calcula el indicador. <br> Con fines de estandarización, la evaluación de los indicadores será TRIMESTRAL.
                        </td>
                        <td style="text-align: center; background-color: #d9e3f5;"> Ene-Mar </td>
                        <td style="text-align: center; background-color: #d9e3f5;"> Abr-Jun </td>
                        <td style="text-align: center; background-color: #d9e3f5;"> Jul-Sep </td>
                        <td style="text-align: center; background-color: #d9e3f5;"> Oct-Dic </td>
                        <th rowspan="2" style="text-align: center; background-color: #cbd8f0;">2021</th>
                        <td rowspan="2" style="padding-left: 1em;"> {!! $ficha->linea_base !!} </td>
                    </tr>
                    <tr style="background-color: #cbd8f0;">
                        <td colspan="2" style="text-align: center;">Trimestral</td>
                        <td style="text-align: center;"> Reporte del 1 al 10 de abril </td>
                        <td style="text-align: center;"> Reporte del 1 al 10 de julio </td>
                        <td style="text-align: center;"> Reporte del 1 al 10 de octubre </td>
                        <td style="text-align: center;"> Reporte del 1 al 10 de enero </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div style="page-break-after: always"></div>

    <div class="row pb-15">
        <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
            <table class="table-hover" style="width: 100%;">
                <tbody>
                        <tr style="background-color: #c9daf8;">
                            <th colspan="2" style="text-align: center; text-transform: uppercase;">Sentido del Indicador </th>
                            <th colspan="2" style="text-align: center; text-transform: uppercase;">Fórmula </th>
                            <th style="text-align: center; text-transform: uppercase;">Descripción</th>
                        </tr>
                        <tr style="background-color: #d9e3f5;">
                            <td colspan="2" style="padding-left: 1em;">Establece si el indicador tiene un comportamiento ascendente, descendente, regular o niminal a lo largo del tiempo.</td>
                            <td colspan="2" style="padding-left: 1em;">
                                La relación cuantitativa del indicador, expresada a través de una ecuación que involucra el uso de dos o más variables. <br> Es el método de cálculo del indicador.
                            </td>
                            <td style="padding-left: 1em;">
                                Breve explicación de lo que representa el resultado obtenido de la aplicación de la fórmula del indicador. Debe especificar lo que se espera medir del objetivo al que está asociado, debe ayudar a entender la utilidad o uso del indicador.
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;"> {!! $ficha->sentidoIndicador('comportamiento') !!} </td>
                            <td style="padding-left: 1em;"> {!! $ficha->sentidoIndicador('descripcion') !!} </td>
                            <td colspan="2" style="text-align: center;"> {!! $ficha->formula !!} </td>
                            <td style="padding-left: 1em;"> {!! $ficha->descripcion !!} </td>
                        </tr>
                        <tr style="height: 2em;"><td colspan="5"><br><br></td></tr>
                        <tr style="background-color: #c9daf8;">
                            <th colspan="2" style="text-align: center; text-transform: uppercase;">Nombre de la variable </th>
                            <th colspan="2" style="text-align: center; text-transform: uppercase;">Descripción de la variable </th>
                            <th style="text-align: center; text-transform: uppercase;">Fuente de información </th>
                        </tr>
                        <tr style="background-color: #d9e3f5;">
                            <td colspan="2" style="padding-left: 1em;">El factor o elemento que interviene en la fórmula del indicador.</td>
                            <td colspan="2" style="padding-left: 1em;">
                                Explicación del elemento que interviene en la fórmula del indicador, lo que entendemos y acotamos al escribir esa variable.
                            </td>
                            <td style="padding-left: 1em;">
                                El origen de donde se alimentarán las variables del indicador. Deberán ser siempre las mismas, lo que nos permitirá hacer comparaciones del indicador en el tiempo.
                            </td>
                        </tr>
                    @foreach( $ficha->fuentesInfo() as $fuente )
                        <tr>
                            @if( $loop->first )
                                <td colspan="2" rowspan="{!! count($ficha->fuentesInfo()) !!}" style="padding-left: 1em; text-align: center;"> {!! $ficha->variable !!} </td>
                                <td colspan="2" rowspan="{!! count($ficha->fuentesInfo()) !!}" style="padding-left: 1em;"> {!! $ficha->descripcion_variable !!} </td>
                            @endif
                                <td style="padding-left: 3em;"> {!! $fuente !!} </td>
                        </tr>
                    @endforeach
                        <tr style="height: 2em;"><td colspan="5"><br><br></td></tr>
                        <tr style="background-color: #c9daf8;">
                            <th colspan="2" style="text-align: center; text-transform: uppercase;">Meta Trimestral del Indicador </th>
                            <th colspan="2" style="text-align: center; text-transform: uppercase;">Rango de Semaforización </th>
                            <th style="text-align: center; text-transform: uppercase;">Semaforización</th>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td style="padding-left: 1em; background-color: #d9e3f5;">
                                <b style="padding-left: 2em;">Límite Inferior</b> <br>
                                Es el valor mínimo aceptable que puede tener el indicador.
                            </td>
                            <td style="padding-left: 1em; background-color: #d9e3f5;">
                                <b style="padding-left: 2em;">Límite Superior</b> <br> Es el valor máximo aceptable que puede tener el indicador.
                            </td>
                            <td style="padding-left: 1em; background-color: #d9e3f5;">
                                Si el valor del indicador se encuentra dentro del rango de aceptación, se pondrá VERDE, sel valor alcanzado del indicador es menor o mayor que la meta programada pero se mantiene dentro del rango establecio estará en AMARILLO, en caso de que esté muy lejos de los límites se pondrá en ROJO.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left: 1em;"> {!! $ficha->meta_trimestral1 !!} </td>
                            <td colspan="2"></td>
                            <td rowspan="4" style="padding-left: 35%;">
                                <div class="rojo" style="width: 30px; height: 30px; border: 1px solid black; margin: 1em; border-radius: 50%; background: @if( $ficha->semaforo == 1) #dc3545; @else #ffebeb; @endif"></div>
                                <div class="amarillo" style="width: 30px; height: 30px; border: 1px solid black; margin: 1em; border-radius: 50%; background: @if( $ficha->semaforo == 2) #ffc107; @else #fffaeb; @endif"></div>
                                <div class="verde" style="width: 30px; height: 30px; border: 1px solid black; margin: 1em; border-radius: 50%; background: @if( $ficha->semaforo == 3) #28a745; @else #f5fff7; @endif"></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left: 1em;"> {!! $ficha->meta_trimestral2 !!} </td>
                            <th style="padding-left: 1em; text-align: center;"> Valor 1 </th>
                            <td style="padding-left: 1em; text-align: center;"> {!! $ficha->valor1_semaforo !!} </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left: 1em;"> {!! $ficha->meta_trimestral3 !!} </td>
                            <th style="padding-left: 1em; text-align: center;"> Valor 2 </th>
                            <td style="padding-left: 1em; text-align: center;"> {!! $ficha->valor2_semaforo !!} </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left: 1em;"> {!! $ficha->meta_trimestral4 !!} </td>
                            <th style="padding-left: 1em; text-align: center;"> Meta </th>
                            <td style="padding-left: 1em; text-align: center;"> {!! $ficha->meta_semaforo !!} </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div style="page-break-after: always"></div><!-- Salto de página -->

    <div class="row pb-15">
        <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
            <h2 style="text-align: center; background-color: #a9c7f4;">{!! __('GLOSARIO') !!}</h2>
            <table class="table-hover" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="padding-left: 3em;"> {!! $ficha->glosario !!} </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br><br>

    <div class="row pb-15">
        <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
            <h2 style="text-align: center; background-color: #a9c7f4;">{!! __('OBSERVACIONES') !!}</h2>
            <table class="table-hover" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="padding-left: 3em;"> {!! $ficha->observaciones !!} </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br><br>

    <div class="row pb-15">
        <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
            <h2 style="text-align: center; background-color: #a9c7f4;">{!! __('RESPONSABLES DE LA INFORMACIÓN') !!}</h2>
            <table class="table-hover" style="width: 100%;">
                <thead>
                    <tr style="background-color: #c9daf8;">
                        <th style="text-align: center; text-transform: uppercase;">Nombre del enlace institucional </th>
                        <th style="text-align: center; text-transform: uppercase;">Cargo del enlace institucional </th>
                        <th style="text-align: center; text-transform: uppercase;">Firma del enlace institucional </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding-left: 1em;"> {!! $ficha->nombre_enlace_institucion !!} </td>
                        <td style="padding-left: 1em;"> {!! $ficha->cargo_enlace_institucion !!} </td>
                        <td style="border: #000000 solid thin; min-height: 5em; height: 5em;"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br>

    <div class="row pb-15">
        <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
            <table class="table-hover" style="width: 100%;">
                <thead>
                    <tr style="background-color: #c9daf8;">
                        <th style="text-align: center; text-transform: uppercase;">Nombre del titular de la unidad responsable </th>
                        <th style="text-align: center; text-transform: uppercase;">Cargo del titular de la unidad responsable </th>
                        <th style="text-align: center; text-transform: uppercase;">Firma del titular de la unidad responsable </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding-left: 1em;"> {!! $ficha->nombre_titular !!} </td>
                        <td style="padding-left: 1em;"> {!! $ficha->cargo_titular !!} </td>
                        <td style="border: #000000 solid thin; min-height: 5em; height: 5em;"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br>

    <div class="row pb-15">
        <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
            <h4 style="text-align: center; background-color: #a9c7f4;">{!! __('CUESTIONARIO DE VALIDACIÓN DEL INDICADOR') !!}</h4>
            <table class="table-hover" style="width: 100%;">
                <tbody>
                        <tr>
                            <td></td>
                            <td style="background-color: #c9daf8; padding-left: 1em;">
                                Para revisar que el indicador cumpla con todos los elementos requeridos, verifique que cumpla con las siguientes condiciones:
                            </td>
                            <td></td>
                        </tr>
                    @foreach( $ficha->cuestionario('selected') as $sentence )
                        <tr>
                            <td style="width: 33%;"></td>
                            <td style="padding-left: 1em;"> {!! $sentence !!} </td>
                            <td style="width: 33%;"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>