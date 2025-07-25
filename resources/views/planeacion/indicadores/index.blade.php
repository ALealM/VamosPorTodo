@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  <div class="mb-2 mt-2">
    <a href="{{url('planeacionE/indicadorCreate')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nuevo Indicador</a>
  </div>

  @if($indicadores->isEmpty())
    <div class="text-center">No hay estrategias dadas de alta para mostrar</div>
  @else
    @include('planeacion.indicadores.table')
  @endif
  
@endsection
