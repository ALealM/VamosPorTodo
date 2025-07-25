@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  <div class="mb-2 mt-2">
    <a href="{{url('planeacionE/estrategiaCreate')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nueva Estrategia</a>
  </div>

  @if($estrategias->isEmpty())
    <div class="text-center">No hay estrategias dadas de alta para mostrar</div>
  @else
    @include('planeacion.estrategias.table')
  @endif
  
@endsection
