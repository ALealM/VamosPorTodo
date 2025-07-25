@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  <div class="mb-2 mt-2">
    <a href="{{url('frecuenciaKPI/create')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nueva frecuencia (KPI)</a>
  </div>

  @if($frecuencias->isEmpty())
    <div class="text-center">No hay frecuencias dadas de alta para mostrar</div>
  @else
    @include('catalogos.frecuenciasKPI.table')
  @endif
  
@endsection
