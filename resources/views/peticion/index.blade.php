@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  <div class="mb-2 mt-2">
    <a href="{{url('peticion/acuerdoCreate')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nueva Reunión</a>
  </div>

  @if($acuerdos->isEmpty())
    <div class="text-center">No hay reuniones dadas de alta para mostrar</div>
  @else
    @include('peticion.table')
  @endif
  
  
  
<script>
    function reunionEnviar(id) {
        $.get(BASE_URL + "reunionEnviar", {'id': id}, function (r) {
            $('#tdEvt' + id).empty();
            $('#tdEvt' + id).append('<button class="btn btn-sm btn-warning">PENDIENTE<div class="ripple-container"></div></button>');
            $('#btn' + id).removeAttr('onclick');
            $('#btn' + id).removeAttr('style');
            $('#btn' + id).attr('style', 'display:none');
        });
    }
</script>
@endsection
