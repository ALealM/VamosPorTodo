<table class="table tile table-hover  dataTable" role='grid' id="data-table">
  <thead>
    <tr>
      <th>#</th>
      <th>Eje</th>
      <th>Estrategia</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($estrategias as $estrategia)
      <tr>
        <td >{!! $estrategia->eje()->id.".".$estrategia->numero !!}</td>
        <td >{!! $estrategia->eje()->eje !!}</td>
        <td >{!! $estrategia->estrategia !!}</td>

        <td class="text-center">
          <div class="btn-group m-0" role="group">
            <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Acciones
            </button>
            <div class="dropdown-menu">
              <a href="{{url('/planeacionE/estrategiaEdit/'.$estrategia->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil mr-2"></i>Editar </a><br>
            </div>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
