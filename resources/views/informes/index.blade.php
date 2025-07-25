@extends('layouts.app', ['activePage' => 'informe', 'mainPage' => 'informe'])
@section('title', 'Main page')
@section('content')

<div class="mb-2 mt-2">
    <a href="{{url('informe/create')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nuevo informe diario</a>    
</div>

@if($informes->isEmpty())
<div class="text-center">No hay informes dados de alta para mostrar</div>
@else
@include('informes.table')
@endif

<script>
    function informePDF(id) {
        window.location = BASE_URL + "informePDF/" + id;
    }

    function informeEnviar(id) {
        $.get(BASE_URL + "informeEnviar", {'id': id}, function (r) {
            $('#tdInf' + id).empty();
            $('#tdInf' + id).append('Enviado');
            $('#btnEnv' + id).removeAttr('onclick');
            $('#btnEnv' + id).removeAttr('style');
            $('#btnEnv' + id).attr('style', 'display:none');
            $('#btnEd' + id).removeAttr('onclick');
            $('#btnEd' + id).removeAttr('style');
            $('#btnEd' + id).attr('style', 'display:none');
        });
    }
</script>
@endsection