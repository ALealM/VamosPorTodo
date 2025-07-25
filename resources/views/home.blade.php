@extends('layouts.app', ['activePage' => 'inicio'])
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <p style="font-size: 18px">Bienvenido</p>
                    <h3>{{ \Auth::User()->nombre }} {{ \Auth::User()->ap_paterno }} {{ \Auth::User()->ap_materno }}</h3>
                </div>
                @if(\Auth::User()->tipo == 12)
                <div class="panel-body text-center">
                    <h1>SISTEMA DE LÍNEAS DE ACCIÓN</h1>
                </div>
                @else
                <div class="panel-body text-center">
                    <img src="../img/cuadros.png" style="max-width:15%;width:auto;height:auto;padding-top: 30px"/>
                </div>
                <div class="panel-body text-center">                    
                    <h1>SISTEMA DE INFORMACIÓN</h1>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
