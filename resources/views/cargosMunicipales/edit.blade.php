{!! Form::model( @$cargo, ['route' =>[ 'updateCargoMunicipal' ],'method' => ( 'PUT'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
{{Form::hidden('id')}}
<div class="col-lg-10 col-md-8 ml-auto mr-auto">
    <div style="padding-top: 10px" class="text-center">
        <img style="width:200px; height:auto;" src="{{ asset('/') }}/img/cargosMunicipales/{{$cargo->fotografia}}">        
    </div>
    <div style="padding-top: 10px">
        <section class="border p-4 d-flex justify-content-center mb-4">
            <div style="width: 22rem;">
                <input type="file" class="form-control" id="customFile" autocompleted="" accept=".png,.jpg,.jpeg" name='fotografia'>
            </div>
        </section>
        <table class="table-hover" style="width: 100%;" id="tablaBeneficiarios">
            <tbody>
                <tr>
                    <th style="width: 150px">Nombre</th>
                    <td>{{ Form::text('nombre',null,['placeholder'=>'Escriba el nombre','class'=>'form-control','required','autofocus']) }}</td>
                </tr>
                <tr style="background-color:#ddd">
                    <th>Dirección General</th>
                    <td>{{ Form::text('direccion_gral',null,['placeholder'=>'Escriba la dirección general','class'=>'form-control','required']) }}</td>
                </tr>
                <tr>
                    <th>Cargo</th>
                    <td>{{ Form::text('cargo',null,['placeholder'=>'Escriba el cargo','class'=>'form-control','required']) }}</td>
                </tr>
                <tr style="background-color:#ddd">
                    <th>Género</th>
                    <td>{{ Form::select('genero',['M'=>'Mujer','H'=>'Hombre'],null,['placeholder'=>'Seleccione...','class'=>'form-control','required']) }}</td>
                </tr>
                <tr>
                    <th style="width: 150px">Teléfono</th>
                    <td>{{ Form::text('telefono',null,['placeholder'=>'Escriba el teléfono','class'=>'form-control','autofocus']) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <br><a href="javascript:;" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"><i class="fa fa-times mr-2"></i>Cancelar</a>
        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
    </div>
</div>
</form>