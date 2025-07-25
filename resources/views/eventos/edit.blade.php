@extends('layouts.app', ['activePage' => ( $evento->diario ? 'eventosDiariosUpdate' : 'editEvento' ) , 'mainPage' => 'eventos'])
@section('title', 'Main page')

@section('content')
    <style>
        @media (min-width: 768px) {
            .modal-map {
                width: 90%;
                max-width:1200px;
            }
        }
    </style>

    <!-- Select color -->

    <!-- Internal Specturm-color picker css-->
    <link href="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">

    {!! Form::model( @$evento, ['route' =>[ 'updateEvento' ],'method' => ( 'PUT'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
    <input type="hidden" name="ubicacion" id="ubicacion" value='{{$evento->ubicacion}}'>
    <input type="hidden" value='{{$evento->id}}' name='id'>
    <div class="row">
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
                                {!! Form::textArea('titulo',null,['class'=>'form-control','required','placeholder'=>'Escriba el título del evento','required','rows'=>'2' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            Lugar:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('lugar',null,['class'=>'form-control','placeholder'=>'Escriba el lugar del evento','required' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            Ubicación en Mapa:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                <a class="form-control" onclick="desplegarMap()" style="font-size: inherit;" type="none" data-toggle="modal" data-target=".bd-example-modal-lg" id="btnMap">{{$evento->ubicacion }}</a>
                                <i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            Fecha:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::date('fecha',null,['class'=>'form-control','required' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            Hora inicio:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::time('hora_inicio',null,['class'=>'form-control','required','placeholder'=>'Escriba la hora de inicio' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            Término:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::time('hora_fin',null,['class'=>'form-control','required','placeholder'=>'Escriba la hora de terminación' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            Código de vestimenta:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::select('vestimenta',['0'=>'Casual','1'=>'Formal','2'=>'Indiferente'],null,['class'=>'form-control','required','placeholder'=>'Seleccione el código de vestimenta...' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr style="height: calc(1.9675rem + 2px);">
                        <th>
                            Se requiere la presencia de:
                        </th>
                    </tr>
                    <tr style="border-bottom: #ced9df solid thin;
    background-image: linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px); border-bottom-width: medium; border-bottom-style: solid;">
                        <td>
                            <div class="form-group" style="margin-bottom: 10px; height: calc(1.0375rem + 2px); padding-left: 2em;">
                                <label class="ckbox mg-b-15-f" for="presidente"> <input type="checkbox" class="btn-check" name="presidente" id="presidente" autocomplete="off" @if($evento->asistencia_presidente) checked @endif> <span style="font-size: 15px;"> <b> Presidente </b> </span> </label>
                                <i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3" style="text-align-last: center;">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            Semáforo:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                <input id="showPaletteOnly" type="text" name="semaforo">
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
                        <th>
                            Montaje:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::textarea('montaje',null,['class'=>'form-control form-control-sm','required','rows'=>'3','placeholder'=>'Montaje del evento']) !!}<i class="form-group__bar"></i>
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
                            Invitados especiales:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::textarea('invitados_e',null,['class'=>'form-control form-control-sm','required','rows'=>'3','placeholder'=>'Invitados especiales']) !!}<i class="form-group__bar"></i>
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
                            Invitados:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::textarea('invitados',null,['class'=>'form-control form-control-sm','required','rows'=>'3','placeholder'=>'Invitados']) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row col-md-12" style="padding-bottom: 15px">
        <div class="col-md-12 text-center">
            <h4>Áreas Colaboradoras</h4>
        </div>
        <div class="col-md-12">            
            <!--<div class="col-md-8 ml-2">-->
            {{Form::select('colaboradores[]',$direcciones,$colaboradores,['multiple','size'=>'10'])}}
            <script>
              $('select[name="colaboradores[]"]').bootstrapDualListbox();
            </script>
            <!--</div>-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h4>Orden del día <a  class="btn btn-success btn-sm text-white" style="color: green" data-toggle="tooltip" title="Agregar" onclick="addLineA()"><i class="fa fa-plus-square fa-2x"></i></a></h4>
        </div>
        <div class="col-md-12">
            <table class="table-bordered table-condensed table-hover" style="width: 100%" id="tablaAcciones">
                <tbody>
                            <tr>
                                <th colspan="2" style="text-align: center">Horario</th>
                                <th colspan="3"></th>
                            </tr>
                            <tr>
                                <th style="text-align: center">Inicio</th>
                                <th style="text-align: center">Fin</th>
                                <th style="text-align: center">Actividad</th>
                                <th style="text-align: center">Observaciones</th>
                                <th></th>
                            </tr>
                    @if( count($acciones) == 0 )
                            <td><div class="form-group" style="margin-bottom: 10px">{!! Form::time('hInicio[]',date('H:i'),['class'=>'form-control','placeholder'=>'Ingrese hora inicial','required','id'=>'i1']) !!}<i class="form-group__bar"></i></div></td>
                            <td><div class="form-group" style="margin-bottom: 10px">{!! Form::time('hFin[]',date('H:i'),['class'=>'form-control','placeholder'=>'Ingrese hora final','required','id'=>'f1']) !!}<i class="form-group__bar"></i></div></td>
                            <td><div class="form-group" style="margin-bottom: 10px">{!! Form::text('act[]',null,['class'=>'form-control','placeholder'=>'Ingrese la actividad','required','id'=>'a1']) !!}<i class="form-group__bar"></i></div></td>
                            <td><div class="form-group" style="margin-bottom: 10px">{!! Form::text('obs[]',null,['class'=>'form-control','placeholder'=>'Ingrese las observaciones','id'=>'o1']) !!}<i class="form-group__bar"></i></div></td>
                            <td><button class="btn btn-sm text-white" style="color: red; cursor: not-allowed" type="button" disabled><i class="fa fa-minus-square"></i></button></td>
                    @else
                        @foreach( $acciones as $accion)
                            <tr>
                                <td><div class="form-group" style="margin-bottom: 10px">{!! Form::time('hInicio[]',$accion->hora_inicio,['class'=>'form-control','placeholder'=>'Ingrese hora inicial','required','id'=>'i1']) !!}<i class="form-group__bar"></i></div></td>
                                <td><div class="form-group" style="margin-bottom: 10px">{!! Form::time('hFin[]',$accion->hora_fin,['class'=>'form-control','placeholder'=>'Ingrese hora final','required','id'=>'f1']) !!}<i class="form-group__bar"></i></div></td>
                                <td><div class="form-group" style="margin-bottom: 10px">{!! Form::text('act[]',$accion->actividad,['class'=>'form-control','placeholder'=>'Ingrese la actividad','required','id'=>'a1']) !!}<i class="form-group__bar"></i></div></td>
                                <td><div class="form-group" style="margin-bottom: 10px">{!! Form::text('obs[]',$accion->observaciones,['class'=>'form-control','placeholder'=>'Ingrese las observaciones','id'=>'o1']) !!}<i class="form-group__bar"></i></div></td>
                                <td><a class="btn btn-danger btn-sm text-white" style="color: red" onclick="deleteRow(this.parentNode.parentNode.rowIndex, 'tablaAcciones')" type="button"><i class="fa fa-minus-square"></i></a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <!--<hr>-->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <br>
            <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
            <a class="btn btn-secondary" href="{{url('/eventosIndex')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
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
        function addLineA(op) {
            var idA = Math.floor(Math.random() * 10000) + 1000;
            var tbl = document.getElementById('tablaAcciones');
            var lastRow = tbl.rows.length;
            var row = tbl.insertRow(lastRow);

            var i = row.insertCell(0);
            var f = row.insertCell(1);
            var act = row.insertCell(2);
            var obs = row.insertCell(3);
            var ac = row.insertCell(4);

            i.innerHTML = '<div class="form-group bmd-form-group is-filled" style="margin-bottom: 10px">\n\
            <input class="form-control" required="" placeholder="Ingrese hora inicial" id="i'+idA+'"  name="hInicio[]" type="time" value="{{date('H:i')}}">\n\
            <i class="form-group__bar"></i></div>';
            f.innerHTML = '<div class="form-group bmd-form-group is-filled" style="margin-bottom: 10px">\n\
            <input class="form-control" required="" placeholder="Ingrese hora final" id="f'+idA+'"  name="hFin[]" type="time" value="{{date('H:i')}}">\n\
            <i class="form-group__bar"></i></div>';
            act.innerHTML = '<div class="form-group bmd-form-group is-filled" style="margin-bottom: 10px">\n\
            <input class="form-control" required="" placeholder="Ingrese la actividad" id="a'+idA+'"  name="act[]" type="text">\n\
            <i class="form-group__bar"></i></div>';
            obs.innerHTML = '<div class="form-group bmd-form-group is-filled" style="margin-bottom: 10px">\n\
            <input class="form-control" placeholder="Ingrese las observaciones" id="o'+idA+'"  name="obs[]" type="text">\n\
            <i class="form-group__bar"></i></div>';
            ac.innerHTML = '<a class="btn btn-danger btn-sm text-white" style="color: red" onclick="deleteRow(this.parentNode.parentNode.rowIndex,' + "'tablaAcciones'" + ')" type="button" style="cursor:pointer"><i class="fa fa-minus-square"></i></a>';

            return false;
        }

        function deleteRow(rowIndex, nameTable){
            var table = document.getElementById(nameTable);
            if(table.rows.length>3)
                table.deleteRow(rowIndex);
        }

        function desplegarMap(){
            mapboxgl.accessToken = 'pk.eyJ1IjoibWFwZm91bmQiLCJhIjoiY2p5NGp3ZTh2MTg3MDNpbXAxM2MxeGoybiJ9.VXQ3NXUpfX1YRB37TwBMYA';
            const map = new mapboxgl.Map({
                container: 'map', // container ID
                style: 'mapbox://styles/mapbox/streets-v11', // style URL
                center: <?php echo ($evento->ubicacion ? $evento->ubicacion : '[-100.97633711684888, 22.151434736659397]') ?>, // starting position
                zoom: 16 // starting zoom
            });
            
            
            map.on('click', function(e) {
                var coordinates = e.lngLat;
                var coord = '['+coordinates.lng+', '+coordinates.lat+']';
                $('#ubicacion').val(coord);
                $('#btnMap').text(coord);
                $('#btnMap').color='unset';
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

            map.on('style.load', function () {
            map.on('idle',function(){
                map.resize()
            })

            });
            var elem = document.getElementsByClassName("mapboxgl-canvas");
            for (var i = 0; i < elem.length; i++) {
                elem[i].style.width='-webkit-fill-available';
                elem[i].style.height='-webkit-fill-available';
            }
        }
    </script>

    <!-- Select color
    https://seballot.github.io/spectrum/ -->

    <!-- Internal Jquery.maskedinput js-->
    <script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>

    <!-- Internal Specturm-colorpicker js-->
    <script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>

    <script type="text/javascript">
        $(function () {
            $('#showPaletteOnly').spectrum({
                preferredFormat: "hex",
                showPaletteOnly: true,
                showPalette: true,
                color: @switch($evento->semaforo) @case(1) '#dc3545' @break @case(2) '#ffc107' @break @case(3) '#28a745' @break @default '#ffffff' @break @endswitch ,
                palette: ['#28a745', '#ffc107', '#dc3545'] // 1 -> rojo;   2 -> amarillo;  3 -> verde (comienzan en verde)
            }); // Fc-datepicker

            @if($evento->diario) document.getElementById('form').setAttribute('onsubmit',"return validar();"); @endif
        });
    </script>
@endsection