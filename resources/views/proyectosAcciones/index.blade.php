@extends('layouts.app', ['activePage' => 'proyectoAccion'])
@section('title', 'Main page')
@section('content')

<div class="mb-2 mt-2">
    <!-- <a href="{{url('proyectoAccion/create')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nuevo Proyecto/Acción</a> -->
</div>

@if($proyAccs->isEmpty())
<div class="text-center">No hay proyectos o acciones dados de alta para mostrar</div>
@else
@include('proyectosAcciones.table')
@endif
@if($totMun!=0)
@include('proyectosAcciones.grafica')
@endif

<script>

    function borrarPA(idP) {

        swal({
            title: 'Eliminar Proyecto!',
            text: 'El Proyecto se eliminará definitivamente. ¿Desea continuar?',
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
                window.location.href = BASE_URL + "proyectoAccion/delete/" + idP;
            }
        });
    }
    
    function proyectoPDF(id) {
        window.location = BASE_URL + "proyectoPDF/" + id;
    }

</script>
@endsection
