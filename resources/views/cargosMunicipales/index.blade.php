@extends('layouts.app')
@section('title', 'Main page')
@section('content')
<style>
    .progress-bar-rose{
        background-color: #d221f3 !important;
    }
</style>
<div class="card" style="display:none">
    <div class="row">
        <div class="col-md-6 text-center">
            <h4><b>Mujeres: {{$mujeres}} ({{($mujeres==0) ? 0 : round($mujeres/29*100,2)}}%)</b></h4>
            <div class="col-md-8 ml-auto mr-auto">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar-rose" role="progressbar" aria-valuenow="{{round($mujeres/29*100,2)}}" aria-valuemin="0" aria-valuemax="100" style="width:{{round($mujeres/29*100,2)}}%">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <h4><b> Hombres: {{$hombres}} ({{($hombres==0) ? 0 : round($hombres/29*100,2)}}%)</b></h4>
            <div class="col-md-8 ml-auto mr-auto">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{round($hombres/29*100,2)}}" aria-valuemin="0" aria-valuemax="100" style="width:{{round($hombres/29*100,2)}}%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card ml-auto mr-auto">
    <div class="text-center">
        <a class="btn btn-sm btn-outline-info" onclick="cargosPDF()" ><i class="fa fa-download"></i> Descargar</a>
    </div>
</div>
@if($cargos->isEmpty())
<div class="text-center">No hay cargos municipales dados de alta para mostrar</div>
@else
@include('cargosMunicipales.table')
@endif
<script>
    // var BASE_URL = window.location.protocol + "//" + window.location.host + "/";

    function showCargo(id) {
        $.get(BASE_URL + "showCargo", {'id': id}, function (r) {
            $("#myModalLabel").html('<h3 class="mt-0">Detalle de Cargo Municipal</h3>');
            $("#myModalBody").html(r);
            $("#myModal").modal();
        });
    }

    function editCargo(id) {
        $.get(BASE_URL + "editCargo", {'id': id}, function (r) {
            $("#myModalLabel").html('<h3 class="mt-0">Edición de Cargo Municipal</h3>');
            $("#myModalBody").html(r);
            $("#myModal").modal();
        });
    }

    function cargosPDF() {
        window.location = BASE_URL + "cargosPDF";
    }
</script>
@endsection
