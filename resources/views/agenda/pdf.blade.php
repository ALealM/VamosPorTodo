<link rel="stylesheet" type="text/css" href="">

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

    h4, table > tr > th { text-transform: uppercase; }
    h4, .h4 { font-family: fantasy; }/*sans-serif*/
</style>

<div id="footer">
    <div class="page-number"></div>
</div>

<!--<div id="watermark">
    <img src="{{asset('img/esq1.png')}}" height="100%" width="100%" style=" opacity: 0.5"/>
</div>-->

<div style="font-size: 13px; padding-left: 3em; padding-right: 3em; padding-bottom: 2em;">
    <div class="row pb-15">
        <div class="mr-auto ml-auto" style="padding-top: 10px; text-align: center;">
            <table style="width: 100%">
                <tbody>
                    <tr>
                        <td style="width: 450px"><h4>{{date('d')}}/{{ $meses[date('n', strtotime(date('m')*1))-1] }}/{{date('Y')}}</h4></td>
                        <td style="text-align: right"><h4>FOLIO: {{$agenda->folio}}</h4></td>
                    </tr>
                    <tr>
                        <td>
                            Registrado el {{ $dias[date('w', strtotime($agenda->fecha_alta))] }} {{ date('j', strtotime($agenda->fecha_alta)) }} de {{ $meses[date('n', strtotime($agenda->fecha_alta))-1] }} de {{ date('Y', strtotime($agenda->fecha_alta)) }}
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            Evento <h4 style="text-align: center">{!! str_replace("\n", "<br>", $agenda->titulo_evento) !!}</h4>
            <table class="table-hover" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="text-align: center">META</th>
                        <th style="text-align: center">SOLUCIÓN</th>
                        <th style="text-align: center">EJES</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding-left: 1em; text-transform: capitalize; background-color: #f9f0d6; text-align:center;">{!! $agenda->meta !!}</td>
                        <td style="padding-left: 1em; text-transform: capitalize; background-color: #f9f0d6; text-align: center;">{!! str_replace("\n", "<br>", $agenda->solucion) !!}</td>
                        <td style="padding-left: 1.5em; text-transform: capitalize; background-color:#ddd;">
                            @foreach($agenda->ejes as $eje)
                                {{$eje->eje}} <br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-8 mr-auto ml-auto" style="padding-top: 15px; text-align: center;">
            <table class="table-borderless table-condensed" style="width: 100%;">
                <tbody>
                    <tr><th style="text-align: center; color: #002a80" colspan="2"><h4>Ejes estratégicos y enfoque de la agenda</h4></th></tr>
                    <tr><th></th><th class="tx-15" style="text-align: left;">Conceptos:</th></tr>
                    <tr><td></td><td>A continuación se presenta una breve explicación de cada uno de los ejes:</td></tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr><th colspan="2" style="text-align:center;"><label class="main-content-label" style="color: #002a80; margin-top: 1.2rem; margin-bottom: 1rem !important;"> Sí San Luis Seguro: </label></th></tr>
                    <tr>
                        <td style=" width: 125px"><img src="{{asset('/img/ejes')}}/seguro.png" alt="" width="100"></td>
                        <td class="tdDesign">
                            Fortalecer el tejido social, recuperar las calles y espacios públicos de la delincuencia,
                            crear la Secretaría de Seguridad Ciudadana a través de la implementación del nuevo
                            modelo homologado de justicia cívica, buen gobierno y cultura de la legalidad.
                        </td>
                    </tr>
                    <tr><th colspan="2" style="text-align:center;"><label class="main-content-label" style="color: #002a80; margin-top: 1.2rem; margin-bottom: 1rem !important;"> Sí San Luis con Bienestar: </label></th></tr>
                    <tr>
                        <td><img src="{{asset('/img/ejes')}}/bienestar.png" alt="Sí San Luis con Bienestar" width="100"></td>
                        <td class="tdDesign" style="text-align: justify;">
                            Generar las condiciones para satisfacer conjuntamente una serie de factores que responden a la calidad de vida de las personas. El bienestar social se expresa a través de los niveles de salud, educación, vivienda, bienes de consumo, desarrollo urbano, seguridad y en todos los aspectos relacionados con el medio ambiente
                        </td>
                    </tr>
                    <tr><th colspan="2" style="text-align:center;"><label class="main-content-label" style="color: #002a80; margin-top: 1.2rem; margin-bottom: 1rem !important;"> Sí San Luis Sostenible: </label></th></tr>
                    <tr>
                        <td><img src="{{asset('/img/ejes')}}/sostenible.png" alt="Sí San Luis Sostenible" width="100"></td>
                        <td class="tdDesign" style="text-align: justify;">
                            Adoptar el enfoque de la Agenda 2030 y sus directrices en materia de desarrollo sostenible de manera integral en las atribuciones del H. Ayuntamiento para combatir la desigualdad, generar una sociedad pacífica e inclusiva, proteger la vida y los ecosistemas naturales y abordar de manera urgente los efectos del cambio climático.
                            En otras palabras, el desarrollo sostenible es aquel capaz de satisfacer las necesidades del presente sin comprometer la capacidad de las futuras generaciones para satisfacer sus propias necesidades tanto en el ámbito social, ambiental y económico.
                        </td>
                    </tr>
                    <tr><th colspan="2" style="text-align:center; padding-top: 1em;"><label class="main-content-label" style="color: #002a80; margin-top: 1.2rem;">Sí San Luis Innovador: </label></th></tr>
                    <tr>
                        <td><img src="{{asset('/img/ejes')}}/innovador.png" alt="Sí San Luis Innovador" width="100"></td>
                        <td class="tdDesign" style="text-align: justify;">
                            Promover la conectividad entre la ciudadanía, su gobierno y los actores políticos, públicos y privados, para la mejor toma de decisiones, gestión ágil y eficiente de trámites para elevar el nivel de calidad de vida con un uso responsable, productivo y transparente de las tecnologías de la información y comunicación.
                        </td>
                    </tr>
                    <tr><th colspan="2" style="text-align:center;"><label class="main-content-label" style="color: #002a80; margin-top: 1.2rem; margin-bottom: 1rem !important;">Sí San Luis Competitivo: </label></th></tr>
                    <tr><td><img src="{{asset('/img/ejes')}}/competitivo.png" alt="Sí San Luis Competitivo" width="100"></td>
                        <td class="tdDesign" style="text-align: justify;">
                            Un San Luis de oportunidades equitativas con acciones enfocadas a lograr un municipio competitivo que genere más empleos y mejores ingresos a través de alianzas con los sectores productivos, así como la creación del Instituto Municipal del Emprendimiento.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @if( @$agenda->gabinetes )
            <div class="row">
                <div class="col-8 mr-auto ml-auto" style="padding-top: 15px">
                    <h4 style="text-align: center">Direcciones que intervienen</h4>
                    <table class="table table-hover table-bordered" style="width: 100%; text-align: center">
                        <tbody>
                            @foreach($agenda->gabinetes as $gab)
                                <tr style="{{ ( $loop->index % 2 == 1 ) ? '' : 'background-color:#ddd' }}">
                                    <td style="text-transform: capitalize;"> {{ $gab['gabinete'] }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-8 mr-auto ml-auto" style="padding-top: 15px; text-align: center;">
                <h4 style="text-align: center">Grupo Objetivo</h4>
                <table class="table table-hover table-bordered" style="width: 90%; text-align: center">
                    <tbody>
                        <tr>
                            <th style="text-align: center">
                                <h6 class="tx-semibold" style="margin-bottom: 0px; color: #073656; font-size: 14px;">EDADES</h6>
                                <span style="color: #999999 !important; font-size: 12px;">Toma de decisión de los padres</span>
                            </th>
                            <th style="text-align: center">
                                <h6 class="tx-semibold" style="margin-bottom: 0px; color: #073656; font-size: 14px;">EDADES</h6>
                                <span style="color: #999999 !important; font-size: 12px;">Toma de decisión propia</span>
                            </th>
                            <th style="text-align: center">
                                <h6 class="tx-semibold" style="margin-bottom: 0px; color: #073656; font-size: 14px;"> NSE </h6>
                                <span style="font-size: 12px;"> &nbsp; </span>
                            </th>
                        </tr>
                        <tr>
                            <td> &nbsp;
                                @foreach($agenda->grupObjet as $go)
                                    @if($go->tipo == 3)
                                        {{ $go->nombre == 'Otro' ? $go->otro : $go->nombre }} <br>
                                    @endif
                                @endforeach
                            </td>
                            <td> &nbsp;
                                @foreach($agenda->grupObjet as $go)
                                    @if($go->tipo == 1)
                                        {{ $go->nombre == 'Otro' ? $go->otro : $go->nombre }} <br>
                                    @endif
                                @endforeach
                            </td>
                            <td> &nbsp;
                                @foreach($agenda->grupObjet as $go)
                                    @if($go->tipo == 2)
                                        {{ $go->nombre == 'Otro' ? $go->otro : $go->nombre }} <br>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-hover table-bordered" style="width: 90%; text-align: center">
                    <tbody>
                        <tr>
                            <th style="text-align: center">
                                <h6 class="tx-semibold" style="margin-bottom: 0px; color: #073656; font-size: 14px;">GÉNERO</h6>
                            </th>
                            <th style="text-align: center">
                                <h6 class="tx-semibold" style="margin-bottom: 0px; color: #073656; font-size: 14px;">GRUPO OBJETIVO</h6>
                            </th>
                            <th style="text-align: center">
                                <h6 class="tx-semibold" style="margin-bottom: 0px; color: #073656; font-size: 14px;">NIVEL DE EDUCACIÓN</h6>
                            </th>
                        </tr>
                        <tr>
                            <td> &nbsp;
                                @foreach($agenda->grupObjet as $go)
                                    @if($go->tipo == 5)
                                        {{ $go->nombre == 'Otro' ? $go->otro : $go->nombre }} <br>
                                    @endif
                                @endforeach
                            </td>
                            <td> &nbsp;
                                @foreach($agenda->grupObjet as $go)
                                        @if($go->tipo == 6)
                                            {{ $go->nombre == 'Otro' ? $go->otro : $go->nombre }} <br>
                                        @endif
                                    @endforeach
                            </td>
                            <td> &nbsp;
                                @foreach($agenda->grupObjet as $go)
                                    @if($go->tipo == 4)
                                        {{ $go->nombre == 'Otro' ? $go->otro : $go->nombre }} <br>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mr-auto ml-auto" style="padding-top: 15px; text-align: center;">
                <h4 style="text-align: center">Medios de comunicación externos</h4>
                <table class="table table-hover table-bordered" style="width: 100%; text-align: center">
                    <tbody>
                        <tr>
                            <th>
                                <h6 class="tx-semibold" style="margin-bottom: 0px; color: #073656; font-size: 14px;">DIGITAL</h6>
                            </th>
                            <th>
                                <h6 class="tx-semibold" style="margin-bottom: 0px; color: #073656; font-size: 14px;">PRESENCIAL</h6>
                            </th>
                            <th>
                                <h6 class="tx-semibold" style="margin-bottom: 0px; color: #073656; font-size: 14px;">TRADICIONALES</h6>
                            </th>
                            <th>
                                <h6 class="tx-semibold" style="margin-bottom: 0px; color: #073656; font-size: 14px;">OTROS</h6>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                @foreach($agenda->medCom as $mc)
                                    @if($mc->tipo == 1)
                                        {{ $mc->medio }} <br>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($agenda->medCom as $mc)
                                    @if($mc->tipo == 2)
                                        {{ $mc->medio }} <br>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($agenda->medCom as $mc)
                                    @if($mc->tipo == 3)
                                        {{ $mc->medio }} <br>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($agenda->medCom as $mc)
                                    @if($mc->tipo == 4)
                                        {{ $mc->otro }}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mr-auto ml-auto" style="padding-top: 15px">
                <h4 style="text-align: center">Medios de comunicación internos</h4>
                <table class="table table-hover table-bordered" style="width: 100%; text-align: center">
                    <tbody>
                        @foreach($agenda->medCom as $mc)
                            @if($mc->tipo == 6)
                                <tr style="{{ ( $loop->index % 2 == 0 ) ? '' : 'background-color:#ddd' }}">
                                    <td> {{ $mc->medio == 'Otros' ? $go->otro : $go->medio }} </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mr-auto ml-auto" style="padding-top: 15px">
                <h4 style="text-align: center">Datos Generales del Evento</h4>
                <table class="table table-hover table-bordered" style="width: 100%;">
                    <tbody>
                            <tr>
                                <th style="text-align: left; width: 40%;"> TÍTULO </th>
                                <td style="text-transform: uppercase; text-align: left;"> {!! $agenda->titulo_evento !!} </td>
                            </tr>
                            <tr>
                                <th style="text-align: left; width: 40%;"> CONTENIDO DE LA PRESENTACIÓN </th>
                                <td style="text-transform: uppercase; text-align: left; background-color: #f9f0d6"> {!! $agenda->contenido_presentacion !!} </td>
                            </tr>
                        @if( sizeof($agenda->invitados) > 0 )
                            <tr style="margin-bottom: 2px; margin-top: 3px;">
                                <th style="text-align: center;" colspan="2"> INVITADOS </th>
                            </tr>
                            <tr>
                                <td style="text-transform: uppercase; text-align: center;" colspan="2">
                                    @foreach($agenda->invitados as $invitados)
                                        {{ $invitados->invitado }} <br>
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mr-auto ml-auto" style="padding-top: 15px">
                <h4 style="text-align: center"> Matriz de riesgos </h4>
                <table class="table-bordered table-condensed table-hover" style="width: 100%; text-indent: 2em; border-top-style: hidden;">
                    <thead>
                        <tr style="text-align: center; border-right-style: hidden; border-left-style: hidden;">
                            <th></th>
                            <th colspan="3" class="tx-15" style="border-right-style: hidden; border-left-style: hidden;">Cumple</th>
                            <th></th>
                        </tr>
                        <tr style="text-align: center" class="tx-15">
                            <th style="border-left-style: hidden; border-top-style: hidden;">Criterios</th>
                            <th style=" background-color: #00cc00">Alto</th>
                            <th style=" background-color: #ffcc33">Medio</th>
                            <th style=" background-color: #ff9900">Bajo</th>
                            <th style=" background-color: #fff4d3">Plan de acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agenda->riesgos->where('tipo_matriz', 1) as $riesgo)
                            <tr>
                                <td style="text-transform: uppercase; border: 1px solid #e8e8f7;">{{$riesgo->riesgo}}</td>
                                <td style="text-align:center; border: 1px solid #e8e8f7;">
                                    @if($riesgo->cumple == 1 )
                                        <b style="color: #5cb85c; font-size: 20px; font-weight: bold;">x</b>
                                    @endif
                                </td>
                                <td style="text-align:center; border: 1px solid #e8e8f7;">
                                    @if($riesgo->cumple == 2 )
                                        <b style="color: #f0ad4e; font-size: 20px; font-weight: bold;">x</b>
                                    @endif
                                </td>
                                <td style="text-align:center; border: 1px solid #e8e8f7;">
                                    @if($riesgo->cumple == 3 )
                                        <b style="color: #d9534f; font-size: 20px; font-weight: bold;">x</b>
                                    @endif
                                </td>
                                <td style="text-transform: capitalize; border: 1px solid #e8e8f7;">{{$riesgo->plan_accion}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mr-auto ml-auto" style="padding-top: 15px">
                <h4 style="text-align: center"> Matriz de mitigación de riesgos </h4>
                <table class="table-bordered table-condensed table-hover" style="width: 100%; text-indent: 2em; border-top-style: hidden;">
                    <thead>
                        <tr style="text-align: center; border-right-style: hidden; border-left-style: hidden;">
                            <th></th>
                            <th colspan="3" style="border-right-style: hidden; border-left-style: hidden;">Cumple</th>
                            <th></th>
                        </tr>
                        <tr style="text-align: center">
                            <th style="border-left-style: hidden; border-top-style: hidden;">Criterios</th>
                            <th style=" background-color: #00cc00">Alto</th>
                            <th style=" background-color: #ffcc33">Medio</th>
                            <th style=" background-color: #ff9900">Bajo</th>
                            <th style=" background-color: #fff4d3">Plan de acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agenda->riesgos->where('tipo_matriz', 2) as $riesgo)
                            <tr>
                                <td style="text-transform: uppercase; border: 1px solid #e8e8f7;">{{$riesgo->riesgo}}</td>
                                <td style="text-align:center; border: 1px solid #e8e8f7;">
                                    @if($riesgo->cumple == 1 )
                                        <b style="color: #5cb85c; font-size: 20px; font-weight: bold;">x</b>
                                    @endif
                                </td>
                                <td style="text-align:center; border: 1px solid #e8e8f7;">
                                    @if($riesgo->cumple == 2 )
                                        <b style="color: #f0ad4e; font-size: 20px; font-weight: bold;">x</b>
                                    @endif
                                </td>
                                <td style="text-align:center; border: 1px solid #e8e8f7;">
                                    @if($riesgo->cumple == 3)
                                        <b style="color: #d9534f; font-size: 20px; font-weight: bold;">x</b>
                                    @endif
                                </td>
                                <td style="text-transform: capitalize; border: 1px solid #e8e8f7;">{{$riesgo->plan_accion}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mr-auto ml-auto" style="padding-top: 15px">
                <h4 style="text-align: center"> Gestión de los Interesados </h4>
                <div class="row row-sm">
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <th style="text-align: center; max-height: 1em;">
                                    <div style="background-color: rgb(199, 195, 184); color: #617875; font-weight: bold; writing-mode: vertical-lr; transform: rotate(270deg); font-size: 2em; width: 60%;"> ALTO </div>
                                </th>
                                <td style="background-color: rgb(233, 218, 180); padding-left: 1em;" colspan="2">
                                    <div>
                                        <h5 class="tx-medium" style="color: #9d7d28; font-size:13px; margin-bottom: 0;  margin-top: 0;">Latentes</h5>
                                        <p style="color: #9d7d28; padding-left: 2em; margin-bottom: 0; margin-top: 0;">Informar</p>
                                    </div>
                                </td>
                                <td style="background-color: rgb(233, 181, 182); padding-left: 1em;" colspan="2">
                                    <div>
                                        <h5 class="tx-medium" style="color: #d16668; font-size:13px; margin-bottom: 0;  margin-top: 0;">Promotores</h5>
                                        <p style="color: #d16668; padding-left: 2em; margin-bottom: 0; margin-top: 0;">Involucrar</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td style="background-color: rgb(233, 218, 180); padding-left: 1em;">
                                    <p>
                                        @foreach($agenda->interesados->where('poder','alto')->where('interes','alto')->where('tipo', 1) as $interesado)
                                            {{$interesado->depto}} <br>
                                        @endforeach
                                    </p>
                                </td>
                                <td style="background-color: rgb(233, 218, 180); padding-right: 1em; text-align: right;">
                                    <p>
                                        @foreach($agenda->interesados->where('poder','alto')->where('interes','alto')->where('tipo', 0) as $interesado)
                                            {{$interesado->depto}} <br>
                                        @endforeach
                                    </p>
                                </td>
                                <td style="background-color: rgb(233, 181, 182); padding-left: 1em;">
                                    <p>
                                        @foreach($agenda->interesados->where('poder','alto')->where('interes','bajo')->where('tipo',1) as $interesado)
                                            {{$interesado->depto}} <br>
                                        @endforeach
                                    </p>
                                </td>
                                <td style="background-color: rgb(233, 181, 182); padding-righ: 1em; text-align: right;">
                                    <p>
                                        @foreach($agenda->interesados->where('poder','alto')->where('interes','bajo')->where('tipo',0) as $interesado)
                                            {{$interesado->depto}} <br>
                                        @endforeach
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <th style="text-align: center;">
                                    <div style="text-align: center;"> <h4 style="font-weight: bold; writing-mode: vertical-rl; transform: rotate(270deg); font-size: 1em;"> PODER </h4> </div>
                                </th>
                                <td style="border-left: rgb(233, 218, 180) solid 3px; border-bottom: rgb(233, 218, 180) solid 3px; text-align: center;">
                                    <b style="color: #5cb85c; font-size: 25px; font-weight: bold; color: #19b159 !important;"> + </b>
                                </td>
                                <td style="border-right: rgb(233, 218, 180) solid 3px; border-bottom: rgb(233, 218, 180) solid 3px; text-align: center;">
                                    <b style="color: #f16d75; font-size: 25px; font-weight: bold; color: #f16d75 !important;"> - </b>
                                </td>
                                <td style="border-left: rgb(233, 181, 182) solid 3px; border-bottom: rgb(233, 181, 182) solid 3px; text-align: center;">
                                    <b style="color: #5cb85c; font-size: 25px; font-weight: bold; color: #19b159 !important;"> + </b>
                                </td>
                                <td style="border-right: rgb(233, 181, 182) solid 3px; border-bottom: rgb(233, 181, 182) solid 3px; text-align: center;">
                                    <b style="color: #f16d75; font-size: 25px; font-weight: bold; color: #f16d75 !important;"> - </b>
                                </td>
                            </tr>
                            <tr><th></th><td colspan="4"></td></tr>
                            <tr>
                                <th></th>
                                <td style="background-color: rgb(155, 226, 227); padding-left: 1em;" colspan="2">
                                    <div>
                                        <h5 class="tx-medium" style="color: #49a0a2; font-size:13px; margin-bottom: 0; margin-top: 0;">Apáticos</h5>
                                        <p style="color: #49a0a2; padding-left: 2em; margin-bottom: 0; margin-bottom: 0; margin-top: 0;">Monitorizar</p>
                                    </div>
                                </td>
                                <td style="background-color: rgb(216, 198, 241); padding-left: 1em;" colspan="2">
                                    <div>
                                        <h5 class="tx-medium" style="color: #9780b7; font-size:13px; margin-bottom: 0; margin-top: 0;">Defensores</h5>
                                        <p style="color: #9780b7; padding-left: 2em; margin-bottom: 0; margin-bottom: 0; margin-top: 0;">Reportar</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td style="background-color: rgb(155, 226, 227); padding-left: 1em;">
                                    <p>
                                        @foreach($agenda->interesados->where('poder','bajo')->where('interes','alto')->where('tipo',1) as $interesado)
                                            {{$interesado->depto}} <br>
                                        @endforeach
                                    </p>
                                </td>
                                <td style="background-color: rgb(155, 226, 227); padding-right: 1em; text-align: right;">
                                    <p>
                                        @foreach($agenda->interesados->where('poder','bajo')->where('interes','alto')->where('tipo',0) as $interesado)
                                            {{$interesado->depto}} <br>
                                        @endforeach
                                    </p>
                                </td>
                                <td style="background-color: rgb(216, 198, 241); padding-left: 1em;">
                                    <p>
                                        @foreach($agenda->interesados->where('poder','bajo')->where('interes','bajo')->where('tipo',1) as $interesado)
                                            {{$interesado->depto}} <br>
                                        @endforeach
                                    </p>
                                </td>
                                <td style="background-color: rgb(216, 198, 241); padding-righ: 1em; text-align: right;">
                                    <p>
                                        @foreach($agenda->interesados->where('poder','bajo')->where('interes','bajo')->where('tipo',0) as $interesado)
                                            {{$interesado->depto}} <br>
                                        @endforeach
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <th style="text-align: center;">
                                    <div style="background-color: rgb(199, 195, 184); color: #617875; font-weight: bold; writing-mode: vertical-lr; transform: rotate(270deg); font-size: 2em; width: 50%;"> BAJO </div>
                                </th>
                                <td style="border-left: rgb(155, 226, 227) solid 3px; border-bottom: rgb(155, 226, 227) solid 3px; text-align: center;">
                                    <b style="color: #5cb85c; font-size: 25px; font-weight: bold; color: #19b159 !important;"> + </b>
                                </td>
                                <td style="border-right: rgb(155, 226, 227) solid 3px; border-bottom: rgb(155, 226, 227) solid 3px; text-align: center;">
                                    <b style="color: #f16d75; font-size: 25px; font-weight: bold; color: #f16d75 !important;"> - </b>
                                </td>
                                <td style="border-left: rgb(216, 198, 241) solid 3px; border-bottom: rgb(216, 198, 241) solid 3px; text-align: center;">
                                    <b style="color: #5cb85c; font-size: 25px; font-weight: bold; color: #19b159 !important;"> + </b>
                                </td>
                                <td style="border-right: rgb(216, 198, 241) solid 3px; border-bottom: rgb(216, 198, 241) solid 3px; text-align: center;">
                                    <b style="color: #f16d75; font-size: 25px; font-weight: bold; color: #f16d75 !important;"> - </b>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <div style="background-color: rgb(199, 195, 184); color: #617875; font-weight: bold; font-size: 20px; width: 50%;"> ALTO </div>
                                </td>
                                <td style="text-align: center;" colspan="2">
                                    <h4 style="font-weight: bold; writing-mode: vertical-rl; font-size: 1em;"> INTERÉS </h4>
                                </td>
                                <td style="text-align: right;">
                                    <div style="background-color: rgb(199, 195, 184); color: #617875; font-weight: bold; font-size: 20px; width: 50%;"> BAJO </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
</div>
