@extends('layouts.app', ['activePage' => 'Indicadores', 'mainPage' => 'Indicadores'])
@section('title', 'Main page')
@section('content')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
<style>
    .nav-pills .nav-link.active {
        background-color: #e8ebf5;
    }

    .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
      color: black !important;
    }

    thead {
        text-align: center;
        background-color: #fff;
    }

    .shadow1 {
      -moz-box-shadow:    3px 2px 1px 1px #073656; -webkit-box-shadow: 3px 2px 1px 1px #073656;
      box-shadow:         3px 2px 1px 1px #073656; border-radius: 3px;
    }
    .shadow2 {
      -moz-box-shadow:    3px 2px 1px 1px #073656; -webkit-box-shadow: 3px 2px 1px 1px #073656;
      box-shadow:         3px 2px 1px 1px #073656; border-radius: 3px;
    }
    .shadow3 {
      -moz-box-shadow:    3px 2px 1px 1px #073656; -webkit-box-shadow: 3px 2px 1px 1px #073656;
      box-shadow:         3px 2px 1px 1px #073656; border-radius: 3px;
    }
    .shadow4 {
      -moz-box-shadow:    3px 2px 1px 1px #073656; -webkit-box-shadow: 3px 2px 1px 1px #073656;
      box-shadow:         3px 2px 1px 1px #073656; border-radius: 3px;
    }
    .shadow5 {
      -moz-box-shadow:    3px 2px 1px 1px #073656; -webkit-box-shadow: 3px 2px 1px 1px #073656;
      box-shadow:         3px 2px 1px 1px #073656; border-radius: 3px;
    }
    .shadow6 {
      -moz-box-shadow:    3px 2px 1px 1px #073656; -webkit-box-shadow: 3px 2px 1px 1px #073656;
      box-shadow:         3px 2px 1px 1px #073656; border-radius: 3px;
    }
</style>



