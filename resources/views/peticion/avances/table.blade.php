<table class="table tile table-hover thead-dark dataTable" role='grid' id="data-table">
    <thead>
        <tr>
            <th>Actividad</th>
            <th>Avance</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach($avances as $avance)
        {!! $avance !!}
        <tr>
            <td>{!! $avance->actividad !!}</td>
            <td>{!! $avance->avance !!}</td>
            <td>{!! $avance->fecha !!}</td>
            <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu">
                        
                        <a href="{{url('/peticion/avancesEdit/'.$avance->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil mr-2"></i>Editar </a><br>
                        <a href="{{url('/peticion/avancesDelete/'.$avance->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-trash-o mr-2"></i>Eliminar </a><br>
                        
                    </div>
                </div>
            </td>
        </tr>
        @php $i++ @endphp
        @endforeach
    </tbody>
</table>
