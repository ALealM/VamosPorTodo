@extends('layouts.app', ['activePage' => 'reporteEvento', 'mainPage' => 'eventos'])
@section('title', 'Main page')
@section('content')

{!! Form::model( @$evento, ['route' =>[ 'storeReporte' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}

<input type="hidden" value='{{$evento->id}}' name='id'>
<div class="row pb-15">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
        <h4 style="text-align: center"> <b>FOLIO: {{$folio}}</b><br><br>{!! str_replace("\n", "<br>", $evento->titulo) !!}</h4>
        <table class="table-hover" style="width: 100%;" id="tablaBeneficiarios">
            <tbody>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">LUGAR Y FECHA</th>
                    <td colspan="5" style=" text-transform: uppercase">{{ $evento->lugar }}, {{ $dias[date('w', strtotime($evento->fecha))] }} {{ date('j', strtotime($evento->fecha)) }} de {{ $meses[date('n', strtotime($evento->fecha))-1] }} de {{ date('Y', strtotime($evento->fecha)) }}</td>
                </tr>
                <tr>
                    <th style="text-align: center">HORA INICIO</th>
                    <td>{{ $evento->hora_inicio }}</td>
                    <th style="text-align: center">HORA TÉRMINO</th>
                    <td>{{ $evento->hora_fin }}</td>
                    <th style="text-align: center">CÓDIGO DE VESTIMENTA</th>
                    <td>{{ $evento->vestimenta() }}</td>
                </tr>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">MONTAJE</th>
                    <td colspan="5">{!! str_replace("\n", "<br>", $evento->montaje) !!}</td>
                </tr>
                <tr>
                    <th style="text-align: center">INVITADOS ESPECIALES</th>
                    <td colspan="5">{!! str_replace("\n", "<br>", $evento->invitados_e) !!}</td>
                </tr>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">INVITADOS</th>
                    <td colspan="5">{!! str_replace("\n", "<br>", $evento->invitados) !!}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
        <h4 style="text-align: center">ORDEN DEL DÍA</h4>
        <table class="table table-hover table-bordered" style="width: 100%; text-align: center" id="tablaBeneficiarios">
            <tbody>
                <tr style="background-color:#ddd">
                    <th colspan="2">HORARIO</th>
                    <th rowspan="2">ACTIVIDAD</th>
                    <th rowspan="2">OBSERVACIONES</th>
                </tr>
                <tr style="background-color:#ddd">
                    <th style="width: 50px">INICIO</th>
                    <th style="width: 50px">FIN</th>                    
                </tr>
                @foreach($acciones as $accion)
                <tr>
                    <td>{{$accion->hora_inicio}}</td>
                    <td>{{$accion->hora_fin}}</td>
                    <td>{{$accion->actividad}}</td>
                    <td>{{$accion->observaciones}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
        <h4 style="text-align: center">REPORTE FINAL</h4>
        <div class="form-group" style="margin-bottom: 10px">
            {!! Form::textarea('reporte',null,['class'=>'form-control form-control-sm','rows'=>'3','placeholder'=>'Reporte del evento...','required']) !!}<i class="form-group__bar"></i>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
        <h4 style="text-align: center">EVIDENCIA</h4>
        <div class="custom-file">
            <input type="file" name="archivos[]" multiple >
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <br>
        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
        <a class="btn btn-secondary" href="{{url('/eventos/listadoAutorizado')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
    </div>
</div>
@endsection
