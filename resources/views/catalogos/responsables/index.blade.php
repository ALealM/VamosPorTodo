@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  <div class="mb-2 mt-2">
    <a href="{{url('responsables/create')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nuevo responsable</a>
  </div>


  @if($responsables->isEmpty())
    <div class="text-center">No hay responsables dados de alta para mostrar</div>
  @else
    @include('catalogos.responsables.table')
  @endif
  
@endsection
