@extends('layouts.app', ['activePage' => 'solicitudes', 'mainPage' => 'programas'])
@section('title', 'Main page')
@section('content')

<div class="mb-2 mt-2">
    <a href="{{url('solicitud/create')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nueva solicitud</a>
</div>

@include('solicitudes.table')
<script>

    function borrarSol(idS) {

        swal({
            title: 'Eliminar Solicitud!',
            text: 'La solicitud se eliminará definitivamente. ¿Desea continuar?',
            type: 'warning',
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-danger',
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, borrar",
            cancelButtonClass: 'btn btn-light',
        }).then(function (r) {
            if (r.dismiss === 'cancel' || r.dismiss === 'overlay') {
                return false;
            }
            if (r.value === true) {
                window.location.href = BASE_URL + "solicitud/delete/" + idS;
            }
        });
    }
    
    function solicitudPDF(id) {
        window.location = BASE_URL + "solicitudPDF/" + id;
    }

</script>
@endsection
