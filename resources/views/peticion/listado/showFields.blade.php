@extends('layouts.app')
@section('title', 'Main page')
@section('content')


<div class="row pb-15">
    <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
        <h4 style="text-align: center"> <b>Título de la reunión:</b><br>{!! $acuerdo->acuerdo !!}</h4>
        <h4 style="text-align: center"> <b>Temas:</h4>
        <p style="text-align: center; font-size: 15px">{!! ($acuerdo->temas==null) ? 'Sin temas específicos' : $acuerdo->temas !!}</p>
        <div class="form-group">
            <table class="table-bordered table-condensed table-hover col-md-12">
                <thead>
                    <tr style="background-color:#ddd">
                        <th>Usuario</th>
                        <th>Dependencia</th>
                        <th>Fecha solicitada</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{!! $acuerdo->usuario()->nombre !!}</td>
                        <td>{!! $acuerdo->usuario()->dependencia()->direccion !!}</td>
                        <td>{!! date('d/m/Y', strtotime($acuerdo->fecha_solicitada)) !!}</td>
                    </tr>
                    <tr style="background-color:#ddd">
                        <th>Fecha otorgada</th>
                        <th>Hora otorgada</th>
                        <th>Estatus</th>
                    </tr>
                    <tr>                                                        
                        <th>{!! ($acuerdo->fecha_otorgada==null) ? 'Sin fecha' : date('d/m/Y', strtotime($acuerdo->fecha_otorgada)) !!}<i class="form-group__bar"></i></th>
                        <th>{!! ($acuerdo->hora_otorgada==null) ? 'Sin hora' : date('H:i', strtotime($acuerdo->hora_otorgada)) !!}<i class="form-group__bar"></i></th>
                        <th>{!! $estatus[$acuerdo->estatus] !!}</th>
                    </tr>
                </tbody>
            </table>  
        </div>
    </div>  
</div>
  
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12 text-center">
    <br>
    <a class="btn btn-secondary" href="{{url('/peticion/listado')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
  </div>
</div>

@endsection



