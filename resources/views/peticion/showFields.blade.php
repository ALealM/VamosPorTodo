

@extends('layouts.app')
@section('title', 'Main page')
@section('content')


<div class="mb-12">
    <div class="mb-2 mt-2" style="background-color:azure; border-radius: 10px;">
        <div style="padding: 20px; justify.content: center;">
            <h3>Solicitud de Reunión</h3>
            <p><i class="fa fa-info-circle mr-2"></i>Proceso de solicitud de reunión para acuerdos:</br>
                Seleccione la fecha para realizar una reunión.</br>
                Escriba únicamente el título del asunto a tratar.<br> 
                Si su petición es aprobada posteriormente podrá subir detalle de los acuerdos y archivos adjuntos como evidencia.
            </p>
        </div>
    </div>

    <div class="form-group col-md-12" style="margin-bottom: 10px">
        <table class="table-responsive col-md-6 dark-th">
            <thead>
                <tr>
                    <th>Usuario:{{ \Auth::User()->nombre }} {{ \Auth::User()->ap_paterno }} {{ \Auth::User()->ap_materno }}</th>
                    <th>|</th>
                    <th>Dependencia:{{ \Auth::User()->dependencia()->direccion }}</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="form-group col-md-12" style="margin-bottom: 10px">
        <table class="table-responsive col-md-12 dark-th">
            <thead>
                <tr class="col-md-12">
                    <th>Título del acuerdo: {!! Form::text('acuerdo',$acuerdo->acuerdo,['class'=>'form-control','class'=>'col-md-12','required','placeholder'=>'Escriba el título del acuerdo','required' ]) !!}</th>
                </tr>
                <tr class="col-md-12">
                    <th>Seleccione la fecha:{!! Form::date('fecha_solicitada',$acuerdo->fecha_solicitada,['class'=>'form-control form-control-sm','class'=>'col-md-12','required']) !!}</th>
                </tr>
            </thead>
        </table>
        
</div>




<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12 text-center">
    <br>
    <a class="btn btn-secondary" href="{{url('/peticion/index')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
  </div>
</div>

@endsection