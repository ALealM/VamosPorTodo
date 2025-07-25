@extends('layouts.app')
@section('title', 'Main page')
@section('content')

<div class="row pb-15">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
        <h4 style="text-align: center"> <b>Acuerdo: {{$acuerdoAct->acuerdos()->acuerdo}}</b></h4>
        <h4 style="text-align: center"> <b>Temas:<br> {{ $acuerdoAct->acuerdos()->temas==null ? 'Sin temas específicos' : $acuerdoAct->acuerdos()->temas}}</b></h4>
        <table class="table-hover table-bordered" style="width: 100%; margin-bottom: 30px;" id="tablaBeneficiarios">
            <tbody>
                <tr style="background-color:#ddd;">
                    <th style="text-align: center;">ACTIVIDAD</th>
                    <td colspan="4">{{ $acuerdoAct->actividad }}</td>
                </tr>
                <tr>
                    <th style="text-align: center;">RESPONSABLE</th>
                    <td>{{ $acuerdoAct->dependencia()->direccion }}</td>
                    <th style="text-align: center">FECHA</th>
                    <td>{{ $acuerdoAct->fecha }}</td>
                </tr>
                <tr>
                    <th style="text-align: center; background-color:#ddd;" colspan="4">ÁREAS COLABORADORAS</th>
                </tr>
                @foreach($acuerdoAct->areascolaboradoras() as $col)
                <tr>
                    <td style="text-align: center;" colspan="4" >{{ $col->direccion }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<br><br>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <br>
        <a class="btn btn-secondary" href="{{url('/peticion/acuerdos_actividades/index')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
    </div>
</div>




@endsection
