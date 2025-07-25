@extends('layouts.app')
@section('title', 'Main page')
@section('content')


  {!! Form::model( @$oInventario, ['route' =>[ 'storeAccion' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}

  <div class="row">
    <div class="col-md-6">
      <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
        <tbody>
          <tr>
            <th>
              Nombre Acción:
            </th>
          </tr>
          <tr>
            <td>
              <div class="form-group" style="margin-bottom: 10px">
                {!! Form::text('nombre',null,['class'=>'form-control','required','placeholder'=>'Escriba el nombre de la acción','required' ]) !!}<i class="form-group__bar"></i>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-6">
      <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
        <tbody>
          <tr>
            <th>
              Tipo:
            </th>
          </tr>
          <tr>
            <td>
              <div class="form-group" style="margin-bottom: 10px">
                {!! Form::select('id_tipo_accion',$acciones,null,['class'=>'form-control','required','placeholder'=>'Seleccione el tipo de acción...','required' ]) !!}<i class="form-group__bar"></i>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-6 ">
      <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
        <tbody>
          <tr>
            <th>
              Problemática:
            </th>
          </tr>
          <tr>
            <td>
              <div class="form-group" style="margin-bottom: 10px">
                {!! Form::text('problematica',null,['class'=>'form-control','required','placeholder'=>'Escriba la problemática','required' ]) !!}<i class="form-group__bar"></i>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-12">
      <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
        <tbody>
          <tr>
            <th>
              Descripción:
            </th>
          </tr>
          <tr>
            <td>
              <div class="form-group" style="margin-bottom: 10px">
                {!! Form::textarea('descripcion',null,['class'=>'form-control form-control-sm','required','rows'=>'3','placeholder'=>'Descripción de la acción']) !!}<i class="form-group__bar"></i>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-center">
      <h4>Beneficiarios <a  class="btn btn-success btn-sm text-white" style="color: green" data-toggle="tooltip" title="Agregar" onclick="addLineB('{{$opciones}}')"><i class="fa fa-plus-square-o fa-2x"></i></a></h4>
    </div>
    <div class="col-md-12">
      <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%" id="tablaBeneficiarios">
        <tbody>


          <tr>
            <th>Colonia</th>
            <th>Tipo beneficiarios</th>
            <th>Número beneficiarios</th>
            <th></th>
          </tr>
          <tr>
            <td>
              <div class="row">
                <div class="col-lg-6">
                  <input id="coloniaB_a_0" type="hidden" name="coloniaB[0]" />
                  <input id="coloniaB_0" type="text" name="coloniaB_0" class="form-control inputSlim" autocomplete="off" required onkeypress="{ buscar_colonia(0);  return false; }" />
                </div>
                <div class="col-lg-6">
                  <a href="javascript:" class="btn btn-secondary btn-sm" onclick="{  buscar_colonia(0) }"><i class="fa fa-search mr-2"></i>Buscar colonia</a>
                </div>
              </div>


            </td>
            <td><div class="form-group" style="margin-bottom: 10px">{!! Form::select('tipoB[]',$tiposB,null,['class'=>'form-control','required','placeholder'=>'Seleccione el tipo de beneficiarios...','required' ]) !!}<i class="form-group__bar"></i></div></td>
            <td><div class="form-group" style="margin-bottom: 10px">{!! Form::text('numeroB[]',null,['class'=>'form-control','required','placeholder'=>'Escriba el número de beneficiarios','required' ]) !!}<i class="form-group__bar"></i></div></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-center">
      <h4>Responsables <a  class="btn btn-success btn-sm text-white" style="color: green" data-toggle="tooltip" title="Agregar" onclick="addLineR('{{$opcionesS}}')"><i class="fa fa-plus-square-o fa-2x"></i></a></h4>
    </div>
    <div class="col-md-12">
      <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%" id="tablaResponsables">
        <tbody>
          <tr>
            <th>Secretaría</th>
            <th>Responsable</th>
            <th></th>
          </tr>
          <tr>
            <td><div class="form-group" style="margin-bottom: 10px">{!! Form::select('secret[]',$secrets,null,['class'=>'form-control','required','placeholder'=>'Seleccione la secretaría...','required','id'=>'s1','onchange'=>'getResp(1)']) !!}<i class="form-group__bar"></i></div></td>
            <td><div class="form-group" style="margin-bottom: 10px">{!! Form::select('respon[]',[],null,['class'=>'form-control','required','placeholder'=>'Seleccione un responsable...','required','id'=>'r1']) !!}<i class="form-group__bar"></i></div></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 ">
      <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
        <tbody>
          <tr>
            <th>
              Medio de acción:
            </th>
          </tr>
          <tr>
            <td>
              <div class="form-group" style="margin-bottom: 10px">
                {!! Form::text('medio_accion',null,['class'=>'form-control','required','placeholder'=>'Escriba el medio de acción','required' ]) !!}<i class="form-group__bar"></i>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-6 ">
      <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
        <tbody>
          <tr>
            <th>
              Presupuesto utópico:
            </th>
          </tr>
          <tr>
            <td>
              <div class="form-group" style="margin-bottom: 10px">
                {!! Form::text('presupuesto_utopico',null,['class'=>'form-control','required','placeholder'=>'Escriba el presupuesto','required' ]) !!}<i class="form-group__bar"></i>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-6 ">
      <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
        <tbody>
          <tr>
            <th>
              Indicador:
            </th>
          </tr>
          <tr>
            <td>
              <div class="form-group" style="margin-bottom: 10px">
                {!! Form::text('indicador_objetivo',null,['class'=>'form-control','required','placeholder'=>'Escriba el indicador a medir','required' ]) !!}<i class="form-group__bar"></i>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-6 ">
      <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
        <tbody>
          <tr>
            <th>
              Objetivo:
            </th>
          </tr>
          <tr>
            <td>
              <div class="form-group" style="margin-bottom: 10px">
                {!! Form::text('indicador_beneficiarios',null,['class'=>'form-control','required','placeholder'=>'Escriba el número de beneficiarios del objetivo','required' ]) !!}<i class="form-group__bar"></i>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-6 ">
      <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
        <tbody>
          <tr>
            <th>
              Eje Plan DM:
            </th>
          </tr>
          <tr>
            <td>
              <div class="form-group" style="margin-bottom: 10px">
                {!! Form::select('eje_plan_dm',$ejes,null,['class'=>'form-control','required','placeholder'=>'Seleccione el eje del Plan DM...','required' ]) !!}<i class="form-group__bar"></i>
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
      <a class="btn btn-secondary" href="{{url('/acciones/listado')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
    </div>
  </div>


  <script>

  function cambiaSerie()
  {
    var seccion = document.getElementById('seccion').value;
    $("#serie > option").remove();
    $('#serie').append('<option  value="">Seleccione la serie...</option>');
    // var BASE_URL = window.location.protocol + "//" + window.location.host + "/";
    $.get(BASE_URL + "getSeries", {'seccion': seccion}, function (respuesta) {
      $(respuesta).each(function (i, v) { // indice, valor
        $('#serie').append('<option value="' + v.id + '">' + v.codigoSerie + '</option>');
      });
    });
  }

  function addLineB(op) {
    var tbl = document.getElementById('tablaBeneficiarios');
    var lastRow = tbl.rows.length;
    var row = tbl.insertRow(lastRow);

    var c = row.insertCell(0);
    var t = row.insertCell(1);
    var n = row.insertCell(2);
    var ac = row.insertCell(3);

    var cols = '';
    /*$.get(BASE_URL + "getColonias", {}, function (r) {

      $(r).each(function (i, v) {
        cols = cols + '<option value="'+v.id+'">'+v.nombre+'</option>';
      });

      c.innerHTML = '<div class="form-group" style="margin-bottom: 10px">\n\
      <select class="form-control" required="" name="coloniaB[]">\n\
      <option selected="selected" value="">Seleccione la colonia...</option>'+ cols +'\n\
      </select><i class="form-group__bar"></i></div>';
      t.innerHTML = '<div class="form-group" style="margin-bottom: 10px">\n\
      <select class="form-control" required="" name="tipoB[]">\n\
      <option selected="selected" value="">Seleccione el tipo de beneficiarios...</option>'+ op +'\n\
      </select><i class="form-group__bar"></i></div>';
      n.innerHTML = '<div class="form-group" style="margin-bottom: 10px"><input class="form-control" required="" placeholder="Escriba el número de beneficiarios" name="numeroB[]" type="text"><i class="form-group__bar"></i></div>';
      ac.innerHTML = '<a class="btn btn-danger btn-sm text-white" style="color: red" onclick="deleteRow(this.parentNode.parentNode.rowIndex,' + "'tablaBeneficiarios'" + ')" type="button" style="cursor:pointer"><i class="fa fa-minus-square-o"></i></a>';
    });*/





      indexColonias++;
      c.innerHTML = '<div class="row">'+
      '<div class="col-lg-6">'+
      '<input id="coloniaB_a_'+indexColonias+'" type="hidden" name="coloniaB['+indexColonias+']" />'+
      '<input id="coloniaB_'+indexColonias+'" type="text" name="coloniaB_'+indexColonias+'" class="form-control inputSlim" required autocomplete="off" onkeypress="{ buscar_colonia('+indexColonias+'); return false; }" />'+
      '</div>'+
      '<div class="col-lg-6">'+
        '<a href="javascript:" class="btn btn-secondary btn-sm" onclick="{  buscar_colonia('+indexColonias+') }"><i class="fa fa-search mr-2"></i>Buscar colonia</a>'+
      '</div>'+
      '</div>';
      t.innerHTML = '<div class="form-group" style="margin-bottom: 10px">\n\
      <select class="form-control" required="" name="tipoB[]">\n\
      <option selected="selected" value="">Seleccione el tipo de beneficiarios...</option>'+ op +'\n\
      </select><i class="form-group__bar"></i></div>';
      n.innerHTML = '<div class="form-group" style="margin-bottom: 10px"><input class="form-control" required="" placeholder="Escriba el número de beneficiarios" name="numeroB[]" type="text"><i class="form-group__bar"></i></div>';
      ac.innerHTML = '<a class="btn btn-danger btn-sm text-white" style="color: red" onclick="deleteRow(this.parentNode.parentNode.rowIndex,' + "'tablaBeneficiarios'" + ')" type="button" style="cursor:pointer"><i class="fa fa-minus-square-o"></i></a>';


    return false;
  }

  /*BUSCAR COLONIA*/
  var indexColonias = 0;
  var indexColoniaActual = 0;

  function buscar_colonia(iIdIndexColonia)
  {
    indexColoniaActual = iIdIndexColonia;
    $("#myModalLabel").html('<h3 class="mt-0">Agregar colonia</h3>');
    $("#myModalBody").html(
      '<div class="row">' +
        '<label class="col-12 col-form-label">Buscar colonia <small>(ingresa una palabra clave)</small></label>' +
        '<div class="col-lg-12">' +
          '{!! Form::text('buscador_colonia',null,['id'=>'buscador_colonia','class'=>'form-control inputSlim','minlength'=>4,'onkeyup'=>'{ if($("#buscador_colonia").val().length >= 2){cambio_colonia();} }']) !!}' +
        '</div>' +
      '</div>' +
      '<div class="row">' +
        '<div class="col-lg-12 bg-light" style="max-height:150px; overflow-y: scroll;">' +
          '<table>' +
            '<tbody id="tbodyResultadosColonia"></tbody>' +
          '</table>' +
        '</div>' +
      '</div>' +
      '<div class="card-footer text-center">' +
      '<a href="javascript:;" class="btn btn-secondary btn-sm" data-dismiss="modal" aria-label="Close"><i class="fa fa-rotate-left mr-2"></i>Cancelar</a>' +
      '</div>'
    );
    $("#myModal").modal();
  }

  $("#divBusquedaColonia").hide();
  /*$(document).on('keyup', "#buscador_colonia input[type='text']",function () {
  //$('#buscador_colonia').on('keyup',function ( evt ) {
    if ($("#buscador_colonia").val().length > 3) {
      cambio_colonia();
    }
  });*/

  function cambio_colonia()
  {
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[Nombre="csrf-token"]').attr('content')},
      type: "GET",
      url: "{{ asset ('buscador_colonia') }}",
      data: {
        'palabra' : $("#buscador_colonia").val(),
      },
      cache: false,
      dataType: "json",
      success: function (result) {
        if(result.estatus == 1){
          var sHtml = '';
          for (var i in result.resultado) {
            var aResultado = result.resultado[i];
            sHtml = sHtml +
            '<tr>' +
              '<td>' + aResultado['nombre'] + '</td>' +
              '<td>' +
                '<a href="javascript:;" class="btn btn-success btn-sm mr-2 ml-2" onclick="agregar_colonia(\''+aResultado['nombre']+'\','+aResultado['id']+')"><i class="fa fa-plus"></i></a>'+
              '</td>' +
            '</tr>';
          }
          $("#tbodyResultadosColonia").html(sHtml);
        }else {
          notificacion("Alerta","Error al consultar colonia.","error");
        }
      },
      error: function (result) {
        console.log("error");
      }
    });
  }

  function agregar_colonia(sNombre,iId)
  {
    console.log( sNombre,iId,indexColoniaActual );
    $("#coloniaB_"+indexColoniaActual).val(sNombre);
    $("#coloniaB_a_"+indexColoniaActual).val(iId);
    console.log("--",$("#coloniaB_a_"+indexColoniaActual).val() );
    $('#divBusquedaColonia').slideUp();
    $("#myModal").modal('toggle');
  }
  /*BUSCAR COLONIA END*/

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
