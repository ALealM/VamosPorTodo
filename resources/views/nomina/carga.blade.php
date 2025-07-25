@extends('layouts.app', ['activePage' => 'carga', 'mainPage' => 'nomina'])
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
    .btn_evt {
        padding-top: 1px;
        padding-bottom: 1px; 
        height: 27px;
        text-align:center;
    }
</style>
{!! Form::model( @$oInventario, ['route' =>[ 'subirNomina' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}

<div class="row">
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        <div class="col-md-12 text-center"><hr>
                            <h4>Año</h4>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group col-md-7 mr-auto ml-auto" style="margin-bottom: 10px">
                            {!! Form::select('anio',['2022'=>'2022'],'2022',['class'=>'form-control select2','required','id'=>'anio','placeholder'=>'Seleccione el año...']) !!}<i class="form-group__bar"></i>
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
                            <h4>Quincena</h4>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group col-md-7 mr-auto ml-auto" style="margin-bottom: 10px">
                            {!! Form::select('quincena',[],null,['class'=>'form-control select2','required','id'=>'quincena','placeholder'=>'Seleccione la quincena...']) !!}<i class="form-group__bar"></i>
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
                            <h4>Archivo de nómina</h4>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>
                        <div style="margin-bottom: 10px; text-align: center">
                            <input type="file" class="multi" name='nomina' accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required/>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <br>
        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Cargar</button>
    </div>
</div>
<script>

    $(document).ready(function() {        
        @foreach($quincenas as $q)
        $('#quincena').append('<option value="{{$q->id}}" {{$q->carga==1 ? "disabled" : ""}} >{{$q->descripcion}}{{$q->carga==1 ? " - Cargada" : ""}}</option>');
        @endforeach
        $('.select2').select2();
    });   
    
</script>
@endsection
