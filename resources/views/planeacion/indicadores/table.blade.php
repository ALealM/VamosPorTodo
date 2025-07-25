<table class="table tile table-hover  dataTable" role='grid' id="data-table">
  <thead>
    <tr>
      <th>#</th>
      <th>Eje</th>
      <th>Estrategia</th>
      <th>Indicador</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($indicadores as $indicador)
      <tr>
        <td >{!! $indicador->estrategia()->eje()->id.".".$indicador->estrategia()->numero.".".$indicador->numero !!}</td>
        <td >{!! $indicador->estrategia()->eje()->eje !!}</td>
        <td >{!! $indicador->estrategia()->estrategia !!}</td>
        <td >{!! $indicador->indicador !!}</td>
        <td class="text-center">
          <div class="btn-group m-0" role="group">
            <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Acciones
            </button>
            <div class="dropdown-menu">
                <a href="{{url('/planeacionE/indicadorEdit/'.$indicador->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil mr-2"></i>Editar </a><br>
              <a href="{{url('/planeacionE/indicadorShow/'.$indicador->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-list-ul mr-2"></i>Detalles </a><br>
            </div>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
