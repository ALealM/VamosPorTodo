<html>
    <head>
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 4cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2.5cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0.5cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;
                bottom: 0cm;
            }
            .page-number:before {
                position: fixed;
                left: 9.5cm;
                bottom: 1.2cm;
                color: #aaa;
                font-size: 0.9em;
                z-index: 9999;
                content: "Página " counter(page);
            }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <img src="{{asset('img/encabezadoInf.png')}}" width="100%" height="100%"/>
        </header>

        <footer>
            <div class="page-number"></div>
            <img src="{{asset('img/footerInf.png')}}" width="100%" height="100%"/>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <div style="padding-top: 0px; font-family: 'Times New Roman', Times, serif">
                <table class="table-hover table-bordered" style="width: 100%;" id="tablaBeneficiarios">
                    <tbody>
                        <tr>
                            <th style="border: 2px solid {{$solicitud->semaforo==0 ? '#940a0a;' : (($solicitud->semaforo==1) ? '#b88400;' : (($solicitud->semaforo==2) ? '#048506;' : '#048506;'))}}
                                ;text-align: center; color:{{$solicitud->semaforo==0 ? '#940a0a;' : (($solicitud->semaforo==1) ? '#b88400;' : (($solicitud->semaforo==2) ? '#b85000;' : '#048506;'))}}; 
                                text-transform: uppercase; font-size: 14px; width: 120px">
                                {!! $solicitud->estatus() !!}
                            </th>
                            <td><h4><b>ASUNTO:</b> {!!  $solicitud->asunto !!}</h4></td>
                        </tr>
                        <tr>
                            <th style="text-align: center; background-color:#ddd">FECHA</th>
                            <td style=" text-transform: uppercase">{{ $dias[date('w', strtotime($solicitud->fecha_alta))] }} {{ date('j', strtotime($solicitud->fecha_alta)) }} de {{ $meses[date('n', strtotime($solicitud->fecha_alta))-1] }} de {{ date('Y', strtotime($solicitud->fecha_alta)) }}</td>
                        </tr>
                        <tr>
                            <th style="text-align: center; background-color:#ddd">DESCRIPCIÓN</th>
                            <td>{!! $solicitud->descripcion !!}</td>
                        </tr>
                        <tr>
                            <th style="text-align: center; background-color:#ddd">TIPO</th>
                            <td>{!! $solicitud->rubro()->nombre !!}</td>
                        </tr>
                        <tr>
                            <th style="text-align: center; background-color:#ddd">COLONIA</th>
                            <td>{!! $solicitud->colonia()->colonia !!}</td>
                        </tr>
                        <tr>
                            <th style="text-align: center; background-color:#ddd">UBICACIÓN</th>
                            <td>{!! $solicitud->ubicacion !!}</td>
                        </tr>
                        <tr>
                            <th style="text-align: center; background-color:#ddd">PROGRAMA</th>
                            <td>{!! $solicitud->programa()->nombre !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="padding-top: 0px; font-family: 'Times New Roman', Times, serif">
                @if($beneficiarios->isEmpty())
                <table class="table-hover table-bordered" style="width: 100%;" id="tablaBeneficiarios">
                    <tbody>
                        <tr>
                            <td><br>*Sin beneficiarios registrados</td>
                        </tr>
                    </tbody>
                </table>
                @else
                <table style="width: 100%; font-size: 12px; padding-top: 20px">
                    <thead>
                        <tr>
                            <th colspan="4" style="text-align: center; font-size: 14px">Listado de Beneficiarios<br><br></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th style=" width: 30px; border-bottom: 1px solid">#</th>
                            <th style="text-align: left; border-bottom: 1px solid">Nombre</th>
                            <th style="text-align: left; border-bottom: 1px solid">Domicilio</th>
                            <th style="text-align: left; border-bottom: 1px solid">Contacto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @foreach($beneficiarios as $beneficiario)
                        <tr>
                            <td style="text-align:center">{!! $i !!}</td>
                            <td>{!! $beneficiario->nombre !!}</td>
                            <td>{!! $beneficiario->domicilio !!}</td>
                            <td>{!! $beneficiario->contacto !!}</td>
                        </tr>
                        @php $i++ @endphp
                        @endforeach
                    </tbody>
                </table> 
                @endif
            </div>
        </main>
    </body>
</html>