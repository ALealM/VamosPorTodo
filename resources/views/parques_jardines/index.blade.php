@extends('layouts.app', ['activePage' => 'solicitud', 'mainPage' => 'parques_jardines'])
@section('title', 'Main page')
@section('content')
   <div class="mb-2 mt-2">
      <a href="{{url('createEcologia')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nueva Solicitud</a>
   </div>

   <div class="table-responsive">
      <table class="table table-hover dataTable" role='grid' id="data-table">
         <thead class="text-center">
            <tr>
               <th>Fecha de creación</th>
               <th>Folio</th>
               <th>Fecha</th>
               <th>Solicitante</th>
               <th>Teléfono</th>
               <th>Inspector</th>
               <th>Fecha de Inspeccion</th>
               <th></th>
            </tr>
         </thead>
         <tbody>
            @foreach($registros as $pj)
               <tr>
                  <td> {{ $pj->fecha_alta }} </td>
                  <td> {{ $pj->folio }} </td>
                  <td> {{ $pj->fecha }} </td>
                  <td> {{ $pj->name_solicitante }} </td>
                  <td> {{ $pj->tel }} </td>
                  <td> {{ $pj->name_inspector }} </td>
                  <td> {{ $pj->fecha_inspeccion }} </td>
                  <td class="text-center">
                     <div class="btn-group m-0" role="group">
                        <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                           Acciones
                        </button>
                        <div class="dropdown-menu">
                           <a href="{{url('/editSolicitudParqueJardin/'.$pj->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Editar </a><br>
                        </div>
                     </div>
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>
@endsection