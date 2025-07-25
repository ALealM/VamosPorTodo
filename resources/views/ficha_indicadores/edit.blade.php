@extends('layouts.app', ['activePage' => 'indicador'])
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
			height: 90%;
			min-height: 90%;
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

		input[type=number]:invalid+span:after {
			content: '✖';
			padding-left: 5px;
		}

		input[type=number]:valid+span:after {
			content: '✓';
			padding-left: 5px;
		}
	</style>

	<!-- Select color semáforo -->

	<!-- Internal Specturm-color picker css-->
	<link href="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">

	{!! Form::model( @$indicadores, ['route' =>[ 'updateFichaIndicadores' ], 'method' => ( 'POST'), 'class' =>'form-horizontal', 'id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data", 'onsubmit'=>"return validar();" ]) !!}

	<input type="hidden" value='{{$ficha->id}}' name='id'>

	<div class="row">
		<br>
		<div class="col-md-12 text-center" style="background-color:#eee;">
			<h4> Ficha Técnica de Indicadores <b style="float: right; color: #d5d5d5;"> Fecha de registro: &nbsp;&nbsp; {!! $ficha->fecha_alta !!} </b> </h4>
		</div>
		<div class="col-md-1"></div>
		<div class="col-md-4">
			<br>
			<table class="table-borderless table-condensed table-hover" style="width: 100%">
				<tbody>
					<tr> <th> Dependencia o entidad: </th> </tr>
					<tr>
						<td>
							<div class="form-group" style="margin-bottom: 10px">
								{!! Form::select('dependencia', $dependencias, $ficha->id_dependencia, ['class'=>'form-control', 'required', 'onchange' => "changeInfo(this)" ]) !!}
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
					<tr> <th> Unidad responsable: </th> </tr>
					<tr>
						<td>
							<div class="form-group" style="margin-bottom: 10px" id="unidadDiv">
								@if( $ficha->id_unidad )
								{!! Form::select('unidad', $unidades, $ficha->id_unidad, ['id' => 'unidad', 'class'=>'form-control' ]) !!}
								@endif
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
			<h4>Alineación con el Plan Municipal de Desarrollo 2021-2024 y sus programas</h4>
		</div>
	</div>

	<br>

	<div class="col-md-12 row">
		<div class="col-md-12 text-center">
			<h4> EJE ESTRATÉGICO </h4><hr>
		</div>
	</div>
	<div class="row row-sm">
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Eje estratégico del PMD 2021-2024 </h6>
					<br><hr><br>
					<div class="form-group" style="margin-bottom: 10px">
						{!! Form::select('eje_estrategico', $ejesEstrategicos, $ficha->id_eje_estrategico, [ 'class'=>'form-control', 'required', 'onchange' => "changeInfo(this)" ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-2">
			<div class="card custom-card size-fijo">
				<div class="card-body" id="eje_estrategicoImg" style="text-align-last: center; top: 50%; left: 25%; transform: translate(0,-40%); position: absolute; width: 50%; height: 70%;">
					<img src = "/logos{{$ficha->ejeEstrategico('logo')}}" style = "height: 100%;">
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Objetivo dentro del eje estratégico al que contribuye del Plan </h6>
					<br><hr><br>
					<div class="textDesign" id="objetivoEjeEstrategico">
						{!! $ficha->ejeEstrategico('objetivo') !!}
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Estrategia general del eje estratégico al que contribuye del Plan </h6>
					<br><hr><br>
					<div class="textDesign" id="estrategiaEjeEstrategico">
						{!! $ficha->ejeEstrategico('estrategia') !!}
					</div>
				</div>
			</div>
		</div>
	</div>

	<br><br>

	<div class="col-md-12 row">
		<div class="col-md-12 text-center">
			<h4> EJE TRANSVERSAL </h4><hr>
		</div>
	</div>
	<div class="row row-sm">
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Eje transversal del  PMD 2021-2024 </h6>
					<br><hr><br>
					<div class="form-group" style="margin-bottom: 10px">
						{!! Form::select('eje_transversal', $ejesTransversales, $ficha->id_eje_transversal, [ 'class'=>'form-control', 'required', 'onchange' => "changeInfo(this)" ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-2">
			<div class="card custom-card size-fijo">
				<div class="card-body" id="eje_transvImg" style="text-align-last: center; top: 50%; left: 50%; transform: translate(-50%,-50%); position: inherit; width: fit-content; height: fit-content;">
					<img src = "/logos{{$ficha->ejeTransversal('logo')}}" style = "height: 60%;">
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Objetivo dentro del eje transversal al que contribuye del Plan </h6>
					<br><hr><br>
					<div class="textDesign" id="objetivoEjeTransversal">
						{!! $ficha->ejeTransversal('objetivo') !!}
					</div>
				</div>
			</div>
		</div>
	</div>

	<br><br>

	<div class="col-md-12 row">
		<div class="col-md-12 text-center">
			<h4> PROGRAMA </h4><hr>
		</div>
	</div>
	<div class="row row-sm">
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Programa del Eje estratégico al que contribuye del Plan </h6>
					<br><hr><br>
					<div class="form-group" style="margin-bottom: 10px" id="progEjeEstratDiv">
						{!! Form::select('progEjeEstrat', $programas, $ficha->id_programa, [ 'class'=>'form-control', 'onchange' => "changeInfo(this)" ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Objetivo específico dentro del programa </h6>
					<br><hr><br>
					<div class="textDesign" id="objetivoEspecificoProgram">
						{!! $ficha->programa('objetivo') !!}
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Estrategia específica del programa al que contribuye del Plan </h6>
					<br><hr><br>
					<div class="textDesign" id="estratEspecificaProgram">
						{!! $ficha->programa('estrategia') !!}
					</div>
				</div>
			</div>
		</div>
	</div>

	<br><br>

	<div class="col-md-12 row">
		<div class="col-md-12 text-center">
			<h4> OBJETIVO DE DESARROLLO SOSTENIBLE </h4><hr>
		</div>
	</div>
	<div class="row row-sm">
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Objetivo de Desarrollo Sostenible de mayor impacto </h6>
					<br><hr><br>
					<div class="form-group" style="margin-bottom: 10px">
						{!! Form::select('objDesarSosten', $objDesarrolloSostenible, $ficha->id_ods, [ 'class'=>'form-control', 'required', 'onchange' => "changeInfo(this)", 'style' => "white-space: pre-line; height: fit-content;" ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-2">
			<div class="card custom-card size-fijo">
				<div class="card-body" style="text-align-last: center;">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> ODS </h6>
					<br><hr><br>
					<div id="odsImg" style="text-align-last: center; left: 5%; transform: translate(7,0%); position: inherit; width: fit-content; height: fit-content;">
						<img src = "/logos{!! $ficha->ods('logo') !!}" style = "height: 60%;">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Descripción del Objetivo de Desarrollo Sostenible </h6>
					<br><hr><br>
					<div class="textDesign" id="odsText">
						{!! $ficha->ods('descripcion_larga') !!}
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Meta relevante para gobiernos locales </h6>
					<br><hr><br>
					<div class="form-group" style="margin-bottom: 10px" id="metaDiv">
						{!! Form::select('meta', $metas, $ficha->id_meta, [ 'class'=>'form-control', 'placeholder'=>'Seleccionar...', 'style' => "white-space: pre-line; height: fit-content;" ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br><br>

	<div class="col-md-12 row">
		<div class="col-md-12 text-center">
			<h4> PROGRAMA PRESUPUESTARIO </h4><hr>
		</div>
	</div>
	<div class="row row-sm">
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Nombre del Programa Presupuestario </h6>
					<br><hr><br>
					<div class="form-group" style="margin-bottom: 10px">
						{!! Form::select('nombreProgramaPresupuest', [ '1' => 'Capital Segura con Equidad de Género', '2' => 'Cultura, Turismo, Deporte y Bienestar Social en la Capital', '3' => 'Capital Sostenible', '4' => 'Capital Confiable e Innovadora', '5' => 'Capital Competitiva' ], $ficha->programa_presupuestario, [ 'class'=>'form-control', 'required', 'placeholder'=>'Seleccionar programa...', 'onchange' => "changeInfo(this)", 'style' => "width: 85%" ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Objetivo del Programa Presupuestario </h6>
					<br><hr><br>
					<div class="textDesign" id="objProgramaPresupuest">
						{{ $ficha->objProgramaPresupuestario() }}
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Resultado Clave </h6>
					<br><hr><br>
					<div class="row row-sm">
						<div class="col-md">
							<div class="form-group" style="margin-bottom: 10px">
								{!! Form::textArea('resultClave', $ficha->resultado, ['class'=>'form-control', 'required', 'rows'=>'3', 'maxlength' => 200 ]) !!}
								<i class="form-group__bar"></i>
							</div>
						</div>
						<div class="col-md textDesign">
							El resultado que debe ocurrir para considerar que el objetivo del programa se ha alcanzado de manera satisfactoria.
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>

	<div class="row">
		<div class="col-md-12 text-center" style="background-color:#eee;">
			<h4> DATOS DE IDENTIFICACIÓN DEL INDICADOR </h4>
		</div>
	</div>

	<br>

	<div class="row row-sm">
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Clave </h6>
					<hr>
					<div class="textDesign">
						La forma alfanumérica determinada para el Presupuesto de Egresos, apartado de indicadores, del ejercicio que corresponda.
					</div><br><br>
					<div class="form-group" style="margin-bottom: 10px">
						{!! Form::text('clave', $ficha->clave, ['class'=>'form-control', 'required', 'maxlength' => 50 ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Nombre del indicador </h6>
					<hr>
					<div class="textDesign">
						Enunciado breve con el cual se denomina el algoritmo empleado para evaluar el cumplimiento de un resultado clave, pudiendo ser este un índice, tasa, razón o proporción.
					</div><br><br>
					<div class="form-group" style="margin-bottom: 10px">
						{!! Form::text('nombreIndicador', $ficha->nombre_indicador, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba el nombre', 'maxlength' => 100 ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Nombre del responsable de llenado </h6>
					<hr> <br>
					<div class="form-group" style="margin-bottom: 10px">
						{!! Form::text('nameResponsable', $ficha->nombre_responsable, ['class'=>'form-control', 'required', 'placeholder'=>'Ingresar nombre', 'maxlength' => 100 ]) !!}
						<i class="form-group__bar"></i> <br>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>

	<div class="row row-sm">
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<table class="table-borderless table-condensed table-hover" style="width: 95%">
						<thead style="background: transparent;">
							<tr>
								<th> <h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Tipo de Indicador </h6> </th>
								<th> <h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Descripción del tipo de indicador </h6> </th>
							</tr>
						</thead>
					</table>
					<br><hr><br>
					<table class="table-borderless table-condensed table-hover" style="width: 95%">
						<tbody>
							<tr>
								<td style="text-align: -webkit-center; padding-bottom: 1em; width: 35%;">
									<div class="form-group" style="margin-bottom: 10px">
										{!! Form::select('indicador', $indicadores, $ficha->indicador('id', 1), [ 'class'=>'form-control', 'required', 'placeholder'=>'Seleccionar...', 'onchange' => "changeInfo(this)", 'style' => "width: 85%" ]) !!}
										<i class="form-group__bar"></i>
									</div>
								</td>
								<td class="textDesign" id="indicadorText" style="padding-bottom: 1em;">
									{!! $ficha->indicador('descripcion', 1) !!}
								</td>
							</tr>
							<tr style="height: 2em;"> <td colspan="4"></td> </tr>
							<tr>
								<td style="text-align: -webkit-center;">
									<div class="form-group" style="margin-bottom: 10px" id="indicador2Div">
										{!! Form::select('indicador2', $indicadores2, $ficha->id_tipo_indicador, [ 'class'=>'form-control', 'placeholder'=>'Seleccionar...', 'onchange' => "changeInfo(this)", 'style' => "width: 85%" ]) !!}
										<i class="form-group__bar"></i>
									</div>
								</td>
								<td class="textDesign" id="indicador2Text">
									{!! $ficha->indicador('descripcion', 2)!!}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<table class="table-borderless table-condensed table-hover" style="width: 95%">
						<thead style="background: transparent;">
							<tr>
								<th> <h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Dimensión </h6> </th>
								<th> <h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Descripción de la dimensión </h6> </th>
							</tr>
						</thead>
					</table>
					<br><hr><br>
					<table class="table-borderless table-condensed table-hover" style="width: 95%">
						<tbody>
							<tr>
								<td style="text-align: -webkit-center; padding-bottom: 1em; width: 35%;">
									<div class="form-group" style="margin-bottom: 10px">
										{!! Form::select('dimension', $dimension, $ficha->dimension('id_categ_dimension', 2), [ 'class'=>'form-control', 'required', 'onchange' => "changeInfo(this)", 'style' => "width: 85%" ]) !!}
										<i class="form-group__bar"></i>
									</div>
								</td>
								<td class="textDesign" id="dimensionText" style="padding-bottom: 1em;">
									{!! $ficha->dimension('descripcion', 1) !!}
								</td>
							</tr>
							<tr style="height: 2em;"> <td colspan="2"></td> </tr>
							<tr>
								<td style="text-align: -webkit-center;">
									<div class="form-group" style="margin-bottom: 10px" id="dimension2Div">
										{!! Form::select('dimension2', $dimension2, $ficha->id_dimension_indicador, [ 'class'=>'form-control', 'onchange' => "changeInfo(this)", 'style' => "width: 85%" ]) !!}
										<i class="form-group__bar"></i>
									</div>
								</td>
								<td class="textDesign" id="dimension2Text">
									{!! $ficha->dimension('descripcion', 2) !!}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Unidad de Medida </h6>
					<br><hr><br>
					<div class="textDesign">
						La forma en que se expresa el resultado de la aplicación del indicador.
						<div class="listgroup-example2">
							<ul class="list-group">
								<li>
									<ul class="list-style-disc">
										<li> En las proporciones e índices de variación proporcional la unidad de medida siempre es porcentaje. </li>
										<li> En las razones y las tasas, la unidad de medida del numerador suele ser la misma que la que se expresa el indicador. </li>
									</ul>
								</li>
							</ul>
						</div>
					</div><br>
					<div class="form-group" style="margin-bottom: 10px">
						{!! Form::text('unidad_medida', $ficha->unidad_medida, ['class'=>'form-control', 'required', 'maxlength' => 10 ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>

	<div class="row row-sm">
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body" style="text-align: -webkit-center;">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Frecuencia de evaluación </h6>
					<br><hr><br>
					<div class="textDesign">
						Es el periodo de tiempo en el cual se calcula el indicador. <br> Con fines de estandarización, la evaluación de los indicadores será TRIMESTRAL.
					</div><br>
					<div class="textDesign text-center" style="width: 30%;">
						Trimestral
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Calendarización de evaluación del Indicador </h6>
					<br><hr><br>
					<table class="table-borderless table-condensed table-hover" style="width: 95%">
						<tbody>
							<tr>
								<td> <div class="textDesign text-center" style="width: 90%;"> Ene-Mar </div> </td>
								<td> <div class="textDesign text-center" style="width: 90%;"> Abr-Jun </div> </td>
								<td> <div class="textDesign text-center" style="width: 90%;"> Jul-Sep </div> </td>
								<td> <div class="textDesign text-center" style="width: 90%;"> Oct-Dic </div> </td>
							</tr>
							<tr style="height: 2.7em;"> <td colspan="2"></td> </tr>
							<tr>
								<td> <div class="textDesign text-center" style="width: 90%; background: rgb(251 249 249); text-shadow: unset;"> Reporte del 1 al 10 de abril </div> </td>
								<td> <div class="textDesign text-center" style="width: 90%; background: rgb(251 249 249); text-shadow: unset;"> Reporte del 1 al 10 de julio </div> </td>
								<td> <div class="textDesign text-center" style="width: 90%; background: rgb(251 249 249); text-shadow: unset;"> Reporte del 1 al 10 de octubre </div> </td>
								<td> <div class="textDesign text-center" style="width: 90%; background: rgb(251 249 249); text-shadow: unset;"> Reporte del 1 al 10 de enero </div> </td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Línea Base </h6>
					<hr> <br><br>
					<div class="row row-sm">
						<div class="col-2 textDesign text-center" style="place-self: center;">
							<b> 2021 </b>
						</div>
						<div class="col-10">
							<div class="form-group" style="margin-bottom: 10px">
								{!! Form::textArea('lineaBase', $ficha->linea_base, ['class'=>'form-control', 'required', 'rows'=>'5', 'maxlength' => 200 ]) !!}
								<i class="form-group__bar"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>

	<section id = "fuenteInfoVariable"></section>

	<div class="row row-sm">
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body" style="text-align: -webkit-center;">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Sentido del Indicador </h6>
					<br><hr><br>
					<div class="textDesign">
						Establece si el indicador tiene un comportamiento ascendente, descendente, regular o niminal a lo largo del tiempo.
					</div><br><br>
					<table class="table-borderless table-condensed table-hover" style="width: 95%">
						<tbody>
							<tr>
								<td style="text-align: -webkit-center; width: 35%;">
									<div class="form-group" style="margin-bottom: 10px">
										{!! Form::select('sentidoIndicador', [ '1' => '1. Ascendente', '2' => '2. Descendente', '3' => '3. Regular', '4' => '4. Nominal' ], $ficha->id_sentido_indicador, [ 'class'=>'form-control', 'required', 'onchange' => "changeInfo(this)", 'style' => "width: 85%" ]) !!}
										<i class="form-group__bar"></i>
									</div>
								</td>
								<td class="textDesign" id="sentidoIndicadorText">
									{!! $ficha->sentidoIndicador('descripcion') !!}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Fórmula </h6>
					<br><hr><br>
					<div class="textDesign">
						La relación cuantitativa del indicador, expresada a través de una ecuación que involucra el uso de dos o más variables. <br> Es el método de cálculo del indicador.
					</div><br>
					<div class="form-group" style="margin-bottom: 10px">
						{!! Form::text('formula', $ficha->formula, ['class'=>'form-control', 'required', 'maxlength' => 100 ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Descripción </h6>
					<br><hr><br>
					<div class="textDesign">
						Breve explicación de lo que representa el resultado obtenido de la aplicación de la fórmula del indicador. Debe especificar lo que se espera medir del objetivo al que está asociado, debe ayudar a entender la utilidad o uso del indicador.
					</div><br>
					<div class="form-group" style="margin-bottom: 10px">
						{!! Form::textArea('descripcion', $ficha->descripcion, ['class'=>'form-control', 'required', 'rows'=>'3', 'maxlength' => 200 ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>

	<section id = "semaforoSection"></section>

	<div class="row row-sm">
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body" style="text-align: -webkit-center;">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Nombre de la variable </h6>
					<br><hr><br>
					<div class="textDesign">
						El factor o elemento que interviene en la fórmula del indicador.
					</div><br><br><br>
					<div class="form-group" style="margin-bottom: 10px">
						{!! Form::text('variable', $ficha->variable, ['class'=>'form-control', 'required', 'maxlength' => 50 ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Descripción de la variable </h6>
					<br><hr><br>
					<div class="textDesign">
						Explicación del elemento que interviene en la fórmula del indicador, lo que entendemos y acotamos al escribir esa variable.
					</div><br>
					<div class="form-group" style="margin-bottom: 10px">
						{!! Form::textArea('descVariable', $ficha->descripcion_variable, ['class'=>'form-control', 'required', 'rows'=>'3', 'maxlength' => 200 ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Fuente de información </h6>
					<br><hr><br>
					<div class="textDesign">
						El origen de donde se alimentarán las variables del indicador. Deberán ser siempre las mismas, lo que nos permitirá hacer comparaciones del indicador en el tiempo.
					</div>
					<table class="table-borderless table-condensed table-hover" style="width: 100%" id="fuenteInfoFocus">
						<tbody>
							<tr style="height: 1em;"></tr>
							<tr>
								<td width="5%"> </td>
								<td>
									<b style="color: #cdd6df; padding-left: 1em;"> Seleccionar...</b>
									<div class="form-group" style="margin-bottom: 10px">
										<div class="selectgroup selectgroup-pills">
											<label class="selectgroup-item ">
												<input type="checkbox" name="fuente_info[0]" value="1" class="selectgroup-input" @if( strpos($ficha->fuentes_info, 1) !== false ) checked @endif>
												<span class="selectgroup-button">1. Documento digital</span>
											</label><br>
											<label class="selectgroup-item">
												<input type="checkbox" name="fuente_info[1]" value="2" class="selectgroup-input" @if( strpos($ficha->fuentes_info, 2) !== false ) checked @endif>
												<span class="selectgroup-button">2. Sistema</span>
											</label><br>
											<label class="selectgroup-item">
												<input type="checkbox" name="fuente_info[2]" value="3" class="selectgroup-input" @if( strpos($ficha->fuentes_info, 3) !== false ) checked @endif>
												<span class="selectgroup-button">3. Archivo físico</span>
											</label>
										</div>
										<i class="form-group__bar"></i>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<br>

	<div class="row row-sm">
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body" style="text-align: -webkit-center;">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Meta Trimestral del Indicador </h6>
					<br><hr><br><br>
					<div class="textDesign">
						El factor o elemento que interviene en la fórmula del indicador.
					</div><br><br><br>
					<table width="100%">
	            		<thead>
	            			<tr>
	            				<th width="10%">Trimestre</th>
	            				<th></th>
	            			</tr>
	            		</thead>
	            		<tbody>
	            			<tr>
	            				<th class="text-center">1</th>
	            				<td>
									<div class="form-group" style="margin-bottom: 10px">
					              		{!! Form::text('meta_trimestral1', $ficha->meta_trimestral1, ['class'=>'form-control', 'required', 'placeholder'=>'Escribir meta', 'maxlength' => 50 ]) !!}
						              	<i class="form-group__bar"></i>
									</div>
	            				</td>
	            			</tr>
	            			<tr>
	            				<th class="text-center">2</th>
	            				<td>
									<div class="form-group" style="margin-bottom: 10px">
					              		{!! Form::text('meta_trimestral2', $ficha->meta_trimestral2, ['class'=>'form-control', 'required', 'placeholder'=>'Escribir meta', 'maxlength' => 50 ]) !!}
						              	<i class="form-group__bar"></i>
									</div>
	            				</td>
	            			</tr>
	            			<tr>
	            				<th class="text-center">3</th>
	            				<td>
									<div class="form-group" style="margin-bottom: 10px">
					              		{!! Form::text('meta_trimestral3', $ficha->meta_trimestral3, ['class'=>'form-control', 'required', 'placeholder'=>'Escribir meta', 'maxlength' => 50 ]) !!}
						              	<i class="form-group__bar"></i>
									</div>
	            				</td>
	            			</tr>
	            			<tr>
	            				<th class="text-center">4</th>
	            				<td>
									<div class="form-group" style="margin-bottom: 10px">
					              		{!! Form::text('meta_trimestral4', $ficha->meta_trimestral4, ['class'=>'form-control', 'required', 'placeholder'=>'Escribir meta', 'maxlength' => 50 ]) !!}
						              	<i class="form-group__bar"></i>
									</div>
	            				</td>
	            			</tr>
	            		</tbody>
	            	</table>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Rango de Semaforización </h6>
					<br><hr><br>
					<div class="textDesign row row-sm">
						<div class="col-md">
							<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Límite inferior </h6>
							Es el valor mínimo aceptable que puede tener el indicador.
						</div>
						<div class="col-md">
							<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Límite Superior </h6>
							Es el valor máximo aceptable que puede tener el indicador.
						</div>
					</div><br>
					<div class="row row-sm">
			 			<div class="col-md">
			 				<label for="rangeSemaforo">Valor 1</label>
					 		<div class="form-group" style="margin-bottom: 10px">
					 			{!! Form::number('rangeSemaforo', $ficha->valor1_semaforo, ['class'=>'form-control ', 'required', 'min' => 1, 'step' => 0.5, 'onchange' => 'document.getElementsByName("rangeSemaforo2")[0].min = parseInt(this.value)+1' ]) !!}
					 			<span class="validity"></span>
					 			<i class="form-group__bar"></i>
					 		</div>
			 			</div>
			 			<!--div style="width: 5em;"></div-->
			 			<div class="col-md">
			 				<label for="rangeSemaforo2">Valor 2</label>
					 		<div class="form-group" style="margin-bottom: 10px">
					 			{!! Form::number('rangeSemaforo2', $ficha->valor2_semaforo, ['class'=>'form-control ', 'required', 'min' => $ficha->valor1_semaforo+1, 'step' => 0.5, 'onchange' => 'document.getElementsByName("metaSemaforo")[0].min = parseInt(this.value)+1' ]) !!}
					 			<span class="validity"></span>
					 			<i class="form-group__bar"></i>
					 		</div>
			 			</div>
			 		</div><br>
			 		<div class="row row-sm">
			 			<div class="col-md"></div>
			 			<div class="col-md">
			 				<label for="metaSemaforo">Meta</label>
					 		<div class="form-group" style="margin-bottom: 10px">
					 			{!! Form::number('metaSemaforo', $ficha->meta_semaforo, ['class'=>'form-control ', 'required', 'min' => $ficha->valor2_semaforo+1, 'step' => 1 ]) !!}
					 			<span class="validity"></span>
					 			<i class="form-group__bar"></i>
					 		</div>
			 			</div>
			 			<div class="col-md"></div>
			 		</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Semaforización </h6>
					<br><hr><br>
					<div class="textDesign">
						Si el valor del indicador se encuentra dentro del rango de aceptación, se pondrá VERDE, el valor alcanzado del indicador es menor o mayor que la meta programada pero se mantiene dentro del rango establecio estará en AMARILLO, en caso de que esté muy lejos de los límites se pondrá en ROJO.
					</div><br><br>
					<div style="text-align-last: center;">
						<table class="table-borderless table-condensed table-hover" style="width: 100%" id="semaforoFocus">
							<tbody>
								<tr>
									<td>
										<div class="form-group" style="margin-bottom: 10px; text-align: center;">
											<input id="showPaletteOnly" type="text" name="semaforo">
											<i class="form-group__bar"></i>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>

	<div class="row">
		<div class="col-md-12 text-center" style="background-color:#eee;">
			<h4> GLOSARIO </h4>
		</div>
	</div>

	<br>

	<div class="row row-sm">
		<div class="col-md" style="text-align: -webkit-center;">
			<div class="card custom-card size-fijo" style="width: 80%;">
				<div class="card-body">
					<div class="form-group" style="margin-bottom: 10px;">
						{!! Form::textArea('glosario', $ficha->glosario, ['class'=>'form-control', 'placeholder'=>'Ingrese texto...', 'rows'=>'7', 'maxlength' => 500 ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>

	<div class="row">
		<div class="col-md-12 text-center" style="background-color:#eee;">
			<h4> OBSERVACIONES </h4>
		</div>
	</div>

	<br>

	<div class="row row-sm">
		<div class="col-md" style="text-align: -webkit-center;">
			<div class="card custom-card size-fijo" style="width: 80%;">
				<div class="card-body">
					<div class="form-group" style="margin-bottom: 10px;">
						{!! Form::textArea('observaciones', $ficha->observaciones, ['class'=>'form-control', 'placeholder'=>'Ingrese texto...', 'rows'=>'7', 'maxlength' => 500 ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>

	<div class="row">
		<div class="col-md-12 text-center" style="background-color:#eee;">
			<h4> RESPONSABLES DE LA INFORMACIÓN </h4>
		</div>
	</div>

	<br>

	<div class="row row-sm">
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Nombre del enlace institucional </h6>
					<br><hr><br>
					<div class="form-group" style="margin-bottom: 10px">
						{!! Form::text('name_enlaceInst', $ficha->nombre_enlace_institucion, ['class'=>'form-control', 'required', 'maxlength' => 100 ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Cargo del enlace institucional </h6>
					<br><hr><br>
					<div class="form-group" style="margin-bottom: 10px">
						{!! Form::text('cargo_enlaceInst', $ficha->cargo_enlace_institucion, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba el cargo', 'maxlength' => 100 ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>

	<div class="row row-sm">
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Nombre del titular de la unidad responsable </h6>
					<br><hr><br>
					<div class="form-group" style="margin-bottom: 10px">
						{!! Form::text('name_titularUnitResp', $ficha->nombre_titular, ['class'=>'form-control', 'required', 'maxlength' => 100 ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Cargo del titular de la unidad responsable </h6>
					<br><hr><br>
					<div class="form-group" style="margin-bottom: 10px">
						{!! Form::text('cargo_titularUnitResp', $ficha->cargo_titular, ['class'=>'form-control', 'required', 'maxlength' => 100 ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>

	<div class="row">
		<div class="col-md-12 text-center" style="background-color:#eee;">
			<h4> CUESTIONARIO DE VALIDACIÓN DEL INDICADOR </h4>
		</div>
	</div>

	<br>

	<div class="row row-sm">
		<div class="col-md"> </div>
		<div class="col-md-5">
			<div class="card custom-card size-fijo">
				<div class="card-body" id="cuestionarioFocus">
					<div class="textDesign">
						Para revisar que el indicador cumpla con todos los elementos requeridos, verifique que cumpla con las siguientes condiciones:
					</div><br>
					<div class="form-group" style="margin-bottom: 10px">
						<div class="parsley-checkbox mg-b-0" id="cbWrapper2">
							@foreach ( $ficha->cuestionario('sentence') as $key => $sentence )
								<label class="ckbox mg-b-5-f">
									<input name="validacionIndicador[]" type="checkbox" value="{!! $key !!}" @if( $ficha->cuestionario( $sentence[0] ) ) checked @endif>
									<span>{!! $sentence !!}</span>
								</label> @if( !$loop->last ) <br> @endif
							@endforeach
						</div>
					</div>
					<i class="form-group__bar"></i>
				</div>
			</div>
		</div>
		<div class="col-md"> </div>
	</div>

	<br>



	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 text-center">
			<br>
			<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
			<a class="btn btn-secondary" href="{{url('/indexFichaIndicadores')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
		</div>
	</div>

	<!-- Internal Jquery.maskedinput js-->
	<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>

	<!-- Internal Specturm-colorpicker js-->
	<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>

	<script type="text/javascript">
		// var BASE_URL = window.location.protocol + "//" + window.location.host+ "/";

		$(function () {
			$('#showPaletteOnly').spectrum({
				preferredFormat: "hex",
				showPaletteOnly: true,
				showPalette: true,
				color: '{!! $ficha->semaforo() !!}' ,
	            palette: ['#28a745', '#ffc107', '#dc3545'] // 1 -> rojo;   2 -> amarillo;  3 -> verde (comienzan en verde)
	   		}); // Fc-datepicker
			$('#showPaletteOnly').val( '{{$ficha->semaforo()}}' );
		});

		function changeInfo(info){
			$.get(BASE_URL + "getInfoFichaIndicador", {'name': info.name, 'id': document.getElementsByName(info.name)[0].value}, function (respuesta) {
				for(var i = 0; i < respuesta.length; i++)
					if( i%2 == 0 ){
						$('#' + respuesta[i]).empty();
						$('#' + respuesta[i]).append(respuesta[i+1]);
					}
				});
		}

		function validar(){
			if( !document.getElementsByName('fuente_info[0]')[0].checked && !document.getElementsByName('fuente_info[1]')[0].checked && !document.getElementsByName('fuente_info[2]')[0].checked ){
				window.location.href = '#fuenteInfoVariable';
				notificacion("Alerta","Falta seleccionar alguna fuente de información.","warning");

				let interVal = setInterval("blink('fuenteInfoFocus')",200);
				setTimeout(function (argument) {
					clearInterval(interVal);
					$('#fuenteInfoFocus').css('box-shadow', 'none');
				},10000);

				return false;
			}

			var cuestionario = false;
			document.getElementsByName('validacionIndicador[]').forEach(function(elemento) {
				if( elemento.checked ){
					cuestionario = true;
				   	//break;
				   }
				});
			if ( !cuestionario ) {
				notificacion("Alerta","Falta completar el cuestionario de validación.","warning");
				let interVal = setInterval("blink('cuestionarioFocus')",200);
				setTimeout(function (argument) {
					clearInterval(interVal);
					$('#cuestionarioFocus').css('box-shadow', 'none');
				},10000);
				return false;
			}
		}

		function blink( focus ){
			var color="#FF00FF,#FF00CC,#FF0099,#FF0066,#FF0033,#FF0000";
			color=color.split(",");
			$( '#' + focus ).css('box-shadow', '0 0 20px '+color[parseInt(Math.random()*color.length)]);
		}

	</script>

	<!-- Internal Ion-rangeslider js-->
	<script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
@endsection
