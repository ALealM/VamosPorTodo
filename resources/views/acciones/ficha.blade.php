@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  {!! Form::model( @$accion, ['route' =>[ 'storeAccion' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}


  <div class="row pb-15">
    <div class="col-lg-4 col-md-4 " style="padding-top: 10px">
      <img style="width:200px; height:auto;" src="{{ asset('material') }}/img/logo.png">
    </div>
    <div class="col-lg-8 col-md-8" style="padding-top: 10px">
      <h3>{{ $accion->nombre }}</h3>
      <table class="table-hover" style="width: 100%;" id="tablaBeneficiarios">
        <tbody>
          <tr style="background-color:#ddd">
            <th>Tipo acción</th>
            <th>Problemática</th>
          </tr>
          <tr>
            <td>{{ $accion->tipo()->tipo }}</td>
            <td>{{ $accion->problematica }}</td>
          </tr>
          <tr>
            <th colspan="2" style="background-color:#ddd">Descripción</th>
          </tr>
          <tr>
            <td colspan="2">{{ $accion->descripcion }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 col-md-6" style="padding-top: 10px">
      <h4>Beneficiarios</h4>
      <table class="table table-hover" style="width: 100%;" id="tablaBeneficiarios">
        <tbody>
          <tr style="background-color:#ddd">
            <th>Colonia</th>
            <th>Tipo beneficiarios</th>
            <th>Número beneficiarios</th>
          </tr>
          @foreach($beneficiarios as $ben)
            <tr>
              <td>{{$ben->colonia()->nombre}}</td>
              <td>{{$ben->tipo()->tipo}}</td>
              <td>{{number_format($ben->beneficiarios)}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <h4>Responsables</h4>
      <table class="table table-hover" style="width: 100%;" id="tablaBeneficiarios">
        <tbody>
          <tr style="background-color:#ddd">
            <th >Secretaría</th>
            <th >Responsable</th>
          </tr>
          @foreach($responsables as $resp)
            <tr>
              <td >{{$resp->responsable()->secretaria()->nombre}}</td>
              <td >{{$resp->responsable()->nombre}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
    <div class="col-lg-6 col-md-6" style="padding-top: 10px">
      <h4>Plan</h4>
      <table class="dataTable table-condensed table-hover" style="width: 100%; border: solid 1px #ddd !important " id="tablaBeneficiarios">
        <tbody>
          <tr>
            <th colspan="2">Medio de acción:</th>
          </tr>
          <tr>
            <td colspan="2">{{ $accion->medio_accion }}</td>
          </tr>
          <tr>
            <th >Indicador:</th>
            <th >Objetivo:</th>
          </tr>
          <tr>
            <td >{{ $accion->indicador_objetivo }}</td>
            <td >{{ number_format($accion->indicador_beneficiarios,2,'.',',') }}</td>
          </tr>
          <tr>
            <th colspan="2">Eje plan DM:</th>
          </tr>
          <tr>
            <td colspan="2">{{ $accion->eje()->eje }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="row" style=" padding-bottom:20px;">
    <div class="col-lg-6 col-md-6">

    </div>
    <div class="col-lg-6 col-md-6">
      <table class="dataTable table-condensed table-hover " style="width: 100%; background-color:#ddd" id="tablaBeneficiarios">
        <tbody>
          <tr class="text-right">
            <th >Presupuesto utópico:</th>
          </tr>
          <tr class="text-right">
            <td >$ {{ number_format($accion->presupuesto_utopico,2,'.',',') }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div id="content">
    <div id="container">
      <div id="map" class="map" style="position:relative; height:400px; margin: 1px; border: solid 1px transparent; border-radius: 1em; background: linear-gradient(#ddd, #ddd);"></div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
      <br>
      <a class="btn btn-secondary" href="{{url('/acciones/listado')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
    </div>
  </div>


  <script>
  mapboxgl.accessToken = 'pk.eyJ1IjoibWFwZm91bmQiLCJhIjoiY2p5NGp3ZTh2MTg3MDNpbXAxM2MxeGoybiJ9.VXQ3NXUpfX1YRB37TwBMYA';
  const map = new mapboxgl.Map({
    container: "map", // container ID
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [-100.976006, 22.155569],
    zoom: 11
  });
</script>
@endsection
