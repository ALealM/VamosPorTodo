@extends('layouts.app', ['activePage' => 'eventosDiariosUpdate', 'mainPage' => 'eventos'])
@section('title', 'Main page')
@section('content')
    <div class=" table-responsive">
        <table class="table tile table-hover dataTable" role='grid' id="data-table">
            <thead>
                <tr>
                    <th style=" width: 30px">#</th>
                    <th>Fecha</th>
                    <th>Lugar</th>
                    <th>Título</th>
                    <th>Estatus</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!--0 eliminados
                1 oficilia
                2 inventario-->
                @php $i=1 @endphp
                @foreach($eventos as $evento)
                <tr>
                    <td>{!! $i !!}</td>
                    <td>{!! date( 'd/m/Y', strtotime($evento->fecha) ) !!}</td>
                    <td>{!! $evento->lugar !!}</td>
                    <td>{!! str_replace("\n", "<br>", $evento->titulo) !!}</td>
                    <td id='tdEvt{{$evento->id}}'><button class="btn btn-sm btn-{{$evento->estatus==0 ? 'secondary' : ($evento->estatus==1 ? 'warning' : ($evento->estatus==2 ? 'info' : ($evento->estatus==3 ? 'success' : 'danger'))) }}">{!! $evento->estatus() !!}</button></td>
                    <td class="text-center">
                        <div class="btn-group m-0" role="group">
                            <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Acciones <i class="fas fa-caret-down ml-1"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a href="{{url('/evento/edit/'.$evento->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil-square-o mr-2"></i>Editar</a><br>
                            </div>
                        </div>
                    </td>
                </tr>
                @php $i++ @endphp
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
