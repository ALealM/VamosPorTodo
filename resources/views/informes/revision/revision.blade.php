@extends('layouts.app', ['activePage' => 'revisarInforme', 'mainPage' => 'informe'])
@section('title', 'Main page')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div id="accordion">
            @foreach($informes as $informe)
            <div class="card" style="margin-top: 15px;margin-bottom: 15px;">
                <div class="card-header" id="heading{{$informe->id}}">
                    <h5 class="mb-0">
                        <button class="btn btn-link {{($informe->id==$idx) ? '' : 'collapsed'}}" data-toggle="collapse" data-target="#collapse{{$informe->id}}" aria-expanded="{{($informe->id==$idx) ? 'true' : ''}}" aria-controls="collapse{{$informe->id}}" style="padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 0px; padding: 0px;">
                            <h4 style="margin-bottom: 0px;">{{$informe->direccion()->direccion}}</h4>
                        </button>
                    </h5>
                </div>
                <div id="collapse{{$informe->id}}" class="collapse {{($informe->id==$idx) ? 'show' : ''}}" aria-labelledby="heading{{$informe->id}}" data-parent="#accordion">
                    <div class="card-body">
                        {!! Form::model( @$informe, ['route' =>[ 'updateInformes' ],'method' => ( 'PUT'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
                        {{Form::hidden('id',$informe->id)}}
                        <div class="col-md-12">
                            <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <th colspan="2">
                                            Informe:
                                        </th>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="form-group" style="margin-bottom: 10px">
                                                {!! Form::textArea('informe',null,['class'=>'form-control ckeditor','required','rows'=>'10','id'=>'editor'.$informe->id]) !!}<i class="form-group__bar"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Estatus:
                                        </th>
                                        <th>
                                            Comentarios:
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="btn-check" name="estatus" id="complementar" autocomplete="off" value="3">
                                            <label class="btn btn-secondary btn-sm" for="complementar" style="cursor: auto">COMPLEMENTAR</label>
                                        </td>
                                        <td>
                                            <div class="form-group" style="margin-bottom: 10px">
                                                {!! Form::textArea('comentarios',null,['class'=>'form-control','rows'=>'2']) !!}<i class="form-group__bar"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                       
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                <br>
                                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <script>
                            CKEDITOR.replace('editor{{$informe->id}}', {
                                height: 400,
                                removeButtons: 'PasteFromWord',
                                extraPlugins: 'editorplaceholder',
                                editorplaceholder: 'Escriba el informe del día...',
                                removeDialogTabs: 'image:advanced;link:advanced',
                            });
                        </script>                        
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <br>
        <a class="btn btn-secondary" href="{{url('/informe/listadoRevision')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
    </div>
</div>
@endsection