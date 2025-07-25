@extends('layouts.app', ['activePage' => 'Indicadores', 'mainPage' => 'Indicadores'])
@section('title', 'Main page')
@section('content')
<style>
    .nav-pills .nav-link.active {
        background-color: #e8ebf5;
    }

    thead {
        text-align: center;
        background-color: #fff;
    }
</style>



<div class="tab-container" style="padding-bottom: 0px">
    <ul class="nav nav-pills nav-fill" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" role="tab" aria-expanded="true" aria-current="page" href="#seguro">
                <img src="../img/ejes/logo_seguro.png" style="width:auto; height:50px;">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" role="tab" aria-expanded="false" href="#bienestar">
                <img src="../img/ejes/logo_bienestar.png" style="width:auto; height:50px;">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" role="tab" aria-expanded="false" href="#sostenible">
                <img src="../img/ejes/logo_sostenibilidad.png" style="width:auto; height:50px;">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" role="tab" aria-expanded="false" href="#innovacion">
                <img src="../img/ejes/logo_innovacion.png" style="width:auto; height:50px;">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" role="tab" aria-expanded="false" href="#competitivo">
                <img src="../img/ejes/logo_competitividad.png" style="width:auto; height:50px;">
            </a>
        </li>
    </ul>

    <!--<div class="container">
      <div class="row">
        <div class="col-md-12" style="overflow:scroll;">
          @include('indicadores.table')
        </div>
      </div>
    </div>-->



    <div class="tab-content" style="padding-bottom: 2px">
        <div class="tab-pane fade active show" id="seguro" role="tabpanel" aria-expanded="true">
            <div class=" table-responsive">
                @include('indicadores.table')
            </div>
        </div>

        <div class="tab-pane fade" id="bienestar" role="tabpanel" aria-expanded="false">
            <div class=" table-responsive">
                @include('indicadores.bienestar')
            </div>
        </div>
        <div class="tab-pane fade" id="sostenible" role="tabpanel" aria-expanded="false">
            <div class=" table-responsive">
                @include('indicadores.sostenible')
            </div>
        </div>
        <div class="tab-pane fade" id="innovacion" role="tabpanel" aria-expanded="false">
            <div class=" table-responsive">
                @include('indicadores.innovador')
            </div>
        </div>
        <div class="tab-pane fade" id="competitivo" role="tabpanel" aria-expanded="false">
            <div class=" table-responsive">
                @include('indicadores.competitivo')
            </div>
        </div>
    </div>
</div>


@endsection
