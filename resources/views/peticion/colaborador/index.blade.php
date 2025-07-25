@extends('layouts.app')
@section('title', 'Main page')
@section('content')


  @if($colaborador->isEmpty())
    <div class="text-center">No hay avances dados de alta para mostrar</div>
  @else
    @include('peticion.colaborador.table')
  @endif
  
@endsection

