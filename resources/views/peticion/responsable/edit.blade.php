@extends('layouts.app')
@section('title', 'Main page')
@section('content')

{!! Form::model( @$responsable, ['route' =>[ 'updateAvaResponsable' ],'method' => ( 'PUT'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
{{Form::hidden('id')}}
{{Form::hidden('fecha')}}
<div class="row pb-15">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
        <h4 style="text-align: center"> <b>Acuerdo: {{$responsable->acuerdos()->acuerdo}}</b></h4>
        <!--<br><br>Responsable:{-- str_replace("\n", "<br>", $responsable->responsable()->nombre)--}-->
        <table class="table-hover" style="width: 100%; margin-bottom: 30px;" id="tablaBeneficiarios">
            <tbody>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">ACTIVIDAD</th>
                    <td colspan="5">{{ $responsable->actividad }}</td>
                </tr>
                <tr>
                    <th style="text-align: center">RESPONSABLE</th>
                    <td>{{ $responsable->dependencia()->direccion }}</td>
                    <th style="text-align: center">FECHA</th>
                    <td>{{ $responsable->fecha }}</td>
                </tr>
            </tbody>
        </table>
        
        <table class="table-hover" style="width: 100%; margin-bottom: 30px;" id="tablaBeneficiarios">
            <tbody>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">Avance:</th>
                    <td colspan="5"><p>{!! Form::number('avance',$responsable->avance,['class'=>'form-control','placeholder'=>'Escriba el avance' ]) !!}</p></td>
                    <th style="text-align: center">Evidencias:</th>
                    <td><input type="file" class="form-control" name="archivo"></td>
                </tr>
                <tr>
                    <th style="text-align: center">Reporte:</th>
                    <td colspan="10">{!! Form::text('reporte',$responsable->reporte,['class'=>'form-control','placeholder'=>'Escriba el reporte' ]) !!}</td>
                </tr>
            </tbody>
        </table>
        
    </div>
</div>




<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12 text-center">
    <br>
    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Actualizar</button>
    <a class="btn btn-secondary" href="{{url('/peticion/responsable/index')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
  </div>
</div>

@endsection

