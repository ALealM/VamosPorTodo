@if($proyAccs->isEmpty())
<div class="text-center">No hay proyectos o acciones dados de alta para mostrar</div>
@else
<table class="table tile table-hover dataTable" role='grid' id="tablePOA" style="width: 100%">
    <thead>
        <tr>
            <th style=" width: 30px">#</th>
            <th>Nombre</th>
            <th>Capítulo</th>
            <th>Beneficiarios</th>
            <th>Inversión Total</th>
            <th>Eje Rector</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach($proyAccs as $proyA)
        <tr>
            <td>{!! $i !!}</td>
            <td>{!! $proyA->nombre !!}</td>
            <td>{!! $proyA->concepto()->rubro()->capitulo()->capDesc() !!}</td>
            <td>{!! number_format($proyA->beneficiarios) !!}</td>
            <td>$ {!! number_format($proyA->inversion(),2,".",",") !!}</td>
            <td>{!! $proyA->ejeRector()->eje !!}</td>
            <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{url('/panel/showPOA/'.$proyA->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Ficha</a><br>
                    </div>
                </div>
            </td>
        </tr>
        @php $i++ @endphp
        @endforeach
    </tbody>
</table>
<div class="col-md-12">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    
    <div class="col-md-10 mr-auto ml-auto table-responsive">
        <table class="table tile table-hover table-condensed table-bordered" role='grid' style="margin-top: 30px">
            <thead>
                <tr>
                    <th style="text-align:center" colspan="5">Estructura Financiera</th>
                </tr>
                <tr style="background-color:#ddd">
                    <th style="text-align:center">Inversión Total</th>
                    <th style="text-align:center">Federal</th>
                    <th style="text-align:center">Estatal</th>
                    <th style="text-align:center">Municipal</th>
                    <th style="text-align:center">Otros</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align:center"><small>$</small>{{number_format($totFed+$totEst+$totMun+$totOtros,2,".",",")}}</td>
                    <td style="text-align:center"><small>$</small>{{number_format($totFed,2,".",",")}}</td>
                    <td style="text-align:center"><small>$</small>{{number_format($totEst,2,".",",")}}</td>
                    <td style="text-align:center"><small>$</small>{{number_format($totMun,2,".",",")}}</td>
                    <td style="text-align:center"><small>$</small>{{number_format($totOtros,2,".",",")}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12 table-responsive">
        <table class="table tile table-hover table-condensed table-bordered" role='grid' style="margin-top: 30px">
            <thead>
                <tr>
                    <th style="text-align:center" colspan="13">Calendario de Ejecución Financiera - Recurso Municipal</th>
                </tr>
                <tr style="background-color:#ddd">
                    <th style="text-align:center">MES</th>
                    @foreach($meses as $mes)
                    <th style="text-align:center">{{$mes->mes}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="text-align:center">MONTO</th>
                    @foreach($meses as $mes)
                    <td style="text-align:center"><small>$</small>{{number_format($mes->monto2($idP),2,".",",")}}</td>
                    @endforeach
                </tr>
                <tr>
                    <th style="text-align:center">%</th>
                    @foreach($meses as $mes)
                    <td style="text-align:center">{{round($mes->monto2($idP)/$totMun*100,2)}}<small>%</small></td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    <div id="container"></div>
</div>
<script>
// Create the chart
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Calendario de Ejecución Financiera - Recurso Municipal'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Monto'
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
                    format: '${point.y:,.2f}'
                }
            }
        },
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.porc:,.2f}</b>%<br/>'
        },

        series: [
            {
                name: "Recurso Municipal",
                colorByPoint: true,
                data: [
                    @foreach($meses as $mes)
                    {name: "{{$mes->mes}}",y: {{$mes->monto2($idP)}},porc:{{round($mes->monto2($idP)/$totMun*100,2)}}},
                    @endforeach
                ]
            }
        ]
    });
</script>
@endif