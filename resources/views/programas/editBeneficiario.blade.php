@extends('layouts.app', ['activePage' => 'programas', 'mainPage' => 'programas'])
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
    hr{
        margin-top: 0px;
        margin-bottom: 10px;
    }
</style>
{!! Form::model( @$beneficiario, ['route' =>[ 'updateBeneficiario' ],'method' => ( 'PUT'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data"]) !!}
{{ Form::hidden('id',null) }}
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-7">
        <table class="table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th style="text-align: right; width: 200px; vertical-align: middle">Nombre:</th>
                    <td>
                        <div class="form-group" style="margin-bottom: 5px;padding-bottom: 0px;">
                            {!! Form::text('nombre',null,['class'=>'form-control','required','placeholder'=>'Escriba el nombre del nuevo beneficiario']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th style="text-align: right; vertical-align: middle">Domicilio:</th>
                    <td>
                        <div class="form-group" style="margin-bottom: 5px;padding-bottom: 0px;">
                            {!! Form::text('domicilio',null,['class'=>'form-control','required','placeholder'=>'Escriba el domicilio']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th style="text-align: right; vertical-align: middle">Contacto:<br><small>(Teléfono o medio de contacto)</small></th>
                    <td>
                        <div class="form-group" style="margin-bottom: 5px;padding-bottom: 0px;">
                            {!! Form::text('contacto',null,['class'=>'form-control','required','placeholder'=>'Escriba el contacto']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th style="text-align: right; vertical-align: middle">INE:<br><small>(Clave electoral)</small></th>
                    <td>
                        <div class="form-group" style=" margin-bottom: 5px;padding-bottom: 0px;">
                            {!! Form::text('ine',null,['class'=>'form-control','required','placeholder'=>'Escriba la clave electoral','id'=>'ine','onkeyup'=>"upper('ine')"]) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center; padding-top: 10px">
                        <span style=" font-weight: 400">DEMARCACIÓN TERRITORIAL</span><hr>
                    </td>
                </tr>
                <tr>
                    <th style="text-align: right; vertical-align: middle">Sección electoral:</th>
                    <td>
                        <div class="form-group" style="margin-bottom: 5px;padding-bottom: 0px;">
                            {!! Form::select('id_seccion',$secciones,null,['class'=>'form-control','required','placeholder'=>'Seleccione la sección...','id'=>'seccion','onchange'=>'getColonias()']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th style="text-align: right; vertical-align: middle">Colonia:</th>
                    <td>
                        <div class="form-group" style="margin-bottom: 5px;padding-bottom: 0px;">
                            {!! Form::select('id_colonia',$colonias,null,['class'=>'form-control','required','placeholder'=>'Seleccione la colonia...','id'=>'colonia','onchange'=>'getDemarcacion()']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th style="text-align: right; vertical-align: middle">Demarcación:</th>
                    <td>
                        <div class="form-group" style="margin-bottom: 5px;padding-bottom: 0px;">
                            {!! Form::text('demarcacion',null,['class'=>'form-control','required','readonly','id'=>'demarcacion','placeholder'=>'Demarcación']) !!}<i class="form-group__bar"></i>
                            {{Form::hidden('id_demarcacionSC',null,['id'=>'id_demarcacion'])}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-edit mr-2"></i>Guardar</button>
        <a class="btn btn-secondary" href="{{url('/programa/beneficiarios/'.$programa->id)}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
    </div>
</div>
<div style="text-align: center"><hr>
    <p style="font-size: 20px"><b>Listado de Beneficiarios</b></p>
</div>
@if($beneficiarios->isEmpty())
<div class="text-center">No hay beneficiarios dados de alta en el programa para mostrar</div>
@else
@include('programas.tableBeneficiarios')
@endif
<script>
      // var BASE_URL = window.location.protocol + "//" + window.location.host + "/";

      function borrarBen(id) {
        swal({
            title: "Eliminar Beneficiario",
            text: "¡La información del beneficiario no se podrá recuperar! \n¿Desea continuar?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonText: "Cancelar",
            confirmButtonText: "Sí, borrar"
          },
          function() {
            window.location.href = BASE_URL + "beneficiario/delete/" + id;
          }
        );
      }

    function upper(id){
        var text = $('#'+id).val();
        $('#'+id).val(text.toUpperCase());
    }

    function getColonias() {
        var secc = $('#seccion').val();
        $("#demarcacion").val('');
        $("#colonia > option").remove();
        $('#colonia').append('<option  value="">Seleccione la colonia...</option>');
        $.get(BASE_URL + "getColoniasB", {'secc': secc}, function (r) {
            $(r).each(function (i, v) { // indice, valor
                $('#colonia').append('<option value="' + v.id + '">' + v.colonia + '</option>');
            });
            $('#colonia').append('<option value="1000">Otra</option>');
        });
    }

    function getDemarcacion() {
        var secc = $('#seccion').val();
        var col = $('#colonia').val();
        if(col==1000){
            $('#demarcacion').val('Sin identificar');
            $('#id_demarcacion').val(1000);
        }
        else{
            $("#demarcacion").val('');
            $.get(BASE_URL + "getDemarcacion", {'secc': secc, 'col': col}, function (r) {
                $('#demarcacion').val(r.demarcacion);
                $('#id_demarcacion').val(r.id);
            });
        }
    }
</script>
@endsection
