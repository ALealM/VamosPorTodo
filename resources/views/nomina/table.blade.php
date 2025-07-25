<p>
    <button class="btn btn-sm" type="button" data-toggle="collapse" data-target="#resumen" aria-expanded="false" aria-controls="resumen">Resumen</button>
</p>
<div class="row">
    <div class="col">
        <div class="collapse multi-collapse" id="resumen">
            <div class="card card-body" style="margin-top: 0px; padding-top: 0px">
                <table class="dataTable table-bordered table-condensed table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th colspan="6">GASTO POR DIRECCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($nominaG as $nG)
                            @if($loop->index%3==0)
                        </tr><tr>
                            @endif
                            <td style="text-align: right">{{$nG->direccion}}</td><td style="text-align: right">${{number_format($nG->sueldo,2,".",",")}}</td>
                            @endforeach  
                            <td style="text-align: right"><b>ALTAS</b></td><td style="text-align: right"><b>{{number_format($altas)}}</b></td>
                            <td style="text-align: right"><b>BAJAS</b></td><td style="text-align: right"><b>{{number_format($bajas)}}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<table class="table tile table-hover dataTable" role='grid' id="nominaTable" style=" width: 100%">
    <thead>
        <tr>
            <th style=" width: 30px">#</th>
            <th>Nombre</th>
            <th>Fecha Ingreso</th>
            <th>Sueldo Mensual</th>
            <th>Direccción</th>
            <th>Departamento</th>
            <th>Puesto</th>
        </tr>
    </thead>
    <tbody>
        @php $i=1; $tot = 0; $neto = 0 @endphp
        @foreach($nomina as $nom)
        @php $tot += $nom->sueldo_mensual; $neto += $nom->neto_pagar @endphp
        <tr>
            <td>{!! number_format($i) !!}</td>
            <td>{!! $nom->nombre !!} {!! $nom->ap_paterno !!} {!! $nom->ap_materno !!}</td>
            <td style="text-align: center">{!! $nom->fecha_ingreso !!}</td>
            <td style="text-align: right">$ {!! number_format($nom->sueldo_mensual,2,".",",") !!}</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;{!! $nom->direccion !!}</td>
            <td>{!! $nom->departamento !!}</td>
            <td>{!! $nom->puesto !!}</td>
        </tr>
        @php $i++ @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>{{ number_format($i-1) }}</th>
            <th colspan="2"></th>
            <th style="text-align: right"><small>$</small>{{ number_format($tot,2,".",",") }}&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th colspan="3"></th>
        </tr>
    </tfoot>
</table>
<div class="col-md-12">
    <table class="dataTable table-borderless table-condensed" style="width: 100%">
        <tbody>
            <tr>
                <td>
                    <div class="form-group col-md-12" style="margin-bottom: 0px; margin-top: 0px">
                        {!! Form::select('direccionG[]',$direcciones,null,['class'=>'form-control select2','id'=>'direccionG','onchange'=>'getGrafica()','multiple','style'=>'width:100%']) !!}<i class="form-group__bar"></i>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@php $tot = "<h4><b>$ ".number_format($tot,2,".",",")."</b></h4>"; $neto = "<h4><b>$ ".number_format($neto,2,".",",")."</b></h4>"; $ab = "<h4><b>".number_format($altasD)."/".number_format($bajasD)."</b></h4>" @endphp
<div id='grafica' style="text-align: center;"></div>
<script>

    $("#nominaTable").DataTable({
    aaSorting: [],
            lengthMenu: [[10, 30, 45, 60, - 1], ["10 registros", "30 registros", "45 registros", "60 registros", "Todo"]],
            language: {
            sSearch: "Buscar",
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
    $(document).ready(function () {
    $('#direccionG').select2({
    placeholder: "Seleccione la dirección o las direcciones a remover...",
            allowClear: true
    });
    $("#mensual").empty();
    $("#neto").empty();
    $("#ab").empty();
    $("#mensual").append("{!!$tot!!}");
    $("#neto").append("{!!$neto!!}");
    $("#ab").append("{!!$ab!!}");
    // Create the chart        

    // Build the chart
    Highcharts.chart('grafica', {
    chart: {
    type: 'column',
            height: '800'
    },
            exporting: false,
            credits: false,
            title: {
            text: 'Gasto por Dirección'
            },
            accessibility: {
            announceNewData: {
            enabled: true
            }
            },
            xAxis: {
            type: 'category'
            },
            yAxis: {
            title: {
            text: 'Totales'
            }

            },
            legend: {
            enabled: false
            },
            plotOptions: {
            series: {
            borderWidth: 0,
                    dataLabels: {
                    enabled: true,
                            format: '${point.y:,2f}'
                    }
            }
            },
            tooltip: {
            headerFormat: '<span style="font-size:12px">{series.name} - $<b>{point.y:,2f}</b></span><br>',
                    pointFormat: '<span>{point.name}</span>: <b>{point.p:.2f}%</b> del Total<br/>',
                    backgroundColor: '#fff'
            },
            series: [
            {
            name: "Gasto",
                    colorByPoint: true,
                    data: [
                            @foreach($nominaG as $nG)
                    {
                    name: "{{$nG->direccion}}",
                            y: {{$nG-> sueldo}},
                            p:{{$nG-> sueldo / $totG * 100}}
                    },
                            @endforeach
                    ]
            }
            ]
    });
    });
    function getGrafica() {
    var dir = $('#direccionG').val();
    console.log(dir);
    var q = $('#quincena').val();
    var fi = $('#fecha_i').val();
    var ff = $('#fecha_f').val();
    var pen = $('#pensionados').val();
    $('#grafica').empty();
    $.get(BASE_URL + "getGrafica", {'dir': dir, 'q': q, 'fi': fi, 'ff': ff, 'pen': pen}, function (r) {
    $('#grafica').append(r);
    });
    }
</script>