<div class="tab-container" style="padding-bottom: 0px">
    <ul class="nav nav-pills nav-fill" role="tablist">
      @foreach($areas as $area)
        <li class="nav-item">
            <a class="nav-link {{($loop->first) ? 'active' : ''}}" data-toggle="tab" role="tab" aria-expanded="{{($loop->first) ? 'true' : 'false'}}" aria-current="page" href="#area_{{$area->id}}" style="color:">
                {{$area->direccion}}
            </a>
        </li>
        @endforeach
    </ul>

    <div class="tab-content" style="padding-bottom: 2px">
        <div class="tab-pane fade active show" id="area_102" role="tabpanel" aria-expanded="true">
            <div class="row">
              <div style="text-align: center" class="col-md-12"><h3 style="margin-bottom: 0px"><b>LÍNEAS DE ACCIÓN</b></h3>
                <a onclick="pdf(102)" style="color: green; cursor: pointer;" class="btn btn-sm btn-outline-success"><i class="fa fa-download"></i></a>
              </div>
              @foreach($acciones[1] as $area1)
              <div class="footer-widget shadow1 col-md-3" style="cursor: pointer" onclick="accion({{ $area1->id }},1)" id='div{{ $area1->id }}'>
                  <div style="text-align: center; height: 50px; margin: 10px;">
                      <h4>{{ $area1->programa }}</h4>
                  </div>
              </div>
              @endforeach
              <div style="text-align: center; margin-top: 20px" class="col-md-6" id='ob1'></div>
              <div style="text-align: center; margin-top: 20px" class="col-md-3" id='mt1'></div>
              <div style="text-align: center; margin-top: 20px" class="col-md-3" id='av1'></div>
              <div style="margin-top: 20px" class="col-md-12"><hr></div>
              <div style="text-align: center; margin-top: 20px; display: none" class="col-md-12" id='gr1T'><h3>Desarrollo del periodo</h3></div>
              <div style="text-align: center; margin-top: 20px" class="col-md-12" id='gr1'></div>
            </div>
        </div>

        <div class="tab-pane fade" id="area_103" role="tabpanel" aria-expanded="false">
          <div class="row">
            <div style="text-align: center" class="col-md-12"><h3 style="margin-bottom: 0px"><b>LÍNEAS DE ACCIÓN</b></h3>
              <a onclick="pdf(103)" style="color: green; cursor: pointer;" class="btn btn-sm btn-outline-success"><i class="fa fa-download"></i></a>
            </div>
            @foreach($acciones[2] as $area2)
            <div class="footer-widget shadow2 col-md-3" style="cursor: pointer" onclick="accion({{ $area2->id }},2)" id='div{{ $area2->id }}'>
                <div style="text-align: center; height: 50px; margin: 10px;">
                    <h4>{{ $area2->programa }}</h4>
                </div>
            </div>
            @endforeach
            <div style="text-align: center; margin-top: 20px" class="col-md-6" id='ob2'></div>
            <div style="text-align: center; margin-top: 20px" class="col-md-3" id='mt2'></div>
            <div style="text-align: center; margin-top: 20px" class="col-md-3" id='av2'></div>
            <div style="margin-top: 20px" class="col-md-12"><hr></div>
            <div style="text-align: center; margin-top: 20px; display: none" class="col-md-12" id='gr2T'><h3>Desarrollo del periodo</h3></div>
            <div style="text-align: center; margin-top: 20px" class="col-md-12" id='gr2'></div>
          </div>
        </div>
        <div class="tab-pane fade" id="area_104" role="tabpanel" aria-expanded="false">
          <div class="row">
            <div style="text-align: center" class="col-md-12"><h3 style="margin-bottom: 0px"><b>LÍNEAS DE ACCIÓN</b></h3>
              <a onclick="pdf(104)" style="color: green; cursor: pointer;" class="btn btn-sm btn-outline-success"><i class="fa fa-download"></i></a>
            </div>
            @foreach($acciones[3] as $area3)
            <div class="footer-widget shadow3 col-md-3" style="cursor: pointer" onclick="accion({{ $area3->id }},3)" id='div{{ $area3->id }}'>
                <div style="text-align: center; height: 70px; margin: 10px;">
                    <h4>{{ $area3->programa }}</h4>
                </div>
            </div>
            @endforeach
            <div style="text-align: center; margin-top: 20px" class="col-md-6" id='ob3'></div>
            <div style="text-align: center; margin-top: 20px" class="col-md-3" id='mt3'></div>
            <div style="text-align: center; margin-top: 20px" class="col-md-3" id='av3'></div>
            <div style="margin-top: 20px" class="col-md-12"><hr></div>
            <div style="text-align: center; margin-top: 20px; display: none" class="col-md-12" id='gr3T'><h3>Desarrollo del periodo</h3></div>
            <div style="text-align: center; margin-top: 20px" class="col-md-12" id='gr3'></div>
          </div>
        </div>
        <div class="tab-pane fade" id="area_105" role="tabpanel" aria-expanded="false">
          <div class="row">
            <div style="text-align: center" class="col-md-12"><h3 style="margin-bottom: 0px"><b>LÍNEAS DE ACCIÓN</b></h3>
              <a onclick="pdf(105)" style="color: green; cursor: pointer;" class="btn btn-sm btn-outline-success"><i class="fa fa-download"></i></a>
            </div>
            @foreach($acciones[4] as $area4)
            <div class="footer-widget shadow4 col-md-3" style="cursor: pointer" onclick="accion({{ $area4->id }},4)" id='div{{ $area4->id }}'>
                <div style="text-align: center; height: 60px; margin: 10px; padding-top: 10px">
                    <h4>{{ $area4->programa }}</h4>
                </div>
            </div>
            @endforeach
            <div style="text-align: center; margin-top: 20px" class="col-md-6" id='ob4'></div>
            <div style="text-align: center; margin-top: 20px" class="col-md-3" id='mt4'></div>
            <div style="text-align: center; margin-top: 20px" class="col-md-3" id='av4'></div>
            <div style="margin-top: 20px" class="col-md-12"><hr></div>
            <div style="text-align: center; margin-top: 20px; display: none" class="col-md-12" id='gr4T'><h3>Desarrollo del periodo</h3></div>
            <div style="text-align: center; margin-top: 20px" class="col-md-12" id='gr4'></div>
          </div>
        </div>
        <div class="tab-pane fade" id="area_106" role="tabpanel" aria-expanded="false">
          <div class="row">
            <div style="text-align: center" class="col-md-12"><h3 style="margin-bottom: 0px"><b>LÍNEAS DE ACCIÓN</b></h3>
              <a onclick="pdf(106)" style="color: green; cursor: pointer;" class="btn btn-sm btn-outline-success"><i class="fa fa-download"></i></a>
            </div>
            @foreach($acciones[5] as $area5)
            <div class="footer-widget shadow5 col-md-3" style="cursor: pointer" onclick="accion({{ $area5->id }},5)" id='div{{ $area5->id }}'>
                <div style="text-align: center; height: 70px; margin: 10px;">
                    <h4>{{ $area5->programa }}</h4>
                </div>
            </div>
            @endforeach
            <div style="text-align: center; margin-top: 20px" class="col-md-6" id='ob5'></div>
            <div style="text-align: center; margin-top: 20px" class="col-md-3" id='mt5'></div>
            <div style="text-align: center; margin-top: 20px" class="col-md-3" id='av5'></div>
            <div style="margin-top: 20px" class="col-md-12"><hr></div>
            <div style="text-align: center; margin-top: 20px; display: none" class="col-md-12" id='gr5T'><h3>Desarrollo del periodo</h3></div>
            <div style="text-align: center; margin-top: 20px" class="col-md-12" id='gr5'></div>
          </div>
        </div>
        <div class="tab-pane fade" id="area_107" role="tabpanel" aria-expanded="false">
          <div class="row">
            <div style="text-align: center" class="col-md-12"><h3 style="margin-bottom: 0px"><b>LÍNEAS DE ACCIÓN</b></h3>
              <a onclick="pdf(107)" style="color: green; cursor: pointer;" class="btn btn-sm btn-outline-success"><i class="fa fa-download"></i></a>
            </div>
            @foreach($acciones[6] as $area6)
            <div class="footer-widget shadow6 col-md-3" style="cursor: pointer" onclick="accion({{ $area6->id }},6)" id='div{{ $area6->id }}'>
                <div style="text-align: center; height: 50px; margin: 10px;">
                    <h4>{{ $area6->programa }}</h4>
                </div>
            </div>
            @endforeach
            <div style="text-align: center; margin-top: 20px" class="col-md-6" id='ob6'></div>
            <div style="text-align: center; margin-top: 20px" class="col-md-3" id='mt6'></div>
            <div style="text-align: center; margin-top: 20px" class="col-md-3" id='av6'></div>
            <div style="margin-top: 20px" class="col-md-12"><hr></div>
            <div style="text-align: center; margin-top: 20px; display: none" class="col-md-12" id='gr6T'><h3>Desarrollo del periodo</h3></div>
            <div style="text-align: center; margin-top: 20px" class="col-md-12" id='gr6'></div>
          </div>
        </div>
    </div>
