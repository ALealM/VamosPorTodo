@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  <div class="mb-2 mt-2">
    <a href="{{url('unidadKPI/create')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nueva unidad de medida (KPI)</a>
  </div>

  @if($unidades->isEmpty())
    <div class="text-center">No hay unidades de medida dadas de alta para mostrar</div>
  @else
    @include('catalogos.unidadesKPI.table')
  @endif
  
@endsection
