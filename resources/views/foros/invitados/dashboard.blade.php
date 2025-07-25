@extends('layouts.app', ['activePage' => 'dashboardInvitados', 'mainPage' => 'invitados'])
@section('content')
    <style type="text/css">
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>

    <div class="row row-sm">
        <div class="col-lg-6 col-md-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Invitados {{$invitados->count()}}</h6>
                        <p class="text-muted card-sub-title">Personas por género que fueron invitadas.</p>
                    </div>
                    <div id="pieGender"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Asistentes {{$invitados->where('asistio',1)->count()}}</h6>
                        <p class="text-muted card-sub-title">Personas que fueron invitados y que confirmaron su asistencia.</p>
                    </div>
                    <div id="pieGender2"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Invitados y Asistentes</h6>
                        <p class="text-muted card-sub-title">Tabla comparativa de los integrantes de COPLADEM e invitados que asistieron.</p>
                    </div>
                    <figure class="highcharts-figure">
                        <div id="container2"></div>
                        <p class="highcharts-description">
                        </p>
                    </figure>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        Highcharts.chart('pieGender', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Invitados por género'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
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
                    colors: [Highcharts.color('#EB92BE').brighten((2 - 3) / 7).get(), Highcharts.color('#3DB2FF').brighten((3 - 3) / 7).get()],
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name} <br> {point.y}</b>',
                        distance: -50,
                        filter: {
                            property: 'percentage',
                            operator: '>',
                            value: 4
                        }
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Personas',
                data: [
                    { name: 'Femenino', y: {{$female}} },
                    { name: 'Masculino', y: {{$male}} }
                ]
            }]
        });

        Highcharts.chart('pieGender2', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Asistentes por género'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
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
                    colors: [Highcharts.color('#e83e8c').brighten((2 - 3) / 7).get(), Highcharts.color('#007bff').brighten((3 - 3) / 7).get()],
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name} <br> {point.y}</b>',
                        distance: -50,
                        filter: {
                            property: 'percentage',
                            operator: '>',
                            value: 4
                        }
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Personas',
                data: [
                    { name: 'Femenino', y: {{$asistioFemale}} },
                    { name: 'Masculino', y: {{$asistioMale}} }
                ]
            }]
        });

        Highcharts.chart('container2', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Integrantes de COPLADEM'
            },
            xAxis: {
                categories: [
                    ''
                ]
            },
            yAxis: [{
                min: 0,
                title: {
                    text: 'Employees'
                }
            }],
            legend: {
                shadow: false
            },
            tooltip: {
                shared: true
            },
            plotOptions: {
                column: {
                    grouping: false,
                    shadow: false,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Integrantes',
                color: 'rgba(109,227,148,.9)',
                data: [{{$integrante}}],
                pointPadding: 0.3,
                pointPlacement: -0.2
            }, {
                name: 'Integrantes asistentes',
                color: 'rgba(178,250,186,.9)',
                data: [{{$asistioIntegrante}}],
                pointPadding: 0.4,
                pointPlacement: -0.2
            }, {
                name: 'Invitados',
                color: 'rgba(248,161,63,1)',
                data: [{{$noIntegrante}}],
                pointPadding: 0.3,
                pointPlacement: 0.2,
            }, {
                name: 'Invitados asistentes',
                color: 'rgba(186,60,61,.9)',
                data: [{{$asistioNoIntegrante}}],
                pointPadding: 0.4,
                pointPlacement: 0.2,
            }]
        });
    </script>
@endsection