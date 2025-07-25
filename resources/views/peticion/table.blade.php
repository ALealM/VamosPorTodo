<table class="table tile table-hover thead-dark dataTable" role='grid' id="data-table">
    <thead>
        <tr>
           
          
            <th>Reunión</th>
            <th>Estatus</th>
            <th>Fecha<br>solicitada</th>
            <th>Fecha<br>otorgada</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach($acuerdos as $acuerdo)
        <tr>
            
            <td>{!! $acuerdo->acuerdo !!}</td>
            <!--<td>{!! $acuerdo->usuario()->dependencia()->direccion!!}</td>-->
            <td id='tdEvt{{$acuerdo->id}}'><button class="btn btn-sm btn-{{$acuerdo->estatus==0 ? 'secondary' : ($acuerdo->estatus==1 ? 'warning' : ($acuerdo->estatus==2 ? 'success' : ($acuerdo->estatus==3 ? 'info' : ($acuerdo->estatus==4 ? 'success' : 'danger')))) }}">{!! $acuerdo->status() !!}</button></td>
            <td>{!! date('d/m/Y', strtotime($acuerdo->fecha_solicitada)) !!}</td>
            <td>{!! ($acuerdo->fecha_otorgada==null) ? 'Sin asignar' : date('d/m/Y', strtotime($acuerdo->fecha_otorgada)).' '.date('H:i', strtotime($acuerdo->hora_otorgada)) !!}</td>
            <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu">
                        @if($acuerdo->estatus == 4) <!--estatus 0 enviado, 4 autorizado y 5 no autorizado-->
                        <!--<a class="col-12 btn btn-info btn-sm" style="color: white" onclick="reunionEnviar({!! $acuerdo->id !!})" id='btn{{$acuerdo->id}}' ><i class="fa fa-arrow-circle-o-right"></i> Enviar</a><br>-->
                        <a href="{{url('/peticion/fichaacuerdo/'.$acuerdo->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-plus-square-o mr-2"></i>Acuerdos </a><br>
                        <a href="{{url('/peticion/fichaacuerdoShow/'.$acuerdo->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Ver </a><br>
                        @else
                        <a href="{{url('/peticion/acuerdoEdit/'.$acuerdo->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil mr-2"></i>Editar </a><br>
                        <a href="{{url('/peticion/acuerdoDelete/'.$acuerdo->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-trash-o mr-2"></i>Eliminar </a><br>
                        @endif
                        
                    </div>
                </div>
            </td>
        </tr>
        @php $i++ @endphp
        @endforeach
    </tbody>
</table>
