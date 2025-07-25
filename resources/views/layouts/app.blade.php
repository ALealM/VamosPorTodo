<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Full Business Manager</title>
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.png">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

  <!-- CSS Files -->
  {!! Html::style('css/sweet-alert.css') !!}
  {!! Html::style('css/bootstrap-duallistbox.css') !!}
  <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('material') }}/demo/demo.css" rel="stylesheet" />
  <!--JS BASE JQUERY-->
  <script src="{{ asset('material') }}/js/core/jquery.min.js"></script>
  {!! Html::script('js/sweet-alert.min.js') !!}
  {!! Html::script('js/general.js') !!}
  {!! Html::script('js/jquery.bootstrap-duallistbox.js') !!}

 <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.js"></script>
  <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>

	<!-- Búsqueda Mapa -->
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css" type="text/css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/export-data.js"></script>
		<script src="https://code.highcharts.com/modules/accessibility.js"></script>

  <script type="text/javascript">
  const formatter = new Intl.NumberFormat('en-NZ', {
    style: 'currency',
    currency: 'NZD',
    minimumFractionDigits: 2,
    setCurrencySymbol: ''
  });
  </script>

</head>
<body class="{{ $class ?? '' }} sidebar-mini">


  @if ( @$boolSinLayout != null)
    @yield('content')
  @else
    @auth()
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      @include('layouts.page_templates.auth')
    @endauth
    @guest()
      @include('layouts.page_templates.guest')
    @endguest
  @endif


  <!-- MODAL -->
  <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"></h4>
        </div>
        <div id="myModalBody" class="modal-body">
        </div>
      </div>
    </div>
  </div>
  <!--MODAL END-->




  <script src="{{ asset('material') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="{{ asset('material') }}/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="{{ asset('material') }}/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="{{ asset('material') }}/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{ asset('material') }}/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{ asset('material') }}/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{ asset('material') }}/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="{{ asset('material') }}/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="{{ asset('material') }}/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="{{ asset('material') }}/js/plugins/jasny-bootstrap.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="{{ asset('material') }}/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{ asset('material') }}/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="{{ asset('material') }}/js/plugins/arrive.min.js"></script>
  <!-- Chartist JS -->
  <script src="{{ asset('material') }}/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('material') }}/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('material') }}/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('material') }}/demo/demo.js"></script>
  <script src="{{ asset('material') }}/js/settings.js"></script>
  <script src="{{ asset('js/rowtables.js')}}"></script>
  <script src="{{ asset('js/compras.js')}}"></script>

    <!-- Internal Chartjs charts js-->
    <script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>

  <script type="text/javascript">
  var BASE_URL = window.location.protocol + "//" + window.location.host+ "/";
  // var BASE_URL = window.location.protocol + "//" + window.location.host+ "/informediario";


  $.validator.messages = {
    required: "El campo es necesario.",
    remote: "Ingresa correctamente el campo.",
    email: "Ingresa un correo electrónico válido.",
    url: "Ingresa una URL válida.",
    date: "Ingresa una fecha válida.",
    //dateISO: "Please enter a valid date (ISO).",
    number: "Ingresa un número válido.",
    digits: "Solo ingresa dígitos.",
    //creditcard: "Please enter a valid credit card number.",
    equalTo: "Ingresa el mismo valor.",
    //accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Ingresa no más de {0} caracteres."),
    minlength: jQuery.validator.format("Ingresa no menos de {0} caracteres."),
    rangelength: jQuery.validator.format("Ingresa un valor entre {0} y {1} caracteres."),
    range: jQuery.validator.format("Ingresa un valor entre {0} y {1}."),
    max: jQuery.validator.format("Ingresa un valor menor o igual a {0}."),
    min: jQuery.validator.format("Ingresa un valor igual o mayor a {0}.")
  };

  //Deshabilitar acciones para consultores
  @if ( session('login_consultor') == true )
  $(".acciones").remove();
  //$("#form :input").prop("disabled", true);
  @endif

  $(document).ready(function () {
    generate_tables();
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    $(".dataTable_acc").DataTable({
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
    });
  });

  function generate_tables(){
    $(".dataTable").DataTable({
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
          sNext: "Siguiente",
          sPrevious: "Anterior"
        }
      }
    });
  }

  //Para imprimir
  function imprimir() { window.load = function (){ window.print(); }(); }

  //Para calcular el subtotal en donde aplique
  function calcular_subtotal_iva()
  {
    var fMonto = parseFloat( $("#monto").val()*1 );
    var fIva = parseFloat( $("#iva").val() );
    if( fMonto > 0 && fIva > 0 ){
      var fSubtotal = fMonto / (1 + ( fIva / 100 ));
      $("#spanSubtotal").html( formatter.format(fSubtotal) );
    }else {
      $("#spanSubtotal").html( formatter.format(fMonto) );
    }
  }


</script>
@stack('js')
</body>
@include('common.mensajes')
</html>
