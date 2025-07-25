@extends('layouts.app', ['activePage' => 'showPOA'])
@section('title', 'Main page')
@section('content')

<div class="row pb-15">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
        <h3 style="text-align: center"> <b>{{$proy->nombre}}</b></h3>
        <table class="table-hover table-bordered" style="width: 100%; margin-bottom: 30px">
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
        <table class="table-hover table-bordered" style="width: 100%; margin-bottom: 30px">
            <tbody>
                <tr style="background-color:#ddd">
                    <th style="text-align: center" colspan="2">Clasificación por Objeto del Gasto</th>
                </tr>
                <tr>
                    <th style="text-align: center">Capítulo del Gasto</th>
                    <td colspan="5">{{ $proy->concepto()->rubro()->capitulo()->capDesc() }}</td>                  
                </tr>
                <tr>
                    <th style="text-align: center">Rubro del Gasto</th>
                    <td colspan="5">{{ $proy->concepto()->rubro()->rubro }}</td>                  
                </tr>
                <tr>
                    <th style="text-align: center">Concepto del Gasto</th>
                    <td colspan="5">{{ $proy->concepto()->concepto }}</td>                  
                </tr>
            </tbody>
        </table>
        <table class="table-hover table-bordered" style="width: 100%; margin-bottom: 30px">
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
        <table class="table-hover table-bordered" style="width: 100%; margin-bottom: 30px">
            <tbody>
                <tr style="background-color:#ddd">
                    <th style="text-align: center" colspan="8">Calendario de Ejecución Financiera del Recurso Municipal</th>
                </tr>
                <tr>
                    @foreach($meses as $mes)
                    @if($loop->index%4==0)</tr><tr>@endif
                    <th style="text-align: center">{{$mes->mes()->mes}}</th>
                    <td style="text-align: right">$ {{ number_format($mes->monto,2,".",",") }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        <table class="table-hover table-bordered" style="width: 100%;">
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
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <br>
        <a class="btn btn-secondary" href="{{url('/panel')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
    </div>
</div>
@endsection
