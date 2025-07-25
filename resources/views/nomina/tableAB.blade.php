<style>
    .nav-pills .nav-link.active {
        background-color: #e8ebf5;
        color: #000;
    }

    thead {
        text-align: center;
        background-color: #fff;
    }
</style>
<div class="tab-container" style="padding-bottom: 0px">
    <ul class="nav nav-pills nav-fill" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" role="tab" aria-expanded="true" aria-current="page" href="#cambios">
                <b>CAMBIOS</b>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" role="tab" aria-expanded="false" href="#altas">
                <b>ALTAS</b>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" role="tab" aria-expanded="false" href="#bajas">
                <b>BAJAS</b>
            </a>
        </li>
    </ul>
    <div class="tab-content" style="padding-bottom: 2px">
        <div class="tab-pane fade active show" id="cambios" role="tabpanel" aria-expanded="true">
            <div class=" table-responsive">
                <table class="table tile table-hover dataTable" role='grid' id="tableC" style=" width: 100%">
                    <thead>
                        <tr>
                            <th style=" width: 30px">#</th>
                            <th>Nombre</th>
                            <th>Fecha Ingreso</th>
                            <th>Sueldo Mensual</th>
                            <th>Dirección</th>
                            <th>Departamento</th>
                            <th>Puesto</th>
                            <th>Cambios</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; $totC = 0 @endphp
                        @foreach($cambios as $cambio)
                        @php $totC += $cambio->sm2 @endphp
                        <tr>
                            <td>{!! number_format($i) !!}</td>
                            <td>{!! $cambio->nombre !!} {!! $cambio->ap_paterno !!} {!! $cambio->ap_materno !!}</td>
                            <td style="text-align: center">{!! $cambio->fecha_ingreso !!}</td>
                            <td style="text-align: right">$ {!! number_format($cambio->sm2,2,".",",") !!}</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{!! $cambio->di2 !!}</td>
                            <td>{!! $cambio->de2 !!}</td>
                            <td>{!! $cambio->p2 !!}</td>
                            <td>{!! $cambio->cambios !!}</td>
                        </tr>
                        @php $i++ @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ number_format($i-1) }}</th>
                            <th colspan="2"></th>
                            <th style="text-align: right"><small>$</small>{{ number_format($totC,2,".",",") }}&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th colspan="4"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="altas" role="tabpanel" aria-expanded="false">
            <div class=" table-responsive">
                <table class="table tile table-hover dataTable" role='grid' id="tableA" style=" width: 100%">
                    <thead>
                        <tr>
                            <th style=" width: 30px">#</th>
                            <th>Nombre</th>
                            <th>Fecha Ingreso</th>
                            <th>Sueldo Mensual</th>
                            <th>Dirección</th>
                            <th>Departamento</th>
                            <th>Puesto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; $totA = 0 @endphp
                        @foreach($altas as $alta)
                        @php $totA += $alta->sueldo_mensual @endphp
                        <tr>
                            <td>{!! number_format($i) !!}</td>
                            <td>{!! $alta->nombre !!} {!! $alta->ap_paterno !!} {!! $alta->ap_materno !!}</td>
                            <td style="text-align: center">{!! $alta->fecha_ingreso !!}</td>
                            <td style="text-align: right">$ {!! number_format($alta->sueldo_mensual,2,".",",") !!}</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{!! $alta->direccion !!}</td>
                            <td>{!! $alta->departamento !!}</td>
                            <td>{!! $alta->puesto !!}</td>
                        </tr>
                        @php $i++ @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ number_format($i-1) }}</th>
                            <th colspan="2"></th>
                            <th style="text-align: right"><small>$</small>{{ number_format($totA,2,".",",") }}&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th colspan="3"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="bajas" role="tabpanel" aria-expanded="false">
            <div class=" table-responsive">
                <table class="table tile table-hover dataTable" role='grid' id="tableB" style=" width: 100%">
                    <thead>
                        <tr>
                            <th style=" width: 30px">#</th>
                            <th>Nombre</th>
                            <th>Fecha Ingreso</th>
                            <th>Sueldo Mensual</th>
                            <th>Dirección</th>
                            <th>Departamento</th>
                            <th>Puesto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; $totB = 0 @endphp
                        @foreach($bajas as $baja)
                        @php $totB += $baja->sueldo_mensual @endphp
                        <tr>
                            <td>{!! number_format($i) !!}</td>
                            <td>{!! $baja->nombre !!} {!! $baja->ap_paterno !!} {!! $baja->ap_materno !!}</td>
                            <td style="text-align: center">{!! $baja->fecha_ingreso !!}</td>
                            <td style="text-align: right">$ {!! number_format($baja->sueldo_mensual,2,".",",") !!}</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{!! $baja->direccion !!}</td>
                            <td>{!! $baja->departamento !!}</td>
                            <td>{!! $baja->puesto !!}</td>
                        </tr>
                        @php $i++ @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ number_format($i-1) }}</th>
                            <th colspan="2"></th>
                            <th style="text-align: right"><small>$</small>{{ number_format($totB,2,".",",") }}&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th colspan="3"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $("#tableA").DataTable({
      aaSorting: [],
      lengthMenu: [[10, 30, 45, 60, -1],["10 registros", "30 registros", "45 registros", "60 registros", "Todo"]],
      language: {
        sSearch: "Buscar",
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
    
    $("#tableB").DataTable({
      aaSorting: [],
      lengthMenu: [[10, 30, 45, 60, -1],["10 registros", "30 registros", "45 registros", "60 registros", "Todo"]],
      language: {
        sSearch: "Buscar",
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
    
    $("#tableC").DataTable({
      aaSorting: [],
      lengthMenu: [[10, 30, 45, 60, -1],["10 registros", "30 registros", "45 registros", "60 registros", "Todo"]],
      language: {
        sSearch: "Buscar",
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
</script>