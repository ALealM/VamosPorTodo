@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  {!! Form::model( @$indicador, ['route' =>[ 'updateIndicador' ],'method' => ( 'PUT'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
  {{Form::hidden('id')}}
  <div class="row">
    <div class="col-lg-6">
      <div class="row">
        <div class="col-lg-12">
          <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
              <tr>
                <th>
                  Eje plan Desarrollo Municipal:
                </th>
              </tr>
              <tr>
                <td>
                  <div class="form-group" style="margin-bottom: 10px">
                    {!! Form::select('id_eje',$ejes,$indicador->estrategia()->id_eje,['class'=>'form-control','required','placeholder'=>'Seleccione el eje...','required','onchange'=>'getEstrategias()','id'=>'id_eje']) !!}<i class="form-group__bar"></i>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-12">
          <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
              <tr>
                <th>
                  Estrategia:
                </th>
              </tr>
              <tr>
                <td>
                  <div class="form-group" style="margin-bottom: 10px">
                    {!! Form::select('id_estrategia',$estrategias,null,['class'=>'form-control','required','placeholder'=>'Seleccione la estrategia...','required','id'=>'estrategia']) !!}<i class="form-group__bar"></i>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-12">
          <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
              <tr>
                <th>
                  Indicador (KPI):
                </th>
              </tr>
              <tr>
                <td>
                  <div class="form-group" style="margin-bottom: 10px">
                    {!! Form::text('indicador',null,['class'=>'form-control','required','placeholder'=>'Escriba el nombre del indicador','required']) !!}<i class="form-group__bar"></i>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-12">
          <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
              <tr>
                <th>
                  Unidad:
                </th>
              </tr>
              <tr>
                <td>
                  <div class="form-group" style="margin-bottom: 10px">
                    {!! Form::select('id_unidad_indicador',$unidades,null,['class'=>'form-control','required','placeholder'=>'Seleccione la unidad...','required']) !!}<i class="form-group__bar"></i>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-12">
          <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
              <tr>
                <th>
                  Meta:
                </th>
              </tr>
              <tr>
                <td>
                  <div class="form-group" style="margin-bottom: 10px">
                    {!! Form::text('meta',null,['class'=>'form-control','required','placeholder'=>'Escriba la meta del indicador','required']) !!}<i class="form-group__bar"></i>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-12">
          <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
              <tr>
                <th>
                  Frecuencia de medición / Reporteo:
                </th>
              </tr>
              <tr>
                <td>
                  <div class="form-group" style="margin-bottom: 10px">
                    {!! Form::select('id_frecuencia_indicador',$frecuencias,null,['class'=>'form-control','required','placeholder'=>'Seleccione la frecuencia...','required']) !!}<i class="form-group__bar"></i>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-12">
          <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
              <tr>
                <th>
                  Medio para obtener la información del KPI:
                </th>
              </tr>
              <tr>
                <td>
                  <div class="form-group" style="margin-bottom: 10px">
                    {!! Form::text('formula',null,['class'=>'form-control','required','placeholder'=>'Escriba la fórmula','required']) !!}<i class="form-group__bar"></i>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-12">
          <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
              <tr>
                <th>
                  Meta de Tiempo:
                </th>
              </tr>
              <tr>
                <td>
                  <div class="form-group" style="margin-bottom: 10px">
                    {!! Form::text('meta_tiempo',null,['class'=>'form-control','required','placeholder'=>'Escriba la meta de tiempo','required']) !!}<i class="form-group__bar"></i>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h4>Responsables <a  class="btn btn-success btn-sm text-white" style="color: green" data-toggle="tooltip" title="Agregar" onclick="addLineR('{{$opcionesS}}')"><i class="fa fa-plus-square-o fa-2x"></i></a></h4>
            </div>
            <div class="col-lg-12">
              <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%" id="tablaResponsables">
                <tbody>
                  <tr>
                    <th>Secretaría</th>
                    <th>Responsable</th>
                    <th></th>
                  </tr>
                  @foreach($responsables as $resp)
                    <tr>
                      <td><div class="form-group" style="margin-bottom: 10px">{!! Form::select('secret[]',$secrets,$resp->responsable()->secretaria()->id,['class'=>'form-control','required','placeholder'=>'Seleccione la secretaría...','required','id'=>'s'.$resp->responsable()->id,'onchange'=>'getResp('.$resp->responsable()->id.')']) !!}<i class="form-group__bar"></i></div></td>
                      <td><div class="form-group" style="margin-bottom: 10px">{!! Form::select('respon[]',$resp->responsables($resp->responsable()->secretaria()->id),$resp->responsable()->id,['class'=>'form-control','required','placeholder'=>'Seleccione un responsable...','required','id'=>'r'.$resp->responsable()->id]) !!}<i class="form-group__bar"></i></div></td>
                      <td><a class="btn btn-danger btn-sm text-white" style="color: red" onclick="deleteRow(this.parentNode.parentNode.rowIndex,'tablaResponsables')" type="button"><i class="fa fa-minus-square-o"></i></a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <hr>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
              <tr>
                <th>
                  Comentarios:
                </th>
              </tr>
              <tr>
                <td>
                  <div class="form-group" style="margin-bottom: 10px">
                    {!! Form::textArea('comentarios',null,['class'=>'form-control','required','placeholder'=>'Escriba los comentarios','required','rows'=>'3']) !!}<i class="form-group__bar"></i>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
      <br>
      <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
      <a class="btn btn-secondary" href="{{url('/planeacionE/indicadores')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
    </div>
  </div>
  <script>
  // var BASE_URL = window.location.protocol + "//" + window.location.host + "/";

  function getEstrategias()
  {
    var eje = document.getElementById('id_eje').value;
    $("#estrategia > option").remove();
    $('#estrategia').append('<option  value="">Seleccione la estrategia...</option>');
    $.get(BASE_URL + "getEstrategias", {'eje': eje}, function (respuesta) {
      $(respuesta).each(function (i, v) { // indice, valor
        $('#estrategia').append('<option value="' + v.id + '">' + v.id_eje + "." + v.numero + " " + v.estrategia + '</option>');
      });
    });
  }

  function addLineR(op) {
    var idR = Math.floor(Math.random() * 1000) + 10;
    var tbl = document.getElementById('tablaResponsables');
    var lastRow = tbl.rows.length;
    var row = tbl.insertRow(lastRow);

    var s = row.insertCell(0);
    var r = row.insertCell(1);
    var ac = row.insertCell(2);

    s.innerHTML = '<div class="form-group" style="margin-bottom: 10px">\n\
    <select class="form-control" required name="secret[]" id="s'+idR+'" onchange="getResp('+idR+')">\n\
    <option selected="selected" value="">Seleccione la secretaría...</option>'+ op +'\n\
    </select><i class="form-group__bar"></i></div>';
    r.innerHTML = '<div class="form-group" style="margin-bottom: 10px">\n\
    <select class="form-control" required name="respon[]" id="r'+idR+'">\n\
    <option selected="selected" value="">Seleccione un responsable...</option>\n\
    </select><i class="form-group__bar"></i></div>';
    ac.innerHTML = '<a class="btn btn-danger btn-sm text-white" style="color: red" onclick="deleteRow(this.parentNode.parentNode.rowIndex,' + "'tablaResponsables'" + ')" type="button" style="cursor:pointer"><i class="fa fa-minus-square-o"></i></a>';

    return false;
  }

  function deleteRow(rowIndex, nameTable){
    var table = document.getElementById(nameTable);
    table.deleteRow(rowIndex);
  }

  function getResp(id){
    var idS = $('#s'+id).val();
    $.get(BASE_URL + "getResp", {'idS': idS}, function (r) {
      $('#r'+id).empty();
      $('#r'+id).append('<option selected="selected" value="">Seleccione un responsable...</option>');
      $(r).each(function (i, v) {
        $('#r'+id).append('<option value="'+v.id+'">'+v.nombre+'</option>');
      });
    });
  }
  </script>
@endsection
