@extends('layouts.app')
@section('title', 'Main page')
@section('content')
<style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800);
</style>

<div class="row pb-15">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
        <table class="table-hover table-bordered" style="width: 100%;" id="tablaBeneficiarios">
            <tbody>
                <tr>
                    <th style="text-align: center;"><button class="btn btn-sm {{$solicitud->semaforo==0 ? 'btn-outline-danger' : (($solicitud->semaforo==1) ? 'btn-outline-warning' : 'btn-outline-success')}}">{!! $solicitud->estatus() !!}</button></th>
                    <td><h4><b>ASUNTO:</b> {!!  $solicitud->asunto !!}</h4></td>
                </tr>
                <tr>
                    <th style="text-align: center; background-color:#ddd">FECHA</th>
                    <td style=" text-transform: uppercase">{{ $dias[date('w', strtotime($solicitud->fecha_alta))] }} {{ date('j', strtotime($solicitud->fecha_alta)) }} de {{ $meses[date('n', strtotime($solicitud->fecha_alta))-1] }} de {{ date('Y', strtotime($solicitud->fecha_alta)) }}</td>
                </tr>
                <tr>
                    <th style="text-align: center; background-color:#ddd">DESCRIPCIÓN</th>
                    <td>{!! $solicitud->descripcion !!}</td>
                </tr>
                <tr>
                    <th style="text-align: center; background-color:#ddd">TIPO</th>
                    <td>{!! $solicitud->rubro()->nombre !!}</td>
                </tr>
                <tr>
                    <th style="text-align: center; background-color:#ddd">COLONIA</th>
                    <td>{!! $solicitud->colonia()->colonia !!}</td>
                </tr>
                <tr>
                    <th style="text-align: center; background-color:#ddd">UBICACIÓN</th>
                    <td>{!! $solicitud->ubicacion !!}</td>
                </tr>
                <tr>
                    <th style="text-align: center; background-color:#ddd">PROGRAMA</th>
                    <td>{!! $solicitud->programa()->nombre !!}</td>
                </tr>
                <tr>
                    <th style="text-align: center; background-color:#ddd">EVIDENCIA</th>
                    <td>
                        @foreach($evidencia as $ev)
                        <a href="{{url('solicitudesEv/'.$ev->archivo)}}" target="_blank" class="btn btn-sm btn-secondary"><i class="fa fa-image"></i></a>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <br>
        <span style=" font-weight: 600">ALTA DE BENEFICIARIOS</span><hr>
    </div>
</div>
{!! Form::model( @$oInventario, ['route' =>[ 'storeBeneficiarioSol' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data"]) !!}
{{ Form::hidden('id_programa',$solicitud->id_programa) }}
{{ Form::hidden('id_solicitud',$solicitud->id) }}
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
                            {!! Form::select('id_colonia',[],null,['class'=>'form-control','required','placeholder'=>'Seleccione la colonia...','id'=>'colonia','onchange'=>'getDemarcacion()']) !!}<i class="form-group__bar"></i>
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
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-floppy-o mr-2"></i>Agregar</button>
        <a class="btn btn-warning btn-sm" href="{{url('/solicitudes')}}"><i class="fa fa-times"></i> Regresar</a>
    </div>
</div>
<div style="text-align: center"><hr>
    <p style="font-size: 20px"><b>Listado de Beneficiarios</b></p>
</div>
@if($beneficiarios->isEmpty())
<div class="text-center">No hay beneficiarios dados de alta en la solicitud para mostrar</div>
@else
@include('solicitudes.tableBeneficiarios')
@endif
<script>
      // var BASE_URL = window.location.protocol + "//" + window.location.host + "/";

      function borrarBen(id) {

        swal({
            title: "Eliminar Beneficiario",
            text: "¡La información del beneficiario no se podrá recuperar! \n¿Desea continuar?",
            type: 'warning',
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-danger',
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, borrar",
            cancelButtonClass: 'btn btn-light',
        }).then(function (r) {
            if (r.dismiss === 'cancel' || r.dismiss === 'overlay') {
                return false;
            }
            if (r.value === true) {
                window.location.href = BASE_URL + "beneficiarioSol/delete/" + id;
            }
        });
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
