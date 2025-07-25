@extends('layouts.app')
@section('title', 'Main page')
@section('content')


  <div class="row pb-15">
    <div class="col-lg-4 col-md-4 " style="padding-top: 10px">
      <img style="width:200px; height:auto;" src="{{ asset('material') }}/img/logo.png">
    </div>
    <div class="col-lg-8 col-md-8" style="padding-top: 10px">
      <h3>{{ $indicador->indicador }}</h3>
      <table class="table-hover" style="width: 100%;">
        <tbody>
          <tr style="background-color:#ddd">
            <th>Eje Plan Desarrollo Municipal</th>
            <th>Estrategia</th>
          </tr>
          <tr>
            <td>{{ $indicador->estrategia()->eje()->eje }}</td>
            <td>{{ $indicador->estrategia()->estrategia }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6 col-md-6" style="padding-top: 10px">
      <table class="table table-hover" style="width: 100%;">
        <tbody>
          <tr style="background-color:#ddd">
            <th>Meta</th>
            <th>Frecuencia de Medición / Reporteo</th>
          </tr>
          <tr>
            <td>{{ $indicador->meta }} {{ $indicador->unidad()->unidad }}</td>
            <td>{{ ($indicador->id_frecuencia_indicador==null) ? 'Sin indicar' : $indicador->frecuencia()->frecuencia }}</td>
          </tr>
          <tr style="background-color:#ddd">
            <th>Fórmula / Medio para obtener la información del KPI</th>
            <th>Meta de tiempo</th>
          </tr>
          <tr>
            <td>{{ ($indicador->formula==null) ? 'Sin definir' : $indicador->formula }}</td>
            <td> {{ ($indicador->meta_tiempo==null) ? 'Sin definir' : $indicador->meta_tiempo }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-lg-6 col-md-6" style="padding-top: 10px">
      <h4>Responsables</h4>
      <table class="dataTable table-condensed table-hover" style="width: 100%; border: solid 1px #ddd !important ">
        <tbody>
          @if(!$responsables->isEmpty())
            <tr>
              <th>Secretaría</th>
              <th>Responsable</th>
            </tr>
            @foreach($responsables as $resp)
              <tr>
                <td>{{$resp->responsable()->secretaria()->nombre}}</td>
                <td>{{$resp->responsable()->nombre}}</td>
              </tr>
            @endforeach
          @else
            <tr>
              <td style="text-align: center">Sin responsables</td>
            </tr>
          @endif
        </tbody>
      </table>
      <h4>Comentarios</h4>
      <table class="dataTable table-condensed table-hover" style="width: 100%; border: solid 1px #ddd !important ">
        <tbody>
          <tr>
            @if ( $indicador->comentarios != null)
              <td>{{$indicador->comentarios}}</td>
            @else
              <td style="text-align: center">Sin comentarios</td>
            @endif
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
      <br>
      <a class="btn btn-secondary" href="{{url('/planeacionE/indicadores')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
    </div>
  </div>

@endsection
