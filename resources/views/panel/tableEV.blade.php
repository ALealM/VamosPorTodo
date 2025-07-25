<table class="table tile table-hover dataTable" role='grid' id="data-table" style="width: 100%">
    <thead>
        <tr>
            <th style=" width: 30px">#</th>
            <th>Fecha</th>
            <th>Dirección</th>
            <th>Lugar</th>
            <th>Título</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <!--0 eliminados
        1 oficilia
        2 inventario-->
        @php $i=1 @endphp
        @foreach($eventos as $evento)
        <tr>
            <td>{!! $i !!}</td>
            <td>{!! date( 'd/m/Y', strtotime($evento->fecha) ) !!}</td>
            <td>{!! $evento->user()->gabinete()->direccion !!}</td>
            <td>{!! $evento->lugar !!}</td>
            <td>{!! str_replace("\n", "<br>", $evento->titulo) !!}</td>
            <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu"> 
                        <a href="{{url('/panel/showEV/'.$evento->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Ficha</a><br>
                        <a class="col-12 btn btn-secondary btn-sm" onclick="eventoPDF({!! $evento->id !!})" ><i class="fa fa-download"></i>&nbsp;Descargar</a><br>
                    </div>
                </div>
            </td>
        </tr>
        @php $i++ @endphp
        @endforeach
    </tbody>
</table>