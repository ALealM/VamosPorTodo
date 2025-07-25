@extends('layouts.app')
@section('title', 'Main page')
@section('content')

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

</style>
{!! Form::model( @$oInventario, ['route' =>[ 'storeAsistente' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data"]) !!}
<div class="row col-md-8 mr-auto ml-auto">
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Nombre:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Escriba el nombre del asistente','required','id'=>'nombre','onkeyup'=>"upper('nombre')"]) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Puesto:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::text('puesto',null,['class'=>'form-control','placeholder'=>'Escriba el puesto del asistente','required','id'=>'puesto','onkeyup'=>"upper('puesto')"]) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>   
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Dependencia:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::select('dependencia',$dependencias,null,['class'=>'form-control','required','placeholder'=>'Seleccione la dependencia del asistente...' ]) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Tipo de asistente:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::select('integrante',['0'=>'Invitado','1'=>'Integrante'],null,['class'=>'form-control','required']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Género:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::select('genero',['F'=>'Femenino','M'=>'Masculino'],null,['class'=>'form-control','required','placeholder'=>'Seleccione el género del asistente']) !!}<i class="form-group__bar"></i>
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
        <button type="submit" class="btn btn-success" onsubmit="ubicTrue();"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
        <a class="btn btn-secondary" href="{{url('/invitados/index')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
    </div>
</div>
<script>
 
 function upper(id){
     var text = $('#'+id).val();
     $('#'+id).val(text.toUpperCase());
 }
 
</script>
@endsection
