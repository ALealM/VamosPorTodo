@extends('layouts.app', ['activePage' => 'solicitud', 'mainPage' => 'parques_jardines'])
@section('title', 'Main page')
@section('content')
    {!! Html::style('css/awesome-bootstrap-checkbox.css') !!}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

        #form {
            color: #235a81 !important;
            text-transform: uppercase !important;
            padding-left: 10%;
            padding-right: 10%;
        }
    </style>

    {!! Form::model( @$var, ['route' =>[ 'storeSolicitudParqueJardin' ],'method' => ( 'POST'), 'class'=>'form-horizontal', 'id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}

    <div class="row">
        <div class="col-md-12">
            <table class="table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <td class="text-center" style="border-right: solid #235a81;">
                            <img src = "{{asset('logos')}}/logo_slp_gob_edo.png" style = "width: 50%;">
                        </td>
                        <td class="text-center" style="border-right: solid #235a81;">
                            <img src = "{{asset('logos')}}/logo_ayuntam_slp.png" style = "width: 50%;">
                        </td>
                        <td class="text-center" style="border-right: solid #235a81; font-weight: bold; font-size: larger;">
                            SERVICIOS __<br> MUNICIPALES <br>
                            <label> GOBIERNO DE LA CAPITAL </label>
                        </td>
                        <td class="text-center" style="border-right: solid #235a81; font-weight: bold;font-size: larger;">
                            PARQUES Y <br> JARDINES __<br>
                            <label> GOBIERNO DE LA CAPITAL </label>
                        </td>
                        <td class="text-center" style="background-color: #dfdfed">
                            <h2 style="text-transform: uppercase;"> Solicitud de Servicio </h2>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <table class="table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            Folio:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('folio', null, ['class'=>'form-control text-center', 'required', 'maxlength' => 8, 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57', 'style' => "background-color: #dfdfed; color: darkred; width: 15%;", 'onchange' => '$("#folioFooter").html(this.value)' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
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
                                {!! Form::date('fecha', date('Y-m-d'), ['class'=>'form-control', 'required' ]) !!} <i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>DATOS DEL SOLICITANTE</h3>
        </div>
        <div class="col-md-8">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            Nombre:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('name_solicitante', null, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba el nombre...', 'maxlength' => 100 ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            Teléfono:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('tel', null, ['class'=>'form-control', 'placeholder'=>'Escriba el teléfono', 'maxlength' => 25, 'required', 'id' => 'tel' ]) !!}<i class="form-group__bar"></i>
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
                            Domicilio:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('domicilio', null, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba el domicilio...', 'maxlength' => 100 ]) !!}<i class="form-group__bar"></i>
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
                            ENTRE LAS CALLES DE:
                        </th>
                        <th>Y DE</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('calle1', null, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba el domicilio...', 'maxlength' => 100 ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('calle2', null, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba el domicilio...', 'maxlength' => 100 ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <small>*NOTA: DENTRO DE LA PROPIEDAD NO SE ATIENDE, TODO SERVICIO SOLICITADO DEBERÁ ESTAR DENTRO DE LOS LÍMITES DE LA PROPIEDAD.</small>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <h3> SERVICIO SOLICITADO </h3>
        </div>
        <div class="col-md-3">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            PODA:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('poda', null, ['class'=>'form-control', 'required', 'placeholder'=>'Entrada de texto...', 'maxlength' => 100 ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            TALA:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('tala', null, ['class'=>'form-control', 'required', 'placeholder'=>'Entrada de texto...', 'maxlength' => 100 ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            OTRO:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('otro', null, ['class'=>'form-control', 'placeholder'=>'Entrada de texto...', 'maxlength' => 100 ]) !!}<i class="form-group__bar"></i>
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
                            OBSERVACIONES:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::textArea('observacion_servicio',null,['class'=>'form-control','required','placeholder'=>'Escriba...','rows'=>'2', 'maxlength' => 500 ]) !!}<i class="form-group__bar"></i>
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
                            FIRMA DEL SOLICITANTE:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::textArea('firma_solicitante', null, ['rows'=>'4', 'disabled', 'maxlength' => 0, 'style' => 'width: 25%' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3> INSPECCIÓN </h3>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            FECHA:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::date('fecha_inspeccion', date('Y-m-d'), ['class'=>'form-control', 'required' ]) !!} <i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <table class="table-borderless table-condensed table-hover" style="width: 100%" id="inspeccionArboles">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 40%;">
                            <h4> ÁRBOLES <a  class="btn btn-success btn-sm text-white" style="color: green" data-toggle="tooltip" title="Agregar" onclick="addLine('inspeccion')"><i class="fa fa-plus-square fa-2x"></i></a></h4>
                        </th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>
                            ESPECIE (S):
                        </th>
                        <th>
                            ALTURA (S):
                        </th>
                        <th>
                            DIÁMETRO DE TRONCO (S):
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('inspeccionEspecie[]', null, ['class'=>'form-control', 'required', 'maxlength' => 100, 'id' => 'inspeccionEspecie1' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('inspeccionAltura[]', null, ['class'=>'form-control', 'required', 'maxlength' => 15, 'id' => 'inspeccionAltura1' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('inspeccionDiametro[]', null, ['class'=>'form-control', 'required', 'maxlength' => 15, 'id' => 'inspeccionDiametro1' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-sm text-white" style="color: red; cursor: not-allowed" type="button" disabled>
                                <i class="fa fa-minus-square"></i>
                            </button>
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
                            OBSERVACIONES:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::textArea('observacion_inspeccion',null,['class'=>'form-control','required','placeholder'=>'Escriba...','required','rows'=>'2', 'maxlength' => 500 ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-8">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            Nombre del Inspector:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('name_inspector', null, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba el nombre...', 'maxlength' => 100 ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            FIRMA:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::textArea('firma_inspector', null, ['rows'=>'4', 'disabled', 'maxlength' => 0, 'style' => 'width: 85%' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3> VALORACIÓN </h3>
        </div>
        <div class="col-md-4">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <div class="checkbox checkbox-danger" style="width: fit-content; display: inline-flex;">
                                <input type="checkbox" id="procede" name="procede">
                                <label for='prioridad' style="margin-bottom:0px; color: black;"> &nbsp; PROCEDE: </label>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('procedeText', null, ['class'=>'form-control', 'required', 'placeholder'=>'Ingrese texto...', 'maxlength' => 100 ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            FECHA:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::date('fecha_valoracion', date('Y-m-d'), ['class'=>'form-control', 'required' ]) !!} <i class="form-group__bar"></i>
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
                            OBSERVACIONES:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::textArea('observacion_valoracion',null,['class'=>'form-control','required','placeholder'=>'Escriba...','required','rows'=>'2', 'maxlength' => 500 ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3> RESTITUCIÓN SOLICITADA </h3>
        </div>
        <div class="col-md-12">
            <table class="table-borderless table-condensed table-hover" style="width: 100%" id="restitucionArboles">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 40%;">
                            <h4> ÁRBOLES <a  class="btn btn-success btn-sm text-white" style="color: green" data-toggle="tooltip" title="Agregar" onclick="addLine('restitucion')"><i class="fa fa-plus-square fa-2x"></i></a></h4>
                        </th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>
                            ESPECIE (S):
                        </th>
                        <th>
                            ALTURA (S):
                        </th>
                        <th>
                            DIÁMETRO DE TRONCO (S):
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('restitucionEspecie[]', null, ['class'=>'form-control', 'required', 'maxlength' => 100, 'id' => 'restitucionEspecie1' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('restitucionAltura[]', null, ['class'=>'form-control', 'required', 'maxlength' => 15, 'id' => 'restitucionAltura1' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('restitucionDiametro[]', null, ['class'=>'form-control', 'required', 'maxlength' => 15, 'id' => 'restitucionDiametro1' ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-sm text-white" style="color: red; cursor: not-allowed" type="button" disabled>
                                <i class="fa fa-minus-square"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-8">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            NOMBRE DE QUIÉN VALORÓ:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('name_valoracion', null, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba el nombre...', 'maxlength' => 100 ]) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            FIRMA:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::textArea('firma_inspector', null, ['rows'=>'4', 'disabled', 'maxlength' => 0, 'style' => 'width: 85%' ]) !!}<i class="form-group__bar"></i>
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
            <a class="btn btn-secondary" href="{{url('/solicitud')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
        </div>
    </div>

    <br><hr style="border-color: #235a81; border-width: medium;">

    <div class="row">
        <div class="col-md-12">
            <table class="table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <td class="text-center" style="border-right: solid #235a81; font-weight: bold;">
                            Av. Constitución No. 1590 <br> Col. Julián Carrillo <br> Tel. 444 815 1842
                        </td>
                        <td class="text-center" style="border-right: solid #235a81; font-weight: bold; font-size: larger;">
                            SERVICIOS __<br> MUNICIPALES <br>
                            <label> GOBIERNO DE LA CAPITAL </label>
                        </td>
                        <td class="text-center" style="border-right: solid #235a81; font-weight: bold;font-size: larger;">
                            PARQUES Y <br> JARDINES __<br>
                            <label> GOBIERNO DE LA CAPITAL </label>
                        </td>
                        <td class="text-center" style="border-right: solid #235a81; font-weight: bold;font-size: larger;">
                            FECHA <br>
                            <b>{!! date('d | m | Y') !!}</b> <br>
                            <small>DD &nbsp;&nbsp; MM &nbsp; YYYY</small>
                        </td>
                        <td class="text-center" style="font-weight: bold; font-size: larger;">
                            FOLIO <br>
                            <h5 style="background-color: #dfdfed; color: darkred; font-weight: 400; width: 70%; margin-left: auto;" id="folioFooter"> </h5>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        });

        function addLine(table) {
            var idA = $('#' + table + 'Arboles tbody')[0].rows.length + 1;
            var tbl = document.getElementById(table+'Arboles');
            var lastRow = tbl.rows.length;
            var row = tbl.insertRow(lastRow);

            var i = row.insertCell(0);
            var f = row.insertCell(1);
            var a = row.insertCell(2);
            var ac = row.insertCell(3);

            i.innerHTML = '<div class="form-group" style="margin-bottom: 10px"> <input type="text" name="' + table + 'Especie[]" class="form-control" required maxlength=100 id="' + table + 'Especie' + idA + '"> <i class="form-group__bar"></i> </div>';
            f.innerHTML = '<div class="form-group" style="margin-bottom: 10px"> <input type="text" name="' + table + 'Altura[]" class="form-control" required maxlength=15 id="' + table + 'Altura' + idA + '"> <i class="form-group__bar"></i> </div>';
            a.innerHTML = '<div class="form-group" style="margin-bottom: 10px"> <input type="text" name="' + table + 'Diametro[]" class="form-control" required maxlength=15 id="' + table + 'Diametro' + idA + '"> <i class="form-group__bar"></i> </div>';
            ac.innerHTML = '<a class="btn btn-danger btn-sm text-white" style="color: red" onclick="deleteRow(this.parentNode.parentNode.rowIndex,\'' + table + 'Arboles\')" type="button" style="cursor:pointer"><i class="fa fa-minus-square"></i></a>';

            return false;
        }

        function deleteRow(rowIndex, nameTable){
            var table = document.getElementById(nameTable);
            table.deleteRow(rowIndex);
        }

        $(function () {
            $('#tel').mask('(999) 999-9999');
        });
    </script>
    
    <script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
@endsection