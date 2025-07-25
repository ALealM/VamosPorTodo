<table class="table tile table-hover " role='grid' id="data-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Dirección General</th>
            <th>Cargo</th>
            <th>Nombre</th>
            <th>Género</th>
            <th>Teléfono</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($cargos as $cargo)
        <tr>
            <td>{!! $cargo->id !!}</td>
            <td>{!! $cargo->direccion_gral !!}</td>
            <td>{!! $cargo->cargo !!}</td>
            <td>{{ ($cargo->nombre==null) ? 'Sin nombre' : $cargo->nombre }}</td>
            <td>{{ ($cargo->genero==null) ? 'Sin especificar' : (($cargo->genero=='M') ? 'Mujer' : 'Hombre') }}</td>
            <td>{{ ($cargo->telefono==null) ? 'Sin teléfono' : $cargo->telefono }}</td>
            <td class="text-center">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu">
                        <!--<button href="{{url('/cargoMunicipal/show/'.$cargo->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-list-alt mr-2"></i>Detalles </button><br>-->
                        <button onclick="showCargo({{$cargo->id}})" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-list-alt mr-2"></i>Detalles </button><br>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
