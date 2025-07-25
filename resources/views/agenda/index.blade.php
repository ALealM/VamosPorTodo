@extends('layouts.app', ['activePage' => 'agenda', 'mainPage' => 'agenda'])
@section('title', 'Main page')
@section('content')

@if($agendaRegistros->isEmpty())
    <div class="text-center">No se ha registrado alguna agenda</div>
@else
    <div class=" table-responsive">
        <table class="table table-hover dataTable" role='grid' id="data-table" style="width: 100%">
            <thead>
                <tr>
                    <th style=" width: 30px">#</th>
                    <th>Registro</th>
                    <th>Meta</th>
                    <th>Solución</th>
                    <th>Título de Evento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($agendaRegistros as $key => $agenda)
                    <tr>
                        <td>{!! $key+1 !!}</td>
                        <td>{!! date( 'd/m/Y', strtotime($agenda->fecha_alta) ) !!}</td>
                        <td style="text-transform: capitalize;">{!! $agenda->meta !!}</td>
                        <td style="text-transform: capitalize;">{!! $agenda->solucion !!}</td>
                        <td style="text-transform: capitalize;">{!! $agenda->titulo_evento !!}</td>
                        <td class="text-center">
                            <div class="btn-group m-0" role="group">
                                <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Acciones <i class="fas ml-1"></i>
                                </button>
                                <div class="dropdown-menu">                        
                                    <a href="{{url('/showAgenda/'.$agenda->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Ficha</a><br>
                                    <a href="{{url('/editAgenda/'.$agenda->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil-square-o mr-2"></i>Editar</a><br>
                                    <a class="col-12 btn btn-secondary btn-sm" onclick="agendaPDF( {!! $agenda->id !!} );" ><i class="fa fa-download"></i>&nbsp;Descargar</a><br>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<script type="text/javascript">
    function agendaPDF(id) {
        window.location = BASE_URL + "agendaPDF/" + id;
    }
</script>
@endsection