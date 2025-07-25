<table class="table tile table-hover  dataTable" role='grid' id="data-table">
  <thead>
    <tr>
      <th>#</th>
      <th>Folio</th>
      <th>Fecha</th>
      <th>Área</th>
      <th>Tipo</th>
      <th>Ubicación</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @php $i=1 @endphp
    @foreach($reportes as $reporte)
      <tr>
        <td>{!! $i !!}</td>
        <td>{!! $reporte->folio !!}</td>
        <td>{!! date( 'Y-m-d', strtotime($reporte->fecha) ) !!}</td>
        <td>{!! $reporte->area()->area !!}</td>
        <td>{!! $reporte->falla()->falla !!}</td>
        <td>{!! $reporte->calle()->d_calle !!} #{!! $reporte->numext !!} {!! $reporte->numint !!}, {!! $reporte->colonia()->d_asenta !!}</td>
        <td class="text-center">
          <div class="btn-group m-0" role="group">
            <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Acciones
            </button>
            <div class="dropdown-menu">
              <a href="{{url('/respuesta/ficha/'.$reporte->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Ficha </a><br>
              <a href="{{url('/respuesta/show/'.$reporte->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-list-ul mr-2"></i>Seguimiento </a><br>
            </div>
          </div>
        </td>
      </tr>
      @php $i++ @endphp
    @endforeach
  </tbody>
</table>
