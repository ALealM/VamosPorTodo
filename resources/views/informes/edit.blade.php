@extends('layouts.app', ['activePage' => 'editInforme', 'mainPage' => 'informe'])
@section('title', 'Main page')
@section('content')


{!! Form::model( @$informe, ['route' =>[ 'updateInforme' ],'method' => ( 'PUT'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
<input type="hidden" value='{{$informe->id}}' name='id'>
<div class="row">
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        <div class="col-md-12 text-center"><hr>
                            <h4>SELECCIONAR DÍA A INFORMAR</h4>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group col-md-4 mr-auto ml-auto" style="margin-bottom: 10px">
                            {!! Form::date('fecha',null,['class'=>'form-control','required']) !!}<i class="form-group__bar"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Informe:
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" style="margin-bottom: 10px">
                            {!! Form::textArea('informe',null,['class'=>'form-control ckeditor','required','required','rows'=>'10','id'=>'editor']) !!}<i class="form-group__bar"></i>
                            <script>
                                CKEDITOR.replace('editor', {
                                    height: 400,
                                    removeButtons: 'PasteFromWord',
                                    extraPlugins: 'editorplaceholder',
                                    editorplaceholder: 'Escriba el informe del día...',
                                    removeDialogTabs: 'image:advanced;link:advanced',
                                });
                            </script>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @if($informe->comentarios!=null)
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th style="color: red; width: 250px">
                        Comentarios a tomar en cuenta:
                    </th>
                    <td>
                        {{$informe->comentarios}}                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @endif
    <div class="col-md-12">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
                <tr>
                    <th>
                        Evidencia:
                    </th>
                </tr>
                <tr>
                    <td>
                        <input type="file" name="archivos[]" multiple >
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        <div class="row pb-15">
            <div class="col-md-10 mr-auto ml-auto" style="padding-top: 10px; text-align: center">
                <h4 style="text-align: center">IMÁGENES</h4>*Seleccione las imágenes que desea reemplazar<hr>
                <div class="row">
                    @foreach($imagenes as $imagen)
                    <div class="col-md-3">
                        <input type="checkbox" class="btn-check" name="imagenes[]" autocomplete="off" value="{{$imagen->id}}">
                        <label class="btn btn-secondary btn-sm" for="info-outlined">
                        <a href="{{asset('informes')}}/{{$imagen->anexo}}" target="_blank" class="btn btn-sm btn-secondary">
                            <img src="{{asset('informes')}}/{{$imagen->anexo}}" style="width:100%;">
                        </a>
                        </label>
                    </div>
                    @endforeach   
                </div>
            </div>
        </div>
        <div class="row pb-15">
            <div class="col-md-10 mr-auto ml-auto" style="padding-top: 10px; text-align: center">
                <h4 style="text-align: center">ANEXOS</h4>*Seleccione los anexos que desea reemplazar<hr>
                <div class="row">
                    @foreach($documentos as $documento)
                    <div class="col-md-2">
                        <input type="checkbox" class="btn-check" name="documentos[]" autocomplete="off" value="{{$documento->id}}">
                        <label class="btn btn-secondary btn-sm" for="info-outlined">
                        <a href="{{asset('informes')}}/{{$documento->anexo}}" target="_blank" class="btn btn-sm">ANEXO {{$loop->index+1}}</a>
                        </label>
                    </div>
                    @endforeach   
                </div>
            </div>
        </div>
    </div>    
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <br>
        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
        <a class="btn btn-secondary" href="{{url('/informe/listado')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
    </div>
</div>
@endsection