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
        border-bottom: 0.1pt solid #aaa;
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

<div id="footer">
    <div class="page-number"></div>
</div>

<div style="font-size: 13px;">
    <div class="row pb-15">
        <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
            <table style=" width: 100%">
                <tbody>
                    <tr>
                        <td style=" width: 450px"><h4>{{date('d')}}/{{ $meses[date('n', strtotime(date('m')*1))-3] }}/{{date('Y')}} &nbsp;&nbsp;&nbsp;&nbsp; V1</h4></td>
                        <!--td style="text-align: right"><h4>FOLIO: {}</h4></td-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
            <h2 style="text-align: center; text-transform: uppercase;">{!! $tipo !!}</h2>
        </div>
    </div>

    @if( @$sm )
        <div class="row pb-15">
            <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px;">
                <h4 style="text-align: center">{!! str_replace("\n", "<br>", $sm->titulo) !!}</h4>
                <table class="table-hover" style="width: 50%;">
                    <tbody>
                        <tr style="background-color:#ddd">
                            <th style="text-align: center">FECHA</th>
                            <td style=" text-transform: uppercase">{{ date('d/m/Y', strtotime($sm->fecha) ) }}</td>
                        </tr>
                        <tr style="background-color:#ddd;">
                            <th style="text-align: center">Turno</th>
                            <td>{{ $sm->turno() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
                <h4 style="text-align: center">SUPERVISOR</h4><br>
                <table class="table table-hover table-bordered" style="width: 100%; text-align: center">
                    <thead>
                        <tr style="background-color:#ddd">
                            <th style="width: 50px">NOMBRE DE SUPERVISOR</th>
                            <th style="width: 50px">TELEFONO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$sm->supervisor}}</td>
                            <td>{{$sm->telefono}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
                    <h4 style="text-align: center">COORDINACION DE PARQUES Y JARDINES</h4><br>
                    <table class="table table-hover table-bordered" style="width: 100%; text-align: center">
                        <thead>
                            <tr style="background-color:#ddd">
                                <th>UNIDAD</th>
                                <th>UBICACIÓN</th>
                                <th>TRABAJOS A REALIZAR</th>
                                <th>FOLIOS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sm->detalles as $key => $det)                    
                                <tr style="{{ ($key%2==0) ? '' : 'background-color:#ddd' }}">
                                    <td>{{$det->unidad}}</td>
                                    <td>{{$det->ubicacion}}</td>
                                    <td>{{$det->trabajo}}</td>
                                    <td>{{$det->folio}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        @foreach($servicios as $sm)
            <div class="row pb-15">
                <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px;">
                    <h4 style="text-align: center">{!! str_replace("\n", "<br>", $sm->titulo) !!}</h4>
                    <table class="table-hover" style="width: 50%;">
                        <tbody>
                            <tr style="background-color:#ddd">
                                <th style="text-align: center">FECHA</th>
                                <td style=" text-transform: uppercase">{{ date('d/m/Y', strtotime($sm->fecha) ) }}</td>
                            </tr>
                            <tr style="background-color:#ddd;">
                                <th style="text-align: center">Turno</th>
                                <td>{{ $sm->turno() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
                    <h4 style="text-align: center">SUPERVISOR</h4><br>
                    <table class="table table-hover table-bordered" style="width: 100%; text-align: center">
                        <thead>
                            <tr style="background-color:#ddd">
                                <th style="width: 50px">NOMBRE DE SUPERVISOR</th>
                                <th style="width: 50px">TELEFONO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$sm->supervisor}}</td>
                                <td>{{$sm->telefono}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
                        <h4 style="text-align: center">COORDINACION DE PARQUES Y JARDINES</h4><br>
                        <table class="table table-hover table-bordered" style="width: 100%; text-align: center">
                            <thead>
                                <tr style="background-color:#ddd">
                                    <th>UNIDAD</th>
                                    <th>UBICACIÓN</th>
                                    <th>TRABAJOS A REALIZAR</th>
                                    <th>FOLIOS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sm->detalles as $key => $det)                    
                                    <tr style="{{ ($key%2==0) ? '' : 'background-color:#ddd' }}">
                                        <td>{{$det->unidad}}</td>
                                        <td>{{$det->ubicacion}}</td>
                                        <td>{{$det->trabajo}}</td>
                                        <td>{{$det->folio}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if( !$loop->last ) <br><br><br><hr><br> @endif
            </div>
        @endforeach
    @endif
</div>