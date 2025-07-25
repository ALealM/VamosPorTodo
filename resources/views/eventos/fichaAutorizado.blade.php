@extends('layouts.app', ['activePage' => 'showAutorizadoEvento', 'mainPage' => 'eventos'])
@section('title', 'Main page')
@section('content')

<div class="row pb-15">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
        <h4 style="text-align: center"> <b>FOLIO: {{$folio}}</b><br><br>{!! str_replace("\n", "<br>", $evento->titulo) !!}</h4>
        <table class="table-hover" style="width: 100%;" id="tablaBeneficiarios">
            <tbody>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">LUGAR Y FECHA</th>
                    <td colspan="7" style=" text-transform: uppercase">{{ $evento->lugar }}, {{ $dias[date('w', strtotime($evento->fecha))] }} {{ date('j', strtotime($evento->fecha)) }} de {{ $meses[date('n', strtotime($evento->fecha))-1] }} de {{ date('Y', strtotime($evento->fecha)) }}</td>
                </tr>
                <tr>
                    <th style="text-align: center">HORA INICIO</th>
                    <td>{{ $evento->hora_inicio }}</td>
                    <th style="text-align: center">HORA TÉRMINO</th>
                    <td>{{ $evento->hora_fin }}</td>
                    <td>
                        @if($evento->ubicacion)
                            <a class="btn btn-sm blue-btn" href="{{($evento->ubicacion!=null) ? 'https://google.com/maps/place/'.$evento->ubic.'/@'.$evento->ubicacion.',19z' : ''}}" {{($evento->ubicacion!=null) ? 'target="_blank"' : ''}} ><i class="fa fa-map-marker"></i></a>
                        @else
                            {{$evento->lugar}}
                        @endif
                    </td>
                    <th style="text-align: center">CÓDIGO DE VESTIMENTA</th>
                    <td>{{ $evento->vestimenta() }}</td>
                </tr>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">MONTAJE</th>
                    <td colspan="7">{!! str_replace("\n", "<br>", $evento->montaje) !!}</td>
                </tr>
                <tr>
                    <th style="text-align: center">INVITADOS ESPECIALES</th>
                    <td colspan="7">{!! str_replace("\n", "<br>", $evento->invitados_e) !!}</td>
                </tr>
                <tr style="background-color:#ddd">
                    <th style="text-align: center">INVITADOS</th>
                    <td colspan="7">{!! str_replace("\n", "<br>", $evento->invitados) !!}</td>
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
                @foreach($colaboradores as $colaborador)
                <tr>
                    <td>{{$colaborador->gabinete()->nombre}}</td>
                    <td>{{$colaborador->gabinete()->direccion}}</td>
                </tr>
                @endforeach
            </tbody>
            @endif
        </table>
    </div>
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
<div class="row">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
        <h4 style="text-align: center">REPORTE FINAL DEL EVENTO</h4>
        @if($evento->reporte!=null)
        <table class="table table-hover table-bordered" style="width: 100%; text-align: center" id="tablaBeneficiarios">
            <tbody>
                <tr>
                    <td>
                        {{$evento->reporte}}
                    </td>
                </tr>
            </tbody>
        </table>
        @else
        <center style="text-decoration: underline">SIN REPORTE FINAL</center>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
        <h4 style="text-align: center">EVIDENCIA</h4>
        @if(!$documentos->isEmpty() && !$imagenes->isEmpty())
        <table class="table table-hover table-bordered" style="width: 100%; text-align: center" id="tablaBeneficiarios">
            <tbody>
                <tr>
                    <th style="background-color:#ddd; border-bottom: 1px solid #fff">Fotografías</th>
                    <td>
                        @if(!$imagenes->isEmpty())
                        <div class="row">
                        @foreach($imagenes as $imagen)
                        <div class="col-md-3">
                            <a href="{{asset('anexos')}}/{{$imagen->anexo}}" target="_blank" class="btn btn-sm btn-secondary">
                                <img src="{{asset('anexos')}}/{{$imagen->anexo}}" style="width:100%;">
                            </a>
                        </div>
                        @endforeach
                        @else
                        SIN FOTOGRAFÍAS
                        @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <th style="background-color:#ddd; border-bottom: 1px solid #fff">Documentos</th>
                    <td>
                        @if(!$documentos->isEmpty())
                        <div class="row">
                        @foreach($documentos as $documento)
                            <div class="col-md-3">
                                <a href="{{asset('anexos')}}/{{$documento->anexo}}" target="_blank" class="btn btn-sm">ANEXO {{$loop->index+1}}</a>
                            </div>
                        @endforeach   
                        @else
                        SIN DOCUMENTOS
                        @endif
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        @else
        <center style="text-decoration: underline">SIN DOCUMENTACIÓN ADJUNTA</center>
        @endif
    </div>
