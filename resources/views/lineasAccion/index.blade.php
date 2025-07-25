@extends('layouts.app',['activePage'=>'acciones','mainPage'=>'acciones'])
@section('title', 'Main page')
@section('content')

  <div class="mb-2 mt-2">
    <a href="{{url('lineaAccion/create')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nueva línea de acción</a>
  </div>

  @if($acciones->isEmpty())
    <div class="text-center">No hay líneas de acción dadas de alta para mostrar</div>
  @else
    @include('lineasAccion.table')
  @endif

@endsection
