@extends('layouts.app', ['activePage' => 'altaJardinArte', 'mainPage' => 'jardin_arte'])
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
{!! Form::model( @$oInventario, ['route' =>[ 'storeInvitadoJardinArte' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data"]) !!}
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
                            {!! Form::text('puesto',null,['class'=>'form-control','placeholder'=>'Escriba el puesto del asistente','id'=>'puesto','onkeyup'=>"upper('puesto')"]) !!}<i class="form-group__bar"></i>
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
                            {!! Form::text('dependencia',null,['class'=>'form-control','placeholder'=>'Ingrese la dependencia del asistente','id'=>'dependencia','onkeyup'=>"upper('dependencia')"]) !!}<i class="form-group__bar"></i>
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
                        Direccción:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::text('domicilio',null,['class'=>'form-control','placeholder'=>'Ingrese la direccion del asistente','id'=>'domicilio','onkeyup'=>"upper('domicilio')"]) !!}<i class="form-group__bar"></i>
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
                        ¿Cómo se enteró del foro? <small style="color: red"><b>Sólo para registro de ciudadanos</b></small>
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::text('divulgacion',null,['class'=>'form-control','placeholder'=>'Ingrese la respuesta del asistente','id'=>'divulgacion','onkeyup'=>"upper('divulgacion')"]) !!}<i class="form-group__bar"></i>
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
        <a class="btn btn-secondary" href="{{url('/jardinArte/index')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
    </div>
</div>
<script>
 
 function upper(id){
     var text = $('#'+id).val();
     $('#'+id).val(text.toUpperCase());
 }
 
</script>
@endsection
