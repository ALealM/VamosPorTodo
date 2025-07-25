<table class="table tile table-hover  dataTable" role='grid' id="data-table">
    <thead>
        <tr>
            <th style=" width: 30px">#</th>
            <th>Fecha</th>
            <th>Asunto</th>
            <!--<th>Usuario</th>-->
            <th>Colonia</th>
            <th>Tipo</th>
            <th>Programa</th>
            <th>Estatus</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach($solicitudes as $solicitud)
        <tr>
            <td>{!! $i !!}</td>
            <td>{!! date( 'd/m/Y', strtotime($solicitud->fecha_alta) ) !!}</td>
            <td>{!! $solicitud->asunto !!}</td>
            <!--<td>{{-- $solicitud->user()->correo --}}</td>-->
            <td>{!! $solicitud->colonia()->colonia !!}</td>
            <td>{!! $solicitud->rubro()->nombre !!}</td>
            <td>{!! $solicitud->programa()->nombre !!}</td>
            <td style="text-align: center"><button class="btn btn-sm {{$solicitud->semaforo==0 ? 'btn-outline-danger' : (($solicitud->semaforo==1) ? 'btn-outline-warning' : 'btn-outline-success')}}">{!! $solicitud->estatus() !!}</button></td>
            <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu">
                        @if($solicitud->id_usuario == \Auth::User()->id)
                        <a href="{{url('/solicitud/edit/'.$solicitud->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil-square-o mr-2"></i>Editar</a>
                        <a onclick="borrarSol({{$solicitud->id}})" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-trash-o mr-2"></i>Borrar</a>
                        @endif
                        <a href="{{url('/solicitud/show/'.$solicitud->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-universal-access mr-2"></i>Beneficiarios</a>
                        <a class="col-12 btn btn-secondary btn-sm" onclick="solicitudPDF({!! $solicitud->id !!})" ><i class="fa fa-download"></i>&nbsp;Descargar</a><br>
                    </div>
                </div>
            </td>
        </tr>
        @php $i++ @endphp
        @endforeach
    </tbody>
</table>