@if($evento->diario==0)
<div class="row pb-15">
    <div class="col-md-12 mr-auto ml-auto" style="padding-top: 10px">
        <h4 style="text-align: center"><b>{!! str_replace("\n", "<br>", $evento->titulo) !!}</b><br>{{$direccion}}</h4>
        <table class="table-hover" style="width: 100%;" id="tablaBeneficiarios">
            <tbody>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">LUGAR Y FECHA</th>
                    <td colspan="5" style=" text-transform: uppercase">
                        {{ $evento->lugar }}, {{ $dias[date('w', strtotime($evento->fecha))] }} {{ date('j', strtotime($evento->fecha)) }} de {{ $meses[date('n', strtotime($evento->fecha))-1] }} de {{ date('Y', strtotime($evento->fecha)) }}
                    </td>
                </tr>
                <tr>
                    <th style="text-align: center">HORA INICIO</th>
                    <td>{{ $evento->hora_inicio }}</td>
                    <th style="text-align: center">HORA TÉRMINO</th>
                    <td>{{ $evento->hora_fin }}</td>
                    <th style="text-align: center">CÓDIGO DE VESTIMENTA</th>
                    <td>{{ $evento->vestimenta() }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-11 mr-auto ml-auto" style="padding-top: 15px">
        <h4 style="text-align: center">ORDEN DEL DÍA</h4>
        <table class="table table-hover table-bordered" style="width: 100%; text-align: center">
            <tbody>
                <tr style="background-color:#ddd">
                    <th colspan="2">HORARIO</th>
                    <th rowspan="2">ACTIVIDAD</th>
                    <th rowspan="2">OBSERVACIONES</th>
                </tr>
                <tr style="background-color:#ddd">
                    <th style="width: 50px">INICIO</th>
                    <th style="width: 50px">FIN</th>
                </tr>
                @foreach($acciones as $accion)
                <tr>
                    <td>{{$accion->hora_inicio}}</td>
                    <td>{{$accion->hora_fin}}</td>
                    <td>{{$accion->actividad}}</td>
                    <td>{{$accion->observaciones}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="row pb-15">
    <div class="col-md-12 mr-auto ml-auto" style="padding-top: 10px">
        <h4 style="text-align: center"><b>{!! str_replace("\n", "<br>", $evento->titulo) !!}</b><br>{{$direccion}}</h4>
        <table class="table-hover" style="width: 100%;" id="tablaBeneficiarios">
            <tbody>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">LUGAR Y FECHA</th>
                    <td colspan="5" style=" text-transform: uppercase">
                        SIN DEFINIR
                    </td>
                </tr>
                <tr>
                    <th style="text-align: center">HORA INICIO</th>
                    <td>SIN DEFINIR</td>
                    <th style="text-align: center">HORA TÉRMINO</th>
                    <td>SIN DEFINIR</td>
                    <th style="text-align: center">CÓDIGO DE VESTIMENTA</th>
                    <td>SIN DEFINIR</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-11 mr-auto ml-auto" style="padding-top: 15px">
        <h4 style="text-align: center">ORDEN DEL DÍA</h4>
        <table class="table table-hover table-bordered" style="width: 100%; text-align: center">
            <tbody>
                <tr style="background-color:#ddd">
                    <th colspan="2">HORARIO</th>
                    <th rowspan="2">ACTIVIDAD</th>
                    <th rowspan="2">OBSERVACIONES</th>
                </tr>
                <tr style="background-color:#ddd">
                    <th style="width: 50px">INICIO</th>
                    <th style="width: 50px">FIN</th>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:center">SIN DEFINIR</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endif