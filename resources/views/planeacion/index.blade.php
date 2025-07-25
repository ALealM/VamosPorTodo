@extends('layouts.app', ['activePage' => @$sActivePage ])
@section('content')


  <div class="row justify-content-center">
    <a href="planeacionE/mapaEstrategico" class="btn bg-fbm-blue">
      <i class="fa fa-map mr-2"></i>
      <b>Mapa estratégico</b>
    </a>
  </div>


  <div class="row justify-content-center">
    <div class="col-lg-2 col-md-3 col-sm-6">
      <a href="{{url('planeacionE/ejes')}}" class="card text-dark" style="min-height: 450px;">
        <img class="card-img-top" src="{{ asset('material/img/cuadro_7.png')}}">
        <div class="card-body">
          <h5 class="card-title">EJES DE PLAN DE DESARROLLO MUNICIPAL</h5>
          <p class="card-text">Administración de los ejes que se encuentran dentro del plan de desarrollo municipal.</p>
        </div>
      </a>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-6">
      <a href="{{url('planeacionE/estrategias')}}" class="card text-dark" style="min-height: 450px;">
        <img class="card-img-top" src="{{ asset('material/img/cuadro_9.png')}}">
        <div class="card-body">
          <h5 class="card-title">ESTRATEGIAS</h5>
          <p class="card-text">Administración de estrategias.</p>
        </div>
      </a>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-6">
      <a href="{{url('planeacionE/indicadores')}}" class="card text-dark" style="min-height: 450px;">
        <img class="card-img-top" src="{{ asset('material/img/cuadro_8.png')}}">
        <div class="card-body">
          <h5 class="card-title">INDICADORES (KPIs)</h5>
          <p class="card-text">Administración de indicadores KPIs.</p>
        </div>
      </a>
    </div>
  </div>

@endsection
