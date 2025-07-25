@extends('layouts.app', ['activePage' => 'indicador'])
@section('title', 'Main page')
@section('content')

    <div class="mb-2 mt-2">
        <a href="{{url('createFichaIndicadores')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nueva Ficha</a>
    </div>

    <div class="table-responsive">
        <table class="table tile table-hover dataTable" role='grid' id="data-table">
            <thead>
                <tr>
                    <th>Dependencia</th>
                    <th>Eje Estrátegico</th>
                    <th>Eje Transversal</th>
                    <th>Programa</th>
                    <th>Responsable del Llenado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($fichas as $ficha)
                    <tr>
                        <td> {!! $ficha->dependencia() !!} </td>
                        <td> {!! $ficha->ejeEstrategico('eje') !!} </td>
                        <td> {!! $ficha->ejeTransversal('eje') !!} </td>
                        <td> {!! $ficha->nombre_programa !!} </td>
                        <td> {!! $ficha->nombre_responsable !!} </td>
                        <td class="text-center">
                            <div class="btn-group m-0" role="group">
                                <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{url('/editFichaIndicador/'.$ficha->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Editar </a><br>
                                    <a onclick="borrar({{ $ficha->id }})" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-trash-o mr-2"></i>Borrar</a><br>
                                    <a class="col-12 btn btn-secondary btn-sm" onclick="pdf({!! $ficha->id !!})" ><i class="fa fa-download"></i>&nbsp;Descargar</a><br>
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
                title: 'Eliminar Ficha!',
                text: 'La Ficha se eliminará definitivamente. ¿Desea continuar?',
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
                    window.location.href = BASE_URL + "deleteFichaIndicador/" + id;
                }
            });
        }

        function pdf(id){
            window.location = BASE_URL + "pdfFichaIndicador/" + id;
        }
    </script>
@endsection
