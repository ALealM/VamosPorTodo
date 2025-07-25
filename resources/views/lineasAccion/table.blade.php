<table class="table tile table-hover  dataTable" role='grid' id="data-table">
  <thead>
    <tr>
      <th>#</th>
      <th>Dirección</th>
      <th>Programa</th>
      <th>Indicador</th>
      <th>Meta</th>
      <th>Unidad</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @php $i=1 @endphp
    @foreach($acciones as $accion)
      <tr>
        <td >{!! $i !!}</td>
        <td >{!! $accion->direccion()->direccion !!}</td>
        <td >{!! $accion->programa !!}</td>
        <td >{!! $accion->indicador !!}</td>
        <td >{!! number_format($accion->meta) !!}</td>
        <td >{!! $accion->unidad()->unidad !!}</td>

        <td class="text-center">
          <div class="btn-group m-0" role="group">
            <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Acciones
            </button>
            <div class="dropdown-menu">
              <a href="{{url('/lineaAccion/avance/'.$accion->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-list-ol mr-2"></i>Avance </a><br>
            </div>
          </div>
        </td>
      </tr>
      @php $i++ @endphp
    @endforeach
  </tbody>
</table>
