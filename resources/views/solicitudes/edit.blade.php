@extends('layouts.app')
@section('title', 'Main page')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{!! Html::script('js/jquery.MultiFile.js') !!}
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
    .select2-selection__rendered[title="Reportado"] {color: red !important;}
    .select2-results__option[id*="Reportado"] {color: red;}
    .select2-selection__rendered[title="Iniciado"] {color: #ff9900 !important;}
    .select2-results__option[id*="Iniciado"] {color: #ff9900;}
    .select2-selection__rendered[title="Concluido"] {color: #009900 !important;}
    .select2-results__option[id*="Concluido"] {color: #009900;}
</style>
{!! Form::model( @$solicitud, ['route' =>[ 'updateSolicitud' ],'method' => ( 'PUT'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
<input type="hidden" value='{{$solicitud->id}}' name='id'>
<div class="row">
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Asunto:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::textArea('asunto',null,['class'=>'form-control','required','placeholder'=>'Escriba el asunto de la solicitud','required','rows'=>'1' ]) !!}<i class="form-group__bar"></i>
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
                    <th>
                        Descripción:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::textArea('descripcion',null,['class'=>'form-control','required','placeholder'=>'Escriba la descripción de la solicitud','required','rows'=>'2' ]) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-8">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Referencia de ubicación:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::text('ubicacion',null,['class'=>'form-control','placeholder'=>'Ingrese la ubicación del asunto' ]) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>    
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Colonia:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::select('id_colonia',$colonias,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione la colonia...' ]) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Tipo de problemática:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::select('id_tipo',$rubros,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione el tipo de problemática...' ]) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Programa social:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::select('id_programa',$programas,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione el programa...' ]) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Estatus:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::select('semaforo',$estatus,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione el estatus...' ]) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Dirección responsable:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::select('id_direccion',$direcciones,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione la dirección...' ]) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Evidencia <small>(Una o más fotografías)</small>:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div style="margin-bottom: 10px">
                            <input type="file" class="multi" name='evidencia[]' multiple accept="image/*"/>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Fotografías <small>(Seleccione las que desea reemplazar)</small>:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group row" style="margin-bottom: 10px; text-align: center">
                            @foreach($evidencia as $ev)  
                            <div class="col-md-3">
                                <input type="checkbox" class="btn-check" name="imagenes[]" autocomplete="off" value="{{$ev->id}}">
                                <a href="{{url('solicitudesEv/'.$ev->archivo)}}" target="_blank" class="btn btn-sm btn-secondary">
                                <label class="btn btn-secondary btn-sm" for="info-outlined" style="padding-right: 3px; padding-left: 3px">
                                    <img src="{{url('solicitudesEv/'.$ev->archivo)}}" style=" width: 40px"/>
                                </label>
                                </a>
                            </div>
                            @endforeach
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
                        Día:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::date('day', null, ['class'=>'form-control', 'required' ]) !!} <i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr> <th>Hora:</th> </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::time('hora', null, ['class'=>'form-control', 'required' ]) !!} <i class="form-group__bar"></i>
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
                    <th>No. asistentes</th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::number('no_asistentes', null, ['class'=>'form-control ', 'required' ]) !!} <i class="form-group__bar"></i>
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
                        Lugar:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::text('lugar', null, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba dónde se lleva a cabo la reunión...', 'maxlength' => 100 ]) !!}<i class="form-group__bar"></i>
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
        <a class="btn btn-secondary" href="{{url('/solicitudes')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
    </div>
</div><script>

    $(document).ready(function() {
        $('.select2').select2();
        $('.multi').MultiFile();
    });   
    
</script>

@endsection
