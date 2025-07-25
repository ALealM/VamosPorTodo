@extends('layouts.app', ['activePage' => 'createInforme', 'mainPage' => 'informe'])
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
    .btn_evt {
        padding-top: 1px;
        padding-bottom: 1px; 
        height: 27px;
        text-align:center;
    }
</style>
{!! Form::model( @$oInventario, ['route' =>[ 'storeInforme' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}

<div class="row">
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        <div class="col-md-12 text-center"><hr>
                            <h4>SELECCIONAR DÍA A INFORMAR</h4>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group col-md-4 mr-auto ml-auto" style="margin-bottom: 10px">
                            {!! Form::date('fecha',null,['class'=>'form-control','required','onchange'=>'verificaFecha()','id'=>'fecha']) !!}<i class="form-group__bar"></i>
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
                      <div class="alert alert-light" style="background-color:#a3d8db7d; text-align:center;" role="alert">
                        <p style="display:inline-block;"><i class="material-icons">info</i> El formato de letra debe ser fuente "Calibri" en tamaño 12px, recuerda hacer distinción entre mayúsculas y minúsculas y verificar la ortografía.</p>
                        <p>No es necesario incluir el título de la dirección perteneciente, logos o encabezados.</p>
                      </div>
                    </th>
                  </tr>
                  <tr>
                    <td>
                      <div class="alert alert-secondary" style="background-color:#eee;  text-align:center;" role="alert">
                        <p style="display:inline-block;"> Ejemplo de formato de Informe Diario <a href="../archivos/informe15DENOV2021.pdf" target="_blank"><i class="material-icons" style="color:#555;">file_download</i></a></p>
                      </div>
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        <div class="col-md-12 text-center"><hr>
                            <h4>INFORME</h4>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::textArea('informe',null,['class'=>'form-control ckeditor','required','rows'=>'10','id'=>'editor']) !!}<i class="form-group__bar"></i>
                            <script>
                                CKEDITOR.replace('editor', {
                                    height: 400,
                                    removeButtons: 'PasteFromWord',
                                    extraPlugins: 'editorplaceholder',
                                    editorplaceholder: 'Escriba el informe del día...',
                                    removeDialogTabs: 'image:advanced;link:advanced',
                                });
                            </script>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @if(\Auth::User()->id == 19 || \Auth::User()->id == 73)
    <div class="col-md-4">
        <div class="col-md-12 mr-auto ml-auto">
            <table class="dataTable table-bordered table-condensed table-hover" style="width: 100%; font-size: 13px">
                <tbody>
                    <tr>
                        <th colspan="2" style="text-align: center">NOVEDADES DE FUERZAS MUNICIPALES</th>
                    </tr>
                    <tr style="text-align: center">
                        <th>EVENTOS</th>
                        <th style=" width: 70px">CANTIDAD</th>
                    </tr>
                    @foreach($ev_fm as $fm)
                    <tr>
                        <td>{{ $fm->evento }}</td>
                        <td>{{ Form::text('evento[]','00',['class'=>'form-control btn_evt','required']) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="col-md-12 mr-auto ml-auto">
            <table class="dataTable table-bordered table-condensed table-hover" style="width: 100%; font-size: 13px">
                <tbody>
                    <tr>
                        <th colspan="2" style="text-align: center">NOVEDADES DE POLICÍA VIAL</th>
                    </tr>
                    <tr style="text-align: center">
                        <th>EVENTOS</th>
                        <th style=" width: 70px">CANTIDAD</th>
                    </tr>
                    @foreach($ev_pv as $pv)
                    <tr>
                        <td>{{ $pv->evento }}</td>
                        <td>{{ Form::text('evento[]','00',['class'=>'form-control btn_evt','required','style'=>'padding-top: 1px;padding-bottom: 1px; height: 27px']) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="col-md-12 mr-auto ml-auto">
            <table class="dataTable table-bordered table-condensed table-hover" style="width: 100%; font-size: 13px">
                <tbody>
                    <tr>
                        <th colspan="2" style="text-align: center">CANALIZACIONES DEL 911</th>
                    </tr>
                    <tr style="text-align: center">
                        <th>EVENTOS</th>
                        <th style=" width: 70px">CANTIDAD</th>
                    </tr>
                    @foreach($ev_911 as $e911)
                    <tr>
                        <td>{{ $e911->evento }}</td>
                        <td>{{ Form::text('evento[]','00',['class'=>'form-control btn_evt','required','style'=>'padding-top: 1px;padding-bottom: 1px; height: 27px']) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-12 text-center"><hr>
            <h4>EVENTOS DE IMPACTO <a  class="btn btn-success btn-sm text-white" style="color: green" data-toggle="tooltip" title="Agregar" onclick="addLineE()"><i class="fa fa-plus-square-o fa-2x"></i></a></h4>
        </div>
        <div class="col-md-12">
            <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%" id="tablaEventosImpacto">
                <tbody>
                    <tr style="text-align: center">
                        <th style=" width: 80px">Cantidad</th>
                        <th>Descripción</th>
                        <th style=" width: 50px"></th>
                    </tr>
                    <tr>
                        <td><div class="form-group">{!! Form::text('ei_cant[]','00',['class'=>'form-control','required','required']) !!}<i class="form-group__bar"></i></div></td>
                        <td><div class="form-group">{!! Form::text('ei_desc[]',null,['class'=>'form-control','required','placeholder'=>'Escriba la descripción del evento de impacto...','required']) !!}<i class="form-group__bar"></i></div></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <hr>
        </div>
    </div>
    <div class="col-md-12" style=" padding-bottom: 15px">
        <table class="dataTable table-bordered table-condensed table-hover" style="width: 100%; font-size: 12px;">
            <tbody>
                <tr>
                    <th colspan="13" style="text-align: center">ESTADO DE FUERZA DE LA D.G.S.P.M.</th>
                </tr>
                <tr style="text-align: center">
                    <th colspan="6">POLICÍA VIAL</th>
                    <th colspan="7">FUERZAS MUNICIPALES</th>
                </tr>
                <tr style="text-align: center">
                    <th>Personal Saliente</th>
                    <th>Centro</th>
                    <th>Norte</th>
                    <th>Poniente</th>
                    <th>Sur</th>
                    <th>Oriente</th>
                    <th>Personal Entrante</th>
                    <th>Centro</th>
                    <th>Norte</th>
                    <th>Violencia Familiar</th>
                    <th>Poniente</th>
                    <th>Sur</th>
                    <th>Oriente</th>
                </tr>
                <tr style="text-align: center">
                    <td>Presente</td>
                    <td>{{Form::text('pc[1]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('pn[1]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('pp[1]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('ps[1]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('po[1]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>Presente</td>
                    <td>{{Form::text('pc[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('pn[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('pv[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('pp[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('ps[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('po[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                </tr>
                <tr style="text-align: center">
                    <td>Descansando</td>
                    <td>{{Form::text('dc[1]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('dn[1]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('dp[1]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('ds[1]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('do[1]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>Descansando</td>
                    <td>{{Form::text('dc[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('dn[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('dv[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('dp[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('ds[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('do[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                </tr>
                <tr style="text-align: center">
                    <td>Faltando</td>
                    <td>{{Form::text('fc[1]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('fn[1]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('fp[1]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('fs[1]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('fo[1]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>Faltando</td>
                    <td>{{Form::text('fc[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('fn[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('fv[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('fp[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('fs[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('fo[3]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                </tr>
                <tr style="text-align: center">
                    <th>Personal Entrante</th>
                    <th>Centro</th>
                    <th>Norte</th>
                    <th>Poniente</th>
                    <th>Sur</th>
                    <th>Oriente</th>
                    <th colspan="7">DELEGACIONES</th>
                </tr>
                <tr style="text-align: center">
                    <td>Presente</td>
                    <td>{{Form::text('pc[2]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('pn[2]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('pp[2]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('ps[2]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('po[2]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>Personal</td>
                    <th colspan="2">Bocas</th>
                    <th colspan="2">Pozos</th>
                    <th colspan="2">La Pila</th>
                </tr>
                <tr style="text-align: center">
                    <td>Descansando</td>
                    <td>{{Form::text('dc[2]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('dn[2]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('dp[2]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('ds[2]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('do[2]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>Fuerzas</td>
                    <td colspan="2">{{Form::text('fb','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td colspan="2">{{Form::text('fpz','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td colspan="2">{{Form::text('flp','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                </tr>
                <tr style="text-align: center">
                    <td>Faltando</td>
                    <td>{{Form::text('fc[2]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('fn[2]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('fp[2]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('fs[2]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>{{Form::text('fo[2]','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td>Vial</td>
                    <td colspan="2">{{Form::text('vb','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td colspan="2">{{Form::text('vpz','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td colspan="2">{{Form::text('vlp','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                </tr>
                <tr>
                    <th colspan="5" style="text-align: center">BARANDILLA</th>
                </tr>
                <tr style="text-align: center">
                    <th>Personal Saliente</th>
                    <th colspan="2">Juez Cal.</th>
                    <th colspan="2">Oficiales</th>
                </tr>
                <tr style="text-align: center">
                    <td>Presente</td>
                    <td colspan="2">{{Form::text('pjc','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td colspan="2">{{Form::text('pof','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                </tr>
                <tr style="text-align: center">
                    <td>Descanzando</td>
                    <td colspan="2">{{Form::text('djc','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td colspan="2">{{Form::text('dof','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                </tr>
                <tr style="text-align: center">
                    <td>Faltando</td>
                    <td colspan="2">{{Form::text('fjc','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                    <td colspan="2">{{Form::text('fof','00',['class'=>'form-control btn_evt','required','required'])}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @endif
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        <div class="col-md-12 text-center"><hr>
                            <h4>ANEXOS</h4>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>
                        <input type="file" name="archivos[]" multiple >
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
        <a class="btn btn-secondary" href="{{url('/informe/listado')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
    </div>
</div>
<script>
    function addLineE() {
        var idR = Math.floor(Math.random() * 1000) + 10;
        var tbl = document.getElementById('tablaEventosImpacto');
        var lastRow = tbl.rows.length;
        var row = tbl.insertRow(lastRow);

        var c = row.insertCell(0);
        var d = row.insertCell(1);
        var ac = row.insertCell(2);

        c.innerHTML = '<div class="form-group""><input class="form-control" required="" name="ei_cant[]" type="text" value="00"><i class="form-group__bar"></i></div>';
        d.innerHTML = '<div class="form-group""><input class="form-control" required="" placeholder="Escriba la descripción del evento de impacto..." name="ei_desc[]" type="text"><i class="form-group__bar"></i></div>';
        ac.innerHTML = '<a class="btn btn-danger btn-sm text-white" style="color: red" onclick="deleteRow(this.parentNode.parentNode.rowIndex,' + "'tablaEventosImpacto'" + ')" type="button" style="cursor:pointer"><i class="fa fa-minus-square-o"></i></a>';

        return false;
    }

    function deleteRow(rowIndex, nameTable) {
        var table = document.getElementById(nameTable);
        table.deleteRow(rowIndex);
    }
    
    function verificaFecha(){
        var fecha = $('#fecha').val();
        $.get(BASE_URL + "verificaFecha", {'fecha': fecha}, function (r) {
            if(r > 0){
                console.log(r);
                swal({
                    title: "¡Fecha duplicada!",
                    text: 'Sólo se permite un informe por día.\nFavor de elegir una fecha diferente.',
                    type: "error",
                    buttonsStyling: false
                });
                $('#fecha').val('');
            }
        });
    }
</script>
@endsection
