<table class="table tile table-hover dataTable" role='grid' id="data-table">
    <thead>
        <tr>
            <th style=" width: 30px">#</th>
            <th>Nombre</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach($programas as $programa)
        <tr>
            <td>{!! $i !!}</td>
            <td>{!! $programa->nombre !!}</td>
            <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu">                        
                        <!--<a href="{{url('/programa/edit/'.$programa->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-edit mr-2"></i>Edición</a><br>-->       
                        <!--<a class="col-12 btn btn-secondary btn-sm" onclick="borrarProg({{$programa->id}})"><i class="fa fa-times mr-2"></i>Eliminar</a><br>-->       
                        @if($programa->link == 0)
                        <a href="{{url('/programa/vincular/'.$programa->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-link mr-2"></i>Vincular</a><br>       
                        @else
                        <a href="{{url('/programa/desvincular/'.$programa->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-unlink mr-2"></i>Desvincular</a><br>       
                        <a href="{{url('/programa/beneficiarios/'.$programa->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-universal-access mr-2"></i>Beneficiarios</a><br>       
                        @endif                        
                    </div>
                </div>
            </td>
        </tr>
        @php $i++ @endphp
        @endforeach
    </tbody>
</table>            