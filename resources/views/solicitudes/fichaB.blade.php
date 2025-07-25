@extends('layouts.app', ['activePage' => 'padron', 'mainPage' => 'programas'])
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
        <a class="btn btn-warning btn-sm" href="{{url('/padronBeneficiarios')}}"><i class="fa fa-arrow-circle-left"></i> Regresar</a>
    </div>
</div>
@endsection
