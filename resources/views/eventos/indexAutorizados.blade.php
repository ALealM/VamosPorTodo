@extends('layouts.app', ['activePage' => 'eventosAutorizados', 'mainPage' => 'eventos'])
@section('title', 'Main page')
@section('content')

@include('eventos.tableAutorizados')

<script>
    function eventoPDF(id) {
        window.location = BASE_URL + "eventoPDF/" + id;
    }

    function eventoEnviar(id) {
        $.get(BASE_URL + "eventoEnviar", {'id': id}, function (r) {
            $('#tdEvt' + id).empty();
            $('#tdEvt' + id).append('<button class="btn btn-sm btn-warning">PENDIENTE<div class="ripple-container"></div></button>');
            $('#btn' + id).removeAttr('onclick');
            $('#btn' + id).removeAttr('style');
            $('#btn' + id).attr('style', 'display:none');
        });
    }
</script>
@endsection