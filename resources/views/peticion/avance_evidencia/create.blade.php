@extends('layouts.app')
@section('title', 'Main page')
@section('content')


{!! Form::model( @$acuerdos, ['route' =>[ 'storeAvances' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
{{Form::hidden('id')}}
<div class="row pb-15">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
        <h4 style="text-align: center"> <b>Acuerdo: {{$acuerdos->acuerdo}}</b><br><br>{!! str_replace("\n", "<br>", $acuerdos->usuario()->nombre) !!}</h4>

        <table class="table-hover" style="width: 100%; margin-bottom: 30px;" id="tablaBeneficiarios">
            <tbody>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">ACTIVIDAD</th>
                    <td colspan="5">actividad principal - acordada en reunión</td>
                </tr>
                <tr>
                    <th style="text-align: center">RESPONSABLE</th>
                    <td>Arturo Jaimes Nuñez</td>
                    <th style="text-align: center">FECHA</th>
                    <td>2021-10-21</td>
                </tr>
            </tbody>
        </table>
        
        <table class="table-hover" style="width: 100%; margin-bottom: 30px;" id="tablaBeneficiarios">
            <tbody>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">Avance:</th>
                    <td colspan="5">{!! Form::text('avance',null,['class'=>'form-control','placeholder'=>'Escriba el avance','required' ]) !!}</td>
                    <th style="text-align: center">Evidencias:</th>
                    <td><input type="file" class="form-control" name="archivo"></td>
                </tr>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">Comentarios:</th>
                    <td colspan="5">{!! Form::text('comentarios',null,['class'=>'form-control','placeholder'=>'Escriba el comentario' ]) !!}</td>
                </tr>
            </tbody>
        </table>
        
    </div>
</div>




<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12 text-center">
    <br>
    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
    <a class="btn btn-secondary" href="{{url('/peticion/avances/index')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
  </div>
</div>

@endsection