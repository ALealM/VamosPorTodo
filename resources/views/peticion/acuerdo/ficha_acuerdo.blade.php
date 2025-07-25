@extends('layouts.app')
@section('title', 'Main page')
@section('content')


{!! Form::model( @$acuerdo, ['route' =>[ 'storeFichaacuerdo' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
{{Form::hidden('id')}}
{{Form::hidden('rand[]',0)}}



<div class="row col-md-12">
  <div class="col-md-12 text-center">
      <h4>Reunión:{{ $acuerdo->acuerdo }}</h4>
  </div>
  <div class="col-md-12" id="0">
    <table class="dataTable table-bordered table-condensed table-hover" style="width: 100%; padding-bottom:1em; margin-bottom:1em;" id="tablaAcciones">
    <tbody>
        <tr>Fecha de otorgada:{!! $acuerdo->fecha_otorgada !!}</tr>
    </tbody>
    </table>
  </div>
</div>



<div class="row col-md-12">
  <div class="col-md-12 text-center">
    <h4>Acuerdos <a class="btn btn-success btn-sm text-white" style="color: green;" data-toggle="tooltip" title="Agregar" onclick="addLineAV({{ $acuerdo->id }})"><i class="fa fa-plus-square-o fa-2x"></i></a></h4>
  </div>
  <div class="col-md-12" id="0">
    <table class="dataTable table-bordered table-condensed table-hover" style="width: 100%; padding-bottom:1em; margin-bottom:1em;" id="tablaAcciones">
    <tbody>
        <tr>
          <th colspan="3" style="text-align: center; background-color:#b4cfb5;">Acuerdo</th>
        </tr>
        <tr>
          <th colspan="2" style="text-align: center">Responsable</th>
          <th style="text-align: center">Fecha</th>
        </tr>
        <tr>
          <td colspan="2">
            <div class="form-group">{!! Form::select('id_responsable[]',$direcciones,$acuerdo->responsable,['class'=>'form-control','required','placeholder'=>'Seleccione el área responsable...','required','id'=>'resp1' ]) !!}<i class="form-group__bar"></i></div>
          </td>
          <td>
            <div class="form-group">{!! Form::date('fecha[]',date('Y-m-d'),['class'=>'form-control','placeholder'=>'Seleccione la fecha','required']) !!}<i class="form-group__bar"></i></div>
          </td>          
        </tr>

        <tr>
          <th colspan="3" style="text-align: center; background-color:#eee;">Actividad</th>
          <!--<th style="text-align: center; background-color:#eee;">Avance</th>
          <th style="text-align: center; background-color:#eee;">Evidencias</th>-->
        </tr>
        <tr>
          <td colspan="3" >
            <div class="form-group">{!! Form::text('actividad[]',null,['class'=>'form-control','placeholder'=>'Ingrese la actividad','required']) !!}<i class="form-group__bar"></i></div>
          </td>
          <!--<td>
            <div class="form-group">
              <div class="card-body">
                <div class="form-group">{!! Form::number('avance[]',null,['class'=>'form-control','placeholder'=>'Ingrese el avance','required','id'=>'avance']) !!}<i class="form-group__bar"></i></div>
              </div>
            </div>
          </td>
          <td>
            {!! Form::file('archivo[0][]',['class'=>'','multiple','id'=>'archivo']) !!}
          </td>-->
        </tr>
        <tr>
          <td colspan="5">
            <div class="row col-md-12">
              <div class="col-md-12 text-center">
                <h4>Áreas Colaboradoras</h4>
              </div>
              <div class="col-md-12">
                {{Form::select('colaboradores[0][]',$direcciones,null,['multiple','size'=>'10'])}}
                <script>
                  $('select[name="colaboradores[0][]"]').bootstrapDualListbox();
                </script>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="rows" class="col-md-12" style="padding-right: 0px;padding-left: 0px;margin-right: 0px;margin-left: 0px;
">
    
  </div>
</div>



<br><br>


<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12 text-center">
    <br>
    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
    <a class="btn btn-secondary" href="{{url('/peticion/index')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
  </div>
</div>




<script>
    // You can modify the upload files to pdf's, docs etc
//Currently it will upload only images

$(document).ready(function($) {

// Upload btn on change call function
$(".uploadlogo").change(function() {
  var filename = readURL(this);
  $(this).parent().children('span').html(filename);
});

// Read File and return value  
function readURL(input) {
  var url = input.value;
  var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
  if (input.files && input.files[0] && (
    ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "gif" || ext == "pdf"
    )) {
    var path = $(input).val();
    var filename = path.replace(/^.*\\/, "");
    // $('.fileUpload span').html('Uploaded Proof : ' + filename);
    return "Uploaded file : "+filename;
  } else {
    $(input).val("");
    return "Only image/pdf formats are allowed!";
  }
}
// Upload btn end
});


  function addLineA(op) {
    var idA = Math.floor(Math.random() * 1000) + 10;
    var tbl = document.getElementById('tablaAcciones');
    var lastRow = tbl.rows.length;
    var row = tbl.insertRow(lastRow);

    
    var act = row.insertCell(0);
    var obs = row.insertCell(1);
    var i = row.insertCell(2);
    var f = row.insertCell(3);
    var resp = row.insertCell(4);
    var arch = row.insertCell(5);


    
    act.innerHTML = '<div class="form-group bmd-form-group is-filled" style="margin-bottom: 10px">\n\
  <input class="form-control" required="" placeholder="Ingrese la actividad" id="a' + idA + '"  name="act[]" type="text">\n\
  <i class="form-group__bar"></i></div>';
    obs.innerHTML = '<div class="form-group bmd-form-group is-filled" style="margin-bottom: 10px">\n\
  <input class="form-control" placeholder="Ingrese las observaciones" id="o' + idA + '"  name="obs[]" type="text">\n\
  <i class="form-group__bar"></i></div>';
  i.innerHTML = '<div class="form-group bmd-form-group is-filled" style="margin-bottom: 10px">\n\
  <input class="form-control" required="" placeholder="Ingrese hora inicial" id="i' + idA + '"  name="hInicio[]" type="time" value="{{date('H:i')}}">\n\
  <i class="form-group__bar"></i></div>';
    f.innerHTML = '<div class="form-group bmd-form-group is-filled" style="margin-bottom: 10px">\n\
  <input class="form-control" required="" placeholder="Ingrese hora final" id="f' + idA + '"  name="hFin[]" type="time" value="{{date('H:i')}}">\n\
  <i class="form-group__bar"></i></div>';
    

    return false;
  }

  function deleteRow(div) {
    $('#'+div).remove();
  }
  function addLineAV(id){
    var rand = Math.floor(Math.random() * 100000) + 1000;
    $.get(BASE_URL + "addLineAV", {id:id,rand:rand}, function (r) {
      $('#rows').append(r);
    });
    
  }


</script>

@endsection