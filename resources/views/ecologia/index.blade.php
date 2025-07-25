@extends('layouts.app', ['activePage' => 'ecologia', 'mainPage' => 'ecologia'])
@section('title', 'Main page')
@section('content')
   <div class="mb-2 mt-2">
      <a href="{{url('createEcologia')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nueva Plantilla</a>
   </div>

   <div class="table-responsive">
      <table class="table table-hover dataTable" role='grid' id="data-table">
         <thead class="text-center">
            <tr>
               <h2>Tablero Reporte Aseo Público</h2>
            </tr>
            <tr>
               <th>Título</th>
               <th>Semana</th>
               <th></th>
            </tr>
         </thead>
         <tbody>
            @foreach($ecologia as $inf)
               <tr>
                  <td style="text-transform: uppercase; padding-left: 2em;"> {!! $inf->titulo !!} </td>
                  <td> Del <b> {{ date('d', strtotime($inf->fecha_init) ) }} de {{ $meses[ date('n', strtotime(date('n', strtotime($inf->fecha_init) ) )*1)-3 ] }} </b> al <b> {{ date('d', strtotime($inf->fecha_end) ) }} de {{ $meses[ date('n', strtotime(date('m', strtotime($inf->fecha_end) )*1))-3 ] }} </b> </td>
                  <td class="text-center">
                     <div class="btn-group m-0" role="group">
                        <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                           Acciones
                        </button>
                        <div class="dropdown-menu">
                           <a href="{{url('/editEcologia/'.$inf->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Editar </a><br>
                           <a onclick="borrar({{ $inf->id }})" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-trash-o mr-2"></i>Borrar</a><br>
                           <a class="col-12 btn btn-secondary btn-sm" onclick="pdf({!! $inf->id !!})" ><i class="fa fa-download"></i>&nbsp;Descargar</a><br>
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
            title: 'Eliminar Informe!',
            text: 'El informe se eliminará definitivamente. ¿Desea continuar?',
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
               window.location.href = BASE_URL + "deleteEcologia/" + id;
            }
         });
      }

      function pdf(id){
         window.location = BASE_URL + "pdfEcologia/" + id;
      }
   </script>
@endsection
