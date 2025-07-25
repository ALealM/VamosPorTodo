<table class="table tile table-hover dataTable" role='grid' id="data-table" style="width: 100%">
    <thead>
        <tr>
            <th style=" width: 30px">#</th>
            <th>Dirección</th>
            <th>Nombre</th>
            <th>Capítulo</th>
            <th>Beneficiarios</th>
            <th>Inversión Total</th>
            <th>Eje Rector</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach($proyAccs as $proyA)
        <tr>
            <td>{!! $i !!}</td>
            <td>{!! $proyA->usuario()->gabinete()->direccion !!}</td>
            <td>{!! $proyA->nombre !!}</td>
            <td>{!! $proyA->concepto()->rubro()->capitulo()->capDesc() !!}</td>
            <td>{!! number_format($proyA->beneficiarios) !!}</td>
            <td>$ {!! number_format($proyA->inversion(),2,".",",") !!}</td>
            <td>{!! $proyA->ejeRector()->eje !!}</td>
            <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{url('/proyectoAccion/show/'.$proyA->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Ficha</a><br>
                        @if(\Auth::User()->id == $proyA->id_usuario)
                        <a href="{{url('/proyectoAccion/edit/'.$proyA->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil mr-2"></i>Editar</a><br>
                        <a onclick="borrarPA({{$proyA->id}})" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-trash-o mr-2"></i>Borrar</a><br>
                        @endif
                        <a class="col-12 btn btn-secondary btn-sm" onclick="proyectoPDF('{!! $proyA->id !!}')" ><i class="fa fa-download"></i>&nbsp;PDF</a><br>
                    </div>
                </div>
            </td>
        </tr>
        @php $i++ @endphp
        @endforeach
    </tbody>
</table>