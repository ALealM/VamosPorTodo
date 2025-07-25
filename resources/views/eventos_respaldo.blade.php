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
    #watermark {
        position: fixed;

        /** 
            Set a position in the page for your image
            This should center it vertically
        **/
        bottom:   24cm;
        left:     0cm;

        /** Change image dimensions**/
        width:    3.5cm;
        height:   2.0cm;

        /** Your watermark should be behind every content**/
        z-index:  -1000;
    }
    #watermark2 {
        position: fixed;

        /** 
            Set a position in the page for your image
            This should center it vertically
        **/
        bottom:   24.5cm;
        left:     17.5cm;

        /** Change image dimensions**/
        width:    2.2cm;
        height:   2.0cm;

        /** Your watermark should be behind every content**/
        z-index:  -1000;
    }
    #watermark3 {
        position: fixed;

        /** 
            Set a position in the page for your image
            This should center it vertically
        **/
        bottom:   8.5cm;
        left:     0.5cm;

        /** Change image dimensions**/
        width:   18.5cm;
        height:  9cm;

        /** Your watermark should be behind every content**/
        z-index:  -1000;
    }
    @page {
        margin: 50px !important;
        padding: 0px 0px 0px 0px !important;
    }
</style>
<div id="footer">
    <div class="page-number"></div>
</div>
<!--<div id="watermark">
    <img src="{{asset('img/sixslp.png')}}" height="100%" width="100%" />
</div>
<div id="watermark2">
    <img src="{{asset('img/esq1.png')}}" height="100%" width="100%" style=" opacity: 0.5"/>
</div>-->
<!--<div id="watermark3">
    <img src="{{asset('img/acciones.png')}}" height="100%" width="100%" style=" opacity: 0.3"/>
</div>-->
<div style="font-size: 13px;">
    <div class="row pb-15">
        <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
            <table style=" width: 100%">
                <tbody>
                    <tr>
                        <td style=" width: 450px"><h4>{{date('d')}}/{{ $meses[date('n', strtotime(date('m')*1))-3] }}/{{date('Y')}} V1</h4></td>
                        <td style="text-align: right"><h4>FOLIO: {{$folio}}</h4></td>
                    </tr>
                </tbody>
            </table>
            <h4 style="text-align: center">{!! str_replace("\n", "<br>", $evento->titulo) !!}</h4>
            <table class="table-hover" style="width: 100%;" id="tablaBeneficiarios">
                <tbody>
                    <tr style="background-color:#ddd">
                        <th style="text-align: center">LUGAR Y FECHA</th>
                        <td colspan="5" style=" text-transform: uppercase">{{ $evento->lugar }}, {{ $dias[date('w', strtotime($evento->fecha))] }} {{ date('j', strtotime($evento->fecha)) }} de {{ $meses[date('n', strtotime($evento->fecha))-1] }} de {{ date('Y', strtotime($evento->fecha)) }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: center">HORA INICIO</th>
                        <td>{{ $evento->hora_inicio }}</td>
                        <th style="text-align: center">HORA TÉRMINO</th>
                        <td>{{ $evento->hora_fin }}</td>
                        <th style="text-align: center">CÓDIGO DE VESTIMENTA</th>
                        <td>{{ $evento->vestimenta() }}</td>
                    </tr>
                    <tr style="background-color:#ddd">
                        <th style="text-align: center">MONTAJE</th>
                        <td colspan="5">{!! str_replace("\n", "<br>", $evento->montaje) !!}</td>
                    </tr>
                    <tr>
                        <th style="text-align: center">INVITADOS ESPECIALES</th>
                        <td colspan="5">{!! str_replace("\n", "<br>", $evento->invitados_e) !!}</td>
                    </tr>
                    <tr style="background-color:#ddd">
                        <th style="text-align: center">INVITADOS</th>
                        <td colspan="5">{!! str_replace("\n", "<br>", $evento->invitados) !!}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
            <h4 style="text-align: center">ÁREAS COLABORADORAS</h4>
            <table class="table table-hover table-bordered" style="width: 100%; text-align: center">
                @if($colaboradores->isEmpty())
                <tbody>
                    <tr style="background-color:#ddd">
                        <th style="width: 50px">SIN COLABORADORES</th>
                    </tr>
                </tbody>
                @else
                <tbody>
                    <tr style="background-color:#ddd">
                        <th style="width: 50px">NOMBRE</th>
                        <th style="width: 50px">DIRECCIÓN</th>
                    </tr>
                    @php $i=0; @endphp
                    @foreach($colaboradores as $colaborador)
                    <tr style="{{ ($i%2==0) ? '' : 'background-color:#ddd' }}">
                        <td>{{$colaborador->gabinete()->nombre}}</td>
                        <td>{{$colaborador->gabinete()->direccion}}</td>
                    </tr>
                    @php $i++; @endphp
                    @endforeach
                </tbody>s
                @endif
            </table>
        </div>
        <div class="row">
            <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
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
                        @php $i=0; @endphp
                        @foreach($acciones as $accion)                    
                        <tr style="{{ ($i%2==0) ? '' : 'background-color:#ddd' }}">
                            <td>{{$accion->hora_inicio}}</td>
                            <td>{{$accion->hora_fin}}</td>
                            <td>{{$accion->actividad}}</td>
                            <td>{{$accion->observaciones}}</td>
                        </tr>
                        @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
                <h4 style="text-align: center">REPORTE FINAL DEL EVENTO</h4>
                <table class="table table-hover table-bordered" style="width: 100%; text-align: center" id="tablaBeneficiarios">
                    <tbody>
                        <tr>
                            <td>
                                {{$evento->reporte}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
                <h4 style="text-align: center">REPORTE DE ÁREAS COLABORADORAS</h4>
                @foreach($colaboradores as $colaborador)
                <table class="table table-hover table-bordered" style="width: 100%">
                    <tbody>
                        <tr style="background-color:#ddd">
                            <th colspan="2" style="text-align: center">{{$colaborador->gabinete()->direccion}}</th>
                        </tr>                
                        <tr>
                            <th style=" width: 100px">REPORTE</th>
                            <td style="text-align: left">{{$colaborador->reporte}}</td>
                        </tr>                
                    </tbody>
                </table>
                @endforeach
            </div>
        </div>
    </div>
</div>