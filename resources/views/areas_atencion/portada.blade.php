@extends('layouts.app', ['activePage' => 'portada', 'mainPage' => 'areasAtencion'])
@section('title', 'Main page')

@section('content')
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>

    <script type="text/javascript">
        var gaugeOptions = {
            chart: {
                type: 'solidgauge'
            },

            title: {
                text: 'Total de solicitudes'
            },
            pane: {
                center: ['50%', '50%'],
                startAngle: 0,
                endAngle: 360,
                background: {
                    backgroundColor: '#EEE',
                    innerRadius: '60%',
                    outerRadius: '100%',
                    shape: 'arc',
                    borderWidth: 0
                }
            },
            exporting: {
                enabled: true
            },
            tooltip: {
                enabled: true,
                headerFormat: '<span style="font-size:11px">{series.name}</span>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b>del total<br/>'
            },
            // the value axis
            yAxis: {
                lineWidth: 0,
                tickWidth: 0,
                minorTickInterval: 3,
                tickAmount: 2,
                min: 0,
                tickPositions: []
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                solidgauge: {
                    dataLabels: {
                        y: 5,
                        borderWidth: 0,
                        useHTML: true
                    },
                    linecap: 'round',
                    stickyTracking: false,
                    rounded: true
                }
            }
        };

        var columnOptions = {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Tipo de Solicitud'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -85,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Solicitudes Realizadas'
                }
            },
            credits: {
                enabled: false
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>'
            },
            legend: {
                enabled: false
            }
        };
    </script>

    <div class="row">
        @foreach($areas as $area)
            <div class="col-lg-12 col-xl-12 mb-12" style="padding-bottom: 0.5em;"><!--col-lg-6 col-xl-3 mb-4-->
                <div class="card card-raised border-start border-primary border-4">
                    <div class="card-header" style="padding-bottom: 0;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-lg fw-bold"> <h4 style="font-weight: 400; color:{!! $area->fondo !!};">{!! $area->icon !!} {!! $area->area !!} </h4> </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="color:black; min-height:200px;">
                        @if( in_array( \Auth::User()->id, [1, 6, 67] ) ) <!--Faltan el tipo de user que son los directores-->
                            <div class="col-lg-3 col-xl-3 mb-3" style="display:inline; float:left;">
                                <table cellspacing="10" cellpadding="10" class="table-borderless">
                                    @foreach($area->countMedio as $key => $counter)
                                    <tr>
                                        <td>{!! $key.':' !!}</td>
                                        <td><b> {!! $counter !!} </b></td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td>Totales</td>
                                        <td><b> {!! $area->countArea !!} </b></td>
                                    </tr>
                                </table>
                            </div>
                        @endif

                        <div class="col-lg-3 col-xl-3 mb-3" style="display:inline; float:left; height:200px;">
                            <figure class="highcharts-figure">
                                <div id="column{{$area->id}}" class="chart-container"></div>
                            </figure>
                        </div>

                        <div class="col-lg-3 col-xl-3 mb-3" style="display:inline; float:left; height:200px;">
                            <figure class="highcharts-figure">
                                <div id="solidGauge{{$area->id}}" class="chart-container"></div>
                            </figure>
                        </div>

                        <script type="text/javascript">
                            
                            Highcharts.chart('solidGauge{{$area->id}}', Highcharts.merge(gaugeOptions, {
                                yAxis: {
                                    stops: [
                                        [1, '{!! $area->fondo !!}']
                                    ],
                                    max: 100 || {{ $area->countArea }}
                                },
                                series: [{
                                    name: 'Solicitudes Atendidas',
                                    data: [{{ array_sum($area->countMedio) }}],
                                    dataLabels: {
                                        y: -5,
                                        format:
                                        '<div style="text-align:center; color: {!! $area->fondo !!}">' +
                                        '<span style="font-size:2em;">{!! array_sum($area->countMedio) / 100 * $area->countArea !!}</span>' +
                                        '<span style="font-size:1.5em; opacity:0.4">%</span>' +
                                        '</div>',

                                    }
                                }]
                            }));

                            Highcharts.chart('column{{$area->id}}', Highcharts.merge(columnOptions, {
                                yAxis: {
                                    max: {{ array_sum($area->countMedio) }}
                                },
                                tooltip: {
                                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{y} </b> del total<br/>'
                                },
                                series: [{
                                    name: 'Medios',
                                    color: '{!! $area->fondo !!}',
                                    data: [
                                        @foreach($area->countMedio as $key => $counter)
                                            ['{!! $key !!}', {!! $counter !!}]
                                        @if(!$loop->last) , @endif
                                        @endforeach
                                    ],
                                    dataLabels: {
                                        enabled: false,
                                    }
                                }]
                            }));

                        </script>

                        <div class="col-lg-3 col-xl-3 mb-3" style="display:inline; float:left;">
                            <h4 style="font-weight: 400;"> Reporte Final de Solicitudes </h4> <br>
                            <a style="background: none; color: #28a745; border: solid #28a745 thin;" class="btn" href="{{url('pdfReporteSolicitudes/1')}}">
                                Atendidas <br> <i class="fa fa-download mr-2"></i>
                            </a>
                            <a style="background: none; color: #28a745; border: solid #28a745 thin;" class="btn" href="{{url('pdfReporteSolicitudes/2')}}">
                                En Espera <br> <i class="fa fa-download mr-2"></i>
                            </a>
                            <a style="background: none; color: #28a745; border: solid #28a745 thin;" class="btn" href="{{url('pdfReporteSolicitudes/3')}}">
                                Canceladas <br> <i class="fa fa-download mr-2"></i>
                            </a>
                        </div>

                    </div>
                    <a class="text-white stretched-link" href="{{url('/areaAtencionIndex/'.$area->id)}}">
                        <!--class="card card-raised border-start border-primary border-4"-->
                        <div class="card-footer d-flex align-items-center justify-content-between small" style="border-radius: 11px; border-color: black; padding: 0.75rem 1.25rem; border-top: 1px solid #e8e8f7; border-left: outset; background-color:{!! $area->fondo !!};"><!--background-color:{!! $area->fondo !!};-->
                            <h6 style="text-align:center; font-size: 1rem; margin-bottom: 0px;"> Listado de Solicitudes </h6>
                            <div class="text-white">
                                <svg class="svg-inline--fa fa-angle-right fa-w-8" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg=""><path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"></path></svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection