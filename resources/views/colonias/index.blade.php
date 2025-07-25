@extends('layouts.app', ['activePage' => 'colonias', 'mainPage' => 'programas'])
@section('title', 'Main page')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    .form-control {
        display: block;
        width: 100%;
        height: calc(1.5em + .75rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    hr{
        margin-top: 0px;
        margin-bottom: 10px;
    }
    select {
        text-align-last: center;
    }
    .center-box {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .footer-widget {
        width: 100%;
        height: 100%;
    }
</style>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="form-group" style="margin-bottom: 5px;padding-bottom: 0px; text-align: center">
            <span style=" font-weight: 400; font-size: 20px">Colonia</span>
            {!! Form::select('id_colonia',$colonias,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione la colonia...','id'=>'colonia','onchange'=>'getDatosCol()']) !!}<i class="form-group__bar"></i>
        </div>
    </div>
</div>
<div id='contenido'></div>
<script>
    // var BASE_URL = window.location.protocol + "//" + window.location.host + "/";

    $(document).ready(function() {
        $('.select2').select2();
    });

    function getDatosCol() {
        var col = $('#colonia').val();
        $("#contenido").empty();
        $.get(BASE_URL + "getDatosCol", {'col': col}, function (r) {
            $("#contenido").append(r);
        });
    }

    function informeCol(id) {
        window.location = BASE_URL + "informeCol/" + id;
    }

    function informeColRub(id,rub) {
        window.location = BASE_URL + "informeColRub/" + id + "/" + rub;
    }

</script>
@endsection
