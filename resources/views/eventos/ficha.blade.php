@extends('layouts.app', ['activePage' => 'showEvento', 'mainPage' => 'eventos'])
@section('title', 'Main page')
@section('content')

{!! Form::model( @$accion, ['route' =>[ 'storeAccion' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
<style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800);

.blue-btn:hover,
.blue-btn:active,
.blue-btn:focus,
.blue-btn {
  background: transparent;
  border: solid 1px #090;
  border-radius: 3px;
  color: #090;
  outline: none !important;
}

.fileUpload {
  position: relative;
  overflow: hidden;
  height: 43px;
  margin-top: 0;
}

.fileUpload input.uploadlogo {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  padding: 0;
  font-size: 20px;
  cursor: pointer;
  opacity: 0;
  filter: alpha(opacity=0);
  width: 100%;
  height: 42px;
}

/*Chrome fix*/
input::-webkit-file-upload-button {
  cursor: pointer !important;
  height: 42px;
  width: 100%;
}
    </style>

<div class="row pb-15">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
        <h4 style="text-align: center"> <b>FOLIO: {{$folio}}</b><br><br>{!! str_replace("\n", "<br>", $evento->titulo) !!}</h4>
        <table class="table-hover" style="width: 100%;" id="tablaBeneficiarios">
            <tbody>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">LUGAR Y FECHA</th>
                    <td colspan="7" style=" text-transform: uppercase">{{ $evento->lugar }}, {{ $dias[date('w', strtotime($evento->fecha))] }} {{ date('j', strtotime($evento->fecha)) }} de {{ $meses[date('n', strtotime($evento->fecha))-1] }} de {{ date('Y', strtotime($evento->fecha)) }}
                        
                    </td>
                </tr>
                <tr>
                    <th style="text-align: center">HORA INICIO</th>
                    <td>{{ $evento->hora_inicio }}</td>
                    <th style="text-align: center">HORA TÉRMINO</th>
                    <td>{{ $evento->hora_fin }}</td>
                    <th style="text-align: center">UBICACIÓN</th>
                    <td>
                        @if($evento->ubicacion)
                            <a class="btn btn-sm blue-btn" href="{{($evento->ubicacion!=null) ? 'https://google.com/maps/place/'.$evento->ubic.'/@'.$evento->ubicacion.',19z' : ''}}" {{($evento->ubicacion!=null) ? 'target="_blank"' : ''}} ><i class="fa fa-map-marker"></i></a>
                        @else
                            {{$evento->lugar}}
                        @endif
                    </td>
                    <th style="text-align: center">CÓDIGO DE VESTIMENTA</th>
                    <td>{{ $evento->vestimenta() }}</td>
                </tr>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">MONTAJE</th>
                    <td colspan="7">{!! str_replace("\n", "<br>", $evento->montaje) !!}</td>
                </tr>
                <tr>
                    <th style="text-align: center">INVITADOS ESPECIALES</th>
                    <td colspan="7">{!! str_replace("\n", "<br>", $evento->invitados_e) !!}</td>
                </tr>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">INVITADOS</th>
                    <td colspan="7">{!! str_replace("\n", "<br>", $evento->invitados) !!}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
        <h4 style="text-align: center">ÁREAS COLABORADORAS</h4>
        <table class="table table-hover table-bordered" style="width: 100%; text-align: center">
            @if($colaboradores->isEmpty())
            <tbody>
                <tr style="background-color:#ddd">
                    <th style="width: 50px">SIN COLABORADORES</th>
                </tr>
            </tbody>
            @else
            <tbody>
                <tr style="background-color:#ddd">
                    <th style="width: 50px">NOMBRE</th>
                    <th style="width: 50px">DIRECCIÓN</th>
                </tr>
                @foreach($colaboradores as $colaborador)
                <tr>
                    <td>{{$colaborador->gabinete()->nombre}}</td>
                    <td>{{$colaborador->gabinete()->direccion}}</td>
                </tr>
                @endforeach
            </tbody>
            @endif
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
        <h4 style="text-align: center">ORDEN DEL DÍA</h4>
        <table class="table table-hover table-bordered" style="width: 100%; text-align: center">
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
@if($evento->observaciones && $evento->estatus != 3)
<div class="row">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
        <h4 style="text-align: center">OBSERVACIONES DEL EVENTO</h4>
        <table class="table table-hover table-bordered" style="width: 100%; text-align: center" id="tablaBeneficiarios">
            <tbody>
                <tr>
                    <td>
                        {{$evento->observaciones}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endif
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <br>
        <a class="btn btn-secondary" href="{{url('/eventos/listado')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
    </div>
</div>
@endsection
