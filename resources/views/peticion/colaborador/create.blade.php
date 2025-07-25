@extends('layouts.app')
@section('title', 'Main page')
@section('content')


{!! Form::model( @$colaborador, ['route' =>[ 'storeColaborador' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
{{Form::hidden('id')}}
<div class="row pb-15">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
        <h4 style="text-align: center"> <b>Acuerdo: {{$colaborador->acuerdo}}</b><br><br>{!! str_replace("\n", "<br>", $colaborador->usuario()->nombre) !!}</h4>

        <table class="table-hover" style="width: 100%; margin-bottom: 30px;" id="tablaBeneficiarios">
            <tbody>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">ACTIVIDAD</th>
                    <td colspan="5">{{ $colaborador->actividad }}</td>
                </tr>
                <tr>
                    <th style="text-align: center">RESPONSABLE</th>
                    <td>{{ $colaborador->responsable()->nombre }}</td>
                    <th style="text-align: center">FECHA</th>
                    <td>{{ $colaborador->fecha }}</td>
                </tr>
            </tbody>
        </table>
        
        <table class="table-hover" style="width: 100%; margin-bottom: 30px;" id="tablaBeneficiarios">
            <tbody>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">Avance:</th>
                    <td colspan="5">{!! $colaborador->avance !!}</td>
                    <th style="text-align: center">Evidencias:</th>
                    <td><input type="file" class="form-control" name="archivo"></td>
                </tr>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">Reporte:</th>
                    <td colspan="5">{!! Form::text('reporte',null,['class'=>'form-control','placeholder'=>'Escriba el reporte' ]) !!}</td>
                </tr>
            </tbody>
        </table>
        
    </div>
</div>




<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12 text-center">
    <br>
    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
    <a class="btn btn-secondary" href="{{url('/peticion/colaborador/index')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
  </div>
</div>

@endsection