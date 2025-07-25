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
            <div style="padding-top: 0px; font-family: 'Times New Roman', Times, serif; font-size: 12px">
                <div style="text-align: center; font-size: 14px"><b>{{$area->direccion}}</b><hr></div>
                @foreach($acciones as $accion)
                <table class="table-hover table-bordered" style="width: 100%; padding-top: 0px; margin-top: 0px">
                    <tbody>
                        <tr>
                            <th style="text-align: center; background-color:#ddd; width: 80px">Programa</th>
                            <td>{!! $accion->programa !!}</td>
                        </tr>
                        <tr>
                            <th style="text-align: center; background-color:#ddd">Objetivo</th>
                            <td>{!! $accion->objetivo !!}</td>
                        </tr>
                        <tr>
                            <th style="text-align: center; background-color:#ddd">Indicador</th>
                            <td>{!! ($accion->indicador) ? $accion->indicador : 'Sin indicador definido' !!}</td>
                        </tr>
                        <tr>
                            <th style="text-align: center; background-color:#ddd">Meta</th>
                            <td>{!! $accion->meta !!}</td>
                        </tr>
                        <tr>
                            <th style="text-align: center; background-color:#ddd">Avance</th>
                            <td>{!! $accion->avance !!}</td>
                        </tr>
                    </tbody>
                </table><br>
                @endforeach
            </div>
        </main>
    </body>
</html>
