<table class="table tile table-hover  dataTable" role='grid' id="data-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach($ejes as $eje)
        <tr>
            <td >{!! $i !!}</td>
            <td >{!! $eje->eje !!}</td>
            <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{url('/planeacionE/ejeEdit/'.$eje->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil mr-2"></i>Editar </a><br>
                        <a href="{{url('/planeacionE/ejeDelete/'.$eje->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-trash-o mr-2"></i>Eliminar </a><br>
                    </div>
                </div>
            </td>
        </tr>
        @php $i++ @endphp
        @endforeach
    </tbody>
</table>
