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
			height: 100%;
			min-height: 25%;
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

   {!! Form::model( @$indicadores, ['route' =>[ 'storeFichaIndicadores' ], 'method' => ( 'POST'), 'class' =>'form-horizontal', 'id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data", 'onsubmit'=>"return validar();" ]) !!}

	<div class="row">
		<br>
		<div class="col-md-12 text-center" style="background-color:#eee;">
			<h4> Ficha Técnica de Indicadores <b style="float: right;"> {!! date('d-m-Y') !!} </b> </h4>
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
								{!! Form::select('dependencia', $dependencias, null, ['class'=>'form-control', 'required', 'placeholder' => 'Seleccionar...', 'onchange' => "changeInfo(this)" ]) !!}
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
							<div class="form-group" style="margin-bottom: 10px">
								<div class="form-group" style="margin-bottom: 10px" id="unidadDiv">
									{!! Form::select('unidad', [], null, ['id' => 'unidad', 'class'=>'form-control','placeholder'=>'Seleccionar...' ]) !!}
									<i class="form-group__bar"></i>
								</div>
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
						{!! Form::select('eje_estrategico', $ejesEstrategicos, null, [ 'class'=>'form-control', 'required', 'placeholder'=>'Seleccionar...', 'onchange' => "changeInfo(this)" ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
		 <div class="col-md-2">
			 <div class="card custom-card size-fijo">
				<div class="card-body" id="eje_estrategicoImg" style="text-align-last: center; max-height: 15em; top: 2em;"></div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Objetivo dentro del eje estratégico al que contribuye del Plan </h6>
					<br><hr><br>
					<div class="textDesign" id="objetivoEjeEstrategico"> </div>
				</div>
			</div>
		</div>
		<div class="col-md">
			 <div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Estrategia general del eje estratégico al que contribuye del Plan </h6>
					<br><hr><br>
					<div class="textDesign" id="estrategiaEjeEstrategico"> </div>
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
						{!! Form::select('eje_transversal', $ejesTransversales, null, [ 'class'=>'form-control', 'required', 'placeholder'=>'Seleccionar...', 'onchange' => "changeInfo(this)" ]) !!}
						<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
		 <div class="col-md-2">
			 <div class="card custom-card size-fijo">
				<div class="card-body" id="eje_transvImg" style="text-align-last: center; top: 50%; left: 50%; transform: translate(-50%,-50%); position: inherit; width: fit-content; height: fit-content;"> </div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Objetivo dentro del eje transversal al que contribuye del Plan </h6>
					<br><hr><br>
					<div class="textDesign" id="objetivoEjeTransversal"> </div>
				</div>
			</div>
		</div>
		<!--div class="col-md"> </div-->
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
						{!! Form::select('progEjeEstrat', [], null, [ 'class'=>'form-control', 'placeholder'=>'Seleccionar...', 'onchange' => "changeInfo(this)" ]) !!}
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
					<div class="textDesign" id="objetivoEspecificoProgram"></div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Estrategia específica del programa al que contribuye del Plan </h6>
					<br><hr><br>
					<div class="textDesign" id="estratEspecificaProgram"> </div>
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
						{!! Form::select('objDesarSosten', $objDesarrolloSostenible, null, [ 'class'=>'form-control', 'required', 'placeholder'=>'Seleccionar...', 'onchange' => "changeInfo(this)", 'style' => "white-space: pre-line; height: fit-content;" ]) !!}
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
					<div id="odsImg" style="text-align-last: left: 5%; transform: translate(7%,0%); position: inherit; width: fit-content; height: fit-content;"> </div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Descripción del Objetivo de Desarrollo Sostenible </h6>
					<br><hr><br>
					<div class="textDesign" id="odsText"> </div>
				</div>
			</div>
		</div>
		<div class="col-md">
			 <div class="card custom-card size-fijo">
				<div class="card-body">
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Meta relevante para gobiernos locales </h6>
					<br><hr><br>
					<div class="form-group" style="margin-bottom: 10px" id="metaDiv">
						{!! Form::select('meta', [], null, [ 'class'=>'form-control', 'placeholder'=>'Seleccionar...' ]) !!}
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
	              		{!! Form::select('nombreProgramaPresupuest', [ '1' => 'Capital Segura con Equidad de Género', '2' => 'Cultura, Turismo, Deporte y Bienestar Social en la Capital', '3' => 'Capital Sostenible', '4' => 'Capital Confiable e Innovadora', '5' => 'Capital Competitiva' ], null, [ 'class'=>'form-control', 'required', 'placeholder'=>'Seleccionar programa...', 'onchange' => "changeInfo(this)", 'style' => "width: 85%" ]) !!}
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
					<div class="textDesign" id="objProgramaPresupuest"></div>
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
			              	{!! Form::textArea('resultClave', null, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba el resultado', 'rows'=>'3', 'maxlength' => 200 ]) !!}
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

	<br><br><br>

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
	              	{!! Form::text('clave', null, ['class'=>'form-control', 'required', 'placeholder'=>'Ingresar clave', 'maxlength' => 50 ]) !!}
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
		              	{!! Form::text('nombreIndicador', null, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba el nombre', 'maxlength' => 100 ]) !!}
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
	              	{!! Form::text('nameResponsable', null, ['class'=>'form-control', 'required', 'placeholder'=>'Ingresar nombre', 'maxlength' => 100 ]) !!}
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
										{!! Form::select('indicador', $tipoIndicador, null, [ 'class'=>'form-control', 'required', 'placeholder'=>'Seleccionar...', 'onchange' => "changeInfo(this)", 'style' => "width: 85%" ]) !!}
										<i class="form-group__bar"></i>
									</div>
								</td>
								<td class="textDesign" id="indicadorText" style="padding-bottom: 1em;"> </td>
							</tr>
							<tr style="height: 2em;"> <td colspan="4"></td> </tr>
							<tr>
								<td style="text-align: -webkit-center;">
									<div class="form-group" style="margin-bottom: 10px" id="indicador2Div">
										{!! Form::select('indicador2', [], null, [ 'class'=>'form-control', 'placeholder'=>'Seleccionar...', 'onchange' => "changeInfo(this)", 'style' => "width: 85%" ]) !!}
										<i class="form-group__bar"></i>
									</div>
								</td>
								<td class="textDesign" id="indicador2Text"> </td>
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
										{!! Form::select('dimension', $dimension, null, [ 'class'=>'form-control', 'required', 'placeholder'=>'Seleccionar...', 'onchange' => "changeInfo(this)", 'style' => "width: 85%" ]) !!}
										<i class="form-group__bar"></i>
									</div>
								</td>
								<td class="textDesign" id="dimensionText" style="padding-bottom: 1em;"> </td>
							</tr>
							<tr style="height: 2em;"> <td colspan="2"></td> </tr>
							<tr>
								<td style="text-align: -webkit-center;">
									<div class="form-group" style="margin-bottom: 10px" id="dimension2Div">
										{!! Form::select('dimension2', [], null, [ 'class'=>'form-control', 'placeholder'=>'Seleccionar...', 'onchange' => "changeInfo(this)", 'style' => "width: 85%" ]) !!}
										<i class="form-group__bar"></i>
									</div>
								</td>
								<td class="textDesign" id="dimension2Text"> </td>
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
	              		{!! Form::text('unidad_medida', null, ['class'=>'form-control', 'required', 'placeholder'=>'Ingresar unidad', 'maxlength' => 10 ]) !!}
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
				              	{!! Form::textArea('lineaBase', null, ['class'=>'form-control', 'required', 'rows'=>'5', 'placeholder'=>'Ingresar..', 'maxlength' => 200 ]) !!}
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
										{!! Form::select('sentidoIndicador', [ '1' => '1. Ascendente', '2' => '2. Descendente', '3' => '3. Regular', '4' => '4. Nominal' ], null, [ 'class'=>'form-control', 'required', 'placeholder'=>'Seleccionar...', 'onchange' => "changeInfo(this)", 'style' => "width: 85%" ]) !!}
										<i class="form-group__bar"></i>
									</div>
								</td>
								<td class="textDesign" id="sentidoIndicadorText"> </td>
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
	              		{!! Form::text('formula', null, ['class'=>'form-control', 'required', 'placeholder'=>'Ingresar fórmula', 'maxlength' => 100 ]) !!}
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
		            	{!! Form::textArea('descripcion', null, ['class'=>'form-control', 'required', 'rows'=>'3', 'placeholder'=>'Escribir descripción', 'maxlength' => 200 ]) !!}
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
					<h6 class="tx-16 tx-inverse tx-semibold mg-b-0 text-center"> Nombre de la variable	 </h6>
					<br><hr><br>
					<div class="textDesign">
	               		El factor o elemento que interviene en la fórmula del indicador.
	            	</div><br><br><br>
					<div class="form-group" style="margin-bottom: 10px">
	              		{!! Form::text('variable', null, ['class'=>'form-control', 'required', 'placeholder'=>'Ingresar variable', 'maxlength' => 50 ]) !!}
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
		            	{!! Form::textArea('descVariable', null, ['class'=>'form-control', 'required', 'rows'=>'3', 'placeholder'=>'Escribir descripción', 'maxlength' => 200 ]) !!}
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
													<input type="checkbox" name="fuente_info[0]" value="1" class="selectgroup-input">
													<span class="selectgroup-button">1. Documento digital</span>
												</label><br>
												<label class="selectgroup-item">
													<input type="checkbox" name="fuente_info[1]" value="2" class="selectgroup-input">
													<span class="selectgroup-button">2. Sistema</span>
												</label><br>
												<label class="selectgroup-item">
													<input type="checkbox" name="fuente_info[2]" value="3" class="selectgroup-input">
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
		            </div><br>
	            	<table width="100%">
	            		<thead>
	            			<tr>
	            				<th width="10%">Trimestre</th>
	            				<th></th>
	            			</tr>
	            		</thead>
	            		<tbody>
	            			@for( $i=0; $i<4; $i++ )
		            			<tr>
		            				<th class="text-center">{!! $i+1 !!}</th>
		            				<td>
										<div class="form-group" style="margin-bottom: 10px">
						              		{!! Form::text('meta_trimestral'.$i, null, ['class'=>'form-control', 'required', 'placeholder'=>'Escribir meta', 'maxlength' => 50 ]) !!}
							              	<i class="form-group__bar"></i>
										</div>
		            				</td>
		            			</tr>
							@endfor
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
					 			{!! Form::number('rangeSemaforo', null, ['class'=>'form-control ', 'required', 'min' => 1, 'step' => 0.5, 'onchange' => 'document.getElementsByName("rangeSemaforo2")[0].min = parseInt(this.value)+1' ]) !!}
					 			<span class="validity"></span>
					 			<i class="form-group__bar"></i>
					 		</div>
			 			</div>
			 			<!--div style="width: 5em;"></div-->
			 			<div class="col-md">
			 				<label for="rangeSemaforo2">Valor 2</label>
					 		<div class="form-group" style="margin-bottom: 10px">
					 			{!! Form::number('rangeSemaforo2', null, ['class'=>'form-control ', 'required', 'min' => 2, 'step' => 0.5, 'onchange' => 'document.getElementsByName("metaSemaforo")[0].min = parseInt(this.value)+1' ]) !!}
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
					 			{!! Form::number('metaSemaforo', null, ['class'=>'form-control ', 'required', 'min' => 3, 'step' => 1 ]) !!}
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

	<br><br><br>

	<div class="row">
		<div class="col-md-12 text-center" style="background-color:#eee;">
			<h4> GLOSARIO </h4>
		</div>
	</div>

	<div class="row row-sm">
		<div class="col-md" style="text-align: -webkit-center;">
			<div class="card custom-card size-fijo" style="width: 80%;">
				<div class="card-body">
					<div class="form-group" style="margin-bottom: 10px;">
						{!! Form::textArea('glosario', null, ['class'=>'form-control', 'placeholder'=>'Ingrese texto...', 'rows'=>'7', 'maxlength' => 500 ]) !!}
	              		<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br><br><br>

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
						{!! Form::textArea('observaciones', null, ['class'=>'form-control', 'placeholder'=>'Ingrese texto...', 'rows'=>'7', 'maxlength' => 500 ]) !!}
	              		<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br><br><br>

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
		              	{!! Form::text('name_enlaceInst', null, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba el nombre', 'maxlength' => 100 ]) !!}
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
		              	{!! Form::text('cargo_enlaceInst', null, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba el cargo', 'maxlength' => 100 ]) !!}
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
		              	{!! Form::text('name_titularUnitResp', null, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba el nombre', 'maxlength' => 100 ]) !!}
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
		              	{!! Form::text('cargo_titularUnitResp', null, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba el cargo', 'maxlength' => 100 ]) !!}
		              	<i class="form-group__bar"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br><br><br>

	<div class="row">
		<div class="col-md-12 text-center" style="background-color:#eee;">
			<h4> CUESTIONARIO DE VALIDACIÓN DEL INDICADOR </h4>
		</div>
	</div>

	<br>

	<div class="row row-sm">
		<div class="col-md"> </div>
		<div class="col-5">
			 <div class="card custom-card size-fijo">
				<div class="card-body" id="cuestionarioFocus">
					<div class="textDesign">
	               Para revisar que el indicador cumpla con todos los elementos requeridos, verifique que cumpla con las siguientes condiciones:
	            </div><br>
					<div class="form-group" style="margin-bottom: 10px">
						<div class="parsley-checkbox mg-b-0" id="cbWrapper2">
							<label class="ckbox mg-b-5-f">
								<input name="validacionIndicador[]" type="checkbox" value="1">
								<span>1. El indicador tienen claramente un producto relevante o estratégico con el cual se vincula y un objetivo asociado.</span>
							</label><br>
							<label class="ckbox mg-b-5-f">
								<input name="validacionIndicador[]" type="checkbox" value="2">
								<span>2. El indicador tiene claramente una meta o referente para ser medido su resultado.</span>
							</label><br>
							<label class="ckbox mg-b-5-f">
								<input name="validacionIndicador[]" type="checkbox" value="3">
								<span>3. El resultado del indicador explica de forma precisa y clara el grado de cumplimiento de la meta o el resultado es ambiguo.</span>
							</label><br>
							<label class="ckbox mg-b-5-f">
								<input name="validacionIndicador[]" type="checkbox" value="4">
								<span>4. Muestra o expresa el indicador de forma clara el resultado para poder ser analizado por el responsable.</span>
							</label><br>
							<label class="ckbox mg-b-5-f">
								<input name="validacionIndicador[]" type="checkbox" value="5">
								<span>5. Se ha definido la frecuencia de medición del indicador.</span>
							</label><br>
							<label class="ckbox mg-b-5-f">
								<input name="validacionIndicador[]" type="checkbox" value="6">
								<span>6. La unidad de medición es adecuada para la meta que se espera medir.</span>
							</label><br>
							<label class="ckbox mg-b-5-f">
								<input name="validacionIndicador[]" type="checkbox" value="7">
								<span>7. En la construcción del indicador han participado el enlace institucional y el titular de la unidad responsable.</span>
							</label><br>
							<label class="ckbox mg-b-5-f">
								<input name="validacionIndicador[]" type="checkbox" value="8">
								<span>8. Los indicadores han sido validados por la unidad responsable del desempeño del área o calidad institucional.</span>
							</label>
						</div><!-- parsley-checkbox -->
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
				color: '#fff' ,
	            palette: ['#28a745', '#ffc107', '#dc3545'] // 1 -> rojo;   2 -> amarillo;  3 -> verde (comienzan en verde)
	   		});
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

			if($('#showPaletteOnly').val() == ''){
				window.location.href = '#fuenteInfoVariable';
				notificacion("Alerta","Falta seleccionar un color para el semáforo.","warning");
				let interVal = setInterval("blink('semaforoFocus')",200);
				setTimeout(function (argument) {
					clearInterval(interVal);
					$('#semaforoFocus').css('box-shadow', 'none');
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
@endsection
