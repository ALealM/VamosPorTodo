
<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

    <head profile="http://www.w3.org/2005/10/profile">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>Atención Ciudadana</title>
        <link rel="icon"
              type="image/png"
              href="http://200.94.138.130/atencion_ciudadanaV2/images/icons/favicon.ico">
        <!-- Libs -->
        <script type="text/javascript" src="http://200.94.138.130/atencion_ciudadanaV2/js/vendor/jquery.js"></script>
        <script type="text/javascript" src="http://200.94.138.130/atencion_ciudadanaV2/lib/jquery-ui/jquery-ui.js"></script>
        <script type="text/javascript" src="http://200.94.138.130/atencion_ciudadanaV2/lib/jquery.validate.min.js"></script>
        <script type="text/javascript" src="http://200.94.138.130/atencion_ciudadanaV2/js/foundation.min.js"></script>
        <!--<script type="text/javascript" src="templates/templates.js"></script>-->
        <script type="text/javascript" src="http://200.94.138.130/atencion_ciudadanaV2/lib/typeahead.min.js"></script>
        <script type="text/javascript" src="http://200.94.138.130/atencion_ciudadanaV2/js/ed_us_ajax.js"></script>
        <script type="text/javascript" src="http://200.94.138.130/atencion_ciudadanaV2/js/jquery.sheepItPlugin.js"></script>
        <script type="text/javascript" src="http://200.94.138.130/atencion_ciudadanaV2/js/dropzone.js"></script>
        <script type="text/javascript" src="http://200.94.138.130/atencion_ciudadanaV2/js/FlexSlider/jquery.flexslider.js"></script>
        <script type="text/javascript" src="http://200.94.138.130/atencion_ciudadanaV2/js/jquery.ui.timepicker.js"></script>

        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIJ4iiYO9sANnnb1XZEepN2xI8B8hivSQ&callback=initMap"></script>
        <!--script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDtHJ3Medk-vTDCTWuGScTVbg_sJDiZdJY&sensor=false"></script-->
        <!--script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"></script-->

        <!--<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
              integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
              crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
              integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
              crossorigin=""></script>-->

        <!-- Foundation -->
        <link rel="stylesheet" href="http://200.94.138.130/atencion_ciudadanaV2/css/foundation.css">
        <link rel="stylesheet" href="http://200.94.138.130/atencion_ciudadanaV2/css/foundation-icons.css">
        <link rel="stylesheet" href="http://200.94.138.130/atencion_ciudadanaV2/css/dropzone.css">
        <link rel="stylesheet" href="http://200.94.138.130/atencion_ciudadanaV2/js/FlexSlider/flexslider.css">
        <script src="http://200.94.138.130/atencion_ciudadanaV2/js/vendor/custom.modernizr.js"></script>

        <link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="http://200.94.138.130/atencion_ciudadanaV2/css/smoothness/jquery-ui-1.10.4.custom.min.css">
        <link rel="stylesheet" href="http://200.94.138.130/atencion_ciudadanaV2/css/styles.css">
        <link rel="stylesheet" href="http://200.94.138.130/atencion_ciudadanaV2/lib/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="http://200.94.138.130/atencion_ciudadanaV2/lib/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="http://200.94.138.130/atencion_ciudadanaV2/css/jquery.ui.timepicker.css">
        <link href="http://200.94.138.130/atencion_ciudadanaV2//js/select2/select2.css" rel="stylesheet"/>
        <script src="http://200.94.138.130/atencion_ciudadanaV2//js/select2/select2.js"></script>
        <!-- Datatables -->
        <script type="text/javascript" src="http://200.94.138.130/atencion_ciudadanaV2/js/jquery.dataTables.min.js"></script>
        <!-- <script type="text/javascript" src="http://cdn.datatables.net/plug-ins/be7019ee387/sorting/date-de.js"></script> -->
        <script type="text/javascript" src="http://200.94.138.130/atencion_ciudadanaV2/js/dateFormat.js"></script>
    </head>
    <body>
        <div class="large-10 columns" id="header" style="background-color:#f2f2f2; margin-top: 0px; height: 172px; margin-left:250px">
            <div class="large-12 columns">
                <div class="row collapse">
                    <form action="http://200.94.138.130/atencion_ciudadanaV2/index.php/reporteform" method="post" accept-charset="utf-8">        <div class="small-2 columns" style="margin-top: 50px; margin-right: 0px;">
                            <input type="text" style="width:170px; height: 54px; margin-left: 80px; margin-right: 0px;" name="folio" id="folio" placeholder="Seguimiento de folio" required>
                        </div>
                        <div class="small-10 columns">
                            <input type="image" style="margin-top: 36px; margin-left: 65px;" src="http://200.94.138.130/atencion_ciudadanaV2/imagenes/Buscar.png" alt="Submit Form" />
                        </div>
                    </form>
                </div>
            </div>
            <label style="text-align:end; margin-top: 49px;"> FELIPE DE JESUS  CONTRERAS | <a href="http://200.94.138.130/atencion_ciudadanaV2/index.php/seguimiento/logout">Salir</a></label>

            <p style="text-align:end"> Aseo público</p>

        </div>


        <!--<div class="large-1 columns" style="margin-top: 9px; margin-left: 0px;">
                <input  id="btn-enviar-formularios" type="submit" value="Consultar"/>
        </div>-->

        <div class="row-80" id="uscontenedor" >
            ﻿      <div class="large-8 columns">
                <script>
                    $(document).ready(function () {
                        $("#tipo-falla").select2({
                            width: "100%"});
                        /*$("#colonia").select2({
                         width:"100%",
                         minimumInputLength: 4,
                         ajax: {
                         url: 'http://200.94.138.130/atencion_ciudadanaV2/index.php/app/asentamientos_search',
                         dataType: 'json',
                         type: "GET",
                         data: function (term) {
                         return {
                         term: term
                         };
                         },
                         results: function (data) {
                         return {
                         results: $.map(data, function (item) {
                         return {
                         text: item.d_asenta,
                         slug: item.d_asenta,
                         id: item.id_cp
                         }
                         })
                         };
                         }
                         }
                         }); */

                        var engine = new Bloodhound({
                            name: 'colonias',
                            remote: 'http://200.94.138.130/atencion_ciudadanaV2//index.php/app/asentamientos',
                            prefetch: 'http://200.94.138.130/atencion_ciudadanaV2//index.php/app/asentamientos',
                            datumTokenizer: function (d) {
                                return Bloodhound.tokenizers.whitespace(d.d_asenta);
                            },
                            queryTokenizer: Bloodhound.tokenizers.whitespace
                        });

                        engine.initialize();
                        $("#colonia").typeahead({}, {
                            name: 'colonias',
                            displayKey: 'd_asenta',
                            source: engine.ttAdapter()
                        }).on("typeahead:selected", function (e, datum) {
                            $("#colonia_id").val(datum.id_cp);
                        }).on("typeahead:autocompleted", function (e, datum) {
                            $("#colonia_id").val(datum.id_cp);
                        });

                        var engine = new Bloodhound({
                            name: 'calles',
                            remote: 'http://200.94.138.130/atencion_ciudadanaV2//index.php/app/calles',
                            prefetch: 'http://200.94.138.130/atencion_ciudadanaV2//index.php/app/calles',
                            datumTokenizer: function (d) {
                                return Bloodhound.tokenizers.whitespace(d.d_calle);
                            },
                            queryTokenizer: Bloodhound.tokenizers.whitespace
                        });
                        engine.initialize();
                        $("#calle").typeahead({}, {
                            name: 'calles',
                            displayKey: 'd_calle',
                            source: engine.ttAdapter()
                        }).on("typeahead:selected", function (e, datum) {
                            $("#calle_id").val(datum.id_cc);
                        }).on("typeahead:autocompleted", function (e, datum) {
                            $("#calle_id").val(datum.id_cc);
                        });

                    });



                </script>
            </div>

            <div class="large-8 columns" role="content" id="main-content" style="margin-left:250px">
                <div id="instrucciones" class="group" style="padding: 0px 20px;">
                    <h1>Reportar falla de servicio</h1>
                                <!--<p>El H. Ayuntamiento de San Luis Potosí pone a su disposición el sistema en línea de Atención Ciudadana. Por medio de éste, usted podrá reportar cualquier falla en los servicios públicos dentro de la ciudad en cualquier momento y desde cualquier lugar con acceso a internet.</p>-->
                </div>

                <form action="http://200.94.138.130/atencion_ciudadanaV2/index.php/reporteform/val_servicio" method="post" accept-charset="utf-8" id="reporteForm" enctype="multipart/form-data">        <fieldset>
                        <div class="form-container">
                            <legend>Datos del reporte</legend>
                            <label for="medio_reporte">Medio de recepción *</label>
                            <select type="text" name="medio_reporte" >
                                <option value="t">Teléfono</option>
                                <option value="p">Personal</option>
                                <option value="b">Buzón ciudadano</option>
                                <option value="c">Correo electrónico</option>
                                <option value="r">Redes sociales</option>
                                <!--<option value="g">Gobierno de a pie</option>-->
                                <option value="n">Concertación Social</option>
                                <option value="f">Alumbrado Público</option>
                                <option value="u">Unidad de gestión-centro</option>
                                <option value="7">Canal 7</option>
                                <option value="j">Junta de mejoras</option>
                                <option value="k">Ponte las pilas</option>
                                <option value="l">Consejero de Desarrollo Social</option>
                                <option value="d">Consejo de Desarrollo Rural</option>
                                <option value="m">Bitácora de Colonia</option>
                            </select>
                            <div class="row">
                                <div class="small-12 columns">
                                    <label for="tipo-falla">Tipo de falla *</label>
                                    <select type="text" name="tipofalla" id="tipo-falla" >
                                        <option disabled selected> -- Selecciona un tipo de falla -- </option>
                                        <optgroup label="Area">
                                            <option value=78>Papelera en mal estado</option>
                                            <option value=58>Personal de aseo maltrata al ciudadano</option>
                                            <option value=69>Limpieza de baldíos</option>
                                            <option value=68>Limpieza superficial de alcantarillas</option>
                                            <option value=62>Contenedor de basura saturado</option>
                                            <option value=61>Animal muerto en vía pública </option>
                                            <option value=56>El camión no se llevó mi basura </option>
                                            <option value=55>No pasó el camión de la basura</option>
                                            <option value=537>Vecino saca la basura fuera de horario de recolección</option>
                                            <option value=57>El camión de basura no completó su ruta</option>
                                            <option value=63>Contenedor de basura en mal estado</option>
                                            <option value=64>Basura y/o suciedad en las calles</option>
                                            <option value=77>Papelera saturada</option>
                                        </optgroup>
                                    </select>
                                      <!--<p style="background-color: lightgrey;">

                                        <a href="https://citymis.co/sanluispotosi/public" target="_blank" rel="noopener noreferrer">
                                         Reportes de alumbrado público dar clic aquí
                                        </a>
                                      </p>-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-12 columns">
                                    <label for="calle">Calle </label>
                                    <input name="calle_text" type="text" id="calle">
                                    <input name="calle" type="hidden" id="calle_id">
                                </div>
                                <div class="small-3 columns">
                                    <label for="num-ext">Número ext</label>
                                    <input type="text" name="numext" id="num-ext" value="" >
                                </div>
                                <div class="small-3 columns">
                                    <label for="num-int">Número int</label>
                                    <input type="text" name="numint" id="num-int" value="">
                                </div>
                            </div>

                            <div class="row">
                                <div class="small-12 columns">
                                    <label for="colonia">Colonia </label>
                                    <input name="colonia_text" type="text" id="colonia">
                                    <input name="colonia" type="hidden" id="colonia_id">
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-12 columns">
                                    <label for="entre-calles-1">Entre calles</label>
                                </div>
                                <div class="small-6 columns">
                                    <input type="text" name="entrecalles1" id="entre-calles-1" value="">
                                </div>
                                <div class="small-1 columns">
                                    <label for="entre-calles-2" class="center inline">y</label>
                                </div>
                                <div class="small-5 columns">
                                    <input type="text" name="entrecalles2" id="entre-calles-2" value="">
                                </div>
                                <div class="row" >
                                    <div class="small-12 columns ">
                                        <button class="btn-enviar-formularios" type="button" id="posiciona">
                                            Posicionar en mapa
                                        </button>
                                        <img src="http://200.94.138.130/atencion_ciudadanaV2/iconos/i.png" data-tooltip aria-haspopup="true" class="has-tip" title="Con la calle y la colonia seleccionada, puedes ubicar en el mapa la posición del reporte. Si quieres añadir más exactitud ingresa el número exterior. En caso de que el marcador no se ubique en el punto correcto, puedes hacerlo manualmente arrastrando el marcador o dando click derecho en el punto deseado.">
                                        <p id="accuracy-info" style="display:none; color:red; margin-left:20px; font-weight:bold;"></p>
                                    </div>
                                    <div class="small-12 columns">
                                        <div id="mapa" style="width: 100%;height:294px;margin-bottom: 10px; ">
                                        </div>
                                    </div>
                                    <input name="latitud" id="latitud" type="hidden">
                                    <input type="hidden" name="longitud" id="longitud">
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-12 columns">
                                    <label for="observaciones">Observaciones </label>
                                    <textarea id="observaciones" name="observaciones"></textarea>
                                </div>
                            </div>

                            <div class="row">

                                <div class="small-6 columns">

                                    <label for="fileUpload">Imagen </label>

                                    <input type="file" accept="image/jpeg" id="fileUpload" name="imagen">

                                </div>

                                <img id="previewImage" width="150px" height="150px" style="float:right; margin-right:25px">

                            </div>



                            <script>

                                document.getElementById("fileUpload").onchange = function () {

                                    var reader = new FileReader();



                                    reader.onload = function (e) {

                                        // get loaded data and render thumbnail.

                                        document.getElementById("previewImage").src = e.target.result;

                                    };



                                    // read the image file as a data URL.

                                    reader.readAsDataURL(this.files[0]);

                                };

                            </script>

                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-container">
                            <legend>Reportado por</legend>
                            <div class="row">
                                <div class="small-5 columns">
                                    <label for="nombre">Nombre(s) </label>
                                    <input name="nombre" type="text" id="nombre" value="">
                                </div>
                                <div class="small-5 columns">
                                    <label for="apellido-pat">Apellido Paterno</label>
                                    <input type="text" name="apellidopat" id="apellido-pat" value="" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-5 columns">
                                    <label for="apellido-mat">Apellido Materno</label>
                                    <input type="text" name="apellidomat" id="apellido-mat" value="" >
                                </div>
                                <div class="small-5 columns">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" name="telefono" id="telefono" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-5 columns">
                                    <label for="correo">Correo Electrónico</label>
                                    <input type="text" name="correo" id="correo" value="">
                                </div>
                                <div class="small-5 columns">
                                    <label>Sexo</label>
                                    <div class="small-6" style="width: 51%; float:left">
                                        <label for="masculino">
                                            <input name="sexo" type="radio" value="masculino" id="masculino">
                                            <span class="custom radio"></span> Masculino
                                        </label>
                                    </div>
                                    <div class="small-6" style="width: 49%; float:left">
                                        <label for="feminino">
                                            <input name="sexo" type="radio" value="femenido" id="feminino">
                                            <span class="custom radio"></span> Femenino
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-7 columns">
                                    <label>Tipo de reporte</label>
                                    <div class="small-6" style="width: 30%; float:left">
                                        <label for="Intrerno">
                                            <input name="tiporep" type="radio" value="A" id="Intrerno" checked="checked">
                                            <span class="custom radio"></span> Interno
                                        </label>
                                    </div>
                                    <div class="small-6" style="width: 70%; float:left">
                                        <label for="Respuesta Ciudadana">
                                            <input name="tiporep" type="radio" value="R" id="Respuesta Ciudadana">
                                            <span class="custom radio"></span> Respuesta Ciudadana
                                        </label>
                                    </div>
                                </div>

                                <div class="small-5 columns">
                                    <div class="row">
                                        <div class="small-12 columns">
                                            <label>Edad</label>
                                            <div class="small-4" style="width: 100%; float:left">
                                                <label for="joven">
                                                    <input name="edad" type="radio" value="18-29" id="joven">
                                                    <span class="custom radio"></span> Jóven (18-29)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="small-12 columns">
                                            <div class="small-4" style="width: 100%; float:left">
                                                <label for="jovenAdulto">
                                                    <input name="edad" type="radio" value="30-40" id="jovenAdulto">
                                                    <span class="custom radio"></span> Adulto Jóven (30-40)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="small-12 columns">
                                            <div class="small-4" style="width: 100%; float:left">
                                                <label for="adulto">
                                                    <input name="edad" type="radio" value="40-60" id="adulto">
                                                    <span class="custom radio"></span> Adulto (40-60)
                                                </label>
                                            </div>
                                            <div class="small-4" style="width: 100%; float:left">
                                                <label for="adultoMayor">
                                                    <input name="edad" type="radio" value="60 y mas" id="adultoMayor">
                                                    <span class="custom radio"></span> Adulto Mayor (60 y más)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="small-12 columns">
                                    <label for="informacion_adicional">Informacion adicional</label>
                                    <textarea id="informacion_adicional" name="informacion_adicional"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-9" style="float:left">
                                    <div class="small-1 columns" style="width: 1%;">
                                        <label for="checkbox1"><input type="checkbox" name="visibilidad" id="visibilidad" value="1"><span class="custom checkbox"></span></label>
                                    </div>

                                    <div class="small-11 columns" style="width: 92%;">
                                        <label for="visibilidad">Hacer mi reporte visible para todos
                                            (No se publicarán mis datos personales)</label>
                                    </div>
                                </div>
                                <div class="small-3 columns center" id="enviarServicios" >
                                    <input  id="btn-enviar-formularios" type="submit" style="float:left;" value="Enviar"></input>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <script type="text/javascript">
                $('form input').keydown(function (e) {
                    if (e.keyCode == 13) {
                        var inputs = $(this).parents("form").eq(0).find(":input");
                        if (inputs[inputs.index(this) + 1] != null) {
                            inputs[inputs.index(this) + 1].focus();
                        }
                        e.preventDefault();
                        return false;
                    }
                });
                /**
                 VERIFICA QUE SE HAYA UBICADO UN PUNTO DE LOCALIZACIÓN
                 **/

                (function () {
                    'use strict';
                    window.addEventListener('load', function () {
                        var form = document.getElementById('reporteForm');
                        form.addEventListener('submit', function (event) {
                            event.preventDefault();
                            event.stopPropagation();

                            var latitud = document.getElementById('latitud').value;
                            var longitud = document.getElementById('longitud').value;
                            var id_calle = document.getElementById('calle_id').value;
                            var id_colonia = document.getElementById('colonia_id').value;
                            var numext = document.getElementById('num-ext').value;
                            var id_tipo = document.getElementById('tipo-falla').value;
                            var titulo;
                            var mensaje;
                            if (latitud == '' || longitud == '') {
                                mensaje = 'Ubica el reporte en el mapa.';
                                muestraMensaje(mensaje);
                            }
                            existenReportes(id_calle, id_colonia, numext, latitud, longitud, id_tipo).then(res => {
                                if (res.mensaje) {
                                    mensaje = 'Este servicio ya fue reportado: ' + res.mensaje;
                                    muestraMensaje(mensaje);
                                } else {
                                    $('#reporteForm').submit();
                                }
                            }).catch(error => {
                                /*
                                 console.log("Error al recuperar datos: " + jqXhr.status);
                                 console.log(jqXhr);
                                 console.log(jqXhr.responseJSON);
                                 */
                            });
                        }, false);
                    }, false);
                })();

                function muestraMensaje(mensaje) {
                    alert(mensaje);
                }

                function existenReportes(id_calle, id_colonia, numext, lat, lon, id_tipo) {

                    return new Promise((resolve, reject) => {
                        $.ajax({
                            url: '/atencion_ciudadanaV2/index.php/reporteServicio/reportesRepetidosAjax',
                            type: 'POST',
                            data: {
                                calle: id_calle,
                                colonia: id_colonia,
                                num: numext,
                                latitud: lat,
                                longitud: lon,
                                tipo: id_tipo
                            },
                            dataType: 'JSON',

                            success: function (respuesta) {
                                resolve(respuesta);
                            },

                            error: function (jqXhr) {
                                reject(jqXhr);
                                //if( jqXhr.status == 400 ) {
                                //let json = $.parseJSON( jqXhr.responseText );

                                //$('#mensajeId').text(jqXhr.responseJSON.mensaje);

                                //}
                            }

                        }); //Ajax
                    });
                }

            </script>
            <script src="http://200.94.138.130/atencion_ciudadanaV2/js/googleMap/inicializa.js"></script>
            <!--<div id="myModal" class="reveal-modal" data-reveal>
              <h2>Gracias por tu reporte.</h2>
              <p id="modal-text"> Su denuncia ha sido enviada con el folio Q140330. Puede consultar el progreso de su denuncia a partir de un plazo no mayor a 72 horas.</p>
              <a class="close-reveal-modal">&#215;</a>
            </div>-->

            <style type="text/css">
                .wrapper {
                    display: flex;
                    width: 100%;
                }

                #sidebar {
                    width: 250px;
                    position: absolute;
                    top: 0;
                    left: 0;
                    height: 150vh;
                    z-index: 1;
                    background: #ffffff;
                    color: #fff;
                    transition: all 0.3s;
                    margin-left: 9px;
                    box-shadow: 0px 15px 20px black;
                }
            </style>

            <div class="wrapper">
                <!-- Sidebar -->
                <nav id="sidebar">
                    <div class="sidebar-header" align="center" style="background-color:#f2f2f2;">
                        <img src="http://200.94.138.130/atencion_ciudadanaV2/imagenes/ACmenu.png" width="200px" style="padding-top: 1em; padding-bottom: 2em;">
                    </div>

                    <ul class="list-unstyled components">
                        <li>
                            <div class="row">
                                <div class="large-12 columns" >
                                    <img src="http://200.94.138.130/atencion_ciudadanaV2/imagenes/AltaReporte.png" width="30em"><a  href='http://200.94.138.130/atencion_ciudadanaV2/index.php/seguimiento/servicio/' id='menu'>  Alta de reporte</a>					</div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="large-12 columns" >
                                    <img src="http://200.94.138.130/atencion_ciudadanaV2/imagenes/ListadoReportes.png" width="30em"><a  href='http://200.94.138.130/atencion_ciudadanaV2/index.php/seguimiento/' id='menu'>  Lista de reportes</a>					</div>
                            </div>
                        </li>
                        <li>
                        </li>
                        <li>
                            <div class="row">
                                <div class="large-12 columns" >
                                    <img src="http://200.94.138.130/atencion_ciudadanaV2/imagenes/Exportar.png" width="30em"><a  href='http://200.94.138.130/atencion_ciudadanaV2/index.php/seguimiento/impresion' id='menu'>  Exportar reportes</a>					</div>
                            </div>
                        </li>
                        <li>
                        </li>
                    </ul>

                </nav>
                <!-- Page Content
                <div id="content">

                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">

                <!--<button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                    <span>Toggle Sidebar</span>
                </button>
            </div>
        </nav>
    </div>-->
            </div>
        </div>
        <style type="text/css">
            .indexuno {
                z-index: 5;
                position: absolute;
            }
        </style>
        <!-- Footer -->
        <!--footer class="row">
          <div class="large-8 column" id="footerletras">
            <div class="footer-content group">
              <a href="https://www.sanluis.gob.mx">www.sanluis.gob.mx</a>
              <p>Blv. Salvador Nava Martínez No 1580 Col. Santuario, C.P. 78380 San Luis Potosí, México tel (444) 834 54 00</p>
            </div>
          </div>
          <div class="large-1 column">
          </div>
          <div class="large-4 column" id="footerlogo">
              <img src="imagenes/Slp.logo.png">
          </div>
        </footer-->

        <!--<footer style="text-align:center">
          <div class="row" style="height: 0.5em; background: #AC8B30;">
          </div>
          <div class="row" style="height: 6em; background: #1C3150; padding-top: 1em; padding-bottom: 1em; padding-left: 0em;">
            <div class="col-12 col-md-12">
              <p style="color: #fff; font-size: 0.7em; line-height:normal;float:none;">
                UNIDAD ADMINISTRATIVA MUNICIPAL<br>
                AV. DR. SALVADOR NAVA 1580, EL SANTUARIO; REVOLUCIÓN, 78380 SAN LUIS POTOSÍ<br>
                TEL.: (01) (444) 834-5400<br>
              </p>
            </div>
          </div>
        </footer>-->
        <footer>
            <div class="indexuno">

                <img src="http://200.94.138.130/atencion_ciudadanaV2/imagenes/Pie.png" >

            </div>
        </footer>

        <script>
                      $(document).foundation();
        </script>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-42741606-11', 'auto');
            ga('send', 'pageview');

        </script>

    </body>
</html>
