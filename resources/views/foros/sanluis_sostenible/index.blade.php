@extends('layouts.app', ['activePage' => 'indexSostenible', 'mainPage' => 'sostenible'])
@section('content')
<style>
    .dataTables_wrapper {
        background-color: #2a2a43;
        background-clip: border-box;
        border: 1px solid rgba(0,0,0,.125);
        border-radius: 0.25rem;
        padding: 10px;
        color: white;
        box-shadow: 2px 3px #8888885e;
    }
</style>
<style>
    .funny {
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
        height: 100vh;
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }


    h1, h2, h3, h4, h5, h6 {
        color: #404553;
        margin: 0;
    }

    #app{
        width: 600px;
        margin: 0 auto;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0px 12px 65px rgba(32, 50, 98, .07);
    }

    #app-content{
        background: #fff;
        padding: 20px 50px;
        color: #404553;
    }

    #MultiSelectApp h3 {
        font-size: 30px;
        margin-top: 10px;
        margin-bottom: 25px;
    }

    input[type="text"]:focus {
        outline: none;
    }

    input[type="text"] {
        box-sizing: border-box;
        width: 100%;
        padding: 10px 10px 20px 30px;
        font-size: 14px;
        border: 0;
        border-bottom: 1px solid #eee;
    }
    input[type="text"]::placeholder {
        color: #D4D2E1;
        font-family: 'Avenir';
        font-weight: 400;
    }

    .btn_ {
        background: #6A65FF;
        color: #fff;
        width: 100%;
        display: block;
        line-height: 70px;
        text-align: center;
        text-decoration: none;
        font-weight: 700;
        font-size: 18px;
    }

    .search-icon {
        color: #C1BFD3;
        position: absolute;
        top: 10px;
        left: 2px;
        font-size: 16px;
    }

    .user-list {
        list-style: none;
        padding: 0;
        margin-top: 20px;
    }

    .user-list li {
        padding: 20px;
        cursor: pointer;
    }

    .user-list li:hover {
        background-color: #F9F9F9;
    }

    .user-list li img {
        width: 100%;
    }

    .user-image {
        float: left;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
    }

    .user-list .user-data {
        padding-top: 2px;
        margin-left: 56px;
        position: relative;
    }

    .user-list .user-data h4 {
        font-size: 18px;
        font-weight: 500;
    }

    .user-list .user-data span {
        color: #A7ADBF;
        font-weight: 500;
    }

    .round-checkbox {
        display: block;
        position: absolute;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        top: 6px;
        right: 0px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Create a custom checkbox */
    .round-checkbox .checkmark {
        position: absolute;
        top: 25px;
        right: 20px;
        height: 25px;
        width: 25px;
        border-radius: 25px;
        border: 2px solid #0FCE8F;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .round-checkbox .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .checkmark.checked:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .round-checkbox .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid #0FCE8F;
        border-width: 0 2px 2px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
<style>
    @import url('https://fonts.googleapis.com/css2?family=The+Girl+Next+Door&display=swap');

    * {
        margin: 0;
        padding: 0;
        font-family: 'Calibri Light', sans-serif;
        font-size: 1rem;
        box-sizing: border-box;
    }

    .list {
        padding: 30px 75px 10px 30px;
        position: relative;
        width: 95%;
        color:white;
        /*max-width: 420px;*/
        margin: 50px auto;
        padding: 1.3em;
        background: #292942;
        border-radius: .75em;
        -webkit-filter: drop-shadow(1px 2px 5px rgba(0,0,0,.3));
        filter: drop-shadow(1px 2px 5px rgba(0,0,0,.3));
        box-shadow: 0 2px 2px rgb(76 76 76),
            0 0px 5px rgb(54 49 243 / 15%),
            0 0px 4px rgb(0 0 0 / 35%),
            0 5px 20px rgb(49 101 243 / 25%),
            0 15px 50px rgb(74 74 74),
            inset 0 0 15px rgb(255 255 255 / 5%);


        /*background: linear-gradient(90deg, rgba(235,144,188,1) 18%, rgba(224,92,92,1) 88%);*/
        /*border-top: 50px solid #ffb6c1;*/
    }

    .list h2 {
        color: #2D2D2D;
        font-size: 30px;
        padding: 10px 0;
        margin-left: 10px;
        display: inline-block;
        border-bottom: 4px solid #fff;
    }

    .list label {
        position: relative;
        display: block;
        margin: 0 40px;
        color: #2D2D2D;
        font-size: 24px;
        cursor: pointer;
    }

    .list input[type="checkbox"] {
        -webkit-appearance: none;
        /*color: #fff;*/
    }

    .list i {
        position: absolute;
        top: 0;
        display: inline-block;
        width: 25px;
        height: 25px;
        border: 2px solid #fff;
    }

    .list input[type="checkbox"]:checked ~ i {
        top: 1px;
        border-top: none;
        border-right: none;
        height: 15px;
        width: 25px;
        transform: rotate(-45deg);
    }

    .list span {
        position: relative;
        left: 40px;
        transition: 0.5s;
    }

    .list span:before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 1px;
        background: #fff;
        transform: translateY(-50%) scaleX(0);
        transform-origin: right;
        transition: transform 0.5s;
    }

    .list input[type="checkbox"]:checked ~ span:before {
        transform: translateY(-50%) scaleX(1);
        transform-origin: left;
        transition: transform 0.5s;
    }
    <i class="far fa-check-circle"></i>
    .list input[type="checkbox"]:checked ~ span{
        color: #fff; /*#154e6b;*/
    }

    /*.table-striped{
            background: rgba(255,255,255,.03);
    }*/

    .page-link {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: 0;
        line-height: 1.25;
        color: #f8f9fa;
        background-color: transparent;
        border: 0 solid #dee2e6;
    }

    .page-item.active .page-link {
        z-index: 1;
        color: #292942;
        background-color: #ffffff;
        border-color: #2196f3;
    }

    a {
        color: #2727ad;
    }

    a:hover,
    a:focus {
        color: #fff;
        text-decoration: none;
    }

    .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
        /* padding: 12px 8px;*/
        vertical-align: middle;
        border-color: rgba(255,255,255,.03);
    }

    .form-control {
        color: #fafafa;
    }

    .table-striped>tbody>tr:nth-of-type(odd) {
        background-color: rgba(255,255,255,.03);/*#48485c70;*/
    }
