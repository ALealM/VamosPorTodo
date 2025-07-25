<style>
    #header,
    #footer {
        position: fixed;
        left: 0;
        right: 0;
        font-size: 0.9em;
    }

    #header {
        top: 0;
        border-bottom: 0.1pt solid transparent;
        margin-top: -10px;
        margin-bottom: -4em;
        z-index: 100;
        background-color: #01457c;
        max-width: 25%;
        padding-right: 2em;
        color: #fff;
        font-weight: bold;
    }

    #footer {
        bottom: 0;
        background: #e3e3e3;
        text-align: center;
        padding-top: 0;
        margin-top: 0;
    }

    @page {
        margin: 0px !important;
        padding: 0px 0px 0px 0px !important;
        background-color: #d9cfb7;
    }

    .card {
        box-shadow: 0 1px 4px 0 rgb(0 0 0 / 14%);
        width: 100%;
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }

    body{
        background-color: #d9cfb7;
        padding-top: 2em;
        margin-right: 0;
        height: 100%;
    }

    .single-line {
        width: 190%;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        font-weight: bold;
        margin-block-start: 0; margin-block-end: 0;
        margin-top: 0; margin-bottom: 0;
    }

    .text {
    display: flex;
    margin: 0 0 1em 0.5em; /* top, right, bottom, left */
    word-break:break-all;
    font-weight: bolder;
    padding-bottom: 1em;
    font-size: 14px;
}
</style>

<div id="header">
    <h1 style="text-transform: uppercase; text-align: right;">{!! $ecologia->titulo !!}</h1>
</div>

<div id="footer">
    <img src="{{asset('logos')}}/ayuntamiento_slp.png" style="width: auto; height: auto;"/>
</div>

<div style="font-size: 16px;">
    <table style="width: 100%; margin-bottom: -10%;">
        <tr>
            <td style="width: 45%; max-width: 35%; background: #fff; padding-left: 1em; margin-top: 2%;">
                <table style="width: 100%;">
                        <tr>
                            <td></td>
                            <td>
                                <img src="{{asset('ecologia')}}/{{$ecologia->main_image}}" style="max-width:90%; width:auto; height:auto; margin-top: -50%; float: right; padding-top: 0;"/>
                            </td>
                        </tr>
                    @foreach($ecologia->actividades as $value)
                        <tr>
                            <td>
                                <b style="color: #adaeb0; font-size: 2.0rem; font-weight: bold;">&raquo;</b>
                            </td>
                            <td style="padding-left: 0.5em;">
                                <b style="color: #0d314e; font-weight: bold; font-size: 1.4rem;">{!! $value['actividad'] !!}</b>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </td>

            <td style="width: 60%; background: #00467d; padding-left: 3.666667%; margin-right: 0; padding-top: 1.5em;">
                <table style="width: 100%; padding-left: 1em; padding-right: 0;">
                    <tr>
                        <td style="max-width: 50%; width: 50%; padding-right: 1em;">
                            <div class="card" style="background: #2892e5; margin-bottom: -1em; border-radius: 0; height:17%; padding-right: 1em; padding-top: 3px;">
                                <div class="card" style="border: solid #fff thin; background: transparent; border-radius: 0; height: 100%; margin-left: -5%; margin-top: -5%; margin-bottom: 3px; padding-left: 1em;">
                                    <div class="text" style="color: #003b67;">{!! $ecologia->card1 !!}</div>
                                </div>
                            </div>
                        </td>
                        <td style="max-width: 50%; width: 50%; padding-left: 1em;">
                            <div class="card" style="background: #8fc4ef; margin-bottom: -1em; border-radius: 0; height:17%; padding-right: 1em; padding-top: 3px;">
                                <div class="card" style="border: solid #fff thin; background: transparent; border-radius: 0; height: 100%; margin-left: -5%; margin-top: -5%; margin-bottom: 3px; padding-left: 1em;">
                                    <div class="text" style="color: #003b67;">{!! $ecologia->card2 !!}</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <br>
                <!-- Imagen Horizontal (right) -->
                <div class="row">
                    <div style="width: 90%; text-align: right; margin-right: 0;">
                        <img src="{{asset('ecologia')}}/{{$ecologia->horizontal_image}}" style="max-width:80%; width: auto; height: auto; padding-top: 30px; text-align: right;"/>
                    </div>
                </div>
                @if( @$ecologia->title_cards === false ) <br> @endif
                <table style="width: 100%; padding-left: 1em;">
                    @if( @$ecologia->title_cards )
                        <caption style="text-align: left;"> <h3 style="text-transform: uppercase;"> {!! $ecologia->title_cards !!} </h3> </caption>
                    @endif
                    <tr style="border-bottom: 0 transparent; padding-bottom: 0.5em; max-height: 40%; margin-bottom: 5px;">
                        <td style="max-width: 60%; width: 50%;">
                            <div class="card" style="background: #2892e5; margin-bottom: -1em; border-radius: 0; height:17%; padding-right: 1em; padding-top: 3px;">
                                <div class="card" style="border: solid #fff thin; background: transparent; border-radius: 0; height: 100%; margin-left: -5%; margin-top: -5%; margin-bottom: 3px; padding-left: 1em;">
                                    <div class="text" style="color: #003b67;">{!! $ecologia->card3 !!}</div>
                                </div>
                            </div>
                        </td>
                        <td rowspan="2" style="text-align: right; padding-left: 1em; margin-top: 0; padding-right: 0;">
                            <img src="{{asset('ecologia')}}/{{$ecologia->vertical_image}}" style="max-width:100%; width:auto; height:auto; float: right; padding-right: 0; margin-right: -1.65em;"/>
                        </td>
                    </tr>
                    <tr style="border-top: 0 transparent; padding-top: 0.5em; padding-bottom: 1em; max-height: 40%; margin-bottom: 5px;">
                        <td><br><br>
                            <div class="card" style="background: #8fc4ef; margin-bottom: -1em; border-radius: 0; height:17%; padding-right: 1em; padding-top: 3px;">
                                <div class="card" style="border: solid #fff thin; background: transparent; border-radius: 0; height: 100%; margin-left: -5%; margin-top: -5%; margin-bottom: 3px; padding-left: 1em;">
                                    <div class="text" style="color: #003b67;">{!! $ecologia->card4 !!}</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>

            <td style="writing-mode: vertical-rl; transform: rotate(270deg); padding: 0; max-width: 10em; padding-top: 0.5em;">
                <table>
                    <tr style="margin: 0;">
                        <h1 class="single-line" style="color: #8c816f; font-family: system-ui; margin-left: -8em;"> INFORME SEMANAL</h1>
                    </tr>
                    <tr>
                        <h2 class="single-line" style="color: #8b806e; margin-left: -10.6em;">
                            Del {{ date('d', strtotime($ecologia->fecha_init) ) }} de {{ $meses[ date('n', strtotime(date('n', strtotime($ecologia->fecha_init) ) )*1)-3 ] }} </b> al <b> {{ date('d', strtotime($ecologia->fecha_end) ) }} de {{ $meses[ date('n', strtotime(date('m', strtotime($ecologia->fecha_end) )*1))-3 ] }}
                        </h2>
                    </tr>
                    <tr>
                        <h3 class="single-line" style="color: #c1b299; margin-left: -13.5em;"> DIRECCIÓN DE GESTIÓN ECOLÓGICA Y MANEJO DE RESIDUOS </h3>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>