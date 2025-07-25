<table class="table tile table-hover thead-dark dataTable" role='grid' id="data-table">
    <thead>
        <tr>
            <th>Reunión</th>
            <th>Acuerdo</th>
            <th>Avance</th>
            <th>Fecha</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach($acuerdos_actividades as $acuerdo)
        <tr>
            <td>{!! $acuerdo->acuerdos()->acuerdo !!}</td> <!--Reunión es acuerdo-->
            <td>{!! $acuerdo->actividad !!}</td>
            <td>{!! $acuerdo->avance*1 !!}%</td>
            <td>{!! date( 'd/m/Y', strtotime($acuerdo->fecha) )  !!}</td>
            <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu">
                        <!--<a href="{{url('/peticion/fichaacuerdo/'.$acuerdo->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-plus-square-o mr-2"></i>Crear </a><br>-->
                        <a href="{{url('/peticion/acuerdos_actividadesShow/'.$acuerdo->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Ver </a><br>
                        <!--<a href="{{url('/peticion/acuerdoEdit/'.$acuerdo->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil mr-2"></i>Editar </a><br>-->
                        <!--<a href="{{url('/peticion/acuerdoDelete/'.$acuerdo->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-trash-o mr-2"></i>Eliminar </a><br>-->
                    </div>
                </div>
            </td>
        </tr>
        @php $i++ @endphp
        @endforeach
    </tbody>
</table>
