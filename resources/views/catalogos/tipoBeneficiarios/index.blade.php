@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  <div class="mb-2 mt-2">
    <a href="{{url('tipoBeneficiario/create')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nuevo tipo de beneficiario</a>
  </div>

  @if($tipoBeneficiarios->isEmpty())
    <div class="text-center">No hay tipos de beneficiarios dados de alta para mostrar</div>
  @else
    @include('catalogos.tipoBeneficiarios.table')
  @endif

@endsection
