@extends('layouts.app', ['activePage' => 'servMunic'])
@section('title', 'Main page')

@section('content')
	<style>
		h4, .h4 {
			font-size: 1.3125rem;
			font-family: "Roboto", sans-serif;
		}

		.form-control {
			display: block;
			width: 100%;
			height: calc(1.5em + .75rem + 2px);
			padding: .375rem .75rem;
			font-size: 1rem;
			font-weight: 400;
			line-height: 1.5;
			color: #495057;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid #ced4da;
			border-radius: .25rem;
			transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
		}

		.size-fijo{
			height: 100%;
			min-height: 100%;
			max-height: 100%;
			box-sizing: border-box;
		}

		.textDesign{
			text-align: justify;
			padding: 1em;
			text-shadow: 1px 1px 1px #c7c8cd;
			background: -webkit-gradient( linear, left bottom, left top, color-stop(0.02, rgb(218 221 216)), color-stop(0.51, rgb(237 241 233)), color-stop(0.87, rgb(245 245 245)) );
			-webkit-border-top-left-radius: 1em;
			-webkit-border-top-right-radius: 1em;
			border-bottom-left-radius: 1em;
			border-bottom-right-radius: 1em;
		}

		.form-control {
		    width: 95%;
		}
	</style>

   {!! Form::model( @$servMun, ['route' =>[ 'updateServiciosMunicipales' ], 'method' => ( 'POST'), 'class' =>'form-horizontal', 'id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data", 'onsubmit'=>"return validar();" ]) !!}

   <input type="hidden" value='{{$sm->id}}' name='id'>

	<div class="row">
		<br>
		<div class="col-md-12 text-center" style="background-color:#eee;">
			<h4> Parques </h4>
		</div>
		<div class="col-md-1"></div>
		<div class="col-md-4">
			<br>
			<table class="table-borderless table-condensed table-hover" style="width: 100%">
				<tbody>
					<tr> <th> Fecha: </th> </tr>
					<tr>
						<td>
							<div class="form-group" style="margin-bottom: 10px">
								{!! Form::date('fecha', $sm->fecha, ['class'=>'form-control form-control-sm','required' ]) !!}
								<i class="form-group__bar"></i>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-1"></div>
		<div class="col-md-3">
			<br>
			<table class="table-borderless table-condensed table-hover" style="width: 100%">
				<tbody>
					<tr> <th> Turno: </th> </tr>
					<tr>
						<td style="font-weight: bold;">
							<div class="form-group" style="margin-bottom: 10px">
								{!! Form::select('turno', ['1' => 'Matutino', '2' => 'Vespertino'], $sm->turno, [ 'class'=>'form-control', 'placeholder'=>'Seleccionar...', 'required' ]) !!}
								<i class="form-group__bar"></i>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-3"></div>
	</div>

	<br>

	<div class="row">
		<div class="col-md-12 text-center" style="background-color:#eee;">
			<h4> Supervisor </h4>
		</div>
	</div>
	<br><hr>
	<div class="row row-sm">
		<div class="col-md">
			 <div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Nombre </h6>
					<br><hr><br>
					<div class="form-group" style="margin-bottom: 10px">

						{!! Form::text('name', $sm->supervisor, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba el nombre', 'maxlength' => 100, 'list' => 'nameList', 'onchange' => "changeInfo(this)", 'id' => 'name' ]) !!}
						<!-- Lista de opciones -->
						<datalist id="nameList">
							@foreach ($supervisores as $key => $dat)
								<option data-name="{{ $key }}" value="{{ $dat }}" label="{{ $dat }}"></option>
							@endforeach
						</datalist>

						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Teléfono </h6>
					<br><hr><br>
					<div class="form-group" style="margin-bottom: 10px; padding-top: 1px; padding-left: 1em;">
						{!! Form::text('tel', $sm->telefono, ['class'=>'form-control', 'placeholder'=>'Escriba el teléfono', 'maxlength' => 25, 'required', 'id' => 'tel' ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br><br>

	<div class="col-md-12 row">
		<div class="col-md-12 text-center">
			<h4> COORDINACION DE PARQUES Y JARDINES <a  class="btn btn-success btn-sm text-white" style="color: green" data-toggle="tooltip" title="Agregar" onclick="addLine()"><i class="fa fa-plus-square fa-2x"></i></a> </h4><hr>
		</div>
	</div>

	<div class="row row-sm">
		<div class="col-md-12">
            <div class=" table-responsive">
                <table class="table-condensed table-hover" style="width: 100%" id="tablaServicios">
                	<thead>
                        <tr>
                            <th style="text-align: center">Unidad</th>
                            <th style="text-align: center">Ubicación</th>
                            <th style="text-align: center">TRABAJOS A REALIZAR</th>
                            <th style="text-align: center">Folios</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        	@foreach($sm->detalles as $det)
	                            <td>
	                            	<div class="form-group" style="margin-bottom: 10px">

	                            		{!! Form::text('unidad[]', $det->unidad, ['class'=>'form-control', 'required', 'placeholder'=>'Ingrese unidad', 'maxlength' => 100, 'list' => 'unidadList', 'id' => 'unidad1' ]) !!}
	                            		<i class="form-group__bar"></i>
	                            	</div>
	                            </td>
	                            <td>
	                            	<div class="form-group" style="margin-bottom: 10px">

	                            		{!! Form::text('ubicacion[]', $det->ubicacion, ['class'=>'form-control', 'required', 'placeholder'=>'Ingrese ubicación', 'maxlength' => 150, 'list' => 'ubicacionList', 'id' => 'ubicacion1' ]) !!}

	                            		<i class="form-group__bar"></i>
	                            	</div>
	                            </td>
	                            <td>
	                            	<div class="form-group" style="margin-bottom: 10px">

	                            		{!! Form::text('trabajo[]', $det->trabajo, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba el trabajo', 'maxlength' => 150, 'list' => 'trabajoList', 'id' => 'trabajo1' ]) !!}

	                            		<i class="form-group__bar"></i>
	                            	</div>
	                            </td>
	                            <td>
	                            	<div class="form-group" style="margin-bottom: 10px">
	                            		{!! Form::text('folio[]', $det->folio, [ 'class'=>'form-control', 'placeholder'=>'Ingresar Folio..', 'id' => "folio1", 'required', 'maxlength' => 15 ]) !!}
	                            		<i class="form-group__bar"></i>
	                            	</div>
	                            </td>
	                            <td>
	                            	@if( $loop->first )
	                            		<button class="btn btn-sm text-white" style="color: red; cursor: not-allowed" type="button" disabled><i class="fa fa-minus-square"></i></button>
	                            	@else
	                            		<a class="btn btn-danger btn-sm text-white" style="color: red" onclick="deleteRow(this.parentNode.parentNode.rowIndex )" type="button" style="cursor:pointer">
	                            			<i class="fa fa-minus-square"></i>
	                            		</a>
                            		@endif
	                            </td>
	                        </tr>
	                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Listas de opciones -->
    <datalist id="unidadList">
    	@foreach ($unidades as $key => $dat)
    	<option data-unidad="{{ $key }}" value="{{ $dat }}" label="{{ $dat }}"></option>
    	@endforeach
    </datalist>

    <datalist id="trabajoList">
    	@foreach ($ubicaciones as $key => $dat)
    	<option data-trabajo="{{ $key }}" value="{{ $dat }}" label="{{ $dat }}"></option>
    	@endforeach
    </datalist>

    <datalist id="ubicacionList">
    	@foreach ($ubicaciones as $key => $dat)
    	<option data-ubicacion="{{ $key }}" value="{{ $dat }}" label="{{ $dat }}"></option>
    	@endforeach
    </datalist>

	<br>

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 text-center">
			<br>
			<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
			<a class="btn btn-secondary" href="{{url('/indexServiciosMunicipales')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
		</div>
	</div>


	<script type="text/javascript">
		// var BASE_URL = window.location.protocol + "//" + window.location.host+ "/";

        function addLine(op) {
            var tbl = document.getElementById('tablaServicios');
            var lastRow = tbl.rows.length;//$("#tablaServicios tr").length
            var row = tbl.insertRow(lastRow);

            var i = row.insertCell(0);
            var f = row.insertCell(1);
            var act = row.insertCell(2);
            var obs = row.insertCell(3);
            var ac = row.insertCell(4);

            i.innerHTML = '<div class="form-group bmd-form-group is-filled" style="margin-bottom: 10px">\n\
            {!! Form::text('unidad[]', null, ['class'=>'form-control', 'required', 'placeholder'=>'Ingrese unidad', 'maxlength' => 100, 'list' => 'unidadList', 'id' => 'temp' ]) !!}\n\
            <i class="form-group__bar"></i></div>';
            document.querySelector('#temp').setAttribute('id', 'unidad' + lastRow);
            f.innerHTML = '<div class="form-group bmd-form-group is-filled" style="margin-bottom: 10px">\n\
            {!! Form::text('ubicacion[]', null, ['class'=>'form-control', 'required', 'placeholder'=>'Ingrese ubicación', 'maxlength' => 150, 'list' => 'ubicacionList', 'id' => 'temp' ]) !!}\n\
            <i class="form-group__bar"></i></div>';
            document.querySelector('#temp').setAttribute('id', 'ubicacion' + lastRow);
            act.innerHTML = '<div class="form-group bmd-form-group is-filled" style="margin-bottom: 10px">\n\
            {!! Form::text('trabajo[]', null, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba el trabajo', 'maxlength' => 150, 'list' => 'trabajoList', 'id' => 'temp' ]) !!}\n\
            <i class="form-group__bar"></i></div>';
            document.querySelector('#temp').setAttribute('id', 'trabajo' + lastRow);
            obs.innerHTML = '<div class="form-group bmd-form-group is-filled" style="margin-bottom: 10px">\n\
            {!! Form::text('folio[]', null, [ 'class'=>'form-control', 'placeholder'=>'Ingresar Folio..', 'id' => "temp", 'required', 'maxlength' => 15 ]) !!}\n\
            <i class="form-group__bar"></i></div>';
            document.querySelector('#temp').setAttribute('id', 'folio' + lastRow);
            ac.innerHTML = '<a class="btn btn-danger btn-sm text-white" style="color: red" onclick="deleteRow(this.parentNode.parentNode.rowIndex )" type="button" style="cursor:pointer"><i class="fa fa-minus-square"></i></a>';

            return false;
        }

        function deleteRow(rowIndex){
            var table = document.getElementById('tablaServicios');
            table.deleteRow(rowIndex);
        }

		function changeInfo(info){
			if( $('#'+info.name+'List').find('option[value="'+$('#'+info.name).val()+'"]').data(info.name) === undefined )
				return false;

			$.get(BASE_URL + "getInfoServiciosMunicipales", {
					'id': $('#'+info.name+'List').find('option[value="'+$('#'+info.name).val()+'"]').data(info.name)
				},
				function (respuesta) {
					$('#tel').val(respuesta);
			});
		}

		function validar(){
			return true;
		}
	</script>
@endsection
