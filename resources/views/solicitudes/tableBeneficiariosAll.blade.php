<table class="table tile table-hover dataTable" role='grid' id="data-table">
    <thead>
        <tr>
            <th style=" width: 30px">#</th>
            <th>Nombre</th>
            <th>Domicilio</th>
            <th>Colonia</th>
            <th>Contacto</th>
            <th>Dirección</th>
            <th>Rubro</th>
            <th>Solicitud</th>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach($beneficiarios as $beneficiario)
        <tr>
            <td>{!! $i !!}</td>
            <td>{!! $beneficiario->nombre !!}</td>
            <td>{!! $beneficiario->domicilio !!}</td>
            <td>{!! $beneficiario->solicitud()->colonia()->colonia !!}</td>
            <td>{!! $beneficiario->contacto !!}</td>
            <td>{!! $beneficiario->solicitud()->responsable()->direccion !!}</td>
            <td>{!! $beneficiario->solicitud()->rubro()->nombre !!}</td>
            <td class="text-center">
                <a href="{{url('/padronBenSol/'.$beneficiario->id_solicitud)}}" class="col-12 btn btn-outline-primary btn-sm"><i class="fa fa-list-alt mr-2"></i>Ver</a><br>       
            </td>
        </tr>
        @php $i++ @endphp
        @endforeach
    </tbody>
</table>            