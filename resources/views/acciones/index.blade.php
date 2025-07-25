@extends('layouts.app')
@section('title', 'Main page')
@section('content')

<div class="mb-2 mt-2">
  <a href="{{url('accion/create')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nueva acción</a>
</div>

    @if($acciones->isEmpty())
      <div class="text-center">No hay acciones dadas de alta para mostrar</div>
    @else
      @include('acciones.table')
    @endif

@endsection
