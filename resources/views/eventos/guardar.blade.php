@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  <div class="box box-default">
    <div class="box-body">
      {!! Form::model( @$oInventario, ['route' =>[ ( $sTipoVista == 'crear' ? 'storeInventario' : 'updateInventario' ) ],'method' => ( $sTipoVista == 'crear' ? 'POST' : 'PUT' ), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                  <tr>
                    <th>
                      Área:
                    </th>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-group" style="margin-bottom: 10px">
                        @if ( $sTipoVista == 'crear' || ($sTipoVista == 'editar' && @$oInventario->id_archivo == null) )
                          {!! Form::select('id_area',$aAreas,null,['class'=>'form-control','required','placeholder'=>'Seleccione el área...','required', 'disabled' => ( $sTipoVista == 'ver' ? true : false ) ]) !!}<i class="form-group__bar"></i>
                        @elseif ( @$oInventario->id_area != null )
                          {{$oInventario->nombre_area}}
                        @elseif (@$oArchivo->nombre_area != null)
                          {{@$oArchivo->nombre_area}}
                        @else
                          Sin área especificada
                        @endif
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                  <tr>
                    <th>
                      Sección:
                    </th>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-group" style="margin-bottom: 10px">
                        {!! Form::select('seccion',$secciones,null,['class'=>'form-control','placeholder'=>'Seleccione la sección...','required','onchange'=>'cambiaSerie()','id'=>'seccion', 'disabled' => ( $sTipoVista == 'ver' ? true : false ) ]) !!}<i class="form-group__bar"></i>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                  <tr>
                    <th>
                      Serie:
                    </th>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-group" style="margin-bottom: 10px">
                        {!! Form::select('codigo',$series,null,['id'=>'serie','class'=>'form-control','placeholder'=>'Seleccione la serie...','required', 'disabled' => ( $sTipoVista == 'ver' ? true : false ) ]) !!}<i class="form-group__bar"></i>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                  <tr>
                    <th>
                      Fecha:
                    </th>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-group" style="margin-bottom: 10px">
                        {!! Form::date('fecha', ( @$oInventario->fecha != null ? @$oInventario->fecha : date('Y-m-d') ),['class'=>'form-control form-control-sm','required', 'disabled' => ( $sTipoVista == 'ver' ? true : false ) ]) !!}<i class="form-group__bar"></i>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                  <tr>
                    <th>
                      Título:
                    </th>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-group" style="margin-bottom: 10px">
                        {!! Form::text('titulo',null,['class'=>'form-control form-control-sm','required','placeholder'=>'Ingrese el título del archivo...', 'disabled' => ( $sTipoVista == 'ver' ? true : false ) ]) !!}<i class="form-group__bar"></i>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                  <tr>
                    <th>
                      Fechas Extremas:
                    </th>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-group" style="margin-bottom: 10px">
                        {!! Form::text('fechas_extremas',null,['class'=>'form-control form-control-sm','required','placeholder'=>'Ingrese las fechas extremas...', 'disabled' => ( $sTipoVista == 'ver' ? true : false ) ]) !!}<i class="form-group__bar"></i>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                  <tr>
                    <th>
                      Número de Fojas:
                    </th>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-group" style="margin-bottom: 10px">
                        {!! Form::text('fojas',null,['class'=>'form-control form-control-sm','required','placeholder'=>'Ingrese el número de fojas...', 'disabled' => ( $sTipoVista == 'ver' ? true : false ) ]) !!}<i class="form-group__bar"></i>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
              <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                  <tr>
                    <th>
                      Descripción:
                    </th>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-group" style="margin-bottom: 10px">
                        {!! Form::textarea('descripcion',null,['class'=>'form-control form-control-sm','required','rows'=>'3','placeholder'=>'Descripción del archivo', 'disabled' => ( $sTipoVista == 'ver' ? true : false ) ]) !!}<i class="form-group__bar"></i>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
                <tbody>
                  <tr>
                    <th colspan="4">
                      Valor primario:
                    </th>
                  </tr>
                  <tr>
                    <td><div class="listview__attrs" style="margin: 0">
                      <span style="margin: 0;padding-top: 5px;padding-bottom: 3px;">
                        <label class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id='valor_a' name='valor_a' {{( @$oInventario->valor_a=='on') ? 'checked' : ''}} {{( $sTipoVista == 'ver' ? 'disabled' : '' )}}>
                          <span class="custom-control-indicator"></span>
                          <span class="custom-control-description">A</span>
                        </label>
                      </span>
                    </div>
                  </td>
                  <td>
                    <div class="listview__attrs" style="margin: 0">
                      <span style="margin: 0;padding-top: 5px;padding-bottom: 3px;">
                        <label class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id='valor_l' name='valor_l' {{( @$oInventario->valor_l=='on') ? 'checked' : ''}} {{( $sTipoVista == 'ver' ? 'disabled' : '' )}}>
                          <span class="custom-control-indicator"></span>
                          <span class="custom-control-description">L</span>
                        </label>
                      </span>
                    </div>
                  </td>
                  <td>
                    <div class="listview__attrs" style="margin: 0">
                      <span style="margin: 0;padding-top: 5px;padding-bottom: 3px;">
                        <label class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id='valor_f' name='valor_f' {{( @$oInventario->valor_f=='on') ? 'checked' : ''}} {{( $sTipoVista == 'ver' ? 'disabled' : '' )}}>
                          <span class="custom-control-indicator"></span>
                          <span class="custom-control-description">F</span>
                        </label>
                      </span>
                    </div>
                  </td>
                  <td>
                    <div class="listview__attrs" style="margin: 0">
                      <span style="margin: 0;padding-top: 5px;padding-bottom: 3px;">
                        <label class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id='valor_c' name='valor_c' {{( @$oInventario->valor_c=='on') ? 'checked' : ''}} {{( $sTipoVista == 'ver' ? 'disabled' : '' )}}>
                          <span class="custom-control-indicator"></span>
                          <span class="custom-control-description">C</span>
                        </label>
                      </span>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
              <tbody>
                <tr>
                  <th colspan="4">
                    Clasificación de acceso:
                  </th>
                </tr>
                <tr>
                  <td><div class="listview__attrs" style="margin: 0">
                    <span style="margin: 0;padding-top: 5px;padding-bottom: 3px;">
                      <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id='clas_p' name='clas_p' {{( @$oInventario->clas_p=='on') ? 'checked' : ''}} {{( $sTipoVista == 'ver' ? 'disabled' : '' )}}>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">P</span>
                      </label>
                    </span>
                  </div>
                </td>
                <td>
                  <div class="listview__attrs" style="margin: 0">
                    <span style="margin: 0;padding-top: 5px;padding-bottom: 3px;">
                      <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id='clas_r' name='clas_r' {{( @$oInventario->clas_r=='on') ? 'checked' : ''}} {{( $sTipoVista == 'ver' ? 'disabled' : '' )}}>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">R</span>
                      </label>
                    </span>
                  </div>
                </td>
                <td>
                  <div class="listview__attrs" style="margin: 0">
                    <span style="margin: 0;padding-top: 5px;padding-bottom: 3px;">
                      <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id='clas_c' name='clas_c' {{( @$oInventario->clas_c=='on') ? 'checked' : ''}} {{( $sTipoVista == 'ver' ? 'disabled' : '' )}}>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">C</span>
                      </label>
                    </span>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
          <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
            <tbody>
              <tr>
                <th colspan="4">
                  Estatus:
                </th>
              </tr>
              <tr>
                <td><div class="listview__attrs" style="margin: 0">
                  <span style="margin: 0;padding-top: 5px;padding-bottom: 3px;">
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id='estatus_t' name='estatus_t' {{( @$oInventario->estatus_t=='on') ? 'checked' : ''}} {{( $sTipoVista == 'ver' ? 'disabled' : '' )}}>
                      <span class="custom-control-indicator"></span>
                      <span class="custom-control-description">T</span>
                    </label>
                  </span>
                </div>
              </td>
              <td>
                <div class="listview__attrs" style="margin: 0">
                  <span style="margin: 0;padding-top: 5px;padding-bottom: 3px;">
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id='estatus_c' name='estatus_c' {{( @$oInventario->estatus_c=='on') ? 'checked' : ''}} {{( $sTipoVista == 'ver' ? 'disabled' : '' )}}>
                      <span class="custom-control-indicator"></span>
                      <span class="custom-control-description">C</span>
                    </label>
                  </span>
                </div>
              </td>
              <td>
                <div class="listview__attrs" style="margin: 0">
                  <span style="margin: 0;padding-top: 5px;padding-bottom: 3px;">
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id='estatus_h' name='estatus_h' {{( @$oInventario->estatus_h=='on') ? 'checked' : ''}} {{( $sTipoVista == 'ver' ? 'disabled' : '' )}}>
                      <span class="custom-control-indicator"></span>
                      <span class="custom-control-description">H</span>
                    </label>
                  </span>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12" style="padding-top: 10px">
        <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
          <tbody>
            <tr>
              <th>
                Ubicación:
              </th>
            </tr>
            <tr>
              <td>
                <div class="form-group" style="margin-bottom: 10px">
                  {!! Form::text('ubicacion',null,['class'=>'form-control form-control-sm','required','placeholder'=>'Ingrese la ubicación del archivo...', 'disabled' => ( $sTipoVista == 'ver' ? true : false ) ]) !!}<i class="form-group__bar"></i>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-12" style="padding-top: 10px">
        @if ( @$oInventario->archivo != null )
          <h5>Archivo cargado desde inventario:</h5>
          <div class="form-group" style="margin-bottom: 10px" id='container'>
            <embed src="{{asset('archivos/'.$oInventario->archivo)}}" type="application/pdf" width="100%" height="500"></embed>
          </div>
        @elseif (($sTipoVista == 'crear' || $sTipoVista == 'editar') && @$oArchivo == null )
          <input type="file" accept=".pdf" class="form-control" name="archivo"/>
          <i class="form-group__bar"></i>
        @endif

        @if ( @$oArchivo != null )
          <h5>Archivo:</h5>
          <div class="form-group" style="margin-bottom: 10px" id='container'>
            <embed src="{{asset('archivos/'.$oArchivo->archivo)}}" type="application/pdf" width="100%" height="500"></embed>
          </div>
        @endif




      </div>
    </div>
  </div>

  <div class="card-body">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <br>
        {{Form::hidden('id',null)}}
        @if( $sTipoVista == 'crear' || $sTipoVista == 'editar' )
          <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
        @endif
        <a class="btn btn-secondary" href="{{url('/inventario/index')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
      </div>
    </div>
  </div>
</div>

</div>
</div>

<script>
function cambiaSerie()
{
  var seccion = document.getElementById('seccion').value;
  $("#serie > option").remove();
  $('#serie').append('<option  value="">Seleccione la serie...</option>');
  // var BASE_URL = window.location.protocol + "//" + window.location.host+ "/";
  $.get(BASE_URL + "getSeries", {'seccion': seccion}, function (respuesta) {
    $(respuesta).each(function (i, v) { // indice, valor
      $('#serie').append('<option value="'+v.id+'">'+v.codigoSerie+'</option>');
    });
  });
}
</script>
@endsection
