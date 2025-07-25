@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  <div class="mb-2 mt-2">
    <a href="{{url('planeacionE/ejeCreate')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nuevo Eje</a>
  </div>

  @if($ejes->isEmpty())
    <div class="text-center">No hay ejes de plan de desarrollo municipal dados de alta para mostrar</div>
  @else
    @include('planeacion.ejes.table')
  @endif
  
@endsection
