@extends('layouts.app', ['activePage' => 'rubros', 'mainPage' => 'programas'])
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

</style>
{!! Form::model( @$oInventario, ['route' =>[ 'storeRubro' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-7">
        <table class="table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th style="text-align: right; width: 200px; vertical-align: middle">Rubro:</th>
                    <td>
                        <div class="form-group" style="margin-bottom: 5px;padding-bottom: 0px;">
                            {!! Form::text('nombre',null,['class'=>'form-control','required','placeholder'=>'Escriba el nombre del nuevo rubro']) !!}<i class="form-group__bar"></i>
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
        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
        <a class="btn btn-secondary" href="{{url('/rubros')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
    </div>
</div> 
@endsection