</style>

<div style="display:inline-block; text-align:center; width:100%;">
    <div><img src="../images/logos/Direcciones 2021-2024_SECRETARIA TECNICA.png" style="max-width:20%;width:auto;height:auto;"></div>
    <div style="text-align:center;">
        <h3>FORO SAN LUIS SOSTENIBLE</h3>
        <h4>LISTADO DE INVITADOS</h4>
        <p>
            Número total de invitados:{{ $total }} | Número de asistentes: <span id="numAsis">{{ $asistentes }}</span>
        </p>
    </div>
</div>


@if(\Auth::User()->tipo == 0 || \Auth::User()->tipo == 6)
<div class="list" style="text-align:center; cursor:pointer" onclick="addInvitado()">
    <h4 style="color: #fff">NUEVO ASISTENTE</h4>
</div>
@endif
<div class="list">
    <table class="table tile thead-dark dataTable table-striped responsive" role='grid' style="background-color: #292942; color:#fff;">
        <thead style="background: rgba(255,255,255,.1); color:#fff; border-radius: 5em;">
            <tr style="text-align:center;">
                <td style="cursor:pointer"><b>NOMBRE</b></td>
                <td style="cursor:pointer"><b>DEPENDENCIA</b></td>
                <td style="cursor:pointer"><b>PUESTO</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($invitados as $inv)
            <tr>
                <td style="width:25%;">
                    @if(\Auth::User()->tipo == 0 || \Auth::User()->tipo == 6)
                    <label>
                        <input type="checkbox" name="asistio" id="asistio{{$inv->id}}" onclick="asistencia({{$inv->id}})" {{($inv->asistio==1) ? 'checked' : ''}}>
                        <i></i>
                        <span style="font-size: 14px; color:white;">{{ $inv->nombre }}</span>
                    </label>
                    @else
                    {{ $inv->nombre }}
                    @endif
                </td>
                <td style="font-size: 12px; width:10%; text-align:center;">{{ $inv->dependencia }}</td>
                <td style="font-size: 12px; width:10%; text-align:center;">{{ $inv->puesto }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<script>
    function asistencia(id){
        var check = 0;
        if ($('#asistio' + id).is(':checked')) {
            check = 1;
        }
        $.get(BASE_URL + "asistenciaSostenible", {'check': check, 'id': id}, function (r) {
            $('#numAsis').empty();
            $('#numInt').empty();
            $('#numAsis').append(r.invitados);
            $('#numInt').append(r.integrantes);
        });
    }
    
    function addInvitado(){
        window.location.href = BASE_URL + "addInvitadoSostenible";
    }
</script>


@endsection
