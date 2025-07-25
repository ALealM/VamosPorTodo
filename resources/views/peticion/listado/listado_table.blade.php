<table class="table tile table-hover dataTable" role='grid' id="data-table">
    <thead>
        <tr>
            <th>Fecha Otorgada</th>
            <th>Fecha Solicitada</th>
            <th>Reunión</th>
            <th>Dependencia</th>
            <th>Estatus</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($acuerdos as $acuerdo)
        <tr>
            <td style="text-align:center">{!! ($acuerdo->fecha_otorgada==null) ? '-/-/- -:-' : date('d/m/Y', strtotime($acuerdo->fecha_otorgada)).' '.date('H:i', strtotime($acuerdo->hora_otorgada)) !!}</td>
            <td>{!! date('d/m/Y', strtotime($acuerdo->fecha_solicitada)) !!}</td>
            <td>{!! $acuerdo->acuerdo !!}</td>
            <td>{!! $acuerdo->usuario()->dependencia()->direccion!!}</td>
            <td id='tdEvt{{$acuerdo->id}}'><button class="btn btn-sm btn-{{$acuerdo->estatus==0 ? 'secondary' : ($acuerdo->estatus==1 ? 'warning' : ($acuerdo->estatus==2 ? 'success' : ($acuerdo->estatus==3 ? 'info' : ($acuerdo->estatus==4 ? 'success' : 'danger')))) }}">{!! $acuerdo->status() !!}</button></td>
            <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Consultar
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{url('/peticion/acuerdolistadoShow/'.$acuerdo->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Ver </a><br>
                        <a href="{{url('/peticion/acuerdolistadoEdit/'.$acuerdo->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil-square-o mr-2"></i>Actualizar </a><br>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>