@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  <div class="mb-2 mt-2">
    <a href="{{url('peticion/avancesCreate')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nuevo Avance</a>
  </div>

  @if($avances->isEmpty())
    <div class="text-center">No hay avances dados de alta para mostrar</div>
  @else
    @include('peticion.avances.table')
  @endif
  
@endsection
