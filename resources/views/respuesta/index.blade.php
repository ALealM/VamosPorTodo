@extends('layouts.app')
@section('title', 'Main page')
@section('content')

<div class="mb-2 mt-2">
  <a href="{{url('respuesta/create')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nuevo reporte</a>
</div>

    @if($reportes->isEmpty())
      <div class="text-center">No hay reportes dados de alta para mostrar</div>
    @else
      @include('respuesta.table')
    @endif
@endsection
