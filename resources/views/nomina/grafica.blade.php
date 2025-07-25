<script>
    $(document).ready(function () {
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
                            y: {{$nG->sueldo}},
                            p:{{$nG->sueldo/$totG*100}}
                        },
                        @endforeach
                    ]
                }
            ]
        });
    });    
</script>