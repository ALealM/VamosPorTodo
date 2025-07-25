@extends('layouts.app')
@section('title', 'Main page')
@section('content')


@if($ficha!=null)
<div class="row pb-15">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
        <h4 style="text-align: center"> <b>Acuerdo: {{$acuerdo->acuerdo}}</b><br><br>{!! str_replace("\n", "<br>", $acuerdo->usuario()->nombre) !!}</h4>
        @foreach($ficha as $fic)
        <table class="table-hover table-bordered" style="width: 100%; margin-bottom: 30px;" id="tablaBeneficiarios">
            <tbody>
                <tr style="background-color:#ddd;">
                    <th style="text-align: center;">ACTIVIDAD</th>
                    <td colspan="3">{{ $fic->actividad }}</td>
                </tr>
                <tr>
                    <th style="text-align: center;">RESPONSABLE</th>
                    <td>{{ $fic->dependencia()->direccion }}</td>
                    <th style="text-align: center">FECHA</th>
                    <td>{{ $fic->fecha }}</td>
                </tr>
                <tr>
                    <th style="text-align: center;" colspan="4">ÁREAS COLABORADORAS</th>
                </tr>
                @foreach($fic->areascolaboradoras() as $col)
                <tr>
                    <td style="text-align: center;" colspan="4" >{{ $col->direccion }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
</div>
@else
<div class="row col-md-12">
    <div class="col-md-12 text-center">
        SIN ACUERDOS PARA MOSTRAR
    </div>

</div>
@endif










<br><br>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <br>
        <a class="btn btn-secondary" href="{{url('/peticion/index')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
    </div>
</div>




@endsection