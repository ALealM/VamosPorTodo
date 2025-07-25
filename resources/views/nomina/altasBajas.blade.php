@extends('layouts.app', ['activePage' => 'cambioss', 'mainPage' => 'nomina'])
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
<form method="post" id="form_ExcelNomina" action="{{URL::to('excelNomina')}}" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-3">
            <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <div class="col-md-12 text-center"><hr style="margin-bottom: 5px; margin-top: 5px">
                                <h4 style="margin-bottom: 0px">Año 1</h4>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group col-md-10 mr-auto ml-auto" style="margin-bottom: 0px; margin-top: 0px">
                                {!! Form::select('anio1',['2022'=>'2022'],'2022',['class'=>'form-control select2','placeholder'=>'Seleccione el año...']) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <div class="col-md-12 text-center"><hr style="margin-bottom: 5px; margin-top: 5px">
                                <h4 style="margin-bottom: 0px">Quincena 1</h4>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group col-md-12" style="margin-bottom: 0px; margin-top: 0px">
                                {!! Form::select('quincena1',$quincenas,null,['class'=>'form-control select2','id'=>'quincena1']) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <div class="col-md-12 text-center"><hr style="margin-bottom: 5px; margin-top: 5px">
                                <h4 style="margin-bottom: 0px">Año 2</h4>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group col-md-10 mr-auto ml-auto" style="margin-bottom: 0px; margin-top: 0px">
                                {!! Form::select('anio2',['2022'=>'2022'],'2022',['class'=>'form-control select2','placeholder'=>'Seleccione el año...']) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <div class="col-md-12 text-center"><hr style="margin-bottom: 5px; margin-top: 5px">
                                <h4 style="margin-bottom: 0px">Quincena 2</h4>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group col-md-12" style="margin-bottom: 0px; margin-top: 0px">
                                {!! Form::select('quincena2',$quincenas,null,['class'=>'form-control select2','id'=>'quincena2']) !!}<i class="form-group__bar"></i>
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
            <button type="button" class="btn btn-info btn-sm" onclick="buscar()"><i class="fa fa-search mr-2"></i>Consultar</button>
        </div>
        <hr>
    </div>
</form>
<div id='contenido' style="text-align: center"></div>
<script>

    $(document).ready(function () {
        $('.select2').select2();
    });

    function buscar() {
        var q1 = $('#quincena1').val();
        var q2 = $('#quincena2').val();
        $('#contenido').empty();
        $('#contenido').append('<hr><img src="../img/preloader4.gif" style="width:40%"/>');
        $.get(BASE_URL + "buscarAB", {'q1': q1, 'q2': q2}, function (r) {
            $('#contenido').empty();
            $('#contenido').append(r);
        });
    }
</script>
@endsection
