@extends('layouts.app')
@section('title', 'Main page')
@section('content')
<style>
#encabezado {
    border-collapse: separate;
    border-spacing: 0;
}
#encabezado, .tdEnc {
    border: 1px solid #eee;
    border-radius: 3px;
    -moz-border-radius: 3px;
    padding: 3px;
}

</style>
{!! Form::open(['route' =>[ 'storeAvancesAc' ],'method' => ( 'POST'),'id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
{{Form::hidden('id',$accion->id)}}
<!-- <div class="row"> -->
  <div class="col-md-12" style="padding-top: 10px">
    <h3 style="text-align: center; margin-top: 0px"><b>Programa: {{$accion->programa}}</b></h3>
  </div>
  <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
    <table style="width: 100%" id="encabezado">
      <tbody>
        <tr>
          <th style="background-color:#ddd;text-align: center; border-bottom: solid 1px #eee">Objetivo</th>
          <td class="tdEnc">{{ $accion->objetivo }}</td>
        </tr>
        <tr>
          <th style="background-color:#ddd;text-align: center">Indicador</th>
          <td class="tdEnc">{{ ($accion->indicador) ? $accion->indicador : 'Sin indicador definido' }}</td>
        </tr>
        <tr>
          <th style="background-color:#ddd;text-align: center">Meta</th>
          <td class="tdEnc">
            @if($accion->id_unidad == 6) $ {{ number_format($accion->meta,2,".",",") }}
            @elseif($accion->id_unidad == 14) {{ $accion->meta }}%
            @else
            {{ number_format($accion->meta) }} {{ $accion->unidad()->unidad }}
            @endif
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-12 mr-auto ml-auto table-responsive" style="padding-top: 10px">
    <table  id="encabezado" class="center" style="width: 100%">
      <tbody>
        <tr>
          @foreach($avances as $avance)
          <th style="background-color:#ddd;text-align: center; border-bottom: solid 1px #eee; width: 8% !important">{{$avance->mes()->mes}}</th>
          <td>
            {{ Form::text('avance[]',$avance->avance,['class'=>'','required','style'=>'width:50px']) }}
            {{ Form::hidden('avId[]',$avance->id) }}
          </td>
          @if($loop->index == 5)
        </tr><tr>
          @endif
          @endforeach
        </tr>
      </tbody>
    </table>
  </div>
<!-- </div> -->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <br>
        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
        <a class="btn btn-secondary" href="{{url('/lineasAccion')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
    </div>
</div>
@endsection
