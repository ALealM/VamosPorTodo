@extends('layouts.app', ['activePage' => 'ecologia', 'mainPage' => 'ecologia'])
@section('title', 'Main page')

@section('content')
	<!-- InternalFileupload css-->
	<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>

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

		.bg-background2 {
			background-color: #01457c;
			background-size: cover;
			background-position: center;
		}

		.bg-background2:before {
			content: "";
			position: absolute;
			height: 100%;
			left: 0;
			right: 0;
			display: block;
			z-index: 1;
			top: 0;
			background: rgba(1, 69, 124, 0.87);
		}

		.bg-background2 .header-text {
			position: relative;
			z-index: 1;
		}

		.title{
			color: #fff;
			background-color: #2e6a99;

		}

		.title:hover, .title::placeholder { color: white; }

		.icons-list-item {
		    text-align: center;
		    display: flex;
		    align-items: baseline;
		    justify-content: start;
		    font-size: 1.4rem;
		    margin: 5px;
		}
	</style>

	{!! Form::model( @$ecologia, ['route' =>[ 'storeEcologia' ], 'method' => ( 'POST'), 'class' =>'form-horizontal', 'id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}

	<div class="row row-sm">
		<div class="col-md">
			<div class="card custom-card" style="background: #d9cfb7;">
				<div class="card-header">
					<div class="row">
						<div class="col-md-10">
							<div class="pt-0 card custom-card pt-7 bg-background2 card pb-7 border-0 overflow-hidden col-md-3" style="margin-top: 1px;">
								<div class="header-text mb-0">
									<div class="container-fluid p-5">
										<div class="form-group" style="margin-bottom: 10px">
											{!! Form::text('titulo', null, ['class'=>'form-control title', 'required', 'placeholder'=>'Escriba el título', 'maxlength' => 100, 'style' => 'text-transform: uppercase;' ]) !!}
											<i class="form-group__bar"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2" style="place-self: center; text-align: center;">
							<div class="row row-sm" style="place-content: center;">
								<h6 class="main-content-label mb-1">Semana del evento</h6>
							</div>
							<div class="row row-sm">
								<div class="col-md-6">
									<div>
										<p class="text-muted card-sub-title">Día Inicial</p>
									</div>
			                        <div class="form-group" style="margin-bottom: 10px">
			                            {!! Form::date('fecha_init', null,[ 'class'=>'form-control', 'required', 'id'=>'fecha_init', 'min' => '2000-01-01', 'style' => 'width: 100%;' ]) !!}<i class="form-group__bar"></i>
			                            <i class="form-group__bar"></i>
			                        </div>
			                    </div>
								<div class="col-md-6">
									<div>
										<p class="text-muted card-sub-title">Día Final</p>
									</div>
			                        <div class="form-group" style="margin-bottom: 10px">
			                            {!! Form::date('fecha_fin', null,[ 'class'=>'form-control', 'required', 'id'=>'fecha_fin', 'min' => '2000-01-01', 'style' => 'width: 100%;' ]) !!}<i class="form-group__bar"></i>
			                            <i class="form-group__bar"></i>
			                        </div>
			                    </div>
			                </div>
						</div>
					</div>
				</div>
				<div class="card-body" style="margin-bottom: -1em; margin-left: -1em;">
					<div class="row">
						<div class="col-md-5" style="background: #fff; padding-top: 1em;">
							<!-- Imagen Principal (left) -->
							<div class="row mb-4" style="justify-content: right;">
								<div class="col-sm-12 col-md-10">
									<input type="file" class="dropify" data-height="200" accept=".jpg, .png, image/jpeg, image/png" name="mainImage" required />
								</div>
							</div>

							<br><br>

							<div class="row row-sm">
								<div class="col-md-12">
									<div class="col-md-12 text-center">
										<h4> LISTA DE ACTIVIDADES <a  class="btn btn-success btn-sm text-white" style="color: green" data-toggle="tooltip" title="Agregar" onclick="addLine()"><i class="fa fa-plus-square fa-2x"></i></a> </h4><hr>
									</div>
									<div class="table-responsive">
										<table class="table-condensed table-hover" style="width: 100%" id="tablaActividades">
											<tbody>
												<tr>
													<td style="max-width: 2em;">
														<li class="icons-list-item">
															<i class="fa fa-arrow-right" data-toggle="tooltip" title="" data-original-title="fa fa-arrow-right"></i>
															&nbsp;&nbsp;&nbsp;
														</li>
													</td>
													<td>
														<div class="form-group" style="margin-bottom: 10px">

															{!! Form::text('actividades[]', null, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba actividad', 'maxlength' => 500, 'id' => 'actividad1' ]) !!}

															<i class="form-group__bar"></i>
														</div>
													</td>
													<td>
														<button class="btn btn-sm text-white" style="color: red; cursor: not-allowed" type="button" disabled>
															<i class="fa fa-minus-square"></i>
														</button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-5" style="background: #00467d; padding-top: 1em;">
							<div class="row row-sm">
								<div class="col-md-5">
									<div class="card custom-card" style="border: solid #fff thin; background: inherit; border-radius: 0;">
										<div class="card custom-card" style="background: #2892e5; margin-left: 2em; margin-bottom: -2em; border-radius: 0;">
											<div class="card-body">
						                        <div class="form-group" style="margin-bottom: 10px">
						                            {!! Form::textArea('card1',null,['class'=>'form-control ckeditor','required','rows'=>'10','id'=>'editor1']) !!}
						                            <i class="form-group__bar"></i>
						                            <script>
						                                var editor1 = CKEDITOR.replace('editor1', {
						                                	uiColor: '#2892e5',
						                                    height: 200,
						                                    removeButtons: 'PasteFromWord',
						                                    extraPlugins: ['editorplaceholder', 'notification'],
						                                    editorplaceholder: 'Inserte Texto...',
						                                    removeDialogTabs: 'image:advanced;link:advanced',
						                                    toolbar: [
															    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
															    { name: 'colors', items: [ 'TextColor' ] },
															    { name: 'styles', items: [ 'Font', 'FontSize' ] },
															    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo' ] },
															    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', '-', 'Strike', 'Subscript', 'Superscript' ] }
															]
						                                });

						                                editor1.on( 'required', function( evt ) {
														    editor1.showNotification( 'This field is required.', 'warning' );
														    editor1.focus();
														    evt.cancel();
														} );
						                            </script>
						                        </div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-1"></div>
								<div class="col-md-5">
									<div class="card custom-card" style="border: solid #fff thin; background: inherit; border-radius: 0;">
										<div class="card custom-card" style="background: #8fc4ef; margin-left: 2em; margin-bottom: -2em; border-radius: 0;">
											<div class="card-body">
						                        <div class="form-group" style="margin-bottom: 10px">
						                            {!! Form::textArea('card2',null,['class'=>'form-control ckeditor','required','rows'=>'10','id'=>'editor2']) !!}
						                            <i class="form-group__bar"></i>
						                            <script>
						                                var editor2 = CKEDITOR.replace('editor2', {
						                                	uiColor: '#8fc4ef',
						                                    height: 200,
						                                    removeButtons: 'PasteFromWord',
						                                    extraPlugins: 'editorplaceholder',
						                                    editorplaceholder: 'Inserte Texto...',
						                                    removeDialogTabs: 'image:advanced;link:advanced',
						                                    toolbar: [
															    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
															    { name: 'colors', items: [ 'TextColor' ] },
															    { name: 'styles', items: [ 'Font', 'FontSize' ] },
															    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo' ] },
															    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', '-', 'Strike', 'Subscript', 'Superscript' ] }
															]
						                                });

						                                editor2.on( 'required', function( evt ) {
														    editor2.showNotification( 'This field is required.', 'warning' );
														    editor2.focus();
														    evt.cancel();
														} );
						                            </script>
						                        </div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<br>

							<!-- Imagen Horizontal (right) -->
							<div class="row mb-4">
								<div class="col-sm-12 col-md-12">
									<input type="file" class="dropify" data-height="200" accept=".jpg, .png, image/jpeg, image/png" name="image2" required />
								</div>
							</div>

							<div class="row row-sm">
								<div class="col-md-6">
									<div class="form-group" style="margin-bottom: 10px">
										{!! Form::text('titulo_cards', null, ['class'=>'form-control title', 'placeholder'=>'Escriba el título (opcional)', 'maxlength' => 100, 'style' => 'max-width: 90%; text-transform: uppercase;' ]) !!}
										<i class="form-group__bar"></i>
									</div>
								</div>
							</div>

							<div class="row row-sm">
								<div class="col-md-5">
									<div class="row row-sm">
										<div class="col-md-12">
											<div class="card custom-card" style="border: solid #fff thin; background: inherit; border-radius: 0;">
												<div class="card custom-card" style="background: #2892e5; margin-left: 2em; margin-bottom: -2em; border-radius: 0;">
													<div class="card-body">
								                        <div class="form-group" style="margin-bottom: 10px">
								                            {!! Form::textArea('card3',null,['class'=>'form-control ckeditor','required','rows'=>'10','id'=>'editor3']) !!}
								                            <i class="form-group__bar"></i>
								                            <script>
								                                var editor3 = CKEDITOR.replace('editor3', {
						                                			uiColor: '#2892e5',
								                                    height: 200,
								                                    removeButtons: 'PasteFromWord',
								                                    extraPlugins: 'editorplaceholder',
								                                    editorplaceholder: 'Inserte Texto...',
								                                    removeDialogTabs: 'image:advanced;link:advanced',
								                                    toolbar: [
																	    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
																	    { name: 'colors', items: [ 'TextColor' ] },
																	    { name: 'styles', items: [ 'Font', 'FontSize' ] },
																	    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo' ] },
																	    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', '-', 'Strike', 'Subscript', 'Superscript' ] }
																	]
								                                });

								                                editor3.on( 'required', function( evt ) {
																    editor3.showNotification( 'This field is required.', 'warning' );
														    		editor3.focus();
																    evt.cancel();
																} );
								                            </script>
								                        </div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row row-sm">
										<div class="col-md-12">
											<div class="card custom-card" style="border: solid #fff thin; background: inherit; border-radius: 0;">
												<div class="card custom-card" style="background: #8fc4ef; margin-left: 2em; margin-bottom: -2em; border-radius: 0;">
													<div class="card-body">
								                        <div class="form-group" style="margin-bottom: 10px">
								                            {!! Form::textArea('card4',null,['class'=>'form-control ckeditor','required','rows'=>'10','id'=>'editor4']) !!}
								                            <i class="form-group__bar"></i>
								                            <script>
								                                editor4 = CKEDITOR.replace('editor4', {
						                                			uiColor: '#8fc4ef',
								                                    height: 200,
								                                    removeButtons: 'PasteFromWord',
								                                    extraPlugins: 'editorplaceholder',
								                                    editorplaceholder: 'Inserte Texto...',
								                                    removeDialogTabs: 'image:advanced;link:advanced',
								                                    toolbar: [
																	    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
																	    { name: 'colors', items: [ 'TextColor' ] },
																	    { name: 'styles', items: [ 'Font', 'FontSize' ] },
																	    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo' ] },
																	    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', '-', 'Strike', 'Subscript', 'Superscript' ] }
																	]
								                                });

								                                editor4.on( 'required', function( evt ) {
																    editor4.showNotification( 'This field is required.', 'warning' );
														    		editor4.focus();
																    evt.cancel();
																} );
								                            </script>
								                        </div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-1"></div>
								<div class="col-md-5" style="padding-top: 20em;">
									<!-- Imagen Vertical (right) -->
									<div class="row mb-4" style="justify-content: right;">
										<div class="col-sm-12 col-md-10">
											<input type="file" class="dropify" data-height="500" accept=".jpg, .png, image/jpeg, image/png" name="image3" required />
										</div>
									</div>
								</div>
							</div>
							<br><br>
						</div>

						<div class="col-md-2" style="writing-mode: vertical-rl; transform: rotate(180deg); padding-top: 3em;">
							<h1 style="color: #8c816f; font-weight: bold; font-family: system-ui;"> INFORME SEMANAL</h1>
							<!--h2 style="color: #8b806e; font-weight: bold;"></h2-->
							<h3 style="color: #c1b299; font-weight: bold;"> DIRECCIÓN DE GESTIÓN ECOLÓGICA Y MANEJO DE RESIDUOS </h3>
						</div>
					</div>
				</div>
				<div class="card-footer" style="background: #e3e3e3; place-content: center; margin: 0;">
					<img src="../logos/ayuntamiento_slp.png" style="max-width:20%; width:auto; height:auto;">
				</div>
			</div>
		</div>
	</div>

	<br><br>

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 text-center">
			<br>
			<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o mr-2"></i>Guardar</button>
			<a class="btn btn-secondary" href="{{url('/indexEcologia')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Cancelar</a>
		</div>
	</div>


	<script type="text/javascript">
		// var BASE_URL = window.location.protocol + "//" + window.location.host+ "/";

		function addLine(op) {
			var tbl = document.getElementById('tablaActividades');
			var lastRow = tbl.rows.length;
			var row = tbl.insertRow(lastRow);

			var i = row.insertCell(0);
            var f = row.insertCell(1);
			var ac = row.insertCell(2);

			i.innerHTML = '<li class="icons-list-item"> <i class="fa fa-arrow-right" data-toggle="tooltip" title="" data-original-title="fa fa-arrow-right"> </i> &nbsp;&nbsp;&nbsp; </li>';
			i.style.maxWidth = '2em';
			f.innerHTML = '<div class="form-group" style="margin-bottom: 10px">\n\
			{!! Form::text('actividades[]', null, ['class'=>'form-control', 'required', 'placeholder'=>'Escriba actividad', 'maxlength' => 500, 'id' => 'temp' ]) !!}\n\
			<i class="form-group__bar"></i></div>';
			document.querySelector('#temp').setAttribute('id', 'actividad' + (lastRow+1));
			ac.innerHTML = '<a class="btn btn-danger btn-sm text-white" style="color: red" onclick="deleteRow(this.parentNode.parentNode.rowIndex )" type="button" style="cursor:pointer"><i class="fa fa-minus-square"></i></a>';

			return false;
		}

		function deleteRow(rowIndex){
			var table = document.getElementById('tablaActividades');
			table.deleteRow(rowIndex);
		}
	</script>

	<!-- Internal Fileuploads js-->
	<script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
@endsection
