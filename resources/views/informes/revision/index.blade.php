@extends('layouts.app', ['activePage' => 'listadoRevision', 'mainPage' => 'informe'])
@section('title', 'Main page')
@section('content')

@if($informes->isEmpty())
<div class="text-center">No hay informes dados de alta para mostrar</div>
@else
@include('informes.revision.table')
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