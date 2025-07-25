@extends('layouts.app', ['activePage' => 'acciones', 'mainPage' => 'acciones'])

@section('content')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<style>
    select {
        text-align: center;
        text-align-last: center;
        font-weight: bold;

        /* webkit*/
    }
    option {
        text-align: center;
        /* reset to left*/
    }

    .shadow {
      -moz-box-shadow:    7px 5px 1px 1px #75aeba;
      -webkit-box-shadow: 7px 5px 1px 1px #75aeba;
      box-shadow:         7px 5px 1px 1px #75aeba;
      border-radius: 5px;
    }
    .shadow1 {
      -moz-box-shadow:    7px 5px 1px 1px #d16969;
      -webkit-box-shadow: 7px 5px 1px 1px #d16969;
      box-shadow:         7px 5px 1px 1px #d16969;
      border-radius: 5px;
    }
    .shadow2 {
      -moz-box-shadow:    7px 5px 1px 1px #6ac47c;
      -webkit-box-shadow: 7px 5px 1px 1px #6ac47c;
      box-shadow:         7px 5px 1px 1px #6ac47c;
      border-radius: 5px;
    }
    .shadow3 {
      -moz-box-shadow:    7px 5px 1px 1px #e8cd6d;
      -webkit-box-shadow: 7px 5px 1px 1px #e8cd6d;
      box-shadow:         7px 5px 1px 1px #e8cd6d;
      border-radius: 5px;
    }
