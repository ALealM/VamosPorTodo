@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  <div class="mb-2 mt-2">
    <a href="{{url('tipoAccion/create')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nuevo tipo de acción</a>
  </div>

  @if($tipoAcciones->isEmpty())
    <div class="text-center">No hay tipos de acciones dados de alta para mostrar</div>
  @else
      @include('catalogos.tipoAcciones.table')

  @endif

@endsection
