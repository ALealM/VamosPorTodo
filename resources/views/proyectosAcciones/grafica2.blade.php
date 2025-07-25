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