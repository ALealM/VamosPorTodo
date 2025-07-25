<table class="table tile table-hover  dataTable" role='grid' id="data-table">
  <thead>
    <tr>
      <th>#</th>
      <th>Nombre</th>
      <th>Tipo</th>
      <th>Problemática</th>
      <th>Descripción</th>
      <th>Responsable(s)</th>
      <th>Beneficiarios</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <!--0 eliminados
    1 oficilia
    2 inventario-->
    @php $i=1 @endphp
    @foreach($acciones as $accion)
      <tr>
        <td>{!! $i !!}</td>
        <td>{!! $accion->nombre !!}</td>
        <td>{!! $accion->tipo()->tipo !!}</td>
        <td>{!! $accion->problematica !!}</td>
        <td>{!! $accion->descripcion !!}</td>
        <td>{!! $accion->responsables() !!}</td>
        <td>{!! $accion->beneficiarios() !!}</td>

        <td class="text-center">
          <div class="btn-group m-0" role="group">
            <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Acciones
            </button>
            <div class="dropdown-menu">
              <a href="{{url('/accion/show/'.$accion->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Ficha </a><br>
            </div>
          </div>
        </td>


      </tr>
      @php $i++ @endphp
    @endforeach
  </tbody>
</table>
