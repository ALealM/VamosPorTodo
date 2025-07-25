@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  <div class="mb-2 mt-2">
    <a href="{{url('secretaria/create')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nueva secretaría</a>
  </div>
  

  @if($secretarias->isEmpty())
    <div class="text-center">No hay secretarías dadas de alta para mostrar</div>
  @else
    @include('catalogos.secretarias.table')
  @endif

@endsection
