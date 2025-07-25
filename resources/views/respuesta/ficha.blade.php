@extends('layouts.app')
@section('title', 'Main page')
@section('content')
    <style>
        table {
            border-collapse: separate;
            border-spacing: 0;
        }
        table, td {
            border: 1px solid #eee;
            border-radius: 3px;
            -moz-border-radius: 3px;
            padding: 3px;
        }
    </style>

    {!! Html::style('css/awesome-bootstrap-checkbox.css') !!}

    @auth
        @if( $reporte->vo_bo_director == false )
            {!! Form::model( @$agenda, ['route' =>[ 'storeRespuestaDirectivos' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
        @endif
    @else
        @if( $reporte->vo_bo_solicitante == false )
            {!! Form::model( @$agenda, ['route' =>[ 'storeVoBoSolicitante' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
        @endif
    @endauth
        <input type="hidden" value='{{ $reporte->id }}' name='id'>

        <div class="row pb-15">
            <div class="col-md-12" style="padding-top: 10px">
                <h3 style="text-align: center; margin-top: 0px"><b>FOLIO: {{$reporte->folio}}</b></h3>
            </div>
            <div class="col-md-6" style="padding-top: 10px">
                <table style="width: 100%; text-align: center">
                    <tbody>
                        <tr style="background-color:#073656; color: white">
                            <th colspan="3" style="text-align: center"><h4><b>Datos generales del reporte</b></h4></th>
                        </tr>
                        <tr style="background-color:#ddd">
                            <th colspan="3" style="text-align: center">Descripción de la incidencia</th>
                        </tr>
                        <tr>
                            <td colspan="3"><h4>{{ $reporte->observaciones }}</h4></td>
                        </tr>
                        <tr style="background-color:#ddd">
                            <th>Medio de recepción</th>
                            <th>Área de atención</th>
                            <th>Tipo de atención</th>
                        </tr>
                        <tr>
                            <td>{{ $reporte->medio()->medio }}</td>
                            <td>{{ $reporte->area()->area }}</td>
                            <td>{{ $reporte->falla()->falla }}</td>
                        </tr>
                        <tr style="background-color:#ddd">
                            <th colspan="3" style="text-align: center">Ubicación</th>
                        </tr>
                        <tr>
                            <td colspan="3">{{ $reporte->calle()->d_calle }} #{{ $reporte->numext }}, {{ $reporte->colonia()->d_asenta }} - Entre calles {{ $reporte->calle1 }} y {{ $reporte->calle2 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6" style="padding-top: 10px">
                <table style="width: 100%; text-align: center">
                    <tbody>
                        <!-- SOLICITANTE -->
                        <tr style="background-color:#073656; color: white">
                            <th colspan="3" style="text-align: center"><h4><b>Solicitante</b></h4></th>
                        </tr>
                        <tr style="background-color:#ddd">
                            <th colspan="2" style="text-align: center">Nombre completo</th>
                            <th>Teléfono</th>
                        </tr>
                        <tr>
                            <td colspan="2"><h4>{{ $reporte->nombre }} {{ $reporte->ap_paterno }} {{ $reporte->ap_materno }}</h4></td>
                            <td>{{ $reporte->telefono }}</td>
                        </tr>
                        <tr style="background-color:#ddd">
                            <th>Correo electrónico</th>
                            <th>Género</th>
                            <th>Rango de edad</th>
                        </tr>
                        <tr>
                            <td>{{ $reporte->email }}</td>
                            <td>{{ $reporte->genero() }}</td>
                            <td>{{ $reporte->edad() }}</td>
                        </tr>
                        <tr style="background-color:#ddd">
                            <th colspan="3" style="text-align: center">Información adicional</th>
                        </tr>
                        <tr>
                            <td colspan="3">{{ ($reporte->adicional==null) ? 'Sin información adicional' : $reporte->adicional }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6" style="padding-top: 10px">
                <table style="width: 100%; text-align: center">
                    <tbody>
                        <tr style="background-color:#ddd">
                            <th>Ubicación en el mapa</th>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{$ubicacion}}" target="_blank">
                                    <img src="https://maps.googleapis.com/maps/api/staticmap?center={{ $reporte->latitud }},{{ $reporte->longitud }}&amp;zoom=17&amp;size=400x300&scale=1&amp;markers={{ $reporte->latitud }},{{ $reporte->longitud }}&amp;key=AIzaSyDIJ4iiYO9sANnnb1XZEepN2xI8B8hivSQ" alt="Ubicacion">
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6" style="padding-top: 10px">
                <table style="width: 100%; text-align: center">
                    <tbody>
                        <tr style="background-color:#ddd">
                            <th>Evidencia fotográfica</th>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{asset("reportes/".$reporte->evidencia)}}" target="_blank">
                                    <img src="{{asset("reportes/".$reporte->evidencia)}}" alt="Evidencia" style="max-width: 300px; max-height: 300px">
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><br>

    @auth
        @if( $reporte->vo_bo_solicitante )
            @if( $reporte->vo_bo_director )
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center" style="padding-top: 1.2em;">
                        <div class="checkbox checkbox-danger" style="border: #b61818 solid; width: fit-content; padding: 1em; display: inline-flex;">
                            <input type="checkbox" id="prioridad" name="prioridad" @if( $reporte->prioridad ) checked value = 1 @endif>
                            <label for='prioridad' style="margin-bottom:0px; font-size: 0.95rem; line-height: 1.7em; color: #8f4b4b;"> &nbsp; Emergencia / Prioridad </label>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6 text-right"><br>
                        <a class="btn btn-secondary" href="{{url('/areaAtencionIndex/'.$reporte->area)}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center" style="padding-top: 1.2em;">
                        <div class="text-center" style="border: #4caf50 solid; width: fit-content; padding: 1em; display: inline-flex;">
                            <label style="margin-bottom:0px; font-size: 0.95rem; line-height: 1.7em; color: #4caf50;"> &nbsp; Solicitud Correcta. </label>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center"><br>
                        <label style="margin-bottom:0px; font-size: 0.95rem; line-height: 1.7em;"> &nbsp; La solicitud ya fue revisada por el solicitante y el Director. </label>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-2 col-sm-6 col-xs-6 text-center" style="padding-top: 1.2em;">
                        <div class="checkbox checkbox-danger" style="border: #b61818 solid; width: fit-content; padding: 1em; display: inline-flex;">
                            <input type="checkbox" id="prioridad" name="prioridad" @if( $reporte->prioridad ) checked value = 1 @endif>
                            <label for='prioridad' style="margin-bottom:0px; font-size: 0.95rem; line-height: 1.7em; color: #8f4b4b;"> &nbsp; Emergencia / Prioridad </label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6 text-center" style="padding-top: 1.2em;">
                        <div class="checkbox checkbox-success" style="border: #4caf50 solid; width: fit-content; padding: 1em; display: inline-flex;">
                            <input type="checkbox" id="vo_bo_director" name="vo_bo_director" required>
                            <label for='vo_bo_director' style="margin-bottom:0px; font-size: 0.95rem; line-height: 1.7em; color: #4caf50;"> &nbsp; Visto bueno por parte del director </label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6 text-left"><br>
                        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
                        <a class="btn btn-secondary" href="{{url('/areaAtencionIndex/'.$reporte->area)}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6 text-center"><br>
                        <label style="margin-bottom:0px; font-size: 0.95rem; line-height: 1.7em;"> &nbsp; La solicitud ya fue revisada por el solicitante. </label>
                    </div>
                </div>
            @endif
        @else
            <div class="row">
                <div class="col-md-5 col-sm-6 col-xs-6 text-center" style="padding-top: 1.2em;">
                    <div class="checkbox checkbox-danger" style="border: #b61818 solid; width: fit-content; padding: 1em; display: inline-flex;">
                        <input type="checkbox" id="prioridad" name="prioridad" @if( $reporte->prioridad ) checked value = 1 @endif>
                        <label for='prioridad' style="margin-bottom:0px; font-size: 0.95rem; line-height: 1.7em; color: #8f4b4b;"> &nbsp; Emergencia / Prioridad </label>
                    </div>
                </div>
                <div class="col-md-7 col-sm-6 col-xs-6 text-left"><br>
                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
                    <a class="btn btn-secondary" href="{{url('/areaAtencionIndex/'.$reporte->area)}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
                </div>
            </div>
        @endif
    @else
        <div class="row">
            <div class="col-md-12">
                <table class="dataTable table-borderless table-condensed" style="width: 100%" id="tablaAvances">
                    <tbody>
                            <tr style="background-color:#073656; color: white">
                                <th style="text-align: center"> Acción </th>
                                <th style="text-align: center"> Fecha </th>
                                <th style="text-align: center"> Hora </th>
                                <th style="text-align: center"> Actividad </th>
                                <th style="text-align: center"> Avance </th>
                            </tr>
                            <tr>
                                <td style="text-align: center">ALTA</td>
                                <td style="text-align: center"> {!! date( 'd/m/Y', strtotime($reporte->fecha) ) !!}</td>
                                <td style="text-align: center"> {!! date( 'H:i A', strtotime($reporte->fecha) ) !!}</td>
                                <td> Se dio de alta un nuevo reporte en <b>{{ $reporte->area()->area }}</b> para la atención de <b>{{ $reporte->falla()->falla }}</b>.</td>
                                <td style="text-align: center"> 0%</td>
                            </tr>
                        @foreach( $reporte->avances() as $avance )
                            <tr @if( $avance->id_usuario == 67 ) style="background-color: #ffffba;" @endif>
                                <td style="text-align: center; @if( $avance->id_usuario == 67 ) font-weight: bolder; @endif"> {{$avance->accion}}</td>
                                <td style="text-align: center;"> {!! date( 'd/m/Y', strtotime($avance->fecha) ) !!}</td>
                                <td style="text-align: center;"> {!! date( 'H:i A', strtotime($avance->fecha) ) !!}</td>
                                <td @if( $avance->id_usuario == 67 ) style="font-weight: bolder; @endif"> {{$avance->actividad}}</td>
                                <td style="text-align: center">
                                    {{$avance->avance}}%
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <small style="color: #a0a0a9;"> * Compromisos realizados por Galindo aparecen resaltados </small>
            </div>
        </div>
        
        <div class="row">
            @if( $reporte->vo_bo_solicitante )
                <div class="col-md-7 col-sm-6 col-xs-6 text-right" style="padding-top: 1.2em;">
                    <div class="text-center" style="border: #4caf50 solid; width: fit-content; padding: 1em; display: inline-flex;">
                        <label style="margin-bottom:0px; font-size: 0.95rem; line-height: 1.7em; color: #4caf50;"> &nbsp; Solicitud Correcta. </label>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-6 text-right"><br>
                    <label style="margin-bottom:0px; font-size: 0.95rem; line-height: 1.7em;"> &nbsp; La solicitud ya fue revisada por el solicitante. </label>
                </div>
            @else
                <div class="col-md-6 col-sm-6 col-xs-6 text-center" style="padding-top: 1.2em;">
                    <div class="checkbox checkbox-success" style="border: #4caf50 solid; width: fit-content; padding: 1em; display: inline-flex;">
                        <input type="checkbox" id="vo_bo_solicitante" name="vo_bo_solicitante" required>
                        <label for='vo_bo_solicitante' style="margin-bottom:0px; font-size: 0.95rem; line-height: 1.7em; color: #4caf50;"> &nbsp; ¿Está de acuerdo con las acciones realizadas?<br>
                            <small> Marqué la casilla si es así. </small>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 text-left" style="place-self: center;"><br>
                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
                </div>
            @endif
        </div>
    @endauth
    <br>
@endsection