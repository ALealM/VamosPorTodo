<!-- pdf Servicios Municipales-->
<style>
    #header,
    #footer {
        position: fixed;
        left: 0;
        right: 0;
        color: #aaa;
        font-size: 0.9em;
    }

    #header {
        top: 0;
        border-bottom: 0.1pt solid transparent;
        margin-top: -10px;
        margin-bottom: -4em;
        z-index: 100;
        padding-right: 2em;
        font-weight: bold;
    }

    #footer {
        bottom: 0;
        border-top: 0.1pt solid #aaa;
    }

    .page-number:before {
        content: "Hoja " counter(page);
    }

    @page {
        margin: 50px !important;
        padding: 0px 0px 0px 0px !important;
    }
</style>

<div id="header">
    <table style="width: 100%; text-align: center">
        <tr>
            <td style="width: 50%; text-align: right; padding-right: 10%;">
                <h4 style="text-transform: uppercase;">{!! $tipo !!}</h4>
            </td>
            <td style="width: 50%; text-align: center;">
                <h6>{{ date('d') }} de {{ $meses[date('n', strtotime(date('m')*1))-3] }} del {{date('Y') }}</h6>
            </td>
        </tr>
    </table>
</div>

<div id="footer">
    <div class="page-number"></div>
</div>

<div style="font-size: 13px;">

    <div class="row pb-15">
        <div class="mr-auto ml-auto">
            <table style="width: 100%; text-align: center">
                <tr>
                    <td style="width: 70%; text-align: right; padding-right: 10%;">
                        <h1 style="text-transform: uppercase;">{!! $tipo !!}</h1>
                    </td>
                    <td style="width: 30%; text-align: center;">
                        <h4>{{ date('d') }} de {{ $meses[date('n', strtotime(date('m')*1))-3] }} del {{date('Y') }}</h4>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    @foreach($reportes as $reporte)
        <div class="row pb-15">
            @if( $reporte->visible )
                <div class="col-md-6" style="padding-top: 20px">
            @else
                <div class="col-md-12" style="padding-top: 20px">
            @endif
                    <table style="width: 100%; text-align: center">
                        <thead>
                            <tr style="background-color:#073656; color: white">
                                <th colspan="3" style="text-align: center"><h3><b>Datos generales del reporte</b></h3></th>
                            </tr>
                            <tr>
                                <th style="width: 50%;"><h4 style="text-align: center; margin-top: 0px"><b>FECHA: {{$reporte->fecha}}</b></h4></th>
                                <th style="width: 50%;"><h4 style="text-align: right; margin-top: 0px"><b>FOLIO: {{$reporte->folio}}</b></h4></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background-color:#ddd">
                                <th colspan="3" style="text-align: center">Descripción de la incidencia</th>
                            </tr>
                            <tr>
                                <td colspan="3"><h4>{{ $reporte->observaciones }}</h4></td>
                            </tr>
                            <tr style="background-color:#ddd">
                                <th>Medio de recepción</th>
                                <th>Área de atención</th>
                                <th>Tipo de atención</th>
                            </tr>
                            <tr>
                                <td>{{ $reporte->medio()->medio }}</td>
                                <td>{{ $reporte->area()->area }}</td>
                                <td>{{ $reporte->falla()->falla }}</td>
                            </tr>
                            <tr style="background-color:#ddd">
                                <th colspan="3" style="text-align: center">Ubicación</th>
                            </tr>
                            <tr>
                                <td colspan="3">{{ $reporte->calle()->d_calle }} #{{ $reporte->numext }}, {{ $reporte->colonia()->d_asenta }} @if( $reporte->calle1 && $reporte->calle2 ) - Entre calles {{ $reporte->calle1 }} y {{ $reporte->calle2 }} @endif </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @if( $reporte->visible )
                <div class="col-md-6" style="padding-top: 10px">
                    <table style="width: 100%; text-align: center">
                        <tbody>
                            <!-- SOLICITANTE -->
                            <tr style="background-color:#073656; color: white">
                                <th colspan="3" style="text-align: center"><h4><b>Solicitante</b></h4></th>
                            </tr>
                            <tr style="background-color:#ddd">
                                <th colspan="2" style="text-align: center">Nombre completo</th>
                                <th>Teléfono</th>
                            </tr>
                            <tr>
                                <td colspan="2"><h4>{{ $reporte->nombre }} {{ $reporte->ap_paterno }} {{ $reporte->ap_materno }}</h4></td>
                                <td>{{ $reporte->telefono }}</td>
                            </tr>
                            <tr style="background-color:#ddd">
                                <th>Correo electrónico</th>
                                <th>Género</th>
                                <th>Rango de edad</th>
                            </tr>
                            <tr>
                                <td>{{ $reporte->email }}</td>
                                <td>{{ $reporte->genero() }}</td>
                                <td>{{ $reporte->edad() }}</td>
                            </tr>
                            <tr style="background-color:#ddd">
                                <th colspan="3" style="text-align: center">Información adicional</th>
                            </tr>
                            <tr>
                                <td colspan="3">{{ ($reporte->adicional==null) ? 'Sin información adicional' : $reporte->adicional }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
                <div class="row">
                    <div class="mr-auto ml-auto" style="padding-top: 15px">
                        <table style="width: 100%; text-align: center">
                            <thead>
                                <tr style="background-color:#ddd">
                                    <th>Ubicación en el mapa</th>
                                    <th>Evidencia fotográfica</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 50%;">
                                        <img src="https://maps.googleapis.com/maps/api/staticmap?center={{ $reporte->latitud }},{{ $reporte->longitud }}&amp;zoom=17&amp;size=400x300&scale=1&amp;markers={{ $reporte->latitud }},{{ $reporte->longitud }}&amp;key=AIzaSyDIJ4iiYO9sANnnb1XZEepN2xI8B8hivSQ" alt="Ubicacion">
                                    </td>
                                    <td style="width: 50%;">
                                        <img src="{{asset("reportes/".$reporte->evidencia)}}" alt="Evidencia" style="max-width: 300px; max-height: 300px">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div><br>
        @if( !$loop->last ) <div style="page-break-after: always"></div><!-- Salto de página --> @endif
    @endforeach
</div>