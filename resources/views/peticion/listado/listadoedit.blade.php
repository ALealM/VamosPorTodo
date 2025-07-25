@extends('layouts.app')
@section('title', 'Main page')
@section('content')


{!! Form::model( @$acuerdo, ['route' =>[ 'updatelistadoAcuerdo' ],'method' => ( 'PUT'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
{{Form::hidden('id')}}

<div class="row pb-15">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
        <h4 style="text-align: center"> <b>Título de la reunión:</b><br><br>{!! $acuerdo->acuerdo !!}</h4>
        <div class="form-group">
            <table class="table-bordered table-condensed table-hover col-md-12">
                <thead>
                    <tr style="background-color:#ddd">
                        <th>Usuario</th>
                        <th>Dependencia</th>
                        <th>Fecha solicitada</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{!! $acuerdo->usuario()->nombre !!}</td>
                        <td>{!! $acuerdo->usuario()->dependencia()->direccion !!}</td>
                        <td>{!! date('d/m/Y', strtotime($acuerdo->fecha_solicitada)) !!}</td>
                    </tr>
                    <tr style="background-color:#ddd" colspan="3">
                        <td colspan="3" style="text-align: center;"><b>Autorizar fecha, hora y estatus de reunión</b></td>
                    </tr>
                    <tr style="background-color:#ddd">
                        <th>Fecha otorgada</th>
                        <th>Hora otorgada</th>
                        <th>Estatus</th>
                    </tr>
                
                    <tr>
                        <th>{!! Form::date('fecha_otorgada',$acuerdo->fecha_solicitada,['class'=>'form-control form-control-sm','required']) !!}<i class="form-group__bar"></i></th>
                        <th>{!! Form::time('hora_otorgada',date('H:i'),['class'=>'form-control form-control-sm','required']) !!}<i class="form-group__bar"></i></th>
                        <th>{!! Form::select('estatus',$estatus,$acuerdo->status(),['class'=>'form-control','required','placeholder'=>'Seleccione el estatus...','required' ]) !!}</th>
                    </tr>
                </tbody>
            </table>  
        </div>
    </div>  
</div>
  
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12 text-center">
    <br>
    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
    <a class="btn btn-secondary" href="{{url('/peticion/listado')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
  </div>
</div>

@endsection



