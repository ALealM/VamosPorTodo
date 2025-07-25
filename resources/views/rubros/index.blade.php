@extends('layouts.app', ['activePage' => 'rubros', 'mainPage' => 'programas'])
@section('title', 'Main page')
@section('content')

  <div class="mb-2 mt-2">
    <a href="{{url('rubro/create')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nuevo Rubro</a>
  </div>

  @if($rubros->isEmpty())
    <div class="text-center">No hay rubros dados de alta para mostrar</div>
  @else
      @include('rubros.table')

  @endif

@endsection
