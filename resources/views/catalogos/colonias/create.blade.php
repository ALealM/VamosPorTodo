@extends('layouts.app')
@section('title', 'Main page')
@section('content')


  {!! Form::model( @$oInventario, ['route' =>[ 'storeColonia' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}

  <div class="row">
    <div class="col-md-6">
      <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
        <tbody>
          <tr>
            <th>
              Colonia:
            </th>
          </tr>
          <tr>
            <td>
              <div class="form-group" style="margin-bottom: 10px">
                {!! Form::text('nombre',null,['class'=>'form-control','required','placeholder'=>'Escriba el nombre de la nueva colonia','required' ]) !!}<i class="form-group__bar"></i>
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
      <a class="btn btn-secondary" href="{{url('/catalogos/colonias')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
    </div>
  </div>

@endsection
