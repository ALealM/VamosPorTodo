@extends('layouts.app')
@section('title', 'Main page')
@section('content')


  <div class="row">
    <div class="col-lg-12" style="box-shadow: 2px 3px #8888885e; border-radius: .25rem;">
      @include('planeacion.mapa.table_slp_seguro')
    </div>
    <div class="col-lg-12" style="box-shadow: 2px 3px #8888885e; border-radius: .25rem;">
      @include('planeacion.mapa.table_slp_incluyente')
    </div>
    <div class="col-lg-12" style="box-shadow: 2px 3px #8888885e; border-radius: .25rem;">
      @include('planeacion.mapa.table_slp_sostenible')
    </div>
    <div class="col-lg-12" style="box-shadow: 2px 3px #8888885e; border-radius: .25rem;">
      @include('planeacion.mapa.table_slp_innovador')
    </div>
    <div class="col-lg-12" style="box-shadow: 2px 3px #8888885e; border-radius: .25rem;">
      @include('planeacion.mapa.table_slp_competitivo')
    </div>
  </div>

@endsection
