@extends('layouts.app')
@section('title', 'Main page')
@section('content')

<div class="mb-12">
    <div class="mb-2 mt-2">
        <h3>Listado de Reuniones para Acuerdos</h3>
    </div>
</div>


  @if($acuerdos->isEmpty())
    <div class="text-center">No hay reuniones dadas de alta para mostrar</div>
  @else
    @include('peticion.listado.listado_table')
  @endif
  
@endsection