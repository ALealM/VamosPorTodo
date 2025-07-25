@extends('layouts.app')
@section('title', 'Main page')
@section('content')
<style>
#encabezado {
    border-collapse: separate;
    border-spacing: 0;
}
#encabezado, .tdEnc {
    border: 1px solid #eee;
    border-radius: 3px;
    -moz-border-radius: 3px;
    padding: 3px;
}
.dropdown-menu {
  max-width:50px;
}
</style>
{!! Form::model( @$reporte, ['route' =>[ 'storeAvancesReporte' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data"]) !!}
{{Form::hidden('id',null)}}
<div class="row pb-15">
  <div class="col-md-12" style="padding-top: 10px">
    <h3 style="text-align: center; margin-top: 0px"><b>Folio: {{$reporte->folio}}</b></h3>
  </div>
  <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
    <table style="width: 100%" id="encabezado">
      <tbody>
        <tr>
          <th style="background-color:#ddd;text-align: center; border-bottom: solid 1px #eee">Descripción</th>
          <td class="tdEnc">{{ $reporte->observaciones }}</td>
        </tr>
        <tr>
          <th style="background-color:#ddd;text-align: center">Área y tipo</th>
          <td class="tdEnc">{{ $reporte->area()->area }} - {{ $reporte->falla()->falla }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div><hr></div>
<div class="row col-md-12">
    <div class="col-md-12 text-center">
        <h4>Registrar Avance <a class="btn btn-success btn-sm text-white" style="color: green" data-toggle="tooltip" title="Agregar" onclick="addLine()" id="agregar"><i class="fa fa-plus fa-2x"></i></a></h4>
    </div>
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed" style="width: 100%" id="tablaAvances">
            <tbody>
                <tr style="background-color:#073656; color: white">
                    <th style="text-align: center">Acción</th>
                    <th style="text-align: center">Fecha</th>
                    <th style="text-align: center">Hora</th>
                    <th style="text-align: center">Actividad</th>
                    <th style="text-align: center">Avance</th>
                    <th></th>
                </tr>
                <tr>
                    <td style="text-align: center">ALTA</td>
                    <td style="text-align: center">{!! date( 'd/m/Y', strtotime($reporte->fecha) ) !!}</td>
                    <td style="text-align: center">{!! date( 'H:i A', strtotime($reporte->fecha) ) !!}</td>
                    <td>Se dio de alta un nuevo reporte en <b>{{ $reporte->area()->area }}</b> para la atención de <b>{{ $reporte->falla()->falla }}</b>.</td>
                    <td style="text-align: center">0%</td>
                    <td class="text-center">
                      <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-gear"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a href="{{url('/respuesta/ficha/'.$reporte->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil mr-2"></i>Editar </a><br>
                          <a href="{{url('/respuesta/show/'.$reporte->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-check mr-2"></i>Guardar</a><br>
                          <a href="{{url('/respuesta/show/'.$reporte->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-times mr-2"></i>Borrar</a><br>
                        </div>
                      </div>
                    </td>
                </tr>
                @foreach($avances as $avance)
                <tr>
                    <td style="text-align: center">{{$avance->accion}}</td>
                    <td style="text-align: center">{!! date( 'd/m/Y', strtotime($avance->fecha) ) !!}</td>
                    <td style="text-align: center">{!! date( 'H:i A', strtotime($avance->fecha) ) !!}</td>
                    <td>{{$avance->actividad}}</td>
                    <td style="text-align: center">
                      {{$avance->avance}}%
                      {{Form::hidden('avance[]',$avance->avance,['class'=>'conteo'])}}
                    </td>
                    <td class="text-center">
                      <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-gear"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a href="{{url('/respuesta/ficha/'.$avance->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil mr-2"></i>Editar </a><br>
                          <a href="{{url('/respuesta/show/'.$avance->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-check mr-2"></i>Guardar</a><br>
                          <a href="{{url('/respuesta/show/'.$avance->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-times mr-2"></i>Borrar</a><br>
                        </div>
                      </div>
                    </td>
                </tr>
                @endforeach
                <tr>
                  <th colspan="4"></td>
                  <th style="text-align: center"><b><span id='totAv'>0.00%</span></b></td>
                  <th>{{Form::hidden('accion',null,['id'=>'accion'])}}</td>
                </tr>
            </tbody>
        </table>
        <!--<hr>-->
    </div>
</div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12 text-center"><hr>
    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
    <a class="btn btn-secondary" href="{{url('/respuesta')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
  </div>
</div>
{{Form::close()}}
<script>
function addLine() {
    var idA = Math.floor(Math.random() * 1000) + 10;
    var tbl = document.getElementById('tablaAvances');
    var lastRow = tbl.rows.length;
    var row = tbl.insertRow(lastRow-1);

    var acc = row.insertCell(0);
    var fecha = row.insertCell(1);
    var hora = row.insertCell(2);
    var act = row.insertCell(3);
    var porc = row.insertCell(4);
    var ac = row.insertCell(5);

    acc.className = 'text-center';
    acc.innerHTML = '<div class="form-group bmd-form-group is-filled" style="margin-bottom: 10px" id="acDT'+idA+'">\n\
    SEGUIMIENTO</div><input type="hidden" value="'+idA+'" name="divAcc[]" class="accion">';
    fecha.innerHTML = '<div class="form-group bmd-form-group is-filled" style="margin-bottom: 10px" id="fDT'+idA+'">\n\
    <input class="form-control" required placeholder="Ingrese fecha" id="f'+idA+'" name="fecha[]" type="date" value="{{date('Y-m-d')}}">\n\
    <i class="form-group__bar"></i></div>';
    hora.innerHTML = '<div class="form-group bmd-form-group is-filled" style="margin-bottom: 10px" id="hDT'+idA+'">\n\
    <input class="form-control" required placeholder="Ingrese hora" id="h'+idA+'" name="hora[]" type="time" value="{{date('H:i')}}">\n\
    <i class="form-group__bar"></i></div>';
    act.innerHTML = '<div class="form-group bmd-form-group is-filled" style="margin-bottom: 10px" id="aDT'+idA+'">\n\
    <input class="form-control" required placeholder="Ingrese la actividad" id="a'+idA+'" name="act[]" type="text">\n\
    <i class="form-group__bar"></i></div>';
    porc.innerHTML = '<div class="form-group bmd-form-group is-filled" style="margin-bottom: 10px" id="pDT'+idA+'">\n\
    <input class="form-control conteo" required placeholder="Ingrese el porcentaje" id="p'+idA+'" name="porc[]" type="text" \n\
    onKeyPress="return isNumberCant(event,'+"'0.00'"+',3,2)" onkeyup="conteo('+idA+')" onBlur="borrar('+idA+')">\n\
    <i class="form-group__bar"></i></div>';
    ac.style = 'vertical-align:top';
    ac.className = 'text-center';
    ac.innerHTML = '<a class="btn btn-danger btn-sm text-white" onclick="deleteRow(this.parentNode.parentNode.rowIndex,' + "'tablaAvances'" + ')" type="button" style="cursor:pointer"><i class="fa fa-times"></i></a>';
    $('#a'+idA).focus();
    $('#accion').val(idA);
    return false;
}

function deleteRow(rowIndex, nameTable){
    var table = document.getElementById(nameTable);
    table.deleteRow(rowIndex);
    $( ".accion" ).each(function( acc ) {
        $('#accion').val($(this).val());
    });
    var total = 0;
    var acc = $('#accion').val();
    $( ".conteo" ).each(function( porc ) {
        total = total + ($(this).val()*1);
        $('#totAv').empty();
        $('#totAv').append(Math.round(total*100)/100+'%');
        $('#acDT'+acc).empty();
        if(total == 100){
          $('#acDT'+acc).append('FINALIZAR');
        }
        else{
          $('#acDT'+acc).append('SEGUIMIENTO');
        }
    });
}

function isNumberCant(e, valInicial, nEntero, nDecimal)
{
    var dec = nDecimal - 1;
    var obj = e.srcElement || e.target;
    var tecla_codigo = (document.all) ? e.keyCode : e.which;
    var tecla_valor = String.fromCharCode(tecla_codigo);
    var patron2 = /[\d.]/;
    var control = (tecla_codigo === 46 && (/[.]/).test(obj.value)) ? false : true;
    var existePto = (/[.]/).test(obj.value);

    //el tab
    if (tecla_codigo === 8)
        return true;

    if (valInicial !== obj.value) {
        var TControl = obj.value.length;
        if (existePto === false && tecla_codigo !== 46) {
            if (TControl === nEntero) {
                obj.value = obj.value + ".";
            }
        }

        if (existePto === true) {
            var subVal = obj.value.substring(obj.value.indexOf(".") + 1, obj.value.length);

            if (subVal.length > dec) {
                return false;
            }
        }

        return patron2.test(tecla_valor) && control;
    } else {
        if (valInicial === obj.value) {
            obj.value = '';
        }
        return patron2.test(tecla_valor) && control;
    }
}

function conteo(id) {
    var total = 0;
    var acc = $('#accion').val();
    $( ".conteo" ).each(function( porc ) {
        $('#agregar').removeAttr('onclick');
        $('#agregar').attr('onclick','addLine()');
        total = total + ($(this).val()*1);
        $('#totAv').empty();
        $('#totAv').append(Math.round(total*100)/100+'%');
        $('#acDT'+acc).empty();
        $('#acDT'+acc).append('SEGUIMIENTO');
    });
    if(total >= 100){
      $('#agregar').removeAttr('onclick');
      var tot = Math.round(($('#p'+id).val())*100)/100;
      total -= tot;
      $('#p'+id).val((Math.round((100-total)*100)/100));
      $('#totAv').empty();
      $('#acDT'+acc).empty();
      $('#totAv').append('100%');
      $('#acDT'+acc).append('FINALIZAR');
    }
}

function borrar(id) {
    val = $('#p'+id).val();
    if(val=='' || val==0){
      $('#p'+id).val('');
    }
}
</script>

@endsection