</div>
@if(!$colaboradores->isEmpty())
<div class="row">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 15px">
        <hr>
        <h4 style="text-align: center">REPORTE DE ÁREAS COLABORADORAS</h4>
        <div id="accordion">
            @foreach($colaboradores as $colaborador)
            <div class="card" style="margin-top: 15px;margin-bottom: 15px;">
                <div class="card-header" id="heading{{$colaborador->id}}" style="padding-bottom: 0px; padding-top: 0px;">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$colaborador->id}}" aria-expanded="false" aria-controls="collapse{{$colaborador->id}}" style="padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 0px; padding: 0px;">
                            <h4 style="margin-bottom: 0px;">{{$colaborador->gabinete()->direccion}}</h4>
                        </button>
                    </h5>
                </div>
                <div id="collapse{{$colaborador->id}}" class="collapse" aria-labelledby="heading{{$colaborador->id}}" data-parent="#accordion">
                    <div class="card-body" style="padding-top: 0px;">
                        <div class="row">
                            <div class="col-md-12" style="padding-top: 15px">
                                <h4 style="text-align: center">REPORTE DEL EVENTO</h4>
                                @if($colaborador->reporte!=null)
                                <table class="table table-hover table-bordered" style="width: 100%; text-align: center" id="tablaBeneficiarios">
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{$colaborador->reporte}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @else
                                <center style="text-decoration: underline">SIN REPORTE</center>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="padding-top: 15px">
                                <h4 style="text-align: center">EVIDENCIA</h4>
                                @if(!$colaborador->imagenes()->isEmpty() && !$colaborador->documentos()->isEmpty())
                                <table class="table table-hover table-bordered" style="width: 100%; text-align: center" id="tablaBeneficiarios">
                                    <tbody>
                                        <tr>
                                            <th style="background-color:#ddd; border-bottom: 1px solid #fff">Fotografías</th>
                                            <td>
                                                @if(!$colaborador->imagenes()->isEmpty())
                                                <div class="row">
                                                    @foreach($colaborador->imagenes() as $imagen)
                                                    <div class="col-md-3">
                                                        <a href="{{asset('anexos')}}/{{$imagen->anexo}}" target="_blank" class="btn btn-sm btn-secondary">
                                                            <img src="{{asset('anexos')}}/{{$imagen->anexo}}" style="width:100%;">
                                                        </a>
                                                    </div>
                                                    @endforeach
                                                    @else
                                                    SIN FOTOGRAFÍAS
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#ddd; border-bottom: 1px solid #fff">Documentos</th>
                                            <td>
                                                @if(!$colaborador->documentos()->isEmpty())
                                                <div class="row">
                                                    @foreach($colaborador->documentos() as $documento)
                                                    <div class="col-md-3">
                                                        <a href="{{asset('anexos')}}/{{$documento->anexo}}" target="_blank" class="btn btn-sm">ANEXO {{$loop->index+1}}</a>
                                                    </div>
                                                    @endforeach   
                                                    @else
                                                    SIN DOCUMENTOS
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @else
                                <center style="text-decoration: underline">SIN DOCUMENTACIÓN ADJUNTA</center>
                                @endif
                            </div>
                        </div>                                           
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <br>
        <a class="btn btn-secondary" href="{{url('/eventos/listadoAutorizado')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
    </div>
</div>
@endsection
