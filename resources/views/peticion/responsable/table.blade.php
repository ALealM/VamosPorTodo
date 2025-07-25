<table class="table tile table-hover thead-dark dataTable" role='grid' id="data-table">
    <thead>
        <tr>
            <th>Actividad</th>
            <th>Avance</th>
            <th>Evidencias</th>
            <th>Fecha</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach($responsable as $resp)

        <tr>
            <td>{!! $resp->actividad !!}</td>
            <td>{!! $avance !!}<small>%</small></td>
            <td>
                @if($resp->evidencias != null)
                <p>Con Evidencias</p>
                @else
                <p>Sin Evidencias</p>
                @endif
            </td>
            <td>{!! $resp->fecha !!}</td>
            <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu">

                        <a href="{{url('/peticion/responsableEdit/'.$resp->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil mr-2"></i>Actualizar </a><br>
                        <a href="{{url('/peticion/responsableShow/'.$resp->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Ver </a><br>
                    </div>
                </div>
            </td>
        </tr>
        @php $i++ @endphp
        @endforeach
    </tbody>
</table>
