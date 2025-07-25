@extends('layouts.app', ['activePage' => 'servMunic'])
@section('title', 'Main page')
@section('content')

    <div class="row row-sm mb-2 mt-2">
        <div class="col-md">
            <div class="">
                <a href="{{url('createServiciosMunicipales')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nuevo servicio</a>
            </div>
        </div>
        <div class="col-md">
            <div class="col-md-6" style="padding-right: 7em;">
                <a style="background: none; color: #28a745; border: solid #28a745 thin;" class="btn" href="{{url('pdfServiciosMunicipales/1')}}">
                    Parques <br> <i class="fa fa-download mr-2"></i>
                </a>
                <a style="background: none; color: #28a745; border: solid #28a745 thin;" class="btn" href="{{url('pdfServiciosMunicipales/2')}}">
                    Sábado <br> <i class="fa fa-download mr-2"></i>
                </a>
                <a style="background: none; color: #28a745; border: solid #28a745 thin;" class="btn" href="{{url('pdfServiciosMunicipales/3')}}">
                    Domingo <br> <i class="fa fa-download mr-2"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table tile table-hover dataTable" role='grid' id="data-table">
            <thead>
                <tr>
                    <th style="padding-left: 2em;">Supervisor</th>
                    <th>Turno</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($servMun as $sm)
                    <tr>
                        <td style="padding-left: 2em;"> {!! $sm->supervisor !!} </td>
                        <td>
                            @switch ( $sm->turno )
                                @case( 1 )
                                        Matutino
                                    @break
                                @case( 2 )
                                        Vespertino
                                    @break
                            @endswitch
                        </td>
                        <td> {!! $sm->fecha !!} </td>
                        <td class="text-center">
                            <div class="btn-group m-0" role="group">
                                <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{url('/editServiciosMunicipales/'.$sm->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Editar </a><br>
                                    <a onclick="borrar({{ $sm->id }})" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-trash-o mr-2"></i>Borrar</a><br>
                                    <a class="col-12 btn btn-secondary btn-sm" onclick="show({!! $sm->id !!})" ><i class="fa fa-download"></i>&nbsp;Descargar</a><br>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        // var BASE_URL = window.location.protocol + "//" + window.location.host+ "/";

        function borrar(id) {
            swal({
                title: 'Eliminar Servicio Municipal!',
                text: 'El Servicio Municipal se eliminará definitivamente. ¿Desea continuar?',
                type: 'warning',
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-danger',
                cancelButtonText: "Cancelar",
                confirmButtonText: "Eliminar",
                cancelButtonClass: 'btn btn-light',
            }).then(function (r) {
                if (r.dismiss === 'cancel' || r.dismiss === 'overlay') {
                    return false;
                }
                if (r.value === true) {
                    window.location.href = BASE_URL + "deleteServiciosMunicipales/" + id;
                }
            });
        }

        function pdf(){
            window.location = BASE_URL + "pdfServiciosMunicipales/" + document.getElementsByName('reportes')[0].value;
        }

        function show(id){
            window.location = BASE_URL + "showServiciosMunicipales/" + id;
        }
    </script>
@endsection
