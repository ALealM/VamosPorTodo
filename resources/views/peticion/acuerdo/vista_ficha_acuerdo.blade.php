{!! Html::style('css/bootstrap-duallistbox.css') !!}
  {!! Html::script('js/jquery.bootstrap-duallistbox.js') !!}
  {{Form::hidden('rand[]',$rand)}}
  <div class="col-md-12" id="{{$rand}}">
    <table class="dataTable table-bordered table-condensed table-hover" style="width: 100%; padding-bottom:1em; margin-bottom:1em;" id="tablaAcciones">
      <tbody>
        <tr>
          <th colspan="3" style="text-align: center; background-color:#b4cfb5;">Acuerdo <a class="btn btn-danger btn-sm text-white pull-right" style="height: " data-toggle="tooltip" title="Eliminar" onclick="deleteRow({{ $rand }})"><i class="fa fa-minus-square-o fa-2x"></i></a></th>
        </tr>
        <tr>
          <th colspan="2" style="text-align: center">Responsable</th>
          <th style="text-align: center">Fecha</th>
        </tr>
        <tr>
          <td colspan="2">
            <div class="form-group" style="margin-bottom: 10px">{!! Form::select('id_responsable[]',$direcciones,$acuerdo->responsable,['class'=>'form-control','required','placeholder'=>'Seleccione el área responsable...','required','id'=>'resp1' ]) !!}<i class="form-group__bar"></i></div>
          </td>
          <td>
            <div class="form-group" style="margin-bottom: 10px">{!! Form::date('fecha[]',date('Y-m-d'),['class'=>'form-control','placeholder'=>'Seleccione la fecha','required']) !!}<i class="form-group__bar"></i></div>
          </td>          
        </tr>

        <tr>
          <th colspan="3" style="text-align: center; background-color:#eee;">Actividad</th>
          <!--<th style="text-align: center;  background-color:#eee;">Avance</th>
          <th style="text-align: center;  background-color:#eee;">Evidencias</th>-->
        </tr>
        <tr>
          <td colspan="3">
            <div class="form-group" style="margin-bottom: 10px">{!! Form::text('actividad[]',null,['class'=>'form-control','placeholder'=>'Ingrese la actividad','required']) !!}<i class="form-group__bar"></i></div>
          </td>
          <!--<td>
            <div class="form-group">
              <div class="card-body">
                <div class="form-group">{!! Form::number('avance[]',null,['class'=>'form-control','placeholder'=>'Ingrese el avance','required','id'=>'avance']) !!}<i class="form-group__bar"></i></div>
              </div>
            </div>
          </td>
          <td>
            {!! Form::file('archivo[0][]',['class'=>'','multiple','id'=>'archivo']) !!}
          </td>-->
        </tr>
        <tr>
          <td colspan="5">
            <div class="row col-md-12">
              <div class="col-md-12 text-center">
                <h4>Áreas Colaboradoras</h4>
              </div>
              <div class="col-md-12">
                {!! Form::select('colaboradores['.$rand.'][]',$direcciones,null,['multiple','size'=>'10','id'=>'colaboradores'.$rand]) !!}
                <script>
                  $('select[id="colaboradores{{$rand}}"]').bootstrapDualListbox();
                </script>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>