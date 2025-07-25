@extends('layouts.app', ['activePage' => 'agendaCreate', 'mainPage' => 'agenda'])
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
    {!! Form::model( @$agenda, ['route' =>[ 'storeAgenda' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data", 'onsubmit'=>"return validar();" ]) !!}

    <div class="row col-md-10 mr-auto ml-auto">
        <div class="col-md-12 text-center">
            <h4>Método de Agenda Estratégica</h4><hr>
        </div>
        <div class="col-md-12">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            Meta:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::textArea('meta',null,['class'=>'form-control','required','placeholder'=>'Escriba la meta','rows'=>'3' ]) !!}<i class="form-group__bar"></i>
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
                        <th>
                            Solución:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::textArea('solucion',null,['class'=>'form-control','required','placeholder'=>'Escriba la solución','rows'=>'3' ]) !!}<i class="form-group__bar"></i>
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
                        <th>
                            Ejes (seleccionar según corresponda):
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="card" style="margin-top: 5px; margin-bottom: 15px">
                                <div class="row mr-auto ml-auto">
                                    @foreach($ejes as $eje)
                                    <div class="col-md-4">
                                        <input type="checkbox" class="btn-check" name="eje" id="eje{{$eje->id}}" autocomplete="off" value="{{$eje->id}}">
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
                    <tr><th></th><th>Conceptos:</th></tr>
                    <tr><th style="text-align: center; color: #002a80" colspan="2">Ejes estratégicos y enfoque de la agenda</th></tr>
                    <tr><td></td><td>A continuación se presenta una breve explicación de cada uno de los ejes:</td></tr>
                    <tr><th colspan="2" style="text-align:center; color: #002a80">Sí San Luis Seguro:</th></tr>
                    <tr><td style=" width: 125px"><img src="{{asset('/img/ejes')}}/seguro.png" alt="Sí San Luis Seguro" width="100"></td>
                        <td style="text-align: justify" class="tdDesign">
                            Fortalecer el tejido social, recuperar las calles y espacios públicos de la delincuencia, crear la
                            Secretaría de Seguridad Ciudadana a través de la implementación del nuevo modelo homologado
                            de justicia cívica, buen gobierno y cultura de la legalidad.
                        </td>
                    </tr>
                    <tr><th colspan="2" style="text-align:center; color: #002a80">Sí San Luis con Bienestar:</th></tr>
                    <tr><td><img src="{{asset('/img/ejes')}}/bienestar.png" alt="Sí San Luis con Bienestar" width="100"></td>
                        <td style="text-align: justify" class="tdDesign">
                            Generar las condiciones para satisfacer conjuntamente una serie de factores que responden a la
                            calidad de vida de las personas. El bienestar social se expresa a través de los niveles de salud,
                            educación, vivienda, bienes de consumo, desarrollo urbano, seguridad y en todos los aspectos
                            relacionados con el medio ambiente
                        </td>
                    </tr>
                    <tr><th colspan="2" style="text-align:center; color: #002a80">Sí San Luis Sostenible:</th></tr>
                    <tr><td><img src="{{asset('/img/ejes')}}/sostenible.png" alt="Sí San Luis Sostenible" width="100"></td>
                        <td style="text-align: justify" class="tdDesign">
                            Adoptar el enfoque de la Agenda 2030 y sus directrices en materia de desarrollo sostenible de
                            manera integral en las atribuciones del H. Ayuntamiento para combatir la desigualdad, generar una
                            sociedad pacífica e inclusiva, proteger la vida y los ecosistemas naturales y abordar de manera
                            urgente los efectos del cambio climático.
                            En otras palabras, el desarrollo sostenible es aquel capaz de satisfacer las necesidades del presente
                            sin comprometer la capacidad de las futuras generaciones para satisfacer sus propias necesidades
                            tanto en el ámbito social, ambiental y económico.
                        </td>
                    </tr>
                    <tr><th colspan="2" style="text-align:center; color: #002a80">Sí San Luis Innovador:</th></tr>
                    <tr><td><img src="{{asset('/img/ejes')}}/innovador.png" alt="Sí San Luis Innovador" width="100"></td>
                        <td style="text-align: justify" class="tdDesign">
                            Promover la conectividad entre la ciudadanía, su gobierno y los actores políticos, públicos y
                            privados, para la mejor toma de decisiones, gestión ágil y eficiente de trámites para elevar el nivel
                            de calidad de vida con un uso responsable, productivo y transparente de las tecnologías de la
                            información y comunicación.
                        </td>
                    </tr>
                    <tr><th colspan="2" style="text-align:center; color: #002a80">Sí San Luis Competitivo:</th></tr>
                    <tr><td><img src="{{asset('/img/ejes')}}/competitivo.png" alt="Sí San Luis Competitivo" width="100"></td>
                        <td style="text-align: justify" class="tdDesign">
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
                <h4>Direcciones que intervienen</h4>
            </div>
            <div class="col-md-12">
                <!--<div class="col-md-8 ml-2">-->
                {{Form::select('direcciones[]',$direcciones,null,['multiple','size'=>'10'])}}
                <script>
                    $('select[name="direcciones[]"]').bootstrapDualListbox();
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
                                <ul><li><b>EDADES</b> Toma de decisión de los padres</li></ul>
                            </div>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="margin-top: 5px; margin-bottom: 15px;">
                                                    <div class="col-md-12">
                                                        <label for="go_1"><input type="checkbox" class="btn-check" name="go_1" id="go_1" autocomplete="off" onclick="selectAll('go_1')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span>
                                                        </label>
                                                    </div>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($go[1] as $go1)
                                                <div class="col-md-12">
                                                    <label class="" for="go{{$go1->id}}" style="color:#000"><input type="checkbox" class="btn-check" name="go[]" id="go{{$go1->id}}" autocomplete="off" value="{{$go1->id}}" @if ($loop->last) onclick="deSelect('go_1','go{{$go1->id}}'); otrosCampo(this.id, 'decPadres');" @else onclick="deSelect('go_1','go{{$go1->id}}');" @endif> {{$go1->nombre}}</label>
                                                </div>
                                                @endforeach
                                                <div class="form-group" id="decPadresOtros" style="width: 70%; margin-left: 3em; display: none;">
                                                    {!! Form::text('otros'.$go1->id,null,['class'=>'form-control','placeholder'=>'Otras edades con decisión parental']) !!}<i class="form-group__bar"></i>
                                                </div>
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
                                <ul><li><b>EDADES</b> Toma de decisión propia</li></ul>
                            </div>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="margin-top: 5px; margin-bottom: 15px">
                                                    <label class="ckbox mg-b-15-f" for="go_2"><input type="checkbox" class="btn-check" name="go_2" id="go_2" autocomplete="off" onclick="selectAll('go_2')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($go[2] as $go2)
                                                <div class="col-md-12">
                                                    <label class="" for="go{{$go2->id}}" style="color:#000"><input type="checkbox" class="btn-check" name="go[]" id="go{{$go2->id}}" autocomplete="off" value="{{$go2->id}}" @if ($loop->last) onclick="deSelect('go_2','go{{$go2->id}}'); otrosCampo(this.id, 'decPropia');" @else onclick="deSelect('go_2','go{{$go2->id}}');" @endif> {{$go2->nombre}}</label>
                                                </div>
                                                @endforeach
                                                <div class="form-group" style="width: 70%; margin-left: 3em; display: none;" id="decPropiaOtros">
                                                    {!! Form::text('otros'.$go2->id,null,['class'=>'form-control','placeholder'=>'Otras edades con decisión propia']) !!}<i class="form-group__bar"></i>
                                                </div>
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
                                <ul><li><b>NSE</b></li></ul>
                            </div>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="margin-top: 5px; margin-bottom: 15px">
                                                    <label class="ckbox mg-b-15-f" for="go_3"><input type="checkbox" class="btn-check" name="go_3" id="go_3" autocomplete="off" onclick="selectAll('go_3')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($go[3] as $go3)
                                                <div class="col-md-12">
                                                    <label class="" for="go{{$go3->id}}" style="color:#000"><input type="checkbox" class="btn-check" name="go[]" id="go{{$go3->id}}" autocomplete="off" value="{{$go3->id}}" @if ($loop->last) onclick="deSelect('go_3','go{{$go3->id}}'); otrosCampo(this.id, 'nse');" @else onclick="deSelect('go_3','go{{$go3->id}}');" @endif> {{$go3->nombre}}</label>
                                                </div>
                                                @endforeach
                                                <div class="form-group" style="width: 70%; margin-left: 3em; display: none;" id="nseOtros">
                                                    {!! Form::text('otros'.$go3->id,null,['class'=>'form-control','placeholder'=>'Otro NSE']) !!}<i class="form-group__bar"></i>
                                                </div>
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
                                <ul><li><b>GÉNERO</b></li></ul>
                            </div>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="margin-top: 5px; margin-bottom: 15px">
                                                    <label class="ckbox mg-b-15-f" for="go_4"><input type="checkbox" class="btn-check" name="go_4" id="go_4" autocomplete="off" onclick="selectAll('go_4')"> <span style="color: #615f62; font-size: 13px;"> TODOS</span></label>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($go[4] as $go4)
                                                <div class="col-md-12">
                                                    <label class="" for="go{{$go4->id}}" style="color:#000"><input type="checkbox" class="btn-check" name="go[]" id="go{{$go4->id}}" autocomplete="off" value="{{$go4->id}}" @if ($loop->last) onclick="deSelect('go_4','go{{$go4->id}}'); otrosCampo(this.id, 'genero');" @else onclick="deSelect('go_4','go{{$go4->id}}')" @endif> {{$go4->nombre}}</label>
                                                </div>
                                                @endforeach
                                                <div class="form-group" style="width: 70%; margin-left: 3em; display: none;" id="generoOtros">
                                                    {!! Form::text('otros'.$go4->id,null,['class'=>'form-control','placeholder'=>'Otro género']) !!}<i class="form-group__bar"></i>
                                                </div>
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
                                <ul><li><b>GRUPO OBJETIVO</b></li></ul>
                            </div>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="margin-top: 5px; margin-bottom: 15px">
                                                    <label class="ckbox mg-b-15-f" for="go_5"><input type="checkbox" class="btn-check" name="go_5" id="go_5" autocomplete="off" onclick="selectAll('go_5')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($go[5] as $go5)
                                                <div class="col-md-12">
                                                    <label class="" for="go{{$go5->id}}" style="color:#000"><input type="checkbox" class="btn-check" name="go[]" id="go{{$go5->id}}" autocomplete="off" value="{{$go5->id}}"> {{$go5->nombre}}</label>
                                                </div>
                                                @endforeach
                                                <div class="form-group" style="width: 70%; margin-left: 3em; display: none;" id="gr_objOtros">
                                                    {!! Form::text('otros'.$go5->id,null,['class'=>'form-control','placeholder'=>'Otros grupos objetivos']) !!}<i class="form-group__bar"></i>
                                                </div>
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
                                <ul><li><b>NIVEL DE EDUCACIÓN</b></li></ul>
                            </div>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="margin-top: 5px; margin-bottom: 15px">
                                                    <label class="ckbox mg-b-15-f" for="go_6"><input type="checkbox" class="btn-check" name="go_6" id="go_6" autocomplete="off" onclick="selectAll('go_6')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($go[6] as $go6)
                                                <div class="col-md-12" >
                                                    <label class="" for="go{{$go6->id}}" style="color:#000"><input type="checkbox" class="btn-check" name="go[]" id="go{{$go6->id}}" autocomplete="off" value="{{$go6->id}}"> {{$go6->nombre}}</label>
                                                </div>
                                                @endforeach
                                                <div class="form-group" style="width: 70%; margin-left: 3em; display: none;" id="nvlEducOtros">
                                                    {!! Form::text('otros'.$go6->id,null,['class'=>'form-control','placeholder'=>'Otros niveles de educación']) !!}<i class="form-group__bar"></i>
                                                </div>
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
                    <b>Zona/Localización</b>
                    <a class="form-control" onclick="desplegarMap()" style="text-align: start; color: silver; font-size: inherit;" type="none" data-toggle="modal" data-target=".bd-example-modal-lg" id="btnMap">Seleccione la localización en el mapa</a>
                    <i class="form-group__bar"></i>
                    <input type="hidden" name="ubicacion" value="" id="ubicacion">
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
                                <ul><li><b>DIGITAL</b></li></ul>
                            </div>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="margin-top: 5px; margin-bottom: 15px;">
                                                    <label class="ckbox mg-b-15-f" for="mce_1"><input type="checkbox" class="btn-check" name="mce_1" id="mce_1" autocomplete="off" onclick="selectAll('mce_1')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($mc[1] as $mc1)
                                                <div class="col-md-12">
                                                    <label class="" for="mc{{$mc1->id}}" style="color:#000"><input type="checkbox" class="btn-check" name="mc[]" id="mc{{$mc1->id}}" autocomplete="off" value="{{$mc1->id}}"> {{$mc1->medio}}</label>
                                                </div>
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
                                <ul><li><b>PRESENCIAL</b></li></ul>
                            </div>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="margin-top: 5px; margin-bottom: 15px">
                                                    <label class="ckbox mg-b-15-f" for="mce_2"><input type="checkbox" class="btn-check" name="mce_2" id="mce_2" autocomplete="off" onclick="selectAll('mce_2')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($mc[2] as $mc2)
                                                <div class="col-md-12">
                                                    <label class="" for="mc{{$mc2->id}}" style="color:#000"><input type="checkbox" class="btn-check" name="mc[]" id="mc{{$mc2->id}}" autocomplete="off" value="{{$mc2->id}}"> {{$mc2->medio}}</label>
                                                </div>
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
                                <ul><li><b>TRADICIONALES</b></li></ul>
                            </div>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="margin-top: 5px; margin-bottom: 15px;">
                                                    <label class="ckbox mg-b-15-f" for="mce_3"><input type="checkbox" class="btn-check" name="mce_3" id="mce_3" autocomplete="off" onclick="selectAll('mce_3')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em;margin-bottom: 1em;width: 20%;margin-left: 7px;">
                                                @foreach($mc[3] as $mc3)
                                                <div class="col-md-12">
                                                    <label class="" for="mc{{$mc3->id}}" style="color:#000"><input type="checkbox" class="btn-check" name="mc[]" id="mc{{$mc3->id}}" autocomplete="off" value="{{$mc3->id}}"> {{$mc3->medio}}</label>
                                                </div>
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
                                <ul><li><b>OTROS</b></li></ul>
                            </div>
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="margin-top: 5px; margin-bottom: 15px">
                                                <div class="col-md-12">
                                                    {!! Form::text('otrosMc18',null,['class'=>'form-control','placeholder'=>'Otros medios de comunicación externos']) !!}
                                                </div>
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
                                            <div style="margin-top: 5px; margin-bottom: 15px;">
                                                    <label class="ckbox mg-b-15-f" for="mci_1"><input type="checkbox" class="btn-check" name="mci_1" id="mci" autocomplete="off" onclick="selectAll('mci')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em; margin-bottom: 1em; width: 60%; margin-left: 1px;">
                                                @foreach($mc[5] as $mc5)
                                                <div class="col-md-12">
                                                    <label class="" for="mc{{$mc5->id}}" style="color:#000"><input type="checkbox" class="btn-check" name="mc[]" id="mc{{$mc5->id}}" autocomplete="off" value="{{$mc5->id}}" @if ($loop->last) onclick="deSelect('mci','mc{{$mc5->id}}'); otrosCampo(this.id, 'medComInt');" @else onclick="deSelect('mci','mc{{$mc5->id}}');" @endif> {{$mc5->medio}}</label>
                                                </div>
                                                @endforeach
                                                <div class="form-group" style="width: 70%; margin-left: 3em; display: none;" id="medComIntOtros">
                                                    {!! Form::text('otrosMc'.$mc5->id,null,['class'=>'form-control','placeholder'=>'Otros medios de comunicación internos']) !!}<i class="form-group__bar"></i>
                                                </div>
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
                            Título:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::textArea('titulo',null,['class'=>'form-control','required','placeholder'=>'Escriba el título del evento','rows'=>'2' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12 row">
            <div class="col-md-12">
                <p style="font-size: 15px"><b>Invitados</b></p>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 card" style="margin-top: 15px; margin-bottom: 15px">
                        <div class="footer-widget">
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="margin-top: 5px; margin-bottom: 15px;">
                                                    <label class="ckbox mg-b-15-f" for="ia_1"><input type="checkbox" class="btn-check" name="ia_1" id="ia_1" autocomplete="off" onclick="selectAll('ia_1')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em; margin-bottom: 1em; width: 60%; margin-left: 1px;">
                                                @foreach($ia[1] as $ia1)
                                                <div class="col-md-12">
                                                    <label class="" for="ia{{$ia1->id}}" style="color:#000"><input type="checkbox" class="btn-check" name="ia[]" id="ia{{$ia1->id}}" autocomplete="off" value="{{$ia1->id}}"> {{$ia1->invitado}}</label>
                                                </div>
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
                                            <div style="margin-top: 5px; margin-bottom: 15px;">
                                                    <label class="ckbox mg-b-15-f" for="ia_2"><input type="checkbox" class="btn-check" name="ia_2" id="ia_2" autocomplete="off" onclick="selectAll('ia_2')"> <span style="color: #615f62; font-size: 13px;"> TODOS </span> </label>
                                                    <hr style="margin-top: -0.1em; margin-bottom: 1em; width: 60%; margin-left: 1px;">
                                                @foreach($ia[2] as $ia2)
                                                <div class="col-md-12">
                                                    <label class="" for="ia{{$ia2->id}}" style="color:#000"><input type="checkbox" class="btn-check" name="ia[]" id="ia{{$ia2->id}}" autocomplete="off" value="{{$ia2->id}}" @if ($loop->last) onclick="deSelect('ia_2','ia{{$ia2->id}}'); otrosCampo(this.id, 'inv');" @else onclick="deSelect('ia_2','ia{{$ia2->id}}');" @endif> {{$ia2->invitado}}</label>
                                                </div>
                                                @endforeach
                                                <div class="form-group" style="width: 70%; margin-left: 3em; display: none;" id="invOtros">
                                                    {!! Form::text('otrosInv15',null,['class'=>'form-control','placeholder'=>'Otros invitados']) !!}<i class="form-group__bar"></i>
                                                </div>
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
                        <th>
                            Contenido de la presentación:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::textArea('contenido',null,['class'=>'form-control','required','placeholder'=>'Escriba el contenido de la presentación','rows'=>'3' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12 text-center">
            <h4>Matriz de riesgos</h4><hr>
        </div>
        <div class="col-md-12">
            <table class="table-bordered table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr style="text-align: center">
                        <th></th>
                        <th colspan="3">Cumple</th>
                        <th></th>
                    </tr>
                    <tr style="text-align: center">
                        <th>Criterios</th>
                        <th style=" background-color: #00cc00">Alto</th>
                        <th style=" background-color: #ffcc33">Medio</th>
                        <th style=" background-color: #ff9900">Bajo</th>
                        <th style=" background-color: #fff4d3">Plan de acción</th>
                    </tr>
                    @foreach($riesgos as $riesgo)
                    <tr>
                        <td>{{$riesgo->riesgo}}</td>
                        <td style="text-align:center">
                            <div class="checkbox checkbox-success">
                                <input type="radio" id="riesgo{{$riesgo->id}}1" value="1" name="riesgo{{$riesgo->id}}" onchange="checkInput('riesgo', {{$riesgo->id}});">
                                <label for='riesgo{{$riesgo->id}}1' style="margin-bottom:0px">&nbsp;</label>
                            </div>
                        </td>
                        <td style="text-align:center">
                            <div class="checkbox checkbox-warning">
                                <input type="radio" id="riesgo{{$riesgo->id}}2" value="2" name="riesgo{{$riesgo->id}}" onchange="checkInput('riesgo', {{$riesgo->id}});">
                                <label for='riesgo{{$riesgo->id}}2' style="margin-bottom:0px">&nbsp;</label>
                            </div>
                        </td>
                        <td style="text-align:center">
                            <div class="checkbox checkbox-danger">
                                <input type="radio" id="riesgo{{$riesgo->id}}3" value="3" name="riesgo{{$riesgo->id}}" onchange="checkInput('riesgo', {{$riesgo->id}});">
                                <label for='riesgo{{$riesgo->id}}3' style="margin-bottom:0px">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            {{Form::text('riesgoPlan'.$riesgo->id,null,['id' => 'riesgoPlan'.$riesgo->id, 'class'=>'form-control','placeholder'=>'Escriba el plan de acción para '.$riesgo->riesgo, 'onchange' => "checkInput('riesgo', $riesgo->id);"])}}
                            <i class="form-group__bar"></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12 text-center" style="padding-top: 20px">
            <h4>Matriz de mitigación de riesgos</h4><hr>
        </div>
        <div class="col-md-12">
            <table class="table-bordered table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr style="text-align: center">
                        <th></th>
                        <th colspan="3">Cumple</th>
                        <th></th>
                    </tr>
                    <tr style="text-align: center">
                        <th>Criterios</th>
                        <th style=" background-color: #00cc00">Alto</th>
                        <th style=" background-color: #ffcc33">Medio</th>
                        <th style=" background-color: #ff9900">Bajo</th>
                        <th style=" background-color: #fff4d3">Plan de acción</th>
                    </tr>
                    @foreach($riesgos as $riesgo)
                    <tr>
                        <td>{{$riesgo->riesgo}}</td>
                        <td style="text-align:center">
                            <div class="checkbox checkbox-success">
                                <input type="radio" id="mitRiesgo{{$riesgo->id}}1" value="1" name="mitRiesgo{{$riesgo->id}}" onchange="checkInput('mitRiesgo', {{$riesgo->id}});">
                                <label for='mitRiesgo{{$riesgo->id}}1' style="margin-bottom:0px">&nbsp;</label>
                            </div>
                        </td>
                        <td style="text-align:center">
                            <div class="checkbox checkbox-warning">
                                <input type="radio" id="mitRiesgo{{$riesgo->id}}2" value="2" name="mitRiesgo{{$riesgo->id}}" onchange="checkInput('mitRiesgo', {{$riesgo->id}});">
                                <label for='mitRiesgo{{$riesgo->id}}2' style="margin-bottom:0px">&nbsp;</label>
                            </div>
                        </td>
                        <td style="text-align:center">
                            <div class="checkbox checkbox-danger">
                                <input type="radio" id="mitRiesgo{{$riesgo->id}}3" value="3" name="mitRiesgo{{$riesgo->id}}" onchange="checkInput('mitRiesgo', {{$riesgo->id}});">
                                <label for='mitRiesgo{{$riesgo->id}}3' style="margin-bottom:0px">&nbsp;</label>
                            </div>
                        </td>
                        <td>{{Form::text('mitRiesgoPlan'.$riesgo->id,null,['id' => 'mitRiesgoPlan'.$riesgo->id, 'class'=>'form-control','placeholder'=>'Escriba el plan de acción para '.$riesgo->riesgo, 'onchange' => "checkInput('mitRiesgo', $riesgo->id);"])}}<i class="form-group__bar"></i></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
                                                    <tr>
                                                        <td><div class="col-md-12" style="margin-bottom: 10px">{!! Form::select('interesado[]', $interesados, null, ['class'=>'form-control','id'=>'interesado1','placeholder'=>'Seleccione departamento...', 'onchange' => 'matriz(this);']) !!}<i class="form-group__bar"></i></div></td>
                                                        <td><div class="col-md-12" style="margin-bottom: 10px">{!! Form::select('poder[]',array('alto' => 'Alto', 'bajo' => 'Bajo'),null,['class'=>'form-control','id'=>'poder1','placeholder'=>'Seleccione tipo de poder...', 'onchange' => 'matriz(this);']) !!}<i class="form-group__bar"></i></div></td>
                                                        <td><div class="col-md-12" style="margin-bottom: 10px">{!! Form::select('interes[]',array('alto' => 'Alto', 'bajo' => 'Bajo'),null,['class'=>'form-control','id'=>'interes1','placeholder'=>'Seleccione el tipo de interés...', 'onchange' => 'matriz(this);']) !!}<i class="form-group__bar"></i></div></td>
                                                        <td><div class="col-md-12" style="margin-bottom: 10px">{!! Form::select('tip[]', array(1 => '+', 0 => '-'),null,['class'=>'form-control','id'=>'tip1','placeholder'=>'Seleccione tipo...', 'onchange' => 'matriz(this);']) !!}<i class="form-group__bar"></i></div></td>
                                                        <td><button class="btn btn-sm text-white" style="color: red; cursor: not-allowed" type="button" disabled><i class="fa fa-minus-square"></i></button></td>
                                                    </tr>
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
    </div>

    <div class="row row-sm">
        <div class="col-md">
            <div class="vertical arriba" style="text-align: right;"> ALTO </div>
        </div>
        <div class="col-md ">
            <div class="card custom-card">
                <div class="card-body" style="background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgb(233 218 180) 100%); border-top-left-radius: 1em; overflow: hidden; max-height: fit-content; display: -webkit-inline-box;">
                    <p class="col-md-6"style="text-align: end; float: right; font-weight: bold;" id="latentes_neg"> </p>
                    <p class="col-md-6" style="text-align: end; font-weight: bold;" id="latentes_pos"> </p>
                    <div id="watermark">
                       <p style="color: #d9d4c6; top: 0.7em; left: 1em;"> <b> Latentes </b> <br><br> Informar </p>
                    </div>
                </div>
                <div class="card-footer" style="text-align-last: justify; width: 70%; place-self: center;">
                    <i class="fa fa-plus-circle fa-2x text-success" data-toggle="tooltip" title="" data-original-title="Positivo"></i>
                    <i class="fa fa-minus-circle fa-2x text-danger" data-toggle="tooltip" title="" data-original-title="Negativo"></i>
                </div>
            </div>
        </div>
        <div class="col-md ">
            <div class="card custom-card">
                <div class="card-body" style="background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgb(233 181 182) 100%); border-top-right-radius: 1em; overflow: hidden; max-height: fit-content; display: -webkit-inline-box;">
                    <p class="col-md-6"style="text-align: end; float: right; font-weight: bold;" id="promotores_neg"> </p>
                    <p class="col-md-6" style="text-align: end; font-weight: bold;" id="promotores_pos"> </p>
                    <div id="watermark">
                       <p style="color: #e9c2c3; right: 1em; top: 0.7em;"> <b> Promotores </b> <br><br> Involucrar </p>
                    </div>
                </div>
                <div class="card-footer" style="text-align-last: justify; width: 70%; place-self: center;">
                    <i class="fa fa-plus-circle fa-2x text-success" data-toggle="tooltip" title="" data-original-title="Positivo"></i>
                    <i class="fa fa-minus-circle fa-2x text-danger" data-toggle="tooltip" title="" data-original-title="Negativo"></i>
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
                <div class="card-body" style="background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgb(155 226 227) 100%); border-top-left-radius: 1em; overflow: hidden; max-height: fit-content; display: -webkit-inline-box;">
                    <p class="col-md-6"style="text-align: end; float: right; font-weight: bold;" id="apaticos_neg"> </p>
                    <p class="col-md-6" style="text-align: end; font-weight: bold;" id="apaticos_pos"> </p>
                    <div id="watermark">
                       <p style="left: 1em; color: #aedadb;"> Monitorizar <br><br> <b> Apáticos </b> </p>
                    </div>
                </div>
                <div class="card-footer" style="text-align-last: justify; width: 70%; place-self: center;">
                    <i class="fa fa-plus-circle fa-2x text-success" data-toggle="tooltip" title="" data-original-title="Positivo"></i>
                    <i class="fa fa-minus-circle fa-2x text-danger" data-toggle="tooltip" title="" data-original-title="Negativo"></i>
                </div>
            </div>
        </div>
        <div class="col-md ">
            <div class="card custom-card">
                <div class="card-body" style="background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgb(216 198 241) 100%); border-top-right-radius: 1em; overflow: hidden; max-height: fit-content; display: -webkit-inline-box;">
                    <p class="col-md-6"style="text-align: end; float: right; font-weight: bold;" id="defensores_neg"> </p>
                    <p class="col-md-6" style="text-align: end; font-weight: bold;" id="defensores_pos"> </p>
                    <div id="watermark">
                       <p style="color: #d6cde3; right: 1em; top: 0.8em;"> Reportar <br><br> <b> Defensores </b> </p>
                    </div>
                </div>
                <div class="card-footer" style="text-align-last: justify; width: 70%; place-self: center;">
                    <i class="fa fa-plus-circle fa-2x text-success" data-toggle="tooltip" title="" data-original-title="Positivo"></i>
                    <i class="fa fa-minus-circle fa-2x text-danger" data-toggle="tooltip" title="" data-original-title="Negativo"></i>
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
                center: [-100.97633711684888, 22.151434736659397], // starting position
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
            for(var i = 0; i < interesadosSelect.length; i++) {
                const numId = interesadosSelect[i].id.replace( /^\D+/g, '');
                if( $("#interesado"+numId).val() && $("#tip"+numId).val() ) {
                    const deptoSelected = $('select[id="interesado'+numId+'"] option:selected').text();
                    if( $("#poder"+numId).val() == 'alto' && $("#interes"+numId).val() == 'alto' )
                        if( $("#tip"+numId).val() == 0)
                            latentes_neg += ( (latentes_neg != '') ? '<br>' : '' ) + deptoSelected;
                        else
                            latentes_pos = latentes_pos + ( (latentes_pos != '') ? '<br>' : '' ) + deptoSelected;
                    if( $("#poder"+numId).val() == 'alto' && $("#interes"+numId).val() == 'bajo' )
                        if( $("#tip"+numId).val() == 0)
                            promotores_neg += ( (promotores_neg != '') ? '<br>' : '' ) + deptoSelected;
                        else
                            promotores_pos += ( (promotores_pos != '') ? '<br>' : '' ) + deptoSelected;
                    if( $("#poder"+numId).val() == 'bajo' && $("#interes"+numId).val() == 'alto' )
                        if( $("#tip"+numId).val() == 0)
                            apaticos_neg += ( (apaticos_neg != '') ? '<br>' : '' ) + deptoSelected;
                        else
                            apaticos_pos += ( (apaticos_pos != '') ? '<br>' : '' ) + deptoSelected;
                    if( $("#poder"+numId).val() == 'bajo' && $("#interes"+numId).val() == 'bajo' )
                        if( $("#tip"+numId).val() == 0)
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

        function validar(){
            if($('#ubicacion').val() != '' && $('select[name="direcciones[]_helper2"] > option').length > 0 )
                return true;
            else{
                if( $('#ubicacion').val() == '' ){
                    $("#ubicInput").focus();
                    notificacion("Alerta","Falta agregar la ubicación.","warning");
                }
                else{
                    window.location.href = '#direccInterv';
                    notificacion("Alerta","Falta seleccionar las direcciones que intervienen.","warning");
                }
                return false;
            }
        }
    </script>
@endsection