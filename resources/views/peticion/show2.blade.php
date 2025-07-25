@extends('layouts.app')
@section('title', 'Main page')
@section('content')


{!! Form::model( @$acuerdos, ['route' =>[ 'storeAcuerdo' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}

<div class="row">
  <div class="col-md-6">
    <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
      <tbody>
        <tr>
          <th>
            Usuario:
            {{ \Auth::User()->nombre }} {{ \Auth::User()->ap_paterno }} {{ \Auth::User()->ap_materno }}
          </th>
          <th>
            Fecha:
            <div class="form-group" style="margin-bottom: 10px">
              {!! Form::date('fecha',date('Y-m-d'),['class'=>'form-control form-control-sm','required']) !!}<i class="form-group__bar"></i>
            </div>
          </th>
        </tr>
        <tr>
          <th>
            Petición Acuerdo:
          </th>
        </tr>
        <tr> 
          <td>
            <div class="form-group" style="margin-bottom: 10px">
              {!! Form::text('acuerdo',null,['class'=>'form-control','required','placeholder'=>'Escriba el acuerdo','required' ]) !!}<i class="form-group__bar"></i>
            </div>
          </td>
        </tr>

        <tr>
          <td>
            <div class="form-group" style="margin-bottom: 10px">
              {!! Form::select('id_dependencia',$dependencias,null,['class'=>'form-control','required','placeholder'=>'Seleccione la dependencia...','required' ]) !!}
              <i class="form-group__bar"></i>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="form-group" style="margin-bottom: 10px">
              {!! Form::select('estatus',$estatus,null,['class'=>'form-control','required','placeholder'=>'Seleccione el estatus...','required' ]) !!}
              <i class="form-group__bar"></i>
            </div>
          </td>
        </tr>
        <tr>
          
          <div class="col-lg-12 col-md-12 col-sm-12">
                <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
                    <tbody>
                        <tr>
                            <th>
                                Archivo:
                            </th>
                        </tr>                
                        <tr>
                            <td>
                                
                                    <input type="file" class="form-control" name="archivo" required><i class="form-group__bar"></i>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>                
            </div>
          
        </tr>

      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12 text-center">
    <br>
    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
    <a class="btn btn-secondary" href="{{url('/peticion/index')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
  </div>
</div>

@endsection