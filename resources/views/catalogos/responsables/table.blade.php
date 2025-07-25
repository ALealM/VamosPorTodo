<table class="table tile table-hover dataTable" role='grid' id="data-table">
  <thead>
    <tr>
      <th>#</th>
      <th>Nombre</th>
      <th>Secretaría</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @php $i=1 @endphp
    @foreach($responsables as $responsable)
      <tr>
        <td >{!! $i !!}</td>
        <td >{!! $responsable->nombre !!}</td>
        <td >{!! $responsable->secretaria()->nombre !!}</td>
        <td class="text-center">
          <div class="btn-group m-0" role="group">
            <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Acciones
            </button>
            <div class="dropdown-menu">
              <a href="{{url('/responsables/edit/'.$responsable->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil mr-2"></i>Editar </a><br>
            </div>
          </div>
        </td>
      </tr>
      @php $i++ @endphp
    @endforeach
  </tbody>
</table>
