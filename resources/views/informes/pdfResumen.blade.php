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
                <div style="text-align: center; padding: 5px; margin: 0px"><p style="font-size: 16px; padding: 0px; margin: 0px">RESUMEN DE INFORMES DIARIOS</p></div>
                <div style="text-align: center; padding: 5px; margin: 0px"><p style="font-size: 16px; padding: 0px; margin: 0px"><b>FECHA:</b> Del {{ $rango }}</p></div>
                <div style=" width: 100%;">
                <div>
                    <div style="text-align: center; padding: 5px; margin: 0px"><p style="font-size: 15px; padding: 0px; margin: 0px"><b>Direcciones que informaron ({{$areasSi->count()}})</b></p></div>
                    <div style="font-size: 13px">
                        <ul>
                        @foreach($areasSi as $si)
                        <li>{{$si->direccion}}</li>
                        @endforeach    
                        </ul>
                    </div>
                    <div style="text-align: center; padding: 5px; margin: 0px"><p style="font-size: 15px; padding: 0px; margin: 0px"><b>Direcciones que No informaron ({{$areasNo->count()}})</b></p></div>
                    <div style="font-size: 13px">
                        <ul>
                        @foreach($areasNo as $no)
                        <li>{{$no->direccion}}</li>
                        @endforeach    
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </main>
    </body>
</html>