</style>
<div class="card">
    <div class="card-body">
        <!--<div class="col-lg-12 col-md-12 col-sm-12">-->
        <div class="col-lg-12 col-md-12 col-sm-12 row" style="padding: 0px; margin: 0px">
            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                <h4 style="margin: 0px"><b>Distrito Local</b></h4>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-2"></div>
            <div class="col-lg-4 col-md-4 col-sm-8 text-center">
                {!! Form::select('distrito',$dists,$dl,['class'=>'form-control form-control-sm','onchange'=>'changeDistrito()','id'=>'distrito','style'=>'width:100%; font-size: 20px; height: 35px;']) !!}
            </div>


            <!--</div>-->
        </div>
    </div>
  </div>
  <!-- <div class="row"> -->
  <!-- <div class="card"> -->
      <!-- <div class="card-body"> -->
        <div class="row">
            <div class="col-md-6" style="padding-left: 20px">
                <div class="footer-widget shadow">
                    <div class="card text-white bg-info mb-12" style=" margin: 0px">
                        <div class="card-header" style="text-align:center; padding-bottom: 0px"><h4><b>MAPA DE DISTRITOS LOCALES</b></h4></div>
                    </div>
                    <div class="col-md-12" style="padding:0px">
                        <div id="map" class="map" style="position:relative; height:400px; margin: 1px; border-top: 1px solid #75aeba; border-left: 1px solid #75aeba; border-radius: 5px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-widget shadow1" style="border-top: 1px solid #d16969; border-left: 1px solid #d16969;">
                    <div class="card text-white bg-danger mb-12" style=" margin: 0px">
                        <div class="card-header" style="text-align:center; padding-bottom: 0px"><h4><b>Acciones al 100% del 01/10/21 al 05/04/22</b></h4></div>
                    </div>
                    <div class="col-md-12">
                        <div id="container"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding-top: 20px">
            <div class="col-md-6">
                <div class="footer-widget shadow2" style="border-top: 1px solid #63db58; border-left: 1px solid #63db58;">
                    <div class="card text-white bg-success mb-12" style=" margin: 0px">
                        <div class="card-header" style="text-align:center; padding-bottom: 0px"><h4><b>TIPOS DE ACCIONES</b></h4></div>
                    </div>
                    <div class="col-md-12 table-responsive">
                        <table class="table table-condensed dataTable_acc table-hover" role='grid'>
                          <thead>
                            <th>Incidencia</th>
                            <th>Total</th>
                          </thead>
                          <tbody>
                            @foreach($fallas as $falla)
                            <tr style="cursor: pointer;" onclick="datosColonia( 'falla', '{!! $falla->falla !!}' );">
                              <td>{{ $falla->falla }}</td>
                              <td>{{ $falla->tot }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-widget shadow3" style="border-top: 1px solid #d6b642; border-left: 1px solid #d6b642;">
                    <div class="card text-white bg-warning mb-12" style=" margin: 0px">
                        <div class="card-header" style="text-align:center; padding-bottom: 0px"><h4><b>ACCIONES POR COLONIA</b></h4></div>
                    </div>
                    <div class="col-md-12 table-responsive">
                        <table class="table table-condensed dataTable_acc table-hover" role='grid'>
                          <thead>
                            <th>Colonia</th>
                            <th>Total</th>
                          </thead>
                          <tbody>
                            @foreach($colonias as $colonia)
                            <tr style="cursor: pointer;" onclick="datosColonia( 'colonia', '{!! $colonia->colonia !!}' );">
                              <td>{{ $colonia->colonia }}</td>
                              <td>{{ $colonia->tot }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <!-- </div> -->
  <!-- </div> -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal">
    <div class="modal-dialog" style="min-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle" style="font-weight: bold;padding-left: 10%;"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<script>
    // var BASE_URL = window.location.protocol + "//" + window.location.host + "/";
    function changeStatus(id, est, secc) {
        dist = $("#distrito").val();
        gen = $("#genero").val();
        oc = $("#ocupacion").val();
        ei = $("#inicio").val();
        ef = $("#fin").val();
        $("#infoSecc").empty();
        var l = 773;
        while (l <= 1820) {
            var mapLayer = map.getLayer('SeccionAct ' + l);
            if (typeof mapLayer !== 'undefined') {
                // Remove map layer & source.
                map.removeLayer('SeccionAct ' + l).removeSource('SeccionAct ' + l);
            }
            l++;
        }
        $.get(BASE_URL + "changeStatus", {id: id, dist: dist, gen: gen, oc: oc, ei: ei, ef: ef}, function (result) {
            $("#infoSecc").append(result);
            $("#data-table4").DataTable(
                    {
                        autoWidth: !1,
                        order: [[0, 'desc']],
                        responsive: !0,
                        lengthMenu: [[10, 30, 45, 60, -1],
                            ["10 registros", "30 registros", "45 registros", "60 registros", "Todo"]],
                        language: {searchPlaceholder: "Buscar en la tabla..."},
                        dom: "Blfrtip",
                    }
            );
            $("#data-table5").DataTable(
                    {
                        autoWidth: !1,
                        order: [[0, 'desc']],
                        responsive: !0,
                        lengthMenu: [[10, 30, 45, 60, -1],
                            ["10 registros", "30 registros", "45 registros", "60 registros", "Todo"]],
                        language: {searchPlaceholder: "Buscar en la tabla..."},
                        dom: "Blfrtip",
                    }
            );
            if (est == 1) {
                $('html, body').animate({scrollTop: $("#data-table5").offset().top + 250}, 1000);

                map.removeLayer('Seccion ' + secc).removeSource('Seccion ' + secc);
                if (dist == 2)
                    map.flyTo({center: [-100.984187, 22.172589], zoom: 17.5});
                if (dist == 5)
                    map.flyTo({center: [-100.961072, 22.408982], zoom: 10});
                if (dist == 6)
                    map.flyTo({center: [-100.955354, 22.059068], zoom: 11.2});
                if (dist == 7)
                    map.flyTo({center: [-101.058819, 22.116106], zoom: 11.3});
                if (dist == 8)
                    map.flyTo({center: [-100.852974, 22.088118], zoom: 15.5});
            } else {
                $('html, body').animate({scrollTop: $("#data-table5").offset().top + 250}, 1000);

//                map.flyTo({
//                    zoom: 12
//                });
                $.get(BASE_URL + "mapaSeccAdd", {'id': id}, function (r) {
                    map.addSource('Seccion ' + r.seccion, {'type': 'geojson', 'data': {'type': 'Feature', 'geometry': {'type': 'Polygon', 'coordinates': [r.mapa]}}});
                    map.addLayer({'id': 'Seccion ' + r.seccion, 'type': 'fill', 'source': 'Seccion ' + r.seccion, 'layout': {}, 'paint': {'fill-color': r.color, 'fill-opacity': 0.2}});
                    map.flyTo({
                        center: r.coords,
                        zoom: 14
                    });
                });
            }
        });
    }

    function changeDistrito() {
        dist = $("#distrito").val();
        window.location = BASE_URL + "acciones/" + dist;
    }

    function busqueda() {
        dist = $("#distrito").val();
        gen = $("#genero").val();
        oc = $("#ocupacion").val();
        ei = $("#inicio").val();
        ef = $("#fin").val();
        $("#infoSecc").empty();
        $.get(BASE_URL + "busqueda", {dist: dist, gen: gen, oc: oc, ei: ei, ef: ef}, function (result) {
            $("#infoSecc").append(result);
            $("#data-table4").DataTable(
                    {
                        autoWidth: !1,
                        order: [[0, 'desc']],
                        responsive: !0,
                        lengthMenu: [[10, 30, 45, 60, -1],
                            ["10 registros", "30 registros", "45 registros", "60 registros", "Todo"]],
                        language: {searchPlaceholder: "Buscar en la tabla..."},
                        dom: "Blfrtip",
                    }
            );
            $("#data-table5").DataTable(
                    {
                        autoWidth: !1,
                        order: [[0, 'desc']],
                        responsive: !0,
                        lengthMenu: [[10, 30, 45, 60, -1],
                            ["10 registros", "30 registros", "45 registros", "60 registros", "Todo"]],
                        language: {searchPlaceholder: "Buscar en la tabla..."},
                        dom: "Blfrtip",
                    }
            );
        });
    }
</script>
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoibWFwZm91bmQiLCJhIjoiY2p5NGp3ZTh2MTg3MDNpbXAxM2MxeGoybiJ9.VXQ3NXUpfX1YRB37TwBMYA';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [-100.953690, 22.302197],
        zoom: 13
    });
    map.addControl(new mapboxgl.FullscreenControl());
    map.on('style.load', function () {
// Add an image to use as a custom marker
        map.loadImage(
                'https://docs.mapbox.com/mapbox-gl-js/assets/custom_marker.png',
                function (error, image) {
                    if (error)
                        throw error;
            }
    );
    }
    );

    $(document).ready(function () {
        var dist = $("#distrito").val();
        $.get(BASE_URL + "mapaDist", {dist: dist}, function (result) {
          var op = 0.15;
          if(dist == 0){ op = 0.45}
            $(result.vs).each(function (i, v) { // indice, valor
                map.addSource('SeccionD ' + v.seccion, {'type': 'geojson', 'data': {'type': 'Feature', 'geometry': {'type': 'Polygon', 'coordinates': [result.mapas[v.seccion]]}}});
                map.addLayer({'id': 'SeccionD ' + v.seccion, 'type': 'fill', 'source': 'SeccionD ' + v.seccion, 'layout': {}, 'paint': {'fill-color': v.base, 'fill-opacity': op}});
            });
        });
        if (dist == 0)
            map.flyTo({center: [-100.962065, 22.302439], zoom: 8.4});
        if (dist == 2)
            map.flyTo({center: [-100.984187, 22.172589], zoom: 11.5});
        if (dist == 5)
            map.flyTo({center: [-100.961072, 22.408982], zoom: 8.9});
        if (dist == 6)
            map.flyTo({center: [-100.955354, 22.059068], zoom: 10.2});
        if (dist == 7)
            map.flyTo({center: [-101.058819, 22.116106], zoom: 10.3});
        if (dist == 8)
            map.flyTo({center: [-100.852974, 22.088118], zoom: 10.4});

            // Create the chart
    Highcharts.chart('container', {
        chart: {
            type: 'column',
            height: 400,
        },
        title: {
            text: ''
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
                text: 'Total de acciones'
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
                    format: '{point.y:.,2f}'
                }
            }
        },
    	credits: false,
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.,2f}</b> del total<br/>'
        },

        series: [
            {
                name: "Acciones",
                colorByPoint: true,
                data: [
                @foreach($acciones as $accion)
                { name: "DL {{$accion->dl}} ({{round($accion->tot/$acciones->sum('tot')*100,2)}}%)", y: {{$accion->tot}} , color: '{{$accion->color()->base}}' },
                @endforeach
            ]
            }
        ]
    });

    });

    // $(document).ready(function () {
    //     if ("geolocation" in navigator) {
    //         navigator.geolocation.getCurrentPosition(position => {
    //             var coord = position.coords.longitude+","+position.coords.latitude;
    //             $.get(BASE_URL + "userCoord", {coord:coord});
    //         });
    //     }
    //     else { /* geolocation IS NOT available, handle it */ }
    // });

    function datosColonia( table, data ) {
        // var BASE_URL = window.location.protocol + "//" + window.location.host + "/";
        $(".modal-body").empty();
        $("#modal").modal();
        let _LoadingHtml = '<div class="spin spin-lg spin-spinning" style="text-align: center;">' +
                //'<span class="tips"> <h2 style="color: cornflowerblue;"> Cargando... </h2> </span>' +
                '<img src="../img/preloader4.gif" style="width:40%"/>' +
            '</div>'
        $(".modal-body").append(_LoadingHtml);
        $("#modalTitle").html(data);
        $.get(BASE_URL + "coloniaDatos", { table: table, data: data }, function (r) {
            $(".spin").remove();
            $(".modal-body").append(r);
            dataTableCharge( table );
        });
    }

    function dataTableCharge( table ){
        $("#"+table+'DatosTable').DataTable({
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
                    sNext: ">>",
                    sPrevious: "<<"
                }
            }
        } );
    }
</script>
@endsection
