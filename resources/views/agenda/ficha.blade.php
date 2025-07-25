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
            padding-bottom: 1em;
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
            font-size: 0.895rem;
        }

        .parsley-checkbox{ margin-top: 5px; }

        #tablaAcciones :hover { background-color: #01b8ff; }

        #tablaAcciones :hover select{ background-color: #ffffff; }

        #tablaAcciones select{ color: #a8afc7; }

        #tablaAcciones :hover th{ color: #ffffff; }


        /***********  FLECHAS DE LA TABLA GESTIÓN DE INTERESADOS ***********/
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
        /*********** END FLECHAS ***********/

        .table-bordered thead{ background: transparent; }

        .table-bordered thead th{
            border-top-width: 1px;
            padding-top: 0;
            padding-bottom: 0;
            background-color: transparent;
        }

        .checkbox label::after { margin-left: -47px; }

        h4, .h4 { font-size: 1.6125rem; }

        .row{ padding-top: 2em; }

        /*********** TAMAÑO DEL CHECKBOX SELECCIONADO ***********/
        .checkbox label::before{
            width: 20px;
            height: 20px;
        }

        .checkbox label::after{ font-size: 13px; }
        /*********** END TAMAÑO CHECKBOX ***********/
        
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
    </style>

    <div class="row col-md-10 mr-auto ml-auto" style="place-content: center;">
        <div class="col-md-7 text-right">
            <h2 style="font-family: sans-serif;">Método de Agenda Estratégica</h2>
        </div>
        <div class="col-md-5 text-right" style="align-self: center;">
            <b>Folio: </b>{{$agenda->folio}}
        </div>
        <div class="col-md-12"><hr></div>
        <div class="col-md-12 d-flex text-center" style="font-size: 0.975rem; padding-top: 1em;">
            <div class="pd-10 flex-fill">
                <div class="card custom-card card-draggable">
                    <div class="card-header tx-medium">
                        Meta:
                    </div>
                    <div class="card-body">
                        <p class="mg-b-0" style="text-transform: capitalize;">
                            {!! $agenda->meta !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="pd-10 flex-fill">
                <div class="card custom-card card-draggable">
                    <div class="card-header tx-medium">
                        Solución:
                    </div>
                    <div class="card-body">
                        <p class="mg-b-0" style="text-transform: capitalize;">
                            {{$agenda->solucion}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="pd-10 flex-fill">
                <div class="card custom-card card-draggable">
                    <div class="card-header tx-medium">
                        Ejes: 
                    </div>
                    <div class="card-body">
                        <p class="mg-b-0" style="text-transform: capitalize;">
                            @foreach($agenda->ejes as $eje)
                                {{$eje->eje}} <br>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr><th style="text-align: center; color: #002a80" colspan="2"><h4>Ejes estratégicos y enfoque de la agenda</h4></th></tr>
                    <tr><th></th><th class="tx-15">Conceptos:</th></tr>
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
                <h4>Direcciones que intervienen</h4>
            </div>
            <div class="col-md-12 row">
                <div class="col-md-3"></div>
                <div class="card col-md-6 text-center" style="padding-top: 1em; padding-bottom: 1em;">
                    @foreach($agenda->gabinetes as $gab)
                        {{ $gab['gabinete'] }} <br>
                    @endforeach
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <div class="col-md-12 row">
            <div class="col-md-12 text-center">
                <h4>Grupo Objetivo</h4><hr>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" style="margin-top: 15px; margin-bottom: 15px; padding-right: 15px; padding-left: 15px;">
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
                                        @foreach($agenda->grupObjet as $go)
                                            @if($go->tipo == 1)
                                                <tr>
                                                    <td>
                                                        {{ $go->nombre == 'Otro' ? $go->otro : $go->nombre }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" style="margin-top: 15px; margin-bottom: 15px; padding-right: 15px; padding-left: 15px;">
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
                                        @foreach($agenda->grupObjet as $go)
                                            @if($go->tipo == 2)
                                                <tr>
                                                    <td>
                                                        {{ $go->nombre == 'Otro' ? $go->otro : $go->nombre }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" style="margin-top: 15px; margin-bottom: 15px; padding-right: 15px; padding-left: 15px;">
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
                                        @foreach($agenda->grupObjet as $go)
                                            @if($go->tipo == 3)
                                                <tr>
                                                    <td>
                                                        {{ $go->nombre == 'Otro' ? $go->otro : $go->nombre }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" style="margin-top: 15px; margin-bottom: 15px; padding-right: 15px; padding-left: 15px;">
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
                                        @foreach($agenda->grupObjet as $go)
                                            @if($go->tipo == 4)
                                                <tr>
                                                    <td>
                                                        {{ $go->nombre == 'Otro' ? $go->otro : $go->nombre }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" style="margin-top: 15px; margin-bottom: 15px; padding-right: 15px; padding-left: 15px;">
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
                                        @foreach($agenda->grupObjet as $go)
                                            @if($go->tipo == 5)
                                                <tr>
                                                    <td>
                                                        {{ $go->nombre == 'Otro' ? $go->otro : $go->nombre }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" style="margin-top: 15px; margin-bottom: 15px; padding-right: 15px; padding-left: 15px;">
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
                                        @foreach($agenda->grupObjet as $go)
                                            @if($go->tipo == 6)
                                                <tr>
                                                    <td>
                                                        {{ $go->nombre == 'Otro' ? $go->otro : $go->nombre }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if( @$agenda->ubicacion )
            <div class="col-md-12 row">
                <div class="col-md-12 mr-auto ml-auto">
                    <div class="form-group" style="margin-bottom: 10px; text-align: center">
                        <h4>Zona/Localización</h4>
                        <div class="card" style="margin-bottom: 10px">
                            <div class="card-body">
                                <div id="map" class="map" style="position:relative; height:70em; margin: 1px; border: solid 1px transparent; border-radius: 1em;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-12 row">
            <div class="col-md-12 text-center">
                <h4>Medios de comunicación externos</h4><hr>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" style="margin-top: 15px; margin-bottom: 15px; padding-right: 15px; padding-left: 15px;">
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
                                        @foreach($agenda->medCom as $mc)
                                            @if($mc->tipo == 1)
                                                <tr>
                                                    <td>
                                                        {{ $mc->medio }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" style="margin-top: 15px; margin-bottom: 15px; padding-right: 15px; padding-left: 15px;">
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
                                        @foreach($agenda->medCom as $mc)
                                            @if($mc->tipo == 2)
                                                <tr>
                                                    <td>
                                                        {{ $mc->medio }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" style="margin-top: 15px; margin-bottom: 15px; padding-right: 15px; padding-left: 15px;">
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
                                        @foreach($agenda->medCom as $mc)
                                            @if($mc->tipo == 3)
                                                <tr>
                                                    <td>
                                                        {{ $mc->medio }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" style="margin-top: 15px; margin-bottom: 15px; padding-right: 15px; padding-left: 15px;">
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
                                        @foreach($agenda->medCom as $mc)
                                            @if($mc->tipo == 4)
                                                <tr>
                                                    <td>
                                                        {{ $mc->otro }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
                    <div class="col-md-6 card" style="padding-top: 1em; padding-bottom: 1em;">
                        <div class="footer-widget">
                            <table class="table-borderless table-condensed" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            @foreach($agenda->medCom as $mc)
                                                @if($mc->tipo == 5 && $mc->id != 26)
                                                        <tr>
                                                            <td>
                                                                {{ $mc->medio }}
                                                            </td>
                                                        </tr>
                                                @else @if($mc->id == 26)
                                                        <tr>
                                                            <td>
                                                                {{ $mc->otro }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach
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
                <h4>Datos Generales del Evento</h4><hr>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card custom-card card-draggable">
                        <div class="card-header tx-medium">
                            Título:
                        </div>
                        <div class="card-body">
                            <p class="mg-b-0" style="text-transform: capitalize;">
                                {!! $agenda->titulo_evento !!}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card custom-card card-draggable">
                        <div class="card-header tx-medium">
                            Contenido de la presentación: 
                        </div>
                        <div class="card-body">
                            <p class="mg-b-0" style="text-transform: capitalize;">
                                {{ $agenda->contenido_presentacion }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 text-center" style="font-size: 0.975rem;">
            <div class="card custom-card card-draggable">
                <div class="card-header tx-medium">
                    Invitados
                </div>
                <div class="card-body">
                        <table class="table-borderless table-condensed" style="width: 100%">
                            <tbody>
                                <tr>
                                    <td>
                                        @foreach($agenda->invitados as $invitados)
                                            <div class="col-md-6">
                                                @if($invitados->tipo == 1)
                                                    {{ $invitados->invitado }}
                                                @endif
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($agenda->invitados as $invitados)
                                            <div class="col-md-6">
                                                @if($invitados->tipo == 2)
                                                    {{ $invitados->medio == 'Otros' ? $invitados->otro : $invitados->invitado }}
                                                @endif
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <p class="mg-b-0" style="text-transform: capitalize;">
                        
                    </p>
                </div>
            </div>
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
                        @foreach($agenda->riesgos->where('tipo_matriz', 1) as $riesgo)
                            <tr>
                                <td>{{$riesgo->riesgo}}</td>
                                <td style="text-align:center">
                                    @if($riesgo->cumple == 1 )
                                        <div class="checkbox checkbox-success">
                                            <input type="radio"  checked  disabled>
                                            <label style="margin-bottom:0px">&nbsp;</label>
                                        </div>
                                    @endif
                                </td>
                                <td style="text-align:center">
                                    @if($riesgo->cumple == 2 )
                                        <div class="checkbox checkbox-warning">
                                            <input type="radio"  checked  disabled>
                                            <label style="margin-bottom:0px">&nbsp;</label>
                                        </div>
                                    @endif
                                </td>
                                <td style="text-align:center">
                                    @if($riesgo->cumple == 3 )
                                        <div class="checkbox checkbox-danger">
                                            <input type="radio"  checked  disabled>
                                            <label style="margin-bottom:0px">&nbsp;</label>
                                        </div>
                                    @endif
                                </td>
                                <td style="text-transform: capitalize;">{{$riesgo->plan_accion}}</td>
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
                        @foreach($agenda->riesgos->where('tipo_matriz', 2) as $riesgo)
                        <tr>
                            <td>{{$riesgo->riesgo}}</td>
                            <td style="text-align:center;">
                                @if($riesgo->cumple == 1 )
                                    <div class="checkbox checkbox-success">
                                        <input type="radio"  checked  disabled>
                                        <label style="margin-bottom:0px">&nbsp;</label>
                                    </div>
                                @endif
                            </td>
                            <td style="text-align:center;">
                                @if($riesgo->cumple == 2 )
                                    <div class="checkbox checkbox-warning">
                                        <input type="radio"  checked  disabled>
                                        <label style="margin-bottom:0px">&nbsp;</label>
                                    </div>
                                @endif
                            </td>
                            <td style="text-align:center;">
                                @if($riesgo->cumple == 3)
                                    <div class="checkbox checkbox-danger">
                                        <input type="radio"  checked  disabled>
                                        <label style="margin-bottom:0px">&nbsp;</label>
                                    </div>
                                @endif
                            </td>
                            <td style="text-transform: capitalize;">{{$riesgo->plan_accion}}</td>
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
                        <h4> Gestión de los Interesados </h4>
                    </th>
                </tr>
                <tr>
                    <td> </td>
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
                    <p class="col-md-6" style="text-align: end; float: right; font-size: larger;" id="latentes_neg">
                        @foreach($agenda->interesados->where('poder','alto')->where('interes','alto')->where('tipo',0) as $interesado)
                            {{$interesado->depto}} <br>
                        @endforeach
                    </p>
                    <p class="col-md-6" style="text-align: end; font-size: larger;" id="latentes_pos">
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
                    <p class="col-md-6" style="text-align: end; float: right; font-size: larger;" id="promotores_neg">
                        @foreach($agenda->interesados->where('poder','alto')->where('interes','bajo')->where('tipo',0) as $interesado)
                            {{$interesado->depto}} <br>
                        @endforeach
                    </p>
                    <p class="col-md-6" style="text-align: end; font-size: larger;" id="promotores_pos">
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
                    <p class="col-md-6"style="text-align: end; float: right; font-size: larger;" id="apaticos_neg">
                        @foreach($agenda->interesados->where('poder','bajo')->where('interes','alto')->where('tipo',0) as $interesado)
                            {{$interesado->depto}} <br>
                        @endforeach
                    </p>
                    <p class="col-md-6" style="text-align: end; font-size: larger;" id="apaticos_pos">
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
                    <p class="col-md-6"style="text-align: end; float: right; font-size: larger;" id="defensores_neg">
                        @foreach($agenda->interesados->where('poder','bajo')->where('interes','bajo')->where('tipo',0) as $interesado)
                            {{$interesado->depto}} <br>
                        @endforeach
                    </p>
                    <p class="col-md-6" style="text-align: end; font-size: larger;" id="defensores_pos">
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
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
           <br>
           <a class="btn btn-secondary" href="{{url('/agenda/listado')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
        </div>
    </div>

    @if( @$agenda->ubicacion )
        <script>
            mapboxgl.accessToken = 'pk.eyJ1IjoibWFwZm91bmQiLCJhIjoiY2p5NGp3ZTh2MTg3MDNpbXAxM2MxeGoybiJ9.VXQ3NXUpfX1YRB37TwBMYA';
            const map = new mapboxgl.Map({
                container: 'map', // container ID
                style: 'mapbox://styles/mapbox/streets-v11', // style URL
                center: {!! $agenda->ubicacion !!}, // starting position
                zoom: 15 // starting zoom
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
        </script>
    @endif
@endsection

@section('script')
    <!-- Internal Form-elements js-->
    <script src="{{URL::asset('assets/js/select2.js')}}"></script>
@endsection