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
        @foreach($colaborador as $col)

        <tr>
            <td>{!! $col->actividad !!}</td>
            <td>{!! $col->avance !!}<small>%</small></td>
            <td>
                @if($col->evidencias != null)
                <p>Con Evidencias</p>
                @else
                <p>Sin Evidencias</p>
                @endif
            </td>
            <td>{!! $col->fecha !!}</td>
            <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu">
                        
                        <a href="{{url('/peticion/colaboradorEdit/'.$col->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil mr-2"></i>Actualizar </a><br>
                        <a href="{{url('/peticion/colaboradorShow/'.$col->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Ver </a><br>
                    </div>
                </div>
            </td>
        </tr>
        @php $i++ @endphp
        @endforeach
    </tbody>
</table>
