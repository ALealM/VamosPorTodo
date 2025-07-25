@extends('layouts.app', ['activePage' => 'panel'])
@section('title', 'Main page')
@section('content')
<div id="accordion">
    <div class="card" style="margin-top: 15px;margin-bottom: 15px;">
        <div class="card-header" id="headingID">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseID" aria-expanded="true" aria-controls="collapseID" style="padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 0px; padding: 0px;">
                    <h4 style="margin-bottom: 0px;">INFORMES DIARIOS</h4>
                </button>
            </h5>
        </div>
        <div id="collapseID" class="collapse show" aria-labelledby="headingID" data-parent="#accordion">
            <div class="card-body">
                @if($informes->isEmpty())
                <div class="text-center">No hay informes dados de alta para mostrar</div>
                @else
                @include('panel.tableID')
                @endif
            </div>
        </div>
    </div>
    <div class="card" style="margin-top: 15px;margin-bottom: 15px;">
        <div class="card-header" id="headingEV">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseEV" aria-expanded="true" aria-controls="collapseEV" style="padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 0px; padding: 0px;">
                    <h4 style="margin-bottom: 0px;">EVENTOS</h4>
                </button>
            </h5>
        </div>
        <div id="collapseEV" class="collapse show" aria-labelledby="headingEV" data-parent="#accordion">
            <div class="card-body">    
                @if($eventos->isEmpty())
                <div class="text-center">No hay eventos dados de alta para mostrar</div>
                @else
                @include('panel.tableEV')
                @endif
            </div>
        </div>
    </div>
    <div class="card" style="margin-top: 15px;margin-bottom: 15px;">
        <div class="card-header" id="headingPA">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapsePA" aria-expanded="true" aria-controls="collapsePA" style="padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 0px; padding: 0px;">
                    <h4 style="margin-bottom: 0px;">PROYECTOS Y ACCIONES</h4>
                </button>
            </h5>
        </div>
        <div id="collapsePA" class="collapse show" aria-labelledby="headingPA" data-parent="#accordion">
            <div class="card-body">    
                <div class="col-md-12 card btn btn-outline-info" style="margin-left: 0px; margin-right: 0px; margin-top: 0px">
                    <div class="card-body row">
                        <div class="col-md-3"><b>Dirección:</b><br>{{Form::select('direcccion',$direcciones,null,['class'=>'form-control','id'=>'direccion','placeholder'=>'Seleccione dirección...','style'=>'width:100%','onchange'=>'getPOA()'])}}</div>
                        <div class="col-md-3"><b>Eje Rector:</b><br>{{Form::select('eje',$ejes,null,['class'=>'form-control','id'=>'eje','placeholder'=>'Seleccione eje...','style'=>'width:100%','onchange'=>'getPOA()'])}}</div>
                        <div class="col-md-3"><b>Capítulo del Gasto:</b><br>{{Form::select('capitulo',$capitulos,null,['class'=>'form-control','id'=>'capitulo','placeholder'=>'Seleccione capítulo...','style'=>'width:100%','onchange'=>'getRubros();getPOA()'])}}</div>
                        <div class="col-md-3"><b>Rubro del Gasto:</b><br>{{Form::select('rubro',[],null,['class'=>'form-control','id'=>'rubro','placeholder'=>'Seleccione rubro...','style'=>'width:100%','onchange'=>'getPOA()'])}}</div>
                    </div>
                </div>
                <div id="divPOA">
                    @include('panel.tablePOA')
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function informePDF(id) {
        window.location = BASE_URL + "informePDF/" + id;
    }

    function eventoPDF(id) {
        window.location = BASE_URL + "eventoPDF/" + id;
    }    
    
    function getRubros(){
        var cap = $('#capitulo').val();
        $.get(BASE_URL + "getRubros", {'cap': cap}, function (r) {
            $('#rubro').empty();
            $('#rubro').append('<option selected="selected" value="">Seleccione rubro...</option>');
            $(r).each(function (i, v) {
                $('#rubro').append('<option value="'+v.id+'">'+v.rubro+'</option>');
            });
        });
    }
    
    function getPOA(){
        $('#divPOA').empty();
        var dir = $('#direccion').val();
        var eje = $('#eje').val();
        var cap = $('#capitulo').val();
        var rub = $('#rubro').val();
        $.get(BASE_URL + "getPOA", {dir:dir, eje:eje, cap:cap, rub:rub}, function (r) {
            $('#divPOA').append(r);
            $("#tablePOA").dataTable({
            aaSorting: [],
            autoWidth: !1,
            responsive: !0,
            lengthMenu: [[10, 30, 45, 60, -1],["10 registros", "30 registros", "45 registros", "60 registros", "Todo"]],
            language: {
              sSearch: "",
              searchPlaceholder: "Buscar en la tabla...",
              lengthMenu: "_MENU_ registros por página",
              zeroRecords: "Ningún registro encontrado",
              info: "Mostrando página _PAGE_ de _PAGES_",
              infoEmpty: "Sin registros",
              infoFiltered: "(Filtrados de _MAX_ total registros)",
              oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior"
              }
            }
          });
        });
    }
</script>
@endsection