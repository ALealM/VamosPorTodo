@extends('layouts.app', ['activePage' => 'juntas', 'mainPage' => 'juntas'])
@section('title', 'Main page')
@section('content')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
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
    hr{
        margin-top: 0px;
        margin-bottom: 10px;
    }
</style>
@include('juntasPC.table')
<div class="col-md-12 row">
@include('juntasPC.graficas')
@include('juntasPC.graficaColor')
</div>
<script>
    // var BASE_URL = window.location.protocol + "//" + window.location.host + "/";
    // Create the chart
    Highcharts.setOptions({
        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
            return {
                radialGradient: {
                    cx: 0.5,
                    cy: 0.3,
                    r: 0.7
                },
                stops: [
                    [0, color],
                    [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                ]
            };
        })
    });
    Highcharts.chart('tipo', {
        chart: {
            type: 'column'
        },
        exporting: false,
        credits: false,
        title: {
            text: 'Distribución de Coordinación'
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
                    format: '{point.y}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.p:.2f}%</b> del Total<br/>'
        },

        series: [
            {
                name: "Distribución",
                colorByPoint: true,
                data: [
                    @foreach($juntasT as $jT)
                    {
                        name: "{{$jT->c1}}",
                        y: {{$jT->tot}},
                        p:{{$jT->tot/$juntasT->sum('tot')*100}}
                    },
                    @endforeach
                ]
            }
        ]
    });

// Build the chart
    Highcharts.chart('color', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Distribución por Color'
        },
        credits: false,
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y}',
                    connectorColor: 'silver',
                    distance: '5%'
                }
            }
        },
        series: [{
            name: 'Total',
            data: [
                { name: 'Verde', y: {{$col[1]}}, color:'#069118' },
                { name: 'Azul', y: {{$col[2]}}, color:'#1722eb' },
                { name: 'Rojo', y: {{$col[3]}}, color:'#ff0000' },
                { name: 'Amarillo', y: {{$col[4]}}, color:'#e8be02' },
                { name: 'Rojo-Azul', y: {{$col[5]}},
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 1
                        },
                    stops: [
                        [0, '#0000ff'],
                        [1, '#ff0000']
                        ]
                    }
                }
            ]
        }]
    });
    function color(id,col) {
        $('#btn_'+id).empty();
        $('#color').empty();
        $.get(BASE_URL + "cambiaColJunta", {id: id, col: col}, function (r) {
            if(col==1){ $('#btn_'+id).attr('style','background-color: green; color: white'); $('#btn_'+id).html('Verde'); }
            if(col==2){ $('#btn_'+id).attr('style','background-color: blue; color: white'); $('#btn_'+id).append('Azul'); }
            if(col==3){ $('#btn_'+id).attr('style','background-color: red; color: white'); $('#btn_'+id).append('Rojo'); }
            if(col==4){ $('#btn_'+id).attr('style','background-color: yellow; color: black'); $('#btn_'+id).append('Amarillo'); }
            if(col==5){ $('#btn_'+id).attr('style','background-image: linear-gradient(to right, red , blue); color: white'); $('#btn_'+id).append('Rojo-Azul'); }
            if(col==0){ $('#btn_'+id).attr('style','background-color: white; color: green'); $('#btn_'+id).append('Seleccione...'); }

// Build the chart
    Highcharts.chart('color', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Distribución por Color'
        },
        credits: false,
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y}',
                    connectorColor: 'silver',
                    distance: '5%'
                }
            }
        },
        series: [{
            name: 'Total',
            data: [
                { name: 'Verde', y: r[1], color:'#069118' },
                { name: 'Azul', y: r[2], color:'#1722eb' },
                { name: 'Rojo', y: r[3], color:'#ff0000' },
                { name: 'Amarillo', y: r[4], color:'#e8be02' },
                { name: 'Rojo-Azul', y: r[5],
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 1
                        },
                    stops: [
                        [0, '#0000ff'],
                        [1, '#ff0000']
                        ]
                    }
                }
            ]
        }]
    });
        });
    }

</script>
@endsection
