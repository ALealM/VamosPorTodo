@extends('layouts.app')
@section('title', 'Main page')
@section('content')


  @if($responsable->isEmpty())
    <div class="text-center">No hay avances dados de alta para mostrar</div>
  @else
    @include('peticion.responsable.table')
  @endif
  
@endsection
