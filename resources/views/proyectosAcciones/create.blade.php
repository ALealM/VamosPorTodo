@extends('layouts.app', ['activePage' => 'createProyectoAccion'])
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
{!! Form::model( @$proyAcc, ['route' =>[ 'storeProyAcc' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}

<div class="row">
    <div class="col-md-12 text-center">
        <h4>Datos Generales del Proyecto</h4><hr>
    </div>
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Macroproyecto:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::text('macroproyecto',null,['class'=>'form-control','required','placeholder'=>'Escriba el Macroproyecto','required']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Nombre del Proyecto o Acción:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::text('nombre',null,['class'=>'form-control','required','placeholder'=>'Escriba el nombre del proyecto o acción','required']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>    
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Descripción breve del proyecto o acción:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::textArea('descripcion',null,['class'=>'form-control','placeholder'=>'Escriba la descripción del proyecto o acción','required','rows'=>'2']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Beneficiarios directos:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::text('beneficiarios',null,['class'=>'form-control','placeholder'=>'Escriba el número de beneficiarios directos','required','onKeyPress'=>'return isNumberInt(event)']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Fuente de Financiamiento:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::select('id_fuente',$fuentes,null,['class'=>'form-control','required','placeholder'=>'Seleccione la fuente de financiamiento...' ]) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <h4>Clasificación por Objeto del Gasto</h4><hr>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Capítulo del gasto:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::select('capitulo',$capitulos,null,['class'=>'form-control','required','placeholder'=>'Seleccione el capítulo del gasto...','id'=>'capitulo','onchange'=>'getRubros()']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Rubro del gasto:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::select('rubro',[],null,['class'=>'form-control','required','placeholder'=>'Seleccione el rubro del gasto...','id'=>'rubro','onchange'=>'getConceptos()']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Concepto del gasto:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::select('id_concepto',[],null,['class'=>'form-control','required','placeholder'=>'Seleccione el concepto del gasto...','id'=>'concepto']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>    
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <h4>Estructura Financiera</h4><hr>
    </div>
    <div class="col-md-12">
        <div class="col-md-3 mr-auto ml-auto">
            <table class="dataTable table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th style="text-align:center">
                            Inversión Total
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('inversion',null,['class'=>'form-control','id'=>'inversion','disabled','style'=>'cursor:default']) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-3">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Federal:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::text('estructura[]',null,['class'=>'form-control est','placeholder'=>'Monto Federal','onkeyup'=>'inversionTotal()','onKeyPress'=>'return isNumberCant(event,"0.00",9,2)']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-3">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Estatal:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::text('estructura[]',null,['class'=>'form-control est','placeholder'=>'Monto Estatal','onkeyup'=>'inversionTotal()','onKeyPress'=>'return isNumberCant(event,"0.00",9,2)']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-3">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Municipal:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::text('estructura[]',null,['class'=>'form-control est','placeholder'=>'Monto Municipal','onkeyup'=>'inversionTotal();verificacionMunicipal()','onKeyPress'=>'return isNumberCant(event,"0.00",9,2)','id'=>'municipal']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-3">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Otros:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::text('estructura[]',null,['class'=>'form-control est','placeholder'=>'Monto Otros','onkeyup'=>'inversionTotal()','onKeyPress'=>'return isNumberCant(event,"0.00",9,2)']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <h4>Calendario de Ejecución Financiera del Recurso Municipal</h4><hr>
    </div>
    <div class="col-md-12 row">
        <div class="col-md-3 "></div>
        <div class="col-md-3 ">
            <table class="dataTable table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th style="text-align:center">
                            Validación
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('validacion',null,['class'=>'form-control','id'=>'validacion','disabled','style'=>'cursor:default; text-align:center']) !!}<i class="form-group__bar"></i>
                                {!! Form::hidden('validacionH',null,['id'=>'validacionH'])!!}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="dataTable table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th style="text-align:center">
                            Diferencia
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-bottom: 10px">
                                {!! Form::text('diferencia',null,['class'=>'form-control','id'=>'diferencia','disabled','style'=>'cursor:default; text-align:center']) !!}<i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @foreach($meses as $mes)
    <div class="col-md-2">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr style="padding-bottom:0px">
                    <th>
                        <div>{{$mes->mes}}:<span id='mes{{$mes->id}}P' class="pull-right">0 %</span></div>
                    </th>
                </tr>
                <tr style="padding-bottom:0px; padding-top:0px; margin-bottom:0px; margin-top:0px;">
                    <td>
                        <div class="form-group" style="padding-bottom:10px; padding-top:0px; margin-bottom:0px; margin-top:0px;">
                            {!! Form::text('mes[]',null,['class'=>'form-control mes','placeholder'=>'Monto de '.$mes->mes,'onKeyPress'=>'return isNumberCant(event,"0.00",9,2)','onkeyup'=>'verificacionMunicipal()','id'=>'mes'.$mes->id]) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <h4>Alineación Estratégica</h4><hr>
    </div>
    <div class="col-md-6">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Eje Rector:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::select('id_eje',$ejes,null,['class'=>'form-control','required','placeholder'=>'Seleccione el Eje Rector...','onchange'=>'getObjetivos()','id'=>'eje']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <table class="dataTable table-borderless table-condensed" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Objetivo de Desarrollo Sostenible:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::select('id_objetivo',[],null,['class'=>'form-control','required','placeholder'=>'Seleccione el Objetivo de Desarrollo Sostenible...','id'=>'objetivos']) !!}<i class="form-group__bar"></i>
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
        <a class="btn btn-secondary" href="{{url('/proyectoAccion/listado')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
    </div>
</div>
<script>
    function inversionTotal() {
        var totInv = 0;
        $( ".est" ).each(function( est ) {
            totInv = totInv + ($(this).val()*1);
            $('#inversion').val('$ '+addCommas(Math.round(totInv*100)/100));
        });
    }

    function verificacionMunicipal() {
        var totMes = 0;
        $( ".mes" ).each(function( mes ) {
            totMes = totMes + ($(this).val()*1);
            $('#validacionH').val(Math.round(totMes*100)/100);            
            if($('#validacionH').val() != $('#municipal').val()){
                $('#validacion').val('INCORRECTO');
                $('#validacion').removeClass('btn btn-outline-success');
                $('#validacion').addClass('btn btn-outline-danger');
                var dif = ($('#municipal').val()*1) - ($('#validacionH').val()*1);
                $('#diferencia').val('$ ' + addCommas(Math.round(dif*100)/100));
            }
            else{
                $('#validacion').removeClass('btn btn-outline-danger');
                $('#validacion').addClass('btn btn-outline-success');
                $('#validacion').val('CORRECTO');
                $('#diferencia').val('$ 0.00');
            }
            var mesP = ($(this).val()*1) / $('#municipal').val()*1;
            $('#'+$(this).attr("id")+'P').empty();
            if($('#municipal').val() == 0 || $('#municipal').val() == null){
                $('#'+$(this).attr("id")+'P').append('0 %');
                $('#diferencia').val('$ 0.00');
            }
            else $('#'+$(this).attr("id")+'P').append(Math.round(mesP*10000)/100+' %');
        });
    }

    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

    function isNumberInt(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
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
    
    function getObjetivos(){
        var eje = $('#eje').val();
        $.get(BASE_URL + "getObjetivos", {'eje': eje}, function (r) {
            $('#objetivos').empty();
            if(eje<5) $('#objetivos').append('<option selected="selected" value="">Seleccione el Objetivo de Desarrollo Sostenible...</option>');
            $(r).each(function (i, v) {
                $('#objetivos').append('<option value="'+v.id+'">'+v.objetivo+' - '+v.descripcion+'</option>');
            });
        });
    }
    
    function getRubros(){
        var cap = $('#capitulo').val();
        $.get(BASE_URL + "getRubros", {'cap': cap}, function (r) {
            $('#rubro').empty();
            $('#rubro').append('<option selected="selected" value="">Seleccione el rubro del gasto...</option>');
            $(r).each(function (i, v) {
                $('#rubro').append('<option value="'+v.id+'">'+v.rubro+'</option>');
            });
        });
    }
    
    function getConceptos(){
        var rubro = $('#rubro').val();
        $.get(BASE_URL + "getConceptos", {'rubro': rubro}, function (r) {
            $('#concepto').empty();
            $('#concepto').append('<option selected="selected" value="">Seleccione el concepto del gasto...</option>');
            $(r).each(function (i, v) {
                $('#concepto').append('<option value="'+v.id+'">'+v.concepto+'</option>');
            });
        });
    }
</script>

@endsection