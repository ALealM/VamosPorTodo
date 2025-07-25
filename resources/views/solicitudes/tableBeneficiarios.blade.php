<table class="table tile table-hover dataTable" role='grid' id="data-table">
    <thead>
        <tr>
            <th style=" width: 30px">#</th>
            <th>Nombre</th>
            <th>Domicilio</th>
            <th>Contacto</th>
            <th>INE</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach($beneficiarios as $beneficiario)
        <tr>
            <td>{!! $i !!}</td>
            <td>{!! $beneficiario->nombre !!}</td>
            <td>{!! $beneficiario->domicilio !!}</td>
            <td>{!! $beneficiario->contacto !!}</td>
            <td>{!! $beneficiario->ine !!}</td>
            <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu">                        
                        <a href="{{url('/beneficiarioSol/edit/'.$beneficiario->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-edit mr-2"></i>Edición</a><br>       
                        <a class="col-12 btn btn-secondary btn-sm" onclick="borrarBen({{$beneficiario->id}})"><i class="fa fa-times mr-2"></i>Eliminar</a><br>                               
                    </div>
                </div>
            </td>
        </tr>
        @php $i++ @endphp
        @endforeach
    </tbody>
</table>            