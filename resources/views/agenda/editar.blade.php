@extends('layouts.app')
@section('title', 'Main page')
@section('content')

    {!! Html::style('css/awesome-bootstrap-checkbox.css') !!}

    <style>
        .form-control {
            display: block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .footer-widget {
            width: 100%;
            height: 100%;
        }

        .hrDesign{
            background-image: linear-gradient(90deg, gray, transparent);
            border: 0;
            height: 1px;
        }

        .tdDesign{
            text-align: justify;
            padding: 1em;
            text-shadow: 1px 1px 1px #c7c8cd;
            background: -webkit-gradient( linear, left bottom, left top, color-stop(0.02, rgb(207 215 201)), color-stop(0.51, rgb(237 241 233)), color-stop(0.87, rgb(245 245 245)) );
            -webkit-border-top-left-radius: 2em;
            -webkit-border-top-right-radius: 2em;
            border-bottom-left-radius: 2em;
            border-bottom-right-radius: 2em;
        }

        .parsley-checkbox{
            margin-top: 5px;
        }

        #tablaAcciones :hover {
          background-color: #01b8ff;
        }

        #tablaAcciones :hover select{
          background-color: #ffffff;
        }

        #tablaAcciones select{
            color: #a8afc7;
        }

        #tablaAcciones :hover th{
            color: #ffffff;
        }

        .abajo:before {
            content: "";
            position: absolute;
            top: -25px;
            left: 0;
            width: 0;
            height: 0;
            border-width: 0 25px 25px;
            border-style: solid;
            border-color: transparent transparent rgba(204,200,188,1);
        }

        .vertical {
            width: 50px;
            height: 100px;
            background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgb(199 195 184) 100%);
            position: relative;
            margin:50px auto;
            color: #617875;
            font-weight: bold;
            float: right;
            writing-mode: vertical-lr;
            transform: rotate(180deg);
            padding-left: inherit;
            font-size: 20px;
        }

        .horizontal {
            width: 35%;
            height: 50px;
            background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgb(199 195 184) 100%);
            position: relative;
            margin:0px auto;
            color: #617875;
            font-weight: bold;
            padding-top: 10px;
            font-size: 20px;
        }

        .derecha:before {
            content: "";
            position: absolute;
            top: 0;
            left: 100%;
            width: 0;
            height: 0;
            border-width: 25px;
            border-style: solid;
            border-color:  transparent transparent transparent rgba(204,200,188,1);
        }

        .izquierda:before {
            content: "";
            position: absolute;
            top: 0px;
            left: -50px;
            width: 0;
            height: 0;
            border-width: 25px;
            border-style: solid;
            border-color: transparent rgba(204,200,188,1) transparent transparent;
        }

        .arriba:before {
            content: "";
            position: absolute;
            bottom: -25px;
            left: 0;
            width: 0;
            height: 0;
            border-width: 25px 25px 0;
            border-style: solid;
            border-color: rgba(204,200,188,1) transparent transparent;
        }

        .table-bordered thead{
            background: transparent;
        }

        .table-bordered thead th{
            border-top-width: 1px;
            padding-top: 0;
            padding-bottom: 0;
            background-color: transparent;
        }

        .checkbox label::after {
            margin-left: -47px;
        }

        #latentes_pos, #latentes_neg, #promotores_pos, #promotores_neg, #apaticos_neg, #apaticos_pos, #defensores_pos, #defensores_neg { z-index: 1; }

        #watermark {
            height: 8em;
            width: 100%;
            position: initial;
            overflow: hidden;
            z-index: 0;
        }

        #watermark p {
            position: absolute;
            top: 1em;
            font-size: 40px;
            pointer-events: none;
            -webkit-transform: rotate(-10deg);
        }

        #watermark p b{
            font-weight: 500;
        }

        #latentes_pos, #latentes_neg, #promotores_pos, #promotores_neg, #apaticos_pos, #apaticos_neg, #defensores_pos, #defensores_neg { font-size: 0.886rem; }
    
        @media (min-width: 768px) {
            .modal-map {
                width: 90%;
                max-width:1200px;
            }
        }
    </style>

    {!! Form::model( @$agenda, ['route' =>[ 'updateAgenda' ],'method' => ( 'PUT'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}

    <input type="hidden" value='{{$agenda->id}}' name='id_agenda'>

    <div class="row col-md-10 mr-auto ml-auto">
        <div class="col-md-12 text-center">
            <h4>Método de Agenda Estratégica</h4><hr>
        </div>
        <div class="col-md-12">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th class="tx-15">
                            Meta:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::textArea('meta',$agenda->meta,['class'=>'form-control','required','rows'=>'3' ]) !!}
                                <i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th class="tx-15">
                            Solución:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::textArea('solucion',$agenda->solucion,['class'=>'form-control','required','rows'=>'3' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th class="tx-15">
                            Ejes (seleccionar según corresponda):
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="card" style="margin-top: 5px; margin-bottom: 15px">
                                <div class="row mr-auto ml-auto" style="padding-top: 1rem; padding-bottom: 1em;">
                                    @foreach($ejes as $eje)
                                        <div class="col-md-4">
                                            <input type="checkbox" class="btn-check" name="eje[]" id="eje{{$eje->id}}" autocomplete="off" value="{{$eje->id}}" @if( count( $agenda->enfoques->where('tabla_provienen',1)->where('id_enfoque', $eje->id) ) > 0 ) checked @else '' @endif>
                                            <label class="btn btn-outline-secondary btn-sm" for="eje{{$eje->id}}">{{$eje->eje}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <table class="table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr><th></th><th class="tx-15">Conceptos:</th></tr>
                    <tr><th style="text-align: center; color: #002a80" colspan="2"><h4>Ejes estratégicos y enfoque de la agenda</h4></th></tr>
                    <tr><td></td><td>A continuación se presenta una breve explicación de cada uno de los ejes:</td></tr>
                    <tr><th colspan="2" style="text-align:center;"><label class="main-content-label tx-16 mb-3" style="color: #002a80; margin-top: 1.2rem;"> Sí San Luis Seguro: </label></th></tr>
                    <tr>
                        <td style=" width: 125px"><img src="{{asset('/img/ejes')}}/seguro.png" alt="" width="100"></td>
                        <td class="tdDesign">
                            Fortalecer el tejido social, recuperar las calles y espacios públicos de la delincuencia, crear la
                            Secretaría de Seguridad Ciudadana a través de la implementación del nuevo modelo homologado
                            de justicia cívica, buen gobierno y cultura de la legalidad.
                        </td>
                    </tr>
                    <tr><th colspan="2" style="text-align:center;"><label class="main-content-label tx-16 mb-3" style="color: #002a80; margin-top: 1.2rem;"> Sí San Luis con Bienestar: </label></th></tr>
                    <tr>
                        <td><img src="{{asset('/img/ejes')}}/bienestar.png" alt="Sí San Luis con Bienestar" width="100"></td>
                        <td class="tdDesign">
                            Generar las condiciones para satisfacer conjuntamente una serie de factores que responden a la
                            calidad de vida de las personas. El bienestar social se expresa a través de los niveles de salud,
                            educación, vivienda, bienes de consumo, desarrollo urbano, seguridad y en todos los aspectos
                            relacionados con el medio ambiente
                        </td>
                    </tr>
                    <tr><th colspan="2" style="text-align:center;"><label class="main-content-label tx-16 mb-3" style="color: #002a80; margin-top: 1.2rem;"> Sí San Luis Sostenible: </label></th></tr>
                    <tr><td><img src="{{asset('/img/ejes')}}/sostenible.png" alt="Sí San Luis Sostenible" width="100"></td>
                        <td class="tdDesign">
                            Adoptar el enfoque de la Agenda 2030 y sus directrices en materia de desarrollo sostenible de
                            manera integral en las atribuciones del H. Ayuntamiento para combatir la desigualdad, generar una
                            sociedad pacífica e inclusiva, proteger la vida y los ecosistemas naturales y abordar de manera
                            urgente los efectos del cambio climático.
                            En otras palabras, el desarrollo sostenible es aquel capaz de satisfacer las necesidades del presente
                            sin comprometer la capacidad de las futuras generaciones para satisfacer sus propias necesidades
                            tanto en el ámbito social, ambiental y económico.
                        </td>
                    </tr>
                    <tr><th colspan="2" style="text-align:center;"><label class="main-content-label tx-16 mb-3" style="color: #002a80; margin-top: 1.2rem;">Sí San Luis Innovador: </label></th></tr>
                    <tr><td><img src="{{asset('/img/ejes')}}/innovador.png" alt="Sí San Luis Innovador" width="100"></td>
                        <td class="tdDesign">
                            Promover la conectividad entre la ciudadanía, su gobierno y los actores políticos, públicos y
                            privados, para la mejor toma de decisiones, gestión ágil y eficiente de trámites para elevar el nivel
                            de calidad de vida con un uso responsable, productivo y transparente de las tecnologías de la
                            información y comunicación.
                        </td>
                    </tr>
                    <tr><th colspan="2" style="text-align:center;"><label class="main-content-label tx-16 mb-3" style="color: #002a80; margin-top: 1.2rem;">Sí San Luis Competitivo: </label></th></tr>
                    <tr><td><img src="{{asset('/img/ejes')}}/competitivo.png" alt="Sí San Luis Competitivo" width="100"></td>
                        <td class="tdDesign">
                            Un San Luis de oportunidades equitativas con acciones enfocadas a lograr un municipio
                            competitivo que genere más empleos y mejores ingresos a través de alianzas con los sectores
                            productivos, así como la creación del Instituto Municipal del Emprendimiento.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row col-md-12" style="padding-bottom: 15px">
            <div class="col-md-12 text-center">
                <h4 style="padding-top: 1.5em;">Direcciones que intervienen</h4>
            </div>
            <div class="col-md-12">
                <!--<div class="col-md-8 ml-2">-->
                {{Form::select('direcciones[]',$direcciones,null,['multiple','size'=>'10'])}}
                <script>
                    var dualList = $('select[name="direcciones[]"]').bootstrapDualListbox();
                    @foreach ($direcciones2 as $key => $value)
                        dualList.append('<option value="{{$key}}" selected>{{$value}}</option>');
                        dualList.bootstrapDualListbox('refresh', true);
                    @endforeach
                </script>
                <!--</div>-->
            </div>
        </div>
        <div class="col-md-12 row">
            <div class="col-md-12 text-center">
                <h4>Grupo Objetivo</h4><hr>
            </div>
            <div class="col-md-12 text-center">
                <p>Seleccione las opciones que apliquen:</p>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 card" style="margin-top: 15px; margin-bottom: 15px">
                        <div class="footer-widget">
                            <div class="col-md-12">
                                <ul class="list-group wd-md-50p" style="padding-top: 1rem; padding-left: 1rem;">
                                    <li class="d-flex text-center">
                                        <div>
                                            <h6 class="tx-16 tx-inverse tx-semibold mg-b-0">EDADES</h6><span class="d-block tx-14 text-muted">Toma de decisión de los padres</span>
                                        </div>
                                    </li>
                                </ul>
                            </div><hr class="hrDesign"/>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="parsley-checkbox mg-b-0">
                                                    <label class="ckbox mg-b-15-f" for="go_1"><input type="checkbox" class="btn-check" name="go_1" id="go_1" autocomplete="off" onclick="selectAll('go_1')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span>
                                                    </label>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($go[1] as $go1)
                                                    <label class="ckbox mg-b-15-f" for="go{{$go1->id}}"><input type="checkbox" class="btn-check go_1" name="go[]" id="go{{$go1->id}}" autocomplete="off" value="{{$go1->id}}" @if ($loop->last) onclick="deSelect('go_1','go{{$go1->id}}'); otrosCampo(this.id, 'decPadres');" @else onclick="deSelect('go_1','go{{$go1->id}}');" @endif @if( count( $agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', $go1->id) ) > 0 ) checked @else '' @endif> <span> {{$go1->nombre}} </span>
                                                    </label>
                                                @endforeach
                                            </div>
                                            @if( count( $agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', 39) ) == 0 )
                                                <div class="form-group" id="decPadresOtros" style="width: 70%; margin-left: 3em; display: none;">
                                            @else
                                                <div class="form-group" id="decPadresOtros" style="width: 70%; margin-left: 3em;">
                                            @endif
                                                    {!! Form::text('otros'.$go1->id,@$agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', 39)->first()->otro,['class'=>'form-control','placeholder'=>'Otras edades con decisión parental']) !!}<i class="form-group__bar"></i>
                                                </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 card" style="margin-top: 15px; margin-bottom: 15px">
                        <div class="footer-widget">
                            <div class="col-md-12">
                                <ul class="list-group wd-md-50p" style="padding-top: 1rem; padding-left: 1rem;">
                                    <li class="d-flex text-center">
                                        <div>
                                            <h6 class="tx-16 tx-inverse tx-semibold mg-b-0">EDADES</h6><span class="d-block tx-14 text-muted">Toma de decisión propia</span>
                                        </div>
                                    </li>
                                </ul>
                            </div><hr class="hrDesign"/>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="parsley-checkbox mg-b-0">
                                                    <label class="ckbox mg-b-15-f" for="go_2"><input type="checkbox" class="btn-check" name="go_2" id="go_2" autocomplete="off" onclick="selectAll('go_2')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($go[2] as $go2)
                                                    <label class="ckbox mg-b-15-f" for="go{{$go2->id}}"><input type="checkbox" class="btn-check go_2" name="go[]" id="go{{$go2->id}}" autocomplete="off" value="{{$go2->id}}" @if ($loop->last) onclick="deSelect('go_2','go{{$go2->id}}'); otrosCampo(this.id, 'decPropia');" @else onclick="deSelect('go_2','go{{$go2->id}}');" @endif @if( count( $agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', $go2->id) ) > 0 ) checked @else '' @endif> <span> {{$go2->nombre}} </span></label>
                                                @endforeach
                                            </div>
                                            @if( count( $agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', 40) ) == 0 )
                                                <div class="form-group" style="width: 70%; margin-left: 3em; display: none;" id="decPropiaOtros">
                                            @else
                                                <div class="form-group" style="width: 70%; margin-left: 3em;" id="decPropiaOtros">
                                            @endif
                                                    {!! Form::text('otros'.$go2->id,@$agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', 40)->first()->otro,['class'=>'form-control','placeholder'=>'Otras edades con decisión propia']) !!}<i class="form-group__bar"></i>
                                                </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 card" style="margin-top: 15px; margin-bottom: 15px">
                        <div class="footer-widget">
                            <div class="col-md-12">
                                <ul class="list-group wd-md-50p" style="padding-top: 1rem; padding-left: 1rem;">
                                    <li class="d-flex text-center">
                                        <div>
                                            <h6 class="tx-16 tx-inverse tx-semibold mg-b-0">NSE</h6><span class="d-block tx-14 text-muted"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div><hr class="hrDesign"/>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="parsley-checkbox mg-b-0">
                                                    <label class="ckbox mg-b-15-f" for="go_3"><input type="checkbox" class="btn-check" name="go_3" id="go_3" autocomplete="off" onclick="selectAll('go_3')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($go[3] as $go3)
                                                    <label class="ckbox mg-b-15-f" for="go{{$go3->id}}"><input type="checkbox" class="btn-check go_3" name="go[]" id="go{{$go3->id}}" autocomplete="off" value="{{$go3->id}}" @if ($loop->last) onclick="deSelect('go_3','go{{$go3->id}}'); otrosCampo(this.id, 'nse');" @else onclick="deSelect('go_3','go{{$go3->id}}');" @endif @if( count( $agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', $go3->id) ) > 0 ) checked @else '' @endif> <span>{{$go3->nombre}} </span> </label>
                                                @endforeach
                                            </div>
                                            @if( count( $agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', 41) ) == 0 )
                                                <div class="form-group" style="width: 70%; margin-left: 3em; display: none;" id="nseOtros">
                                            @else
                                                <div class="form-group" style="width: 70%; margin-left: 3em;" id="nseOtros">
                                            @endif
                                                    {!! Form::text('otros'.$go3->id,@$agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', 41)->first()->otro,['class'=>'form-control','placeholder'=>'Otro NSE']) !!}<i class="form-group__bar"></i>
                                                </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 card" style="margin-top: 15px; margin-bottom: 15px">
                        <div class="footer-widget">
                            <div class="col-md-12">
                                <ul class="list-group wd-md-50p" style="padding-top: 1rem; padding-left: 1rem;">
                                    <li class="d-flex text-center">
                                        <div>
                                            <h6 class="tx-16 tx-inverse tx-semibold mg-b-0">GÉNERO</h6><span class="d-block tx-14 text-muted"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div><hr class="hrDesign"/>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="parsley-checkbox mg-b-0">
                                                    <label class="ckbox mg-b-15-f" for="go_4"><input type="checkbox" class="btn-check" name="go_4" id="go_4" autocomplete="off" onclick="selectAll('go_4')"> <span style="color: #615f62; font-size: 13px;"> TODOS</span></label>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($go[4] as $go4)
                                                    <label class="ckbox mg-b-15-f" for="go{{$go4->id}}"><input type="checkbox" class="btn-check go_4" name="go[]" id="go{{$go4->id}}" autocomplete="off" value="{{$go4->id}}" @if ($loop->last) onclick="deSelect('go_4','go{{$go4->id}}'); otrosCampo(this.id, 'genero');" @else onclick="deSelect('go_4','go{{$go4->id}}')" @endif @if( count( $agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', $go4->id) ) > 0 ) checked @else '' @endif> <span> {{$go4->nombre}} </span></label>
                                                @endforeach
                                            </div>
                                            @if( count( $agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', 42) ) == 0 )
                                                <div class="form-group" style="width: 70%; margin-left: 3em; display: none;" id="generoOtros">
                                            @else
                                                <div class="form-group" style="width: 70%; margin-left: 3em;" id="generoOtros">
                                            @endif
                                                    {!! Form::text('otros'.$go4->id,@$agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', 42)->first()->otro,['class'=>'form-control','placeholder'=>'Otro género']) !!}<i class="form-group__bar"></i>
                                                </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 card" style="margin-top: 15px; margin-bottom: 15px">
                        <div class="footer-widget">
                            <div class="col-md-12">
                                <ul class="list-group wd-md-50p" style="padding-top: 1rem; padding-left: 1rem;">
                                    <li class="d-flex text-center">
                                        <div>
                                            <h6 class="tx-16 tx-inverse tx-semibold mg-b-0">GRUPO OBJETIVO</h6><span class="d-block tx-14 text-muted"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div><hr class="hrDesign"/>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="parsley-checkbox mg-b-0">
                                                    <label class="ckbox mg-b-15-f" for="go_5"><input type="checkbox" class="btn-check" name="go_5" id="go_5" autocomplete="off" onclick="selectAll('go_5')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($go[5] as $go5)
                                                    <label class="ckbox mg-b-15-f" for="go{{$go5->id}}"><input type="checkbox" class="btn-check go_5" name="go[]" id="go{{$go5->id}}" autocomplete="off" value="{{$go5->id}}" @if ($loop->last) onclick="deSelect('go_5','go{{$go5->id}}');otrosCampo(this.id, 'gr_obj');" @else onclick="deSelect('go_5','go{{$go5->id}}');" @endif @if( count( $agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', $go5->id) ) > 0 ) checked @else '' @endif> <span>{{$go5->nombre}}</span> </label>
                                                @endforeach
                                            </div>
                                            @if( count( $agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', 43) ) == 0 )
                                                <div class="form-group" style="width: 70%; margin-left: 3em; display: none;" id="gr_objOtros">
                                            @else
                                                <div class="form-group" style="width: 70%; margin-left: 3em;" id="gr_objOtros">
                                            @endif
                                                    {!! Form::text('otros'.$go5->id,@$agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', 43)->first()->otro,['class'=>'form-control','placeholder'=>'Otros grupos objetivos']) !!}<i class="form-group__bar"></i>
                                                </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 card" style="margin-top: 15px; margin-bottom: 15px">
                        <div class="footer-widget">
                            <div class="col-md-12">
                                <ul class="list-group wd-md-50p" style="padding-top: 1rem; padding-left: 1rem;">
                                    <li class="d-flex text-center">
                                        <div>
                                            <h6 class="tx-16 tx-inverse tx-semibold mg-b-0">NIVEL DE EDUCACIÓN</h6><span class="d-block tx-14 text-muted"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div><hr class="hrDesign"/>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="parsley-checkbox mg-b-0">
                                                    <label class="ckbox mg-b-15-f" for="go_6"><input type="checkbox" class="btn-check" name="go_6" id="go_6" autocomplete="off" onclick="selectAll('go_6')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($go[6] as $go6)
                                                    <label class="ckbox mg-b-15-f" for="go{{$go6->id}}"><input type="checkbox" class="btn-check go_6" name="go[]" id="go{{$go6->id}}" autocomplete="off" value="{{$go6->id}}" @if ($loop->last) onclick="deSelect('go_6','go{{$go6->id}}'); otrosCampo(this.id, 'nvlEduc');" @else onclick="deSelect('go_6','go{{$go6->id}}');" @endif @if( count( $agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', $go6->id) ) > 0 ) checked @else '' @endif> <span>{{$go6->nombre}}</span></label>
                                                @endforeach
                                            </div>
                                            @if( count( $agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', 44) ) == 0 )
                                                <div class="form-group" style="width: 70%; margin-left: 3em; display: none;" id="nvlEducOtros">
                                            @else
                                                <div class="form-group" style="width: 70%; margin-left: 3em;" id="nvlEducOtros">
                                            @endif
                                                    {!! Form::text('otros'.$go6->id,@$agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', 44)->first()->otro,['class'=>'form-control','placeholder'=>'Otros niveles de educación']) !!}<i class="form-group__bar"></i>
                                                </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 row">
            <div class="col-md-4 mr-auto ml-auto">
                <div class="form-group" style="margin-bottom: 10px; text-align: center">
                    <h4>Zona/Localización</h4>
                    <a class="form-control" onclick="desplegarMap();" style="text-align: start; color: silver; font-size: inherit;" type="none" data-toggle="modal" data-target=".bd-example-modal-lg" id="btnMap"> {{ @$agenda->ubicacion ? $agenda->ubicacion : 'Seleccione la localización en el mapa' }}</a>
                    <i class="form-group__bar"></i>
                    <input type="hidden" name="ubicacion" value="{{ @$agenda->ubicacion ? $agenda->ubicacion : '' }}" id="ubicacion">
                </div>
            </div>
        </div>
        <div class="col-md-12 row">
            <div class="col-md-12 text-center">
                <h4>Medios de comunicación externos</h4><hr>
            </div>
            <div class="col-md-12 text-center">
                <p>Seleccione los medios por los cuáles se va a comunicar la acción de manera externa:</p>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 card" style="margin-top: 15px; margin-bottom: 15px">
                        <div class="footer-widget">
                            <div class="col-md-12">
                                <ul class="list-group wd-md-50p" style="padding-top: 1rem; padding-left: 1rem;">
                                    <li class="d-flex text-center">
                                        <div>
                                            <h6 class="tx-16 tx-inverse tx-semibold mg-b-0">DIGITAL</h6><span class="d-block tx-14 text-muted"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div><hr class="hrDesign"/>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="parsley-checkbox mg-b-0">
                                                    <label class="ckbox mg-b-15-f" for="mce_1"><input type="checkbox" class="btn-check" name="mce_1" id="mce_1" autocomplete="off" onclick="selectAll('mce_1')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($mc[1] as $mc1)
                                                    <label class="ckbox mg-b-15-f" for="mc{{$mc1->id}}"><input type="checkbox" class="btn-check mce_1" name="mc[]" id="mc{{$mc1->id}}" autocomplete="off" value="{{$mc1->id}}" onclick="deSelect('mce_1','mc{{$mc1->id}}')" @if( count( $agenda->enfoques->where('tabla_provienen',4)->where('id_enfoque', $mc1->id) ) > 0 ) checked @else '' @endif> <span>{{$mc1->medio}}</span> </label>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 card" style="margin-top: 15px; margin-bottom: 15px">
                        <div class="footer-widget">
                            <div class="col-md-12">
                                <ul class="list-group wd-md-50p" style="padding-top: 1rem; padding-left: 1rem;">
                                    <li class="d-flex text-center">
                                        <div>
                                            <h6 class="tx-16 tx-inverse tx-semibold mg-b-0">PRESENCIAL</h6><span class="d-block tx-14 text-muted"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div><hr class="hrDesign"/>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="parsley-checkbox mg-b-0">
                                                    <label class="ckbox mg-b-15-f" for="mce_2"><input type="checkbox" class="btn-check" name="mce_2" id="mce_2" autocomplete="off" onclick="selectAll('mce_2')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($mc[2] as $mc2)
                                                    <label class="ckbox mg-b-15-f" for="mc{{$mc2->id}}"><input type="checkbox" class="btn-check mce_2" name="mc[]" id="mc{{$mc2->id}}" autocomplete="off" value="{{$mc2->id}}" onclick="deSelect('mce_2','mc{{$mc2->id}}')" @if( count( $agenda->enfoques->where('tabla_provienen',4)->where('id_enfoque', $mc2->id) ) > 0 ) checked @else '' @endif> <span>{{$mc2->medio}}</span></label>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 card" style="margin-top: 15px; margin-bottom: 15px">
                        <div class="footer-widget">
                            <div class="col-md-12">
                                <ul class="list-group wd-md-50p" style="padding-top: 1rem; padding-left: 1rem;">
                                    <li class="d-flex text-center">
                                        <div>
                                            <h6 class="tx-16 tx-inverse tx-semibold mg-b-0">TRADICIONALES</h6><span class="d-block tx-14 text-muted"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div><hr class="hrDesign"/>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="parsley-checkbox mg-b-0">
                                                    <label class="ckbox mg-b-15-f" for="mce_3"><input type="checkbox" class="btn-check" name="mce_3" id="mce_3" autocomplete="off" onclick="selectAll('mce_3')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($mc[3] as $mc3)
                                                    <label class="ckbox mg-b-15-f" for="mc{{$mc3->id}}"><input type="checkbox" class="btn-check mce_3" name="mc[]" id="mc{{$mc3->id}}" autocomplete="off" value="{{$mc3->id}}" onclick="deSelect('mce_3','mc{{$mc3->id}}')" @if( count( $agenda->enfoques->where('tabla_provienen',4)->where('id_enfoque', $mc3->id) ) > 0 ) checked @else '' @endif> <span>{{$mc3->medio}}</span> </label>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 card" style="margin-top: 15px; margin-bottom: 15px">
                        <div class="footer-widget">
                            <div class="col-md-12">
                                <ul class="list-group wd-md-50p" style="padding-top: 1rem; padding-left: 1rem;">
                                    <li class="d-flex text-center">
                                        <div>
                                            <h6 class="tx-16 tx-inverse tx-semibold mg-b-0">OTROS</h6><span class="d-block tx-14 text-muted"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div><hr class="hrDesign"/>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group" style="width: 70%; margin-left: 3em;">
                                                {!! Form::text('otrosMc18',@$agenda->enfoques->where('tabla_provienen',4)->where('id_enfoque', 26)->first()->otro,['class'=>'form-control','placeholder'=>'Otros medios de comunicación externos']) !!}<i class="form-group__bar"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 row">
            <div class="col-md-12 text-center">
                <h4>Medios de comunicación internos</h4><hr>
            </div>
            <div class="container">
                <div class="row" style="place-content: center;">
                    <div class="col-md-6 card" style="margin-top: 15px; margin-bottom: 15px">
                        <div class="footer-widget">
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="parsley-checkbox mg-b-0">
                                                    <label class="ckbox mg-b-15-f" for="mci_1"><input type="checkbox" class="btn-check" name="mci_1" id="mci" autocomplete="off" onclick="selectAll('mci')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em; margin-bottom: 1em; width: 60%; margin-left: 1px;">
                                                @foreach($mc[5] as $mc5)
                                                    <label class="ckbox mg-b-15-f" for="mc{{$mc5->id}}"><input type="checkbox" class="btn-check mci" name="mc[]" id="mc{{$mc5->id}}" autocomplete="off" value="{{$mc5->id}}" @if ($loop->last) onclick="deSelect('mci','mc{{$mc5->id}}'); otrosCampo(this.id, 'medComInt');" @else onclick="deSelect('mci','mc{{$mc5->id}}');" @endif @if( count( $agenda->enfoques->where('tabla_provienen',4)->where('id_enfoque', $mc5->id) ) > 0 ) checked @else '' @endif> <span>{{$mc5->medio}}</span></label>
                                                @endforeach
                                            </div>
                                            @if( count( $agenda->enfoques->where('tabla_provienen',4)->where('id_enfoque', 26) ) == 0 )
                                                <div class="form-group" style="width: 70%; margin-left: 3em; display: none;" id="medComIntOtros">
                                            @else
                                                <div class="form-group" style="width: 70%; margin-left: 3em;" id="medComIntOtros">
                                            @endif
                                                    {!! Form::text('otrosMc'.$mc5->id,@$agenda->enfoques->where('tabla_provienen',4)->where('id_enfoque', 26)->first()->otro,['class'=>'form-control','placeholder'=>'Otros medios de comunicación internos']) !!}<i class="form-group__bar"></i>
                                                </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <h4>Datos Generales del Evento</h4><hr>
        </div>
        <div class="col-md-12">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <p style="font-size: 15px; padding-left: 2rem;"> Título: </p>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::textArea('titulo',$agenda->titulo_evento,['class'=>'form-control', 'required', 'rows'=>'2' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12 row">
            <div class="col-md-5">
                <p style="font-size: 15px; padding-left: 2rem;"><b>Invitados</b></p>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 card" style="margin-top: 15px; margin-bottom: 15px">
                        <div class="footer-widget">
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="parsley-checkbox mg-b-0">
                                                    <label class="ckbox mg-b-15-f" for="ia_1"><input type="checkbox" class="btn-check" name="ia_1" id="ia_1" autocomplete="off" onclick="selectAll('ia_1')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em; margin-bottom: 1em; width: 60%; margin-left: 1px;">
                                                @foreach($ia[1] as $ia1)
                                                    <label class="ckbox mg-b-15-f" for="ia{{$ia1->id}}"><input type="checkbox" class="btn-check ia_1" name="ia[]" id="ia{{$ia1->id}}" autocomplete="off" value="{{$ia1->id}}" onclick="deSelect('ia_1','ia{{$ia1->id}}')" @if( count( $agenda->enfoques->where('tabla_provienen',5)->where('id_enfoque', $ia1->id) ) > 0 ) checked @else '' @endif> <span>{{$ia1->invitado}}</span> </label>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 card" style="margin-top: 15px; margin-bottom: 15px">
                        <div class="footer-widget">
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="parsley-checkbox mg-b-0">
                                                    <label class="ckbox mg-b-15-f" for="ia_2"><input type="checkbox" class="btn-check" name="ia_2" id="ia_2" autocomplete="off" onclick="selectAll('ia_2')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em; margin-bottom: 1em; width: 60%; margin-left: 1px;">
                                                @foreach($ia[2] as $ia2)
                                                    <label class="ckbox mg-b-15-f" for="ia{{$ia2->id}}"><input type="checkbox" class="btn-check ia_2" name="ia[]" id="ia{{$ia2->id}}" autocomplete="off" value="{{$ia2->id}}" @if ($loop->last) onclick="deSelect('ia_2','ia{{$ia2->id}}'); otrosCampo(this.id, 'inv');" @else onclick="deSelect('ia_2','ia{{$ia2->id}}');" @endif @if( count( $agenda->enfoques->where('tabla_provienen',5)->where('id_enfoque', $ia2->id) ) > 0 ) checked @else '' @endif> <span>{{$ia2->invitado}}</span> </label>
                                                @endforeach
                                            </div>
                                            @if( count( $agenda->enfoques->where('tabla_provienen',3)->where('id_enfoque', 39) ) == 0 )
                                                <div class="form-group" style="width: 70%; margin-left: 3em; display: none;" id="invOtros">
                                            @else
                                                <div class="form-group" style="width: 70%; margin-left: 3em;" id="invOtros">
                                            @endif
                                                    {!! Form::text('otrosInv15',null,['class'=>'form-control','placeholder'=>'Otros invitados']) !!}<i class="form-group__bar"></i>
                                                </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th class="tx-15">
                            Contenido de la presentación:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::textArea('contenido',$agenda->contenido_presentacion,['class'=>'form-control','required','rows'=>'3' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12 text-center">
            <br><h4>Matriz de riesgos</h4><br>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
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
                        @foreach($riesgos as $riesgo)
                        <tr>
                            <td>{{$riesgo->riesgo}}</td>
                            <td style="text-align:center">
                                <div class="checkbox checkbox-success">
                                    <input type="radio" id="riesgo{{$riesgo->id}}1" value="1" name="riesgo{{$riesgo->id}}" onchange="checkInput('riesgo', {{$riesgo->id}});" @if( count( $agenda->riesgos->where('tipo_matriz',1)->where('id_riesgo', $riesgo->id)->where('cumple',1) ) > 0 ) checked @else '' @endif>
                                    <label for='riesgo{{$riesgo->id}}1' style="margin-bottom:0px">&nbsp;</label>
                                </div>
                            </td>
                            <td style="text-align:center">
                                <div class="checkbox checkbox-warning">
                                    <input type="radio" id="riesgo{{$riesgo->id}}2" value="2" name="riesgo{{$riesgo->id}}" onchange="checkInput('riesgo', {{$riesgo->id}});" @if( count( $agenda->riesgos->where('tipo_matriz',1)->where('id_riesgo', $riesgo->id)->where('cumple',2) ) > 0 ) checked @else '' @endif>
                                    <label for='riesgo{{$riesgo->id}}2' style="margin-bottom:0px">&nbsp;</label>
                                </div>
                            </td>
                            <td style="text-align:center">
                                <div class="checkbox checkbox-danger">
                                    <input type="radio" id="riesgo{{$riesgo->id}}3" value="3" name="riesgo{{$riesgo->id}}" onchange="checkInput('riesgo', {{$riesgo->id}});" @if( count( $agenda->riesgos->where('tipo_matriz',1)->where('id_riesgo', $riesgo->id)->where('cumple',3) ) > 0 ) checked @else '' @endif>
                                    <label for='riesgo{{$riesgo->id}}3' style="margin-bottom:0px">&nbsp;</label>
                                </div>
                            </td>
                            <td style="border-right-style: hidden; border-bottom-style: hidden;">
                                @if( count( $agenda->riesgos->where('tipo_matriz',1)->where('id_riesgo', $riesgo->id)->where('cumple','>',0) ) > 0 )
                                    {{Form::text('riesgoPlan'.$riesgo->id,$agenda->riesgos->where('tipo_matriz',1)->where('id_riesgo', $riesgo->id)->first()->plan_accion,['id' => 'riesgoPlan'.$riesgo->id, 'class'=>'form-control', 'onchange' => "checkInput('riesgo', $riesgo->id);"])}}
                                @else
                                    {{Form::text('riesgoPlan'.$riesgo->id,null,['id' => 'riesgoPlan'.$riesgo->id, 'class'=>'form-control','placeholder'=>'Escriba el plan de acción para '.$riesgo->riesgo, 'onchange' => "checkInput('riesgo', $riesgo->id);"])}}
                                @endif
                                <i class="form-group__bar"></i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 text-center" style="padding-top: 20px">
            <br><h4>Matriz de mitigación de riesgos</h4><br>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
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
                        @foreach($riesgos as $riesgo)
                        <tr>
                            <td>{{$riesgo->riesgo}}</td>
                            <td style="text-align:center">
                                <div class="checkbox checkbox-success">
                                    <input type="radio" id="mitRiesgo{{$riesgo->id}}1" value="1" name="mitRiesgo{{$riesgo->id}}" onchange="checkInput('mitRiesgo', {{$riesgo->id}});" @if( count( $agenda->riesgos->where('tipo_matriz',2)->where('id_riesgo', $riesgo->id)->where('cumple',1) ) > 0 ) checked @else '' @endif>
                                    <label for='mitRiesgo{{$riesgo->id}}1' style="margin-bottom:0px">&nbsp;</label>
                                </div>
                            </td>
                            <td style="text-align:center">
                                <div class="checkbox checkbox-warning">
                                    <input type="radio" id="mitRiesgo{{$riesgo->id}}2" value="2" name="mitRiesgo{{$riesgo->id}}" onchange="checkInput('mitRiesgo', {{$riesgo->id}});" @if( count( $agenda->riesgos->where('tipo_matriz',2)->where('id_riesgo', $riesgo->id)->where('cumple',2) ) > 0 ) checked @else '' @endif>
                                    <label for='mitRiesgo{{$riesgo->id}}2' style="margin-bottom:0px">&nbsp;</label>
                                </div>
                            </td>
                            <td style="text-align:center">
                                <div class="checkbox checkbox-danger">
                                    <input type="radio" id="mitRiesgo{{$riesgo->id}}3" value="3" name="mitRiesgo{{$riesgo->id}}" onchange="checkInput('mitRiesgo', {{$riesgo->id}});" @if( count( $agenda->riesgos->where('tipo_matriz',2)->where('id_riesgo', $riesgo->id)->where('cumple',3) ) > 0 ) checked @else '' @endif>
                                    <label for='mitRiesgo{{$riesgo->id}}3' style="margin-bottom:0px">&nbsp;</label>
                                </div>
                            </td>
                            <td style="border-right-style: hidden; border-bottom-style: hidden;">
                                @if( count( $agenda->riesgos->where('tipo_matriz',2)->where('id_riesgo', $riesgo->id)->where('cumple','>',0) ) > 0 )
                                    {{Form::text('mitRiesgoPlan'.$riesgo->id,$agenda->riesgos->where('tipo_matriz',2)->where('id_riesgo', $riesgo->id)->first()->plan_accion,['id' => 'mitRiesgoPlan'.$riesgo->id, 'class'=>'form-control', 'onchange' => "checkInput('mitRiesgo', $riesgo->id);"])}}
                                @else
                                    {{Form::text('mitRiesgoPlan'.$riesgo->id,null,['id' => 'mitRiesgoPlan'.$riesgo->id, 'class'=>'form-control','placeholder'=>'Escriba el plan de acción para '.$riesgo->riesgo, 'onchange' => "checkInput('mitRiesgo', $riesgo->id);"])}}
                                @endif
                                <i class="form-group__bar"></i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div><br>
    <div class="col-md-12">
        <table class="table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th class="text-center">
                        <h4> Gestión de los Interesados <a  class="btn btn-success btn-sm text-white" style="color: green" data-toggle="tooltip" title="Agregar" onclick="addLineA()"><i class="fa fa-plus-square fa-2x"></i></a></h4>
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="card" style="margin-top: 5px; margin-bottom: 15px">
                            <div class="col-md-12 card btn btn-outline-info" style="margin-left: 0px; margin-right: 0px; margin-top: 0px; cursor: none;">
                                <div class="card-body row" style="place-content: center;">
                                    <div>
                                        <table class="table-condensed table-responsive" style="width: 100%; text-align-last: center;" id="tablaAcciones">
                                            <tbody>
                                                    <tr>
                                                        <th style="text-align: center">Interesados</th>
                                                        <th style="text-align: center">Poder</th>
                                                        <th style="text-align: center">Interés</th>
                                                        <th style="text-align: center">Tipo</th>
                                                        <th></th>
                                                    </tr>
                                                @if( count( $agenda->interesados ) > 0 )
                                                    @foreach($agenda->interesados as $interesado)
                                                        <tr>
                                                            <td>
                                                                <div class="col-md-12" style="margin-bottom: 10px">
                                                                    {!! Form::select('interesado[]', $interesados, $interesado->id_interesado, ['class'=>'form-control','id'=>'interesado1','placeholder'=>'Seleccione departamento...', 'onchange' => 'matriz(this);']) !!}
                                                                    <i class="form-group__bar"></i>
                                                            </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12" style="margin-bottom: 10px">
                                                                    {!! Form::select('poder[]',array('alto' => 'Alto', 'bajo' => 'Bajo'),$interesado->poder,['class'=>'form-control','id'=>'poder1','placeholder'=>'Seleccione tipo de poder...', 'onchange' => 'matriz(this);']) !!}
                                                                    <i class="form-group__bar"></i>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12" style="margin-bottom: 10px">
                                                                    {!! Form::select('interes[]',array('alto' => 'Alto', 'bajo' => 'Bajo'),$interesado->interes,['class'=>'form-control','id'=>'interes1','placeholder'=>'Seleccione el tipo de interés...', 'onchange' => 'matriz(this);']) !!}
                                                                    <i class="form-group__bar"></i>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12" style="margin-bottom: 10px">
                                                                    {!! Form::select('tip[]', array(1 => '+', 0 => '-'),$interesado->tipo,['class'=>'form-control','id'=>'tip1','placeholder'=>'Seleccione tipo...', 'onchange' => 'matriz(this);']) !!}
                                                                    <i class="form-group__bar"></i>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-danger btn-sm text-white" style="color: red" onclick="deleteRow(this.parentNode.parentNode.rowIndex,' + "'tablaAcciones'" + ')" type="button" style="cursor:pointer"><i class="fa fa-minus-square"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                        <tr>
                                                            <td><div class="col-md-12" style="margin-bottom: 10px">{!! Form::select('interesado[]', $interesados, null, ['class'=>'form-control','id'=>'interesado1','placeholder'=>'Seleccione departamento...', 'onchange' => 'matriz(this);']) !!}<i class="form-group__bar"></i></div></td>
                                                            <td><div class="col-md-12" style="margin-bottom: 10px">{!! Form::select('poder[]',array('alto' => 'Alto', 'bajo' => 'Bajo'),null,['class'=>'form-control','id'=>'poder1','placeholder'=>'Seleccione tipo de poder...', 'onchange' => 'matriz(this);']) !!}<i class="form-group__bar"></i></div></td>
                                                            <td><div class="col-md-12" style="margin-bottom: 10px">{!! Form::select('interes[]',array('alto' => 'Alto', 'bajo' => 'Bajo'),null,['class'=>'form-control','id'=>'interes1','placeholder'=>'Seleccione el tipo de interés...', 'onchange' => 'matriz(this);']) !!}<i class="form-group__bar"></i></div></td>
                                                            <td><div class="col-md-12" style="margin-bottom: 10px">{!! Form::select('tip[]', array(1 => '+', 0 => '-'),null,['class'=>'form-control','id'=>'tip1','placeholder'=>'Seleccione tipo...', 'onchange' => 'matriz(this);']) !!}<i class="form-group__bar"></i></div></td>
                                                            <td><button class="btn btn-sm text-white" style="color: red; cursor: not-allowed" type="button" disabled><i class="fa fa-minus-square"></i></button></td>
                                                        </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="row row-sm">
        <div class="col-md">
            <div class="vertical arriba" style="text-align: right;"> ALTO </div>
        </div>
        <div class="col-md ">
            <div class="card custom-card">
                <div class="card-body" style="background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgb(233 218 180) 100%); border-top-left-radius: 1em;">
                    <p class="col-md-6"style="text-align: end; float: right;" id="latentes_neg">
                        @foreach($agenda->interesados->where('poder','alto')->where('interes','alto')->where('tipo',0) as $interesado)
                            {{$interesado->depto}} <br>
                        @endforeach
                    </p>
                    <p class="col-md-6" style="text-align: end;" id="latentes_pos">
                        @foreach($agenda->interesados->where('poder','alto')->where('interes','alto')->where('tipo',1) as $interesado)
                            {{$interesado->depto}} <br>
                        @endforeach
                    </p>
                    <div id="watermark">
                       <p style="color: #d9d4c6; top: 0.4em; left: 1em;"> <b> Latentes </b> <br> Informar </p>
                    </div>
                </div>
                <div class="card-footer" style="text-align-last: justify; width: 70%; place-self: center;">
                    <i class="si si-plus text-success avatar-xl" data-toggle="tooltip" title="" data-original-title="Positivo"></i>
                    <i class="si si-minus text-danger avatar-xl" data-toggle="tooltip" title="" data-original-title="Negativo"></i>
                </div>
            </div>
        </div>
        <div class="col-md ">
            <div class="card custom-card">
                <div class="card-body" style="background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgb(233 181 182) 100%); border-top-right-radius: 1em;">
                    <p class="col-md-6"style="text-align: end; float: right;" id="promotores_neg">
                        @foreach($agenda->interesados->where('poder','alto')->where('interes','bajo')->where('tipo',0) as $interesado)
                            {{$interesado->depto}} <br>
                        @endforeach
                    </p>
                    <p class="col-md-6" style="text-align: end;" id="promotores_pos">
                        @foreach($agenda->interesados->where('poder','alto')->where('interes','bajo')->where('tipo',1) as $interesado)
                            {{$interesado->depto}} <br>
                        @endforeach
                    </p>
                    <div id="watermark">
                       <p style="color: #e9c2c3; -webkit-transform: rotate(10deg); right: 1em; top: 0.4em;"> <b> Promotores </b> <br> Involucrar </p>
                    </div>
                </div>
                <div class="card-footer" style="text-align-last: justify; width: 70%; place-self: center;">
                    <i class="si si-plus text-success avatar-xl" data-toggle="tooltip" title="" data-original-title="Positivo"></i>
                    <i class="si si-minus text-danger avatar-xl" data-toggle="tooltip" title="" data-original-title="Negativo"></i>
                </div>
            </div>
        </div>
        <div class="col-md "></div>
    </div>

    <div class="row row-sm">
        <div class="col-md-3" style="text-align: center;"> <h4 style="font-weight: bold; writing-mode: vertical-rl; transform: rotate(180deg); float: right;"> PODER </h4> </div>
        <div class="col-md-9"> </div>
    </div>
    <div class="row row-sm">
        <div class="col-md">
            <div class="vertical abajo"> BAJO </div>
        </div>
        <div class="col-md ">
            <div class="card custom-card">
                <div class="card-body" style="background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgb(155 226 227) 100%); border-top-left-radius: 1em;">
                    <p class="col-md-6"style="text-align: end; float: right;" id="apaticos_neg">
                        @foreach($agenda->interesados->where('poder','bajo')->where('interes','alto')->where('tipo',0) as $interesado)
                            {{$interesado->depto}} <br>
                        @endforeach
                    </p>
                    <p class="col-md-6" style="text-align: end;" id="apaticos_pos">
                        @foreach($agenda->interesados->where('poder','bajo')->where('interes','alto')->where('tipo',1) as $interesado)
                            {{$interesado->depto}} <br>
                        @endforeach
                    </p>
                    <div id="watermark">
                       <p style="left: 1em; color: #aedadb;"> Monitorizar <br> <b> Apáticos </b> </p>
                    </div>
                </div>
                <div class="card-footer" style="text-align-last: justify; width: 70%; place-self: center;">
                    <i class="si si-plus text-success avatar-xl" data-toggle="tooltip" title="" data-original-title="Positivo"></i>
                    <i class="si si-minus text-danger avatar-xl" data-toggle="tooltip" title="" data-original-title="Negativo"></i>
                </div>
            </div>
        </div>
        <div class="col-md ">
            <div class="card custom-card">
                <div class="card-body" style="background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgb(216 198 241) 100%); border-top-right-radius: 1em;">
                    <p class="col-md-6"style="text-align: end; float: right;" id="defensores_neg">
                        @foreach($agenda->interesados->where('poder','bajo')->where('interes','bajo')->where('tipo',0) as $interesado)
                            {{$interesado->depto}} <br>
                        @endforeach
                    </p>
                    <p class="col-md-6" style="text-align: end;" id="defensores_pos">
                        @foreach($agenda->interesados->where('poder','bajo')->where('interes','bajo')->where('tipo',1) as $interesado)
                            {{$interesado->depto}} <br>
                        @endforeach
                    </p>
                    <div id="watermark">
                       <p style="color: #d6cde3; -webkit-transform: rotate(10deg); right: 1em; top: 0.8em;"> Reportar <br> <b> Defensores </b> </p>
                    </div>
                </div>
                <div class="card-footer" style="text-align-last: justify; width: 70%; place-self: center;">
                    <i class="si si-plus text-success avatar-xl" data-toggle="tooltip" title="" data-original-title="Positivo"></i>
                    <i class="si si-minus text-danger avatar-xl" data-toggle="tooltip" title="" data-original-title="Negativo"></i>
                </div>
            </div>
        </div>
        <div class="col-md "></div>
    </div>

    <div class="row row-sm" style="align-items: end;">
        <div class="col-md-5">
            <div class="horizontal izquierda" style="float: right;"> ALTO </div>
        </div>
        <div class="col-md-2" style="text-align: center;"> <h4 style="font-weight: bold;"> INTERÉS </h4> </div>
        <div class="col-md-5">
            <div class="horizontal derecha" style="float: left; text-align: right;"> BAJO </div>
        </div>
    </div>

    <br><br>

    <div class="row" style="padding-left: 10em;">
        <div class="col-md-12 col-sm-12 col-xs-12">
           <br>
           <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
           <a class="btn btn-secondary" href="{{url('/agenda/listado')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalMap">
        <div class="modal-dialog modal-map">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ubicación de Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group" style="margin-bottom: 10px">
                        <div class="card-body">
                            <div id="map" class="map" style="position:relative; height:557px; margin: 1px; border: solid 1px transparent; border-radius: 1em;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectAll(c){
            if ($('#' + c).is(':checked')) {
                $( "."+c ).each(function(  ) {
                    $(this).prop('checked', true);
                });
            }     
            else {
                $( "."+c ).each(function(  ) {
                    $(this).prop('checked', false);
                });
            }     
        }
        
        function deSelect(idT,id){
            if ($('#' + id).is(':checked')) {
                $( "."+idT ).each(function(  ) {
                    if ($(this).is(':checked')) {
                        $('#' + idT).prop('checked', true);                     
                    }  
                    else {
                        $('#' + idT).prop('checked', false); 
                        return false;
                    }  
                });
            } 
            else{
                $('#' + idT).prop('checked', false); 
            }
        }

        function addLineA(op) {
            var idA = Math.floor(Math.random() * 1000) + 10;
            var tbl = document.getElementById('tablaAcciones');
            var lastRow = tbl.rows.length;
            var row = tbl.insertRow(lastRow);

            var i = row.insertCell(0);
            var f = row.insertCell(1);
            var act = row.insertCell(2);
            var obs = row.insertCell(3);
            var ac = row.insertCell(4);

            i.innerHTML = '<div class="col-md-12" style="margin-bottom: 10px">{!! Form::select("interesado[]", $interesados, null, ["class"=>"form-control","id"=>"temp","placeholder"=>"Seleccione departamento...","onchange"=>"matriz(this);"]) !!}<i class="form-group__bar"></i></div>';
            document.querySelector('#temp').setAttribute('id', 'interesado' + idA);
            f.innerHTML = '<div class="col-md-12" style="margin-bottom: 10px"><select class="form-control" id="poder' + idA + '"  name="poder[]" onchange="matriz(this);"><option selected="selected" value="">Seleccione tipo de poder...</option><option value="alto">Alto</option><option value="bajo">Bajo</option></select><i class="form-group__bar"></i></div>';
            act.innerHTML = '<div class="col-md-12" style="margin-bottom: 10px"><select class="form-control" id="interes' + idA + '" name="interes[]" onchange="matriz(this);"><option selected="selected" value="">Seleccione el tipo de interés...</option><option value="alto">Alto</option><option value="bajo">Bajo</option></select><i class="form-group__bar"></i></div>';
            obs.innerHTML = '<div class="col-md-12" style="margin-bottom: 10px"><select class="form-control" id="tip' + idA + '" name="tip[]" onchange="matriz(this);"><option selected="selected" value="">Seleccione tipo...</option><option value="1">+</option><option value="0">-</option></select><i class="form-group__bar"></i></div>';
            ac.innerHTML = '<a class="btn btn-danger btn-sm text-white" style="color: red" onclick="deleteRow(this.parentNode.parentNode.rowIndex,' + "'tablaAcciones'" + ')" type="button" style="cursor:pointer"><i class="fa fa-minus-square"></i></a>';

            return false;
        }

        function deleteRow(rowIndex, nameTable){
            var table = document.getElementById(nameTable);
            table.deleteRow(rowIndex);
        }

        function desplegarMap(){
            mapboxgl.accessToken = 'pk.eyJ1IjoibWFwZm91bmQiLCJhIjoiY2p5NGp3ZTh2MTg3MDNpbXAxM2MxeGoybiJ9.VXQ3NXUpfX1YRB37TwBMYA';
            const map = new mapboxgl.Map({
                container: 'map', // container ID
                style: 'mapbox://styles/mapbox/streets-v11', // style URL
                center: {!! @$agenda->ubicacion ? $agenda->ubicacion : '[-100.97633711684888, 22.151434736659397]' !!}, // starting position
                zoom: 15 // starting zoom
            });
                
            map.on('click', function(e) {
                var coordinates = e.lngLat;
                var coord = '['+coordinates.lng+', '+coordinates.lat+']';
                $('#ubicacion').val(coord);
                $('#btnMap').text(coord);
                $('#btnMap').color='unset';
                if($(".mapboxgl-ctrl-fullscreen").length == 0) document.exitFullscreen();
                $('#modalMap').modal('toggle');
            });

            map.addControl(new MapboxGeocoder({
                accessToken: mapboxgl.accessToken
            }));

            map.addControl(new mapboxgl.FullscreenControl());
            map.addControl(new mapboxgl.GeolocateControl({
                positionOptions: {
                    enableHighAccuracy: true
                },
                trackUserLocation: true
            }));
            
            map.on('idle',function(){
                map.resize();
            });
            var elem = document.getElementsByClassName("mapboxgl-canvas");
            for (var i = 0; i < elem.length; i++) {
                elem[i].style.width='-webkit-fill-available';
                elem[i].style.height='-webkit-fill-available';
            }
        }

        function matriz(e){
            var interesadosSelect = document.getElementsByName("interesado[]");
            var latentes_pos = latentes_neg = promotores_pos = promotores_neg = apaticos_pos = apaticos_neg = defensores_pos = defensores_neg = '';
            for(var i = 0; i < interesadosSelect.length; i++){
                const numId = interesadosSelect[i].id.replace( /^\D+/g, '');
                if( $("#interesado"+numId).val() && $("#tip"+numId).val() ){
                    const deptoSelected = $('select[id="interesado'+numId+'"] option:selected').text();
                    if( $("#poder"+numId).val() == 'alto' && $("#interes"+numId).val() == 'alto' )
                        if( $("#tip"+numId).val() == 'neg')
                            latentes_neg += ( (latentes_neg != '') ? '<br>' : '' ) + deptoSelected;
                        else
                            latentes_pos = latentes_pos + ( (latentes_pos != '') ? '<br>' : '' ) + deptoSelected;
                    if( $("#poder"+numId).val() == 'alto' && $("#interes"+numId).val() == 'bajo' )
                        if( $("#tip"+numId).val() == 'neg')
                            promotores_neg += ( (promotores_neg != '') ? '<br>' : '' ) + deptoSelected;
                        else
                            promotores_pos += ( (promotores_pos != '') ? '<br>' : '' ) + deptoSelected;
                    if( $("#poder"+numId).val() == 'bajo' && $("#interes"+numId).val() == 'alto' )
                        if( $("#tip"+numId).val() == 'neg')
                            apaticos_neg += ( (apaticos_neg != '') ? '<br>' : '' ) + deptoSelected;
                        else
                            apaticos_pos += ( (apaticos_pos != '') ? '<br>' : '' ) + deptoSelected;
                    if( $("#poder"+numId).val() == 'bajo' && $("#interes"+numId).val() == 'bajo' )
                        if( $("#tip"+numId).val() == 'neg')
                            defensores_neg += ( (defensores_neg != '') ? '<br>' : '' ) + deptoSelected;
                        else
                            defensores_pos += ( (defensores_pos != '') ? '<br>' : '' ) + deptoSelected;
                }
            }
            $('#latentes_pos').html( latentes_pos );
            $('#latentes_neg').html( latentes_neg );
            $('#promotores_pos').html( promotores_pos );
            $('#promotores_neg').html( promotores_neg );
            $('#apaticos_pos').html( apaticos_pos );
            $('#apaticos_neg').html( apaticos_neg );
            $('#defensores_pos').html( defensores_pos );
            $('#defensores_neg').html( defensores_neg );
            return false;
        }

        function otrosCampo(id, nameDiv) {
            const element = document.getElementById( nameDiv + 'Otros');
            if ($('#' + id).is(':checked')) {
                element.style.display = 'block';
                element.querySelector('input').required = true;
            } 
            else{
                element.style.display = 'none';
                element.querySelector('input').required = false;
            }
        }

    function checkInput(validar, id){
        switch(validar){
            case 'riesgo':
                if ( $('#riesgo'+id+'1').is(':checked') || $('#riesgo'+id+'2').is(':checked') || $('#riesgo'+id+'3').is(':checked') ){
                    document.getElementById('riesgoPlan'+id).required = true;
                    $('riesgoPlan'+id).focus();
                }
                else if( $('riesgoPlan'+id).val() != '' )
                    console.log(document.getElementsByName('riesgo'+id).is(':checked'));
                    else document.getElementsByName('riesgoPlan'.id).removeAttribute("required");
                break;
            case 'mitRiesgo':
                if ( $('#mitRiesgo'+id+'1').is(':checked') || $('#mitRiesgo'+id+'2').is(':checked') || $('#mitRiesgo'+id+'3').is(':checked') ){
                    document.getElementById('mitRiesgoPlan'+id).required = true;
                    $('mitRiesgoPlan'+id).focus();
                }
                else if( $('mitRiesgoPlan'+id).val() != '' )
                    console.log(document.getElementsByName('mitRiesgo'+id).is(':checked'));
                    else document.getElementsByName('mitRiesgoPlan'.id).removeAttribute("required");
                break;
        }
        return false;
    }
    </script>
    
        <!-- Internal Form-elements js-->
        <script src="{{URL::asset('assets/js/select2.js')}}"></script>
@endsection