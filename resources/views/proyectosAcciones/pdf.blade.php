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
            <img src="{{asset('img/encabezadoInfH.png')}}" width="100%" height="100%"/>
        </header>

        <footer>
            <img src="{{asset('img/footerInfH.png')}}" width="100%" height="100%"/>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <div style="padding-top: 0px; font-family: 'Times New Roman', Times, serif">
                <div style="text-align: center; padding: 5px; margin: 0px"><p style="font-size: 16px; padding: 0px; margin: 0px">{{$proy->nombre}}</p></div>
                <div style="text-align: right; padding: 5px; margin: 0px"><p style="font-size: 16px; padding: 0px; margin: 0px"></p></div>
                <div style=" width: 100%;">
                    <table style="width: 100%; border: 1px solid">
                        <tbody>
                            <tr style="background-color:#ddd">
                                <th style="text-align: center" colspan="6">Datos Generales del Proyecto</th>
                            </tr>
                            <tr>
                                <th style="text-align: center">Dirección</th>
                                <td colspan="5">{!! $proy->usuario()->gabinete()->direccion !!}</td>
                            </tr>
                            <tr>
                                <th style="text-align: center">Macroproyecto</th>
                                <td colspan="5">{!! $proy->macroproyecto !!}</td>
                            </tr>
                            <tr>
                                <th style="text-align: center">Financiamiento</th>
                                <td>{!! $proy->fuente()->fuente !!}</td>                    
                                <th style="text-align: center">Beneficiarios</th>
                                <td>{{ number_format($proy->beneficiarios) }}</td>
                                <th style="text-align: center">Inversión</th>
                                <td>$ {{ number_format($proy->inversion(),2,".",",") }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width: 100%; border: 1px solid">
                        <tbody>
                            <tr style="background-color:#ddd">
                                <th style="text-align: center" colspan="2">Clasificación por Objeto del Gasto</th>
                            </tr>
                            <tr>
                                <th style="text-align: center">Capítulo del Gasto</th>
                                <td>{{ $proy->concepto()->rubro()->capitulo()->capDesc() }}</td>                  
                            </tr>
                            <tr>
                                <th style="text-align: center">Rubro del Gasto</th>
                                <td>{{ $proy->concepto()->rubro()->rubro }}</td>                  
                            </tr>
                            <tr>
                                <th style="text-align: center">Concepto del Gasto</th>
                                <td>{{ $proy->concepto()->concepto }}</td>                  
                            </tr>
                        </tbody>
                    </table>
                    <table style="width: 100%; border: 1px solid">
                        <tbody>
                            <tr style="background-color:#ddd">
                                <th style="text-align: center" colspan="8">Estructura Financiera</th>
                            </tr>
                            <tr>
                                @foreach($estructura as $est)
                                @if($loop->index ==0)
                                <th style="text-align: center">Federal</th>
                                @endif
                                @if($loop->index ==1)
                                <th style="text-align: center">Estatal</th>
                                @endif
                                @if($loop->index ==2)
                                <th style="text-align: center">Municipal</th>
                                @endif
                                @if($loop->index ==3)
                                <th style="text-align: center">Otros</th>
                                @endif
                                <td>$ {{ number_format($est->monto,2,".",",") }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                    <table style="width: 100%; border: 1px solid">
                        <tbody>
                            <tr style="background-color:#ddd">
                                <th style="text-align: center" colspan="8">Calendario de Ejecución Financiera del Recurso Municipal</th>
                            </tr>
                            <tr>
                                @php $i=1; @endphp
                                @foreach($meses as $mes)                                
                                <th style="text-align: center">{{$mes->mes()->mes}}</th>
                                <td style="text-align: right">$ {{ number_format($mes->monto,2,".",",") }}</td>
                                @if($i%4==0)</tr><tr>@endif
                                @php $i++; @endphp
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                    <table style="width: 100%; border: 1px solid">
                        <tbody>
                            <tr style="background-color:#ddd">
                                <th style="text-align: center" colspan="8">Alineación Estratégica</th>
                            </tr>
                            <tr>
                                <th style="text-align: center">Eje Rector</th>
                                <td style="text-align: center">{{ $proy->ejeRector()->eje }}</td>
                                <th style="text-align: center">Objetivo de Desarrollo Sostenible</th>
                                <td style="text-align: center">{{ $proy->objetivo()->descripcion }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </body>
</html>