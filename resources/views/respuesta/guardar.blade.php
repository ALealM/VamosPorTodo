@extends('layouts.app')
@section('title', 'Main page')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIJ4iiYO9sANnnb1XZEepN2xI8B8hivSQ&callback=initMap"></script>

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
    /* select {
        text-align-last: center;
    }
    .center-box {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .footer-widget {
        width: 100%;
        height: 100%;
    } */
</style>
{!! Form::model( @$proyAcc, ['route' =>[ 'storeRespuesta' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}

<div class="row">
    <div class="card text-white bg-info mb-12" style=" margin-top: 0px">
        <div class="card-header" style="text-align:center; padding-bottom: 0px"><h4><b>Datos Generales del Reporte</b></h4></div>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Medio de recepción:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-top: 0px">
                            {!! Form::select('medio',$medios,3,['class'=>'form-control','required','id'=>'medio','placeholder'=>'Seleccione...']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Área de atención:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-top: 0px">
                            {!! Form::select('area',$areas,null,['class'=>'form-control','required','id'=>'area','placeholder'=>'Seleccione...','onchange'=>'getFallas()']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Tipo de atención:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-top: 0px">
                            {!! Form::select('tipofalla',[],null,['class'=>'form-control','required','id'=>'tipo-falla']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Calle:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-top: 0px">
                            {!! Form::select('calle',[],null,['class'=>'form-control select2','required','placeholder'=>'Seleccione la calle...','id'=>'calle_id','onchange'=>'setCalle()']) !!}<i class="form-group__bar"></i>
                            <input name="calle_text" type="hidden" id="calle">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Número exterior:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-top: 0px">
                            {!! Form::text('numext',null,['class'=>'form-control','placeholder'=>'Escriba el número exterior','required','id'=>'num-ext']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Número interior:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-top: 0px">
                            {!! Form::text('numint',null,['class'=>'form-control','placeholder'=>'Escriba el número interior','id'=>'num-int']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Colonia:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-top: 0px">
                            {!! Form::select('colonia',$colonias,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione la colonia...','id'=>'colonia_id','onchange'=>'setColonia()']) !!}<i class="form-group__bar"></i>
                            <input name="colonia_text" type="hidden" id="colonia">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-8 row">
        <div class="col-md-12 center" style="text-align: center; font-weight: 900"><b>Entre calles</b><hr style="padding-top: 0px; margin-top: 0px"></div>
        <div class="col-md-6">
            <table class="dataTable table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            Calle 1:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-top: 0px">
                                {!! Form::text('calle1',null,['class'=>'form-control','placeholder'=>'Escriba la primera calle']) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="dataTable table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            Calle 2:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-top: 0px">
                                {!! Form::text('calle2',null,['class'=>'form-control','placeholder'=>'Escriba la segunda calle']) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4" style=" vertical-align: middle; text-align: center">
        <div>
            <button class="btn btn-success" type="button" id="posiciona">
                Posicionar en mapa
            </button>
            <p id="accuracy-info" style="display:none; color:red; margin-left:20px; font-weight:bold;"></p>
        </div>
    </div>
    <div class="col-md-12 card" style=" margin-top: 10px">
        <div class="form-group">
            <div id="mapa" style="height: 500px">
            </div>
            <input type="hidden" name="latitud" id="latitud">
            <input type="hidden" name="longitud" id="longitud">
        </div>
    </div>
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Observaciones:
                    </th>
                </tr>
                <tr>
                    <td style=" padding-right: 10px; margin-right: 10px">
                        <div class="form-group" style="margin-top: 0px">
                            {!! Form::textarea('observaciones',null,['class'=>'form-control','required','placeholder'=>'Escriba las observaciones del reporte...','rows'=>'4']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12 row">
        <table class="dataTable table-borderless table-condensed" style="width: 100%; text-align: center">
            <tbody>
                <tr>
                    <th>
                        Evidencia fotográfica:
                    </th>
                </tr>
                <tr>
                    <td style=" padding-right: 10px; margin-right: 10px; text-align: center">
                        <div class="preview col-md-3 mr-auto ml-auto center" style="text-align: center">
                            <img id="file-ip-1-preview" style=" height: 200px; text-align: center">
                        </div>
                        <input type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event);" name="evidencia">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card text-white bg-info mb-12">
        <div class="card-header" style="text-align:center; padding-bottom: 0px"><h4><b>Solicitante</b></h4></div>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Nombre(s):
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-top: 0px">
                            {!! Form::text('nombre',null,['class'=>'form-control','required','placeholder'=>'Escriba su nombre']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Apellido Paterno:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-top: 0px">
                            {!! Form::text('ap_paterno',null,['class'=>'form-control','required','placeholder'=>'Escriba su apellido paterno']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Apellido Materno:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-top: 0px">
                            {!! Form::text('ap_materno',null,['class'=>'form-control','required','placeholder'=>'Escriba su apellido materno']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Teléfono:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-top: 0px">
                            {!! Form::text('telefono',null,['class'=>'form-control','required','placeholder'=>'Escriba su teléfono']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Correo Electrónico:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-top: 0px">
                            {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Escriba su correo electrónico']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Género:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-top: 0px">
                            {!! Form::select('genero',['1'=>'Femenino','2'=>'Masculino'],null,['class'=>'form-control','required','placeholder'=>'Seleccione su género...']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Rango de edad:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-top: 0px">
                            {!! Form::select('rango',['1'=>'Joven (18-29)','2'=>'Adulto Joven (30-39)','3'=>'Adulto (40-60)','4'=>'Adulto Mayor (mayor de 60)'],null,['class'=>'form-control','required','placeholder'=>'Seleccione su rango de edad...']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-8">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Información Adicional:
                    </th>
                </tr>
                <tr>
                    <td style=" padding-right: 10px; margin-right: 10px">
                        <div class="form-group" style="margin-top: 0px">
                            {!! Form::textarea('adicional',null,['class'=>'form-control','placeholder'=>'Escriba su información adicional...','rows'=>'2']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th style="text-align: center">
                        Hacer mi reporte visible para todos <small>(No se publicarán mis datos personales)</small>
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group row" style="margin-top: 0px">
                            <div class="col-md-3 mr-auto ml-auto">
                                {!! Form::select('visible',['0'=>'No','1'=>'Si'],null,['class'=>'form-control']) !!}<i class="form-group__bar"></i>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <br>
        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
        @auth
        <a class="btn btn-secondary" href="{{url('/respuesta')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
        @endauth
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#medio').select2({
            placeholder: "Seleccione el medio de recepción...",
            allowClear: true
        });
        $('#tipo-falla').select2({
            placeholder: "Seleccione el tipo de atención...",
            allowClear: true,
            tags: true
        });
        $('#area').select2({
            placeholder: "Seleccione el área de atención...",
            allowClear: true
        });

        $('#calle_id').select2({
            placeholder: "Seleccione la calle...",
            allowClear: true,
            ajax: {
                url: '/getCalles',
                dataType: 'json',
                type: "GET",
                //delay: 250,
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data) {
                		var res = data.map(function (calle) {
                        	return {id: calle.id_cc, text: calle.d_calle};
                        });
                    return {
                        results: res
                    };
                },
                cache: true
            },
        });
        $('#colonia_id').select2({
            placeholder: "Seleccione la colonia...",
            allowClear: true,
            ajax: {
                url: '/getColonias',
                dataType: 'json',
                type: "GET",
                //delay: 250,
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data) {
                		var res = data.map(function (colonia) {
                        	return {id: colonia.id_cp, text: colonia.d_asenta};
                        });
                    return {
                        results: res
                    };
                },
                cache: true
            },
        });
    });
</script>
<script type="text/javascript">

    function showPreview(event) {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("file-ip-1-preview");
            preview.src = src;
            preview.style.display = "block";
        }
    }
    $('form input').keydown(function (e) {
        if (e.keyCode == 13) {
            var inputs = $(this).parents("form").eq(0).find(":input");
            if (inputs[inputs.index(this) + 1] != null) {
                inputs[inputs.index(this) + 1].focus();
            }
            e.preventDefault();
            return false;
        }
    });
    /**
     VERIFICA QUE SE HAYA UBICADO UN PUNTO DE LOCALIZACIÓN
     **/

//    (function () {
//        'use strict';
//        window.addEventListener('load', function () {
//            var form = document.getElementById('reporteForm');
//            form.addEventListener('submit', function (event) {
//                event.preventDefault();
//                event.stopPropagation();
//
//                var latitud = document.getElementById('latitud').value;
//                var longitud = document.getElementById('longitud').value;
//                var id_calle = document.getElementById('calle_id').value;
//                var id_colonia = document.getElementById('colonia_id').value;
//                var numext = document.getElementById('num-ext').value;
//                var id_tipo = document.getElementById('tipo-falla').value;
//                var titulo;
//                var mensaje;
//                if (latitud == '' || longitud == '') {
//                    mensaje = 'Ubica el reporte en el mapa.';
//                    muestraMensaje(mensaje);
//                }
//                existenReportes(id_calle, id_colonia, numext, latitud, longitud, id_tipo).then(res => {
//                    if (res.mensaje) {
//                        mensaje = 'Este servicio ya fue reportado: ' + res.mensaje;
//                        muestraMensaje(mensaje);
//                    } else {
//                        $('#reporteForm').submit();
//                    }
//                }).catch(error => {
//                    /*
//                     console.log("Error al recuperar datos: " + jqXhr.status);
//                     console.log(jqXhr);
//                     console.log(jqXhr.responseJSON);
//                     */
//                });
//            }, false);
//        }, false);
//    })();

//    function muestraMensaje(mensaje) {
//        alert(mensaje);
//    }
//
//    function existenReportes(id_calle, id_colonia, numext, lat, lon, id_tipo) {
//
//        return new Promise((resolve, reject) => {
//            $.ajax({
//                url: '/atencion_ciudadanaV2/index.php/reporteServicio/reportesRepetidosAjax',
//                type: 'POST',
//                data: {
//                    calle: id_calle,
//                    colonia: id_colonia,
//                    num: numext,
//                    latitud: lat,
//                    longitud: lon,
//                    tipo: id_tipo
//                },
//                dataType: 'JSON',
//
//                success: function (respuesta) {
//                    resolve(respuesta);
//                },
//
//                error: function (jqXhr) {
//                    reject(jqXhr);
//                    //if( jqXhr.status == 400 ) {
//                    //let json = $.parseJSON( jqXhr.responseText );
//
//                    //$('#mensajeId').text(jqXhr.responseJSON.mensaje);
//
//                    //}
//                }
//
//            }); //Ajax
//        });
//    }

    function getFallas() {
        var idA = $('#area').val();
        $.get(BASE_URL + "getFallas", {'idA': idA}, function (r) {
            $('#tipo-falla').empty();
            $('#tipo-falla').append('<optgroup label="' + $('#area option:selected').text() + '"></optgroup>');
            $('#tipo-falla').append('<option disabled selected>Seleccione el tipo de atención...</option>');
            $(r).each(function (i, v) {
                $('#tipo-falla').append('<option value="' + v.id + '">' + v.falla + '</option>');
            });
        });
    }

    // function getCalles() {

// $(document).on('keyup', '.custom-dropdown .select2-search__field', function (ev) {
//   var self = $(this);
//     var calle = self.val();
//     $.get(BASE_URL + "getCalles", {'calle': calle}, function (r) {
//         $('#calle_id').empty();
//         // $('#calle_id').append('<option disabled selected>Seleccione la calle...</option>');
//         $(r).each(function (i, v) {
//             $('#calle_id').append('<option value="' + v.id_cc + '">' + v.d_calle + '</option>');
//         });
//
//     });
// });

    function setCalle() {
        var calle = $('#calle_id option:selected').text();
        $('#calle').val(calle);
    }

    function setColonia() {
        var colonia = $('#colonia_id option:selected').text();
        $('#colonia').val(colonia);
    }

</script>
<script src="{{URL::asset('js/inicializa.js')}}"></script>
<script>
//    $(document).foundation();
</script>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-42741606-11', 'auto');
    ga('send', 'pageview');

</script>
@endsection
