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
<div id="watermark3">
    <img src="{{asset('img/acciones.png')}}" height="100%" width="100%" style=" opacity: 0.3"/>
</div>
<div style="font-size: 13px;">
	<table  style="width: 100%;border-collapse: collapse;">
        <thead>
            <tr>
                <th style="text-align: center; height: 30px; vertical-align: middle; font-size: 15px" colspan="2">
                    {{date('d/m/Y')}}
                </th>
                <th style="text-align: center; height: 30px; vertical-align: middle; font-size: 15px" colspan="2">
                    CARGOS MUNICIPALES SLP
                </th>
                <th style="text-align: center; height: 30px; vertical-align: middle; font-size: 15px; color: #aaa" colspan="2">
                    <img src="{{asset('img/acciones.png')}}" width="120px"/>
                </th>
            </tr>
            <tr>
                <th style="border: 1px solid black;">#</th>
                <th style="border: 1px solid black;">Dirección General</th>
                <th style="border: 1px solid black;">Cargo</th>
                <th style="border: 1px solid black;">Nombre</th>
                <th style="border: 1px solid black;">Género</th>
                <th style="border: 1px solid black;">Teléfono</th>
            </tr>
        </thead>
        <tbody style="font-size: 11px;">
            @foreach($cargos as $cargo)
            <tr>
                <td style="text-align: center;padding-top: 2px;padding-bottom: 0px; vertical-align: middle">{{$cargo->id}}</td>
                <td style="text-align: center;padding-top: 2px;padding-bottom: 0px; vertical-align: middle">{!! $cargo->direccion_gral !!}</td>
                <td style="text-align: center;padding-top: 2px;padding-bottom: 0px; vertical-align: middle">{!! $cargo->cargo !!}</td>
                <td style="text-align: center;padding-top: 2px;padding-bottom: 0px; vertical-align: middle">{{ ($cargo->nombre==null) ? 'Sin nombre' : $cargo->nombre }}</td>
                <td style="text-align: center;padding-top: 2px;padding-bottom: 0px; vertical-align: middle">{{ ($cargo->genero==null) ? 'Sin especificar' : (($cargo->genero=='M') ? 'Mujer' : 'Hombre') }}</td>
                <td style="text-align: center;padding-top: 2px;padding-bottom: 0px; vertical-align: middle">{{ ($cargo->telefono==null) ? 'Sin teléfono' : $cargo->telefono }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>