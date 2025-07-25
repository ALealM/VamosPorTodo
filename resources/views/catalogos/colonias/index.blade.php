@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  <div class="mb-2 mt-2">
    <a href="{{url('colonia/create')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nueva colonia</a>
  </div>

  @if($colonias->isEmpty())
    <div class="text-center">No hay colonias dadas de alta para mostrar</div>
  @else
    @include('catalogos.colonias.table')
  @endif
  
@endsection
