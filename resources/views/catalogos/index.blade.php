@extends('layouts.app', ['activePage' => @$sActivePage ])
@section('content')




  <div class="row justify-content-center">
    <div class="col-lg-2 col-md-3 col-sm-6 ">
      <a href="{{url('catalogos/tipoAcciones')}}" class="card text-dark">
        <img class="card-img-top" src="{{ asset('material/img/cuadro_1.png')}}">
        <div class="card-body">
          <h5 class="card-title">TIPOS DE ACCIONES</h5>
          <p class="card-text">Parámetros para acciones.</p>
        </div>
      </a>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-6 ">
      <a href="{{url('catalogos/tipoBeneficiarios')}}" class="card text-dark">
        <img class="card-img-top" src="{{ asset('material/img/cuadro_2.png')}}">
        <div class="card-body">
          <h5 class="card-title">TIPOS DE BENEFICIARIOS</h5>
          <p class="card-text">Parámetros para beneficiarios.</p>
        </div>
      </a>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-6 ">
      <a href="{{url('catalogos/colonias')}}" class="card text-dark">
        <img class="card-img-top" src="{{ asset('material/img/cuadro_3.png')}}">
        <div class="card-body">
          <h5 class="card-title">COLONIAS</h5>
          <p class="card-text">Datos de colonias.</p>
        </div>
      </a>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-6 ">
      <a href="{{url('catalogos/secretarias')}}" class="card text-dark">
        <img class="card-img-top" src="{{ asset('material/img/cuadro_4.png')}}">
        <div class="card-body">
          <h5 class="card-title">SECRETARÍAS</h5>
          <p class="card-text">Parámetros para secretarías.</p>
        </div>
      </a>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-2 col-md-3 col-sm-6 ">
      <a href="{{url('catalogos/responsables')}}" class="card text-dark">
        <img class="card-img-top" src="{{ asset('material/img/cuadro_5.png')}}">
        <div class="card-body">
          <h5 class="card-title">RESPONSABLES</h5>
          <p class="card-text">Parámetros para los responsables.</p>
        </div>
      </a>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-6 ">
      <a href="{{url('catalogos/unidadesKPI')}}" class="card text-dark">
        <img class="card-img-top" src="{{ asset('material/img/cuadro_10.png')}}">
        <div class="card-body">
          <h5 class="card-title">UNIDADES</h5>
          <p class="card-text">Administración de unidades.</p>
        </div>
      </a>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-6 ">
      <a href="{{url('catalogos/frecuenciasKPI')}}" class="card text-dark">
        <img class="card-img-top" src="{{ asset('material/img/cuadro_11.png')}}">
        <div class="card-body">
          <h5 class="card-title">FRECUENCIAS</h5>
          <p class="card-text">Administración de frecuencias.</p>
        </div>
      </a>
    </div>
  </div>



@endsection
