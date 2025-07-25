@extends('layouts.app', ['activePage' => 'showInforme', 'mainPage' => 'informe'])
@section('title', 'Main page')
@section('content')

{!! Form::model( @$informe, ['route' =>[ 'storeAccion' ],'method' => ( 'POST'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
<style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800);

    .blue-btn:hover,
    .blue-btn:active,
    .blue-btn:focus,
    .blue-btn {
        background: transparent;
        border: solid 1px #27a9e0;
        border-radius: 3px;
        color: #27a9e0;
        font-size: 16px;
        margin-bottom: 20px;
        outline: none !important;
        padding: 10px 20px;
    }

    .fileUpload {
        position: relative;
        overflow: hidden;
        height: 43px;
        margin-top: 0;
    }

    .fileUpload input.uploadlogo {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
        width: 100%;
        height: 42px;
    }

    /*Chrome fix*/
    input::-webkit-file-upload-button {
        cursor: pointer !important;
        height: 42px;
        width: 100%;
    }
</style>

<div class="row pb-15">
    <div class="col-md-12 text-center">
        <h4>INFORME</h4>
    </div>
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
        {!! $informe->informe!!}
            <hr>
    </div>
</div>
@if(\Auth::User()->id == 19 || \Auth::User()->id == 73)
<div class="row pb-15 col-md-10 mr-auto ml-auto">
    <div class="col-md-4">
        <div class="col-md-12 mr-auto ml-auto">
            <table class="dataTable table-bordered table-condensed table-hover" style="width: 100%; font-size: 13px">
                <tbody>
                    <tr>
                        <th colspan="2" style="text-align: center">NOVEDADES DE FUERZAS MUNICIPALES</th>
                    </tr>
                    <tr style="text-align: center">
                        <th>EVENTOS</th>
                        <th style=" width: 70px">CANTIDAD</th>
                    </tr>
                    @foreach($ev_fm as $fm)
                    <tr>
                        <td>{{ $fm->evento()->evento }}</td>
                        <td style="text-align: center">{{ $fm->cantidad }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="col-md-12 mr-auto ml-auto">
            <table class="dataTable table-bordered table-condensed table-hover" style="width: 100%; font-size: 13px">
                <tbody>
                    <tr>
                        <th colspan="2" style="text-align: center">NOVEDADES DE POLICÍA VIAL</th>
                    </tr>
                    <tr style="text-align: center">
                        <th>EVENTOS</th>
                        <th style=" width: 70px">CANTIDAD</th>
                    </tr>
                    @foreach($ev_pv as $pv)
                    <tr>
                        <td>{{ $pv->evento()->evento }}</td>
                        <td style="text-align: center">{{ $pv->cantidad }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="col-md-12 mr-auto ml-auto">
            <table class="dataTable table-bordered table-condensed table-hover" style="width: 100%; font-size: 13px">
                <tbody>
                    <tr>
                        <th colspan="2" style="text-align: center">CANALIZACIONES DEL 911</th>
                    </tr>
                    <tr style="text-align: center">
                        <th>EVENTOS</th>
                        <th style=" width: 70px">CANTIDAD</th>
                    </tr>
                    @foreach($ev_911 as $e911)
                    <tr>
                        <td>{{ $e911->evento()->evento }}</td>
                        <td style="text-align: center">{{ $e911->cantidad }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-12 text-center"><hr>
        <h4>EVENTOS DE IMPACTO</h4>
    </div>
    <div class="col-md-8 mr-auto ml-auto">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%" id="tablaEventosImpacto">
            <tbody>
                <tr>
                    <th style=" width: 50px; text-align: center">#</th>
                    <th>Evento</th>
                </tr>
                @php $i=1 @endphp
                @foreach($eventosI as $ei)
                <tr>
                    <td style="text-align: center">{{ $i }}</td>
                    <td>{{ $ei->cantidad }} {{ $ei->evento }}</td>
                </tr>
                @php $i++ @endphp
                @endforeach
            </tbody>
        </table>
        <hr>
    </div>
</div>
<div class="row pb-15">
    <div class="col-md-10 mr-auto ml-auto" style="padding-top: 10px">
        <div class="col-md-12" style=" padding-bottom: 15px">
            <table class="dataTable table-bordered table-condensed table-hover" style="width: 100%; font-size: 12px;">
                <tbody>
                    <tr>
                        <th colspan="13" style="text-align: center">ESTADO DE FUERZA DE LA D.G.S.P.M.</th>
                    </tr>
                    <tr style="text-align: center">
                        <th colspan="6">POLICÍA VIAL</th>
                        <th colspan="7">FUERZAS MUNICIPALES</th>
                    </tr>
                    <tr style="text-align: center">
                        <th>Personal Saliente</th>
                        <th>Centro</th>
                        <th>Norte</th>
                        <th>Poniente</th>
                        <th>Sur</th>
                        <th>Oriente</th>
                        <th>Personal Entrante</th>
                        <th>Centro</th>
                        <th>Norte</th>
                        <th>Violencia Familiar</th>
                        <th>Poniente</th>
                        <th>Sur</th>
                        <th>Oriente</th>
                    </tr>
                    <tr style="text-align: center">
                        <td>Presente</td>
                        <td>{{ $ef1->pc }}</td>
                        <td>{{ $ef1->pn }}</td>
                        <td>{{ $ef1->pp }}</td>
                        <td>{{ $ef1->ps }}</td>
                        <td>{{ $ef1->po }}</td>
                        <td>Presente</td>
                        <td>{{ $ef3->pc }}</td>
                        <td>{{ $ef3->pn }}</td>
                        <td>{{ $ef3->pv }}</td>
                        <td>{{ $ef3->pp }}</td>
                        <td>{{ $ef3->ps }}</td>
                        <td>{{ $ef3->po }}</td>
                    </tr>
                    <tr style="text-align: center">
                        <td>Descansando</td>
                        <td>{{ $ef1->dc }}</td>
                        <td>{{ $ef1->dn }}</td>
                        <td>{{ $ef1->dp }}</td>
                        <td>{{ $ef1->ds }}</td>
                        <td>{{ $ef1->do }}</td>
                        <td>Descansando</td>
                        <td>{{ $ef3->dc }}</td>
                        <td>{{ $ef3->dn }}</td>
                        <td>{{ $ef3->dv }}</td>
                        <td>{{ $ef3->dp }}</td>
                        <td>{{ $ef3->ds }}</td>
                        <td>{{ $ef3->do }}</td>
                    </tr>
                    <tr style="text-align: center">
                        <td>Faltando</td>
                        <td>{{ $ef1->fc }}</td>
                        <td>{{ $ef1->fn }}</td>
                        <td>{{ $ef1->fp }}</td>
                        <td>{{ $ef1->fs }}</td>
                        <td>{{ $ef1->fo }}</td>
                        <td>Faltando</td>
                        <td>{{ $ef3->fc }}</td>
                        <td>{{ $ef3->fn }}</td>
                        <td>{{ $ef3->fv }}</td>
                        <td>{{ $ef3->fp }}</td>
                        <td>{{ $ef3->fs }}</td>
                        <td>{{ $ef3->fo }}</td>
                    </tr>
                    <tr style="text-align: center">
                        <th>Personal Entrante</th>
                        <th>Centro</th>
                        <th>Norte</th>
                        <th>Poniente</th>
                        <th>Sur</th>
                        <th>Oriente</th>
                        <th colspan="7">DELEGACIONES</th>
                    </tr>
                    <tr style="text-align: center">
                        <td>Presente</td>
                        <td>{{ $ef2->pc }}</td>
                        <td>{{ $ef2->pn }}</td>
                        <td>{{ $ef2->pp }}</td>
                        <td>{{ $ef2->ps }}</td>
                        <td>{{ $ef2->po }}</td>
                        <td>Personal</td>
                        <th colspan="2">Bocas</th>
                        <th colspan="2">Pozos</th>
                        <th colspan="2">La Pila</th>
                    </tr>
                    <tr style="text-align: center">
                        <td>Descansando</td>
                        <td>{{ $ef2->dc }}</td>
                        <td>{{ $ef2->dn }}</td>
                        <td>{{ $ef2->dp }}</td>
                        <td>{{ $ef2->ds }}</td>
                        <td>{{ $ef2->do }}</td>
                        <td>Fuerzas</td>
                        <td colspan="2">{{ $del->fb }}</td>
                        <td colspan="2">{{ $del->fpz }}</td>
                        <td colspan="2">{{ $del->flp }}</td>
                    </tr>
                    <tr style="text-align: center">
                        <td>Faltando</td>
                        <td>{{ $ef2->fc }}</td>
                        <td>{{ $ef2->fn }}</td>
                        <td>{{ $ef2->fp }}</td>
                        <td>{{ $ef2->fs }}</td>
                        <td>{{ $ef2->fo }}</td>
                        <td>Vial</td>
                        <td colspan="2">{{ $del->vb }}</td>
                        <td colspan="2">{{ $del->vpz }}</td>
                        <td colspan="2">{{ $del->vlp }}</td>
                    </tr>
                    <tr>
                        <th colspan="5" style="text-align: center">BARANDILLA</th>
                    </tr>
                    <tr style="text-align: center">
                        <th>Personal Saliente</th>
                        <th colspan="2">Juez Cal.</th>
                        <th colspan="2">Oficiales</th>
                    </tr>
                    <tr style="text-align: center">
                        <td>Presente</td>
                        <td colspan="2">{{ $bar->pjc }}</td>
                        <td colspan="2">{{ $bar->pof }}</td>
                    </tr>
                    <tr style="text-align: center">
                        <td>Descanzando</td>
                        <td colspan="2">{{ $bar->djc }}</td>
                        <td colspan="2">{{ $bar->dof }}</td>
                    </tr>
                    <tr style="text-align: center">
                        <td>Faltando</td>
                        <td colspan="2">{{ $bar->fjc }}</td>
                        <td colspan="2">{{ $bar->fof }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
<div class="row pb-15">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
        <h4 style="text-align: center">IMÁGENES</h4><hr>
        <div class="row">
            @foreach($imagenes as $imagen)
            <div class="col-md-3">
                <a href="{{asset('informes')}}/{{$imagen->anexo}}" target="_blank" class="btn btn-sm btn-secondary">
                    <img src="{{asset('informes')}}/{{$imagen->anexo}}" style="width:100%;">
                </a>
            </div>
            @endforeach   
        </div>
    </div>
</div>
<div class="row pb-15">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
        <h4 style="text-align: center">ANEXOS</h4><hr>
        <div class="row">
            @foreach($documentos as $documento)
            <div class="col-md-2">
                <a href="{{asset('informes')}}/{{$documento->anexo}}" target="_blank" class="btn btn-sm">ANEXO {{$loop->index+1}}</a>
            </div>
            @endforeach   
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <br>
        <a class="btn btn-secondary" href="{{url('/informe/listado')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
    </div>
</div> 
@endsection