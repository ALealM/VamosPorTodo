@extends('layouts.app', ['activePage' => 'programas', 'mainPage' => 'programas'])
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
{!! Form::model( @$oInventario, ['route' =>[ 'storePrograma' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data"]) !!}
<div class="row">
    <div class="col-md-6 ml-auto mr-auto">
        <table class="table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Nombre:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::text('nombre',null,['class'=>'form-control','required','placeholder'=>'Escriba el nombre del nuevo programa']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-floppy-o mr-2"></i>Crear</button>
    </div>
</div>
<div style="text-align: center"><hr>
    <p style="font-size: 20px"><b>Listado de Programas Sociales</b></p>
</div>
@if($programas->isEmpty())
<div class="text-center">No hay programas dados de alta para mostrar</div>
@else
@include('programas.table')
@endif
<script>
      // var BASE_URL = window.location.protocol + "//" + window.location.host + "/";

      function borrarProg(id) {
        swal({
            title: "Borrar Programa",
            text: "¡La información no se podrá recuperar! \n¿Desea continuar?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonText: "Cancelar",
            confirmButtonText: "Sí, borrar"
          },
          function() {
            window.location.href = BASE_URL + "programa/delete/" + id;
          }
        );
      }
</script>
@endsection
