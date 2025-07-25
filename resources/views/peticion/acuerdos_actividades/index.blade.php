@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  @if($acuerdos_actividades->isEmpty())
    <div class="text-center">No hay acuerdos dados de alta</div>
  @else
    @include('peticion.acuerdos_actividades.table')
  @endif


@endsection
