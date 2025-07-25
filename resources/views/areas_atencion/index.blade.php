@extends('layouts.app')
@section('title', 'Main page')
@section('content')

    <!--div class="mb-2 mt-2">
        <a href="{{url('respuesta/create')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nuevo reporte</a>
    </div-->

    @if($reportes->isEmpty())
        <div class="text-center">No hay reportes dados de alta para mostrar</div>
    @else
        <table class="table tile table-hover dataTable" role='grid' id="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th style="max-width: 2.5em; text-indent: 5%;">Prioridad</th>
                    <th style="text-indent: 10%;">Folio</th>
                    <th>Fecha</th>
                    <th>Área</th>
                    <th>Tipo</th>
                    <th>Ubicación</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($reportes as $reporte)
                    <tr>
                        <td>{!! $loop->index +1 !!}</td>
                        <td class="{{ $reporte->cancelado ? 'text-danger' : 'text-warning' }}" style="text-indent: 10%;">
                            @if($reporte->vo_bo_solicitante)
                                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M16.75 22.16L14 19.16L15.16 18L16.75 19.59L20.34 16L21.5 17.41L16.75 22.16M6 22C4.89 22 4 21.1 4 20V4C4 2.89 4.89 2 6 2H7V9L9.5 7.5L12 9V2H18C19.1 2 20 2.89 20 4V13.34C19.37 13.12 18.7 13 18 13C14.69 13 12 15.69 12 19C12 20.09 12.29 21.12 12.8 22H6Z" />
                                </svg>
                            @else
                                @if($reporte->cancelado)
                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M13,9H18.5L13,3.5V9M6,2H14L20,8V20A2,2 0 0,1 18,22H6C4.89,22 4,21.1 4,20V4C4,2.89 4.89,2 6,2M10.5,11C8,11 6,13 6,15.5C6,18 8,20 10.5,20C13,20 15,18 15,15.5C15,13 13,11 10.5,11M10.5,12.5A3,3 0 0,1 13.5,15.5C13.5,16.06 13.35,16.58 13.08,17L9,12.92C9.42,12.65 9.94,12.5 10.5,12.5M7.5,15.5C7.5,14.94 7.65,14.42 7.92,14L12,18.08C11.58,18.35 11.06,18.5 10.5,18.5A3,3 0 0,1 7.5,15.5Z" />
                                    </svg>
                                @else
                                    @if($reporte->prioridad)
                                        <svg style="width:2em; height:2em" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M21 11.11V5C21 3.9 20.11 3 19 3H14.82C14.4 1.84 13.3 1 12 1S9.6 1.84 9.18 3H5C3.9 3 3 3.9 3 5V19C3 20.11 3.9 21 5 21H11.11C12.37 22.24 14.09 23 16 23C19.87 23 23 19.87 23 16C23 14.09 22.24 12.37 21 11.11M12 3C12.55 3 13 3.45 13 4S12.55 5 12 5 11 4.55 11 4 11.45 3 12 3M5 19V5H7V7H17V5H19V9.68C18.09 9.25 17.08 9 16 9H7V11H11.1C10.5 11.57 10.04 12.25 9.68 13H7V15H9.08C9.03 15.33 9 15.66 9 16C9 17.08 9.25 18.09 9.68 19H5M16 21C13.24 21 11 18.76 11 16S13.24 11 16 11 21 13.24 21 16 18.76 21 16 21M16.5 16.25L19.36 17.94L18.61 19.16L15 17V12H16.5V16.25Z" />
                                        </svg>
                                    @endif
                                @endif
                            @endif
                        </td>
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
                                    @auth
                                        @if( $reporte->cancelado == 0 )
                                            <a href="{{url('/respuesta/show/'.$reporte->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-list-ul mr-2"></i>Seguimiento </a><br>
                                            @if(!$reporte->vo_bo_solicitante)
                                                <a onclick="borrar({{ $reporte->id }})" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-trash-o mr-2"></i>Cancelar</a><br>
                                            @endif
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @auth
            <script type="text/javascript">
                // var BASE_URL = window.location.protocol + "//" + window.location.host+ "/";

                function borrar(id) {
                    swal({
                        title: 'Cancelación de reporte!',
                        text: 'Se cancelará el reporte seleccionado. ¿Desea continuar?',
                        type: 'warning',
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-danger',
                        cancelButtonText: "No",
                        confirmButtonText: "Sí",
                        cancelButtonClass: 'btn btn-light',
                    }).then(function (r) {
                        if (r.dismiss === 'cancel' || r.dismiss === 'overlay') {
                            return false;
                        }
                        if (r.value === true) {
                            window.location.href = BASE_URL + "deleteReporte/" + id;
                        }
                    });
                }
            </script>
        @endauth
    @endif
@endsection
