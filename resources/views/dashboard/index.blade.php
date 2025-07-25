@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  <div class="row">
    <div class="col-lg-12">
        <center><h3>100/100 <strong>ACCIONES</strong>  |  {{number_format(245876)}} <strong>BENEFICIARIOS</strong> </h3></center>
        <div class="row text-center">
            <div class="col-lg-3 widget-pie__item text-center" style="border-bottom: solid 1px #929292">
            <div class="easy-pie-chart" data-percent="30" data-size="115" data-track-color="#efefef" data-bar-color="#4caf50">
              <span class="easy-pie-chart__value text-dark">30</span>
            </div>
            <div ><b>CUMPLIMIENTO</b></div>
          </div>
          <div class="col-lg-3 widget-pie__item text-center" style="border-bottom: solid 1px #929292">
            <div class="easy-pie-chart" data-percent="20" data-size="115" data-track-color="#efefef" data-bar-color="#4caf50">
              <span class="easy-pie-chart__value text-dark">20</span>
            </div>
            <div ><b>PROPUESTA</b></div>
          </div>
          <div class="col-lg-3 widget-pie__item text-center" style="border-bottom: solid 1px #929292">
            <div class="easy-pie-chart" data-percent="40" data-size="115" data-track-color="#efefef" data-bar-color="#4caf50">
              <span class="easy-pie-chart__value text-dark">40</span>
            </div>
            <div ><b>ATENCIÓN CIUDADANA</b></div>
          </div>
          <div class="col-lg-3 widget-pie__item text-center" style="border-bottom: solid 1px #929292">
            <div class="easy-pie-chart" data-percent="10" data-size="115" data-track-color="#efefef" data-bar-color="#4caf50">
              <span class="easy-pie-chart__value text-dark">10</span>
            </div>
            <div ><b>GESTIÓN</b></div>
          </div>
        </div>
    </div>
  </div>
  <br><br>
  <div class="row">
    <div class="col-lg-6">
      <div class="row">
        <div class="col-lg-4">
          <div class="info-box">
            <span class="info-box-icon bg-fbm-blue elevation-1"><i class="material-icons text-white">emoji_people</i></span>
            <div class="info-box-content">
              <span class="info-box-text">Personas</span>
              <span class="info-box-number">{{number_format(244947)}}</span>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="info-box">
            <span class="info-box-icon bg-fbm-blue elevation-1"><i class="material-icons text-white">supervised_user_circle</i></span>
            <div class="info-box-content">
              <span class="info-box-text">Grupos</span>
              <span class="info-box-number">{{number_format(832)}}</span>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="info-box">
            <span class="info-box-icon bg-fbm-blue elevation-1"><i class="material-icons text-white">domain</i></span>
            <div class="info-box-content">
              <span class="info-box-text">Instituciones</span>
              <span class="info-box-number">{{number_format(97)}}</span>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <figure class="highcharts-figure">
            <div id="container-rpm" class="chart-container"></div>
          </figure>
          <p>
            <strong>Cumplimiento a lo largo de acciones.</strong><br>
            Pie chart demonstrating a monochrome color scheme. Monochrome color schemes can make
            certain charts easier to understand, as it helps readers to focus on the content instead of
            the colors. There can also be accessibility benefits to using this kind of color scheme,
            both fo color blindness and tactile mediums, as long as there is a clear separation between slices.
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <figure class="highcharts-figure">
        <div id="container"></div>
        <p class="highcharts-description">
        </p>
      </figure>
    </div>
  </div>




  <script src="vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
  <script src="demo/js/other-charts.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/highcharts-more.js"></script>
  <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <script>
  var gaugeOptions = {
    chart: {
      type: 'solidgauge'
    },
    title: null,
    pane: {
      center: ['50%', '85%'],
      size: '140%',
      startAngle: -90,
      endAngle: 90,
      background: {
        backgroundColor:
        Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
        innerRadius: '60%',
        outerRadius: '100%',
        shape: 'arc'
      }
    },

    exporting: {
      enabled: false
    },

    tooltip: {
      enabled: false
    },

    // the value axis
    yAxis: {
      stops: [
        [0.6, '#DDDF0D'], // yellow
        [0.3, '#DF5353'], // red
        [0.1, '#55BF3B'], // green
      ],
      lineWidth: 0,
      tickWidth: 0,
      minorTickInterval: null,
      tickAmount: 1,
      title: {
        y: -70
      },
      labels: {
        y: 16
      }
    },
    plotOptions: {
      solidgauge: {
        dataLabels: {
          y: 5,
          borderWidth: 0,
          useHTML: true
        }
      }
    }
  };


  // The RPM gauge
  var chartRpm = Highcharts.chart('container-rpm', Highcharts.merge(gaugeOptions, {
    yAxis: {
      min: 0,
      max: 100,
      title: {
        text: 'CUMPLIMIENTO'
      }
    },

    series: [{
      name: 'CUMPLIMIENTO',
      data: [30],
      dataLabels: {
        format:
        '<div style="text-align:center">' +
        '<span style="font-size:25px">{y:.1f}</span><br/>' +
        '<span style="font-size:12px;opacity:0.4">' +
        '30 / 100' +
        '</span>' +
        '</div>'
      },
      tooltip: {
        valueSuffix: ' revolutions/min'
      }
    }]

  }));


  //DONUT
  // Make monochrome colors
  var pieColors = (function () {
    var colors = [],
    base = Highcharts.getOptions().colors[0],
    i;

    for (i = 0; i < 10; i += 1) {
      // Start out with a darkened base color (negative brighten), and end
      // up with a much brighter color
      colors.push(Highcharts.color(base).brighten((i - 3) / 7).get());
    }
    return colors;
  }());

  // Build the chart
  Highcharts.chart('container', {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: 'Tipos de acciones registradas'
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
        colors: pieColors,
        dataLabels: {
          enabled: true,
          format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
          distance: -50,
          filter: {
            property: 'percentage',
            operator: '>',
            value: 4
          }
        }
      }
    },
    series: [{
      name: 'Share',
      data: [
        { name: 'Cumplimiento', y: 30 },
        { name: 'Propuesta', y: 20 },
        { name: 'Atención Ciudadana', y: 40 },
        { name: 'Gestión ', y: 10 }
      ]
    }]
  });

  </script>
@endsection
