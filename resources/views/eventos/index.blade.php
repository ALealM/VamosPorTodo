@extends('layouts.app', ['activePage' => 'eventos', 'mainPage' => 'eventos'])
@section('title', 'Main page')
@section('content')

<div class="mb-2 mt-2">
    @if(\Auth::User()->tipo <> 1)
    <a href="{{url('evento/create')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nuevo evento</a>
    
    @endif
    {{-- Hash::make('123abc') --}}
</div>

@include('eventos.table')

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
