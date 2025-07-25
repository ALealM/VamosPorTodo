@extends('layouts.app')
@section('title', 'Main page')
@section('content')

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
    .btn_evt {
        padding-top: 1px;
        padding-bottom: 1px; 
        height: 27px;
        text-align:center;
    }
</style>
{!! Form::model( @$oInventario, ['route' =>[ 'generaResumen' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}

<div class="row">
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        <div class="col-md-12 text-center"><hr>
                            <h4>Fecha Inicial</h4>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group col-md-7 mr-auto ml-auto" style="margin-bottom: 10px">
                            {!! Form::date('fechaI',date('Y-m-d'),['class'=>'form-control','required','id'=>'fechaI']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        <div class="col-md-12 text-center"><hr>
                            <h4>Fecha Final</h4>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group col-md-7 mr-auto ml-auto" style="margin-bottom: 10px">
                            {!! Form::date('fechaF',date('Y-m-d'),['class'=>'form-control','id'=>'fechaF']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        <div class="col-md-12 text-center"><hr>
                            <h4>Dirección <small>(Opcional)</small></h4>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group col-md-12 mr-auto ml-auto" style="margin-bottom: 10px">
                            {!! Form::select('id_direccion',$direcciones,null,['class'=>'form-control','placeholder'=>'Seleccionar dirección...']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!--<div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2>Simple QR Code</h2>
            </div>
            <div class="card-body">
                {{-- QrCode::size(300)->generate('https://informediario.info/2/1') --}}
            </div>
        </div>        
    </div>-->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <br>
        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Generar</button>
    </div>
</div>
@endsection