</div>
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
              [0.1, '#c73434'], // green
              [0.5, '#d9aa1e'], // yellow
              [0.9, '#158a34'] // red
          ],
          lineWidth: 0,
          tickWidth: 0,
          minorTickInterval: null,
          tickAmount: 2,
          title: {
              y: 0
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

    function accion(id,i) {
        $('#gr' + i + 'T').attr('style','text-align: center; margin-top: 20px; display: block');
        $('.shadow'+i).attr('style','background-color: transparent; cursor: pointer');
        $('#div'+id).attr('style','background-color: #738bdd; color: white');
        $.get(BASE_URL + "getAccion", {'id': id}, function (r) {
            $('#ob' + i).empty(); $('#ob' + i).append('<h3><b>Objetivo</b></h3><div><h4>'+r.objetivo+'</h4></div>');
            $('#mt' + i).empty(); $('#mt' + i).append('<h3><b>Meta</b></h3><div><h3>'+r.meta_+'</h3></div>');
            $('#av' + i).empty(); $('#av' + i).append('<h3><b>Avance</b></h3><div><h3>'+r.avance_+'</h3></div>');
            $('#gr' + i).empty();
            var chartSpeed = Highcharts.chart('gr'+i, Highcharts.merge(gaugeOptions, {
              yAxis: {
                  min: 0,
                  max: r.meta,

              },

              credits: {
                  enabled: false
              },

              series: [{
                  name: 'Speed',
                  data: [r.avance],
                  dataLabels: {
                      format:
                          '<div style="text-align:center">' +
                          '<span style="font-size:25px">{y}</span><br/>' +
                          '<span style="font-size:18px;opacity:0.4">'+r.unidad+'</span>' +
                          '</div>'
                  },
                  tooltip: {
                      valueSuffix: r.unidad
                  }
              }]

          }));

        });
    }

    function pdf(id) {
        window.location = BASE_URL + "pdfAcciones/" + id;
    }

</script>

@endsection
