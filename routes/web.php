<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('logout', [
  'as' => 'logout',
  'uses' => 'Auth\LoginController@logout'
]);

Auth::routes();
Route::group(['middleware' => 'auth'], function() {
  Route::get('/cubo', 'HomeController@cubo');

  Route::get('/', 'HomeController@index');
  Route::get('/home', 'HomeController@index');
  Route::get('/admin', 'HomeController@index');
  Route::get('dashboard', 'AccionesController@dashboard')->name('dashboard');
  Route::get('acciones/listado', 'AccionesController@listado')->name('acciones');
  Route::get('accion/create', 'AccionesController@create')->name('createAccion');
  Route::post('accion/store', 'AccionesController@store')->name('storeAccion');
  Route::get('accion/show/{id}', 'AccionesController@show')->name('showAccion');
  Route::get('getResp', 'AccionesController@getResp');
  Route::get('getColonias', 'AccionesController@getColonias');
  Route::get('buscador_colonia', 'AccionesController@buscador_colonia');

  Route::get('catalogos', 'CatalogosController@index')->name('catalogos');

  Route::get('catalogos/tipoAcciones', 'CatalogosController@tipoAccionesIndex')->name('tipoAcciones');
  Route::get('tipoAccion/create', 'CatalogosController@tipoAccionCreate')->name('createTipoAccion');
  Route::post('tipoAccion/store', 'CatalogosController@tipoAccionStore')->name('storeTipoAccion');

  Route::get('catalogos/tipoBeneficiarios', 'CatalogosController@tipoBeneficiariosIndex')->name('tipoBeneficiarios');
  Route::get('tipoBeneficiario/create', 'CatalogosController@tipoBeneficiarioCreate')->name('createTipoBeneficiario');
  Route::post('tipoBeneficiario/store', 'CatalogosController@tipoBeneficiarioStore')->name('storeTipoBeneficiario');

  Route::get('catalogos/colonias', 'CatalogosController@coloniasIndex')->name('colonias');
  Route::get('colonia/create', 'CatalogosController@coloniaCreate')->name('createColonia');
  Route::post('colonia/store', 'CatalogosController@coloniaStore')->name('storeColonia');

  Route::get('catalogos/secretarias', 'CatalogosController@secretariasIndex')->name('secretarias');
  Route::get('secretaria/create', 'CatalogosController@secretariaCreate')->name('createSecretaria');
  Route::post('secretaria/store', 'CatalogosController@secretariaStore')->name('storeSecretaria');

  Route::get('catalogos/responsables', 'CatalogosController@responsablesIndex')->name('responsables');
  Route::get('responsable/create', 'CatalogosController@responsableCreate')->name('createResponsable');
  Route::post('responsable/store', 'CatalogosController@responsableStore')->name('storeResponsable');

  Route::get('catalogos/unidadesKPI', 'CatalogosController@unidadesKPIIndex')->name('unidadesKPI');
  Route::get('unidadKPI/create', 'CatalogosController@unidadKPICreate')->name('createUnidadKPI');
  Route::post('unidadKPI/store', 'CatalogosController@unidadKPIStore')->name('storeUnidadKPI');

  Route::get('catalogos/frecuenciasKPI', 'CatalogosController@frecuenciasKPIIndex')->name('frecuenciasKPI');
  Route::get('frecuenciaKPI/create', 'CatalogosController@frecuenciaKPICreate')->name('createFrecuenciaKPI');
  Route::post('frecuenciaKPI/store', 'CatalogosController@frecuenciaKPIStore')->name('storeFrecuenciaKPI');

  Route::get('planeacion', 'PlaneacionEstrategicaController@index')->name('planeacion');
  Route::get('planeacionE/mapaEstrategico', 'PlaneacionEstrategicaController@mapaEstrategico')->name('mapaEstrategico');

  Route::get('planeacionE/ejes', 'PlaneacionEstrategicaController@ejesPlanDMIndex')->name('ejesPlanDM');
  Route::get('planeacionE/ejeCreate', 'PlaneacionEstrategicaController@ejePlanDMCreate')->name('createEjePlanDM');
  Route::post('planeacionE/ejeStore', 'PlaneacionEstrategicaController@ejePlanDMStore')->name('storeEjePlanDM');
  Route::get('planeacionE/ejeEdit/{id}', 'PlaneacionEstrategicaController@ejePlanDMEdit')->name('editEjePlanDM');
  Route::put('planeacionE/ejeUpdate', 'PlaneacionEstrategicaController@ejePlanDMUpdate')->name('updateEjePlanDM');

  Route::get('planeacionE/estrategias', 'PlaneacionEstrategicaController@estrategiasIndex')->name('estrategias');
  Route::get('planeacionE/estrategiaCreate', 'PlaneacionEstrategicaController@estrategiaCreate')->name('createEstrategia');
  Route::post('planeacionE/estrategiaStore', 'PlaneacionEstrategicaController@estrategiaStore')->name('storeEstrategia');
  Route::get('planeacionE/estrategiaEdit/{id}', 'PlaneacionEstrategicaController@estrategiaEdit')->name('editEstrategia');
  Route::put('planeacionE/estrategiaUpdate', 'PlaneacionEstrategicaController@estrategiaUpdate')->name('updateEstrategia');

  Route::get('planeacionE/indicadores', 'PlaneacionEstrategicaController@indicadoresIndex')->name('indicadores');
  Route::get('planeacionE/indicadorCreate', 'PlaneacionEstrategicaController@indicadorCreate')->name('createIndicador');
  Route::post('planeacionE/indicadorstore', 'PlaneacionEstrategicaController@indicadorStore')->name('storeIndicador');
  Route::get('planeacionE/indicadorShow/{id}', 'PlaneacionEstrategicaController@indicadorShow')->name('showIndicador');
  Route::get('planeacionE/indicadorEdit/{id}', 'PlaneacionEstrategicaController@indicadorEdit')->name('editIndicador');
  Route::put('planeacionE/indicadorUpdate', 'PlaneacionEstrategicaController@indicadorUpdate')->name('updateIndicador');
  Route::get('getEstrategias', 'PlaneacionEstrategicaController@getEstrategias');

  Route::get('cargosMunicipales', 'CargosMunicipalesController@listado')->name('cargosMunicipales');
  Route::get('cargoMunicipal/show/{id}', 'CargosMunicipalesController@show')->name('showCargoMunicipal');
  Route::get('cargoMunicipal/edit/{id}', 'CargosMunicipalesController@edit')->name('editCargoMunicipal');
  Route::put('cargoMunicipal/update', 'CargosMunicipalesController@update')->name('updateCargoMunicipal');
  Route::get('showCargo', 'CargosMunicipalesController@showCargo');
  Route::get('editCargo', 'CargosMunicipalesController@editCargo');
  Route::get('cargosPDF', 'CargosMunicipalesController@cargosPDF');

  Route::get('eventos/listado', 'EventosController@listado')->name('eventos');
  Route::get('evento/create', 'EventosController@create')->name('createEvento');
  Route::post('evento/store', 'EventosController@store')->name('storeEvento');
  Route::get('evento/show/{id}', 'EventosController@show')->name('showEvento');
  Route::get('eventoPDF/{id}', 'EventosController@eventoPDF');
  Route::get('eventoEnviar', 'EventosController@eventoEnviar');
  Route::get('evento/observaciones/{id}', 'EventosController@observaciones')->name('showObservaciones');
  Route::post('evento/storeObservaciones', 'EventosController@storeObservaciones')->name('storeObservaciones');
  Route::get('evento/edit/{id}', 'EventosController@edit')->name('editEvento');
  Route::put('evento/update', 'EventosController@update')->name('updateEvento');
  Route::get('eventosColaboracion/listado', 'EventosController@listadoColaboracion')->name('eventosColaboracion');
  Route::get('evento/showColaboracion/{id}', 'EventosController@showColaboracion')->name('showColaboracionEvento');
  Route::get('evento/showAutorizado/{id}', 'EventosController@showAutorizado')->name('showAutorizadoEvento');
  Route::get('eventos/listadoAutorizado', 'EventosController@listadoAutorizado')->name('eventosAutorizados');
  Route::get('evento/reporte/{id}', 'EventosController@reporte')->name('reporteEvento');
  Route::post('evento/storeReporte', 'EventosController@storeReporte')->name('storeReporte');
  Route::get('evento/reporteColaboracion/{id}', 'EventosController@reporteColaboracion')->name('reporteEventoColaboracion');
  Route::post('evento/storeReporteColaboracion', 'EventosController@storeReporteColaboracion')->name('storeReporteColaboracion');
  Route::get('calendarioEventosDiarios', 'EventosController@calendario')->name('calendarioEventosDiarios');
  Route::get('getEventoDiario', 'EventosController@getEventoDiario');
  Route::get('eventosDiariosUpdate', 'EventosController@eventosDiariosUpdate')->name('eventosDiariosUpdate');

  Route::get('informe/listado', 'InformeController@listado')->name('informe');
  Route::get('informe/create', 'InformeController@create')->name('createInforme');
  Route::post('informe/store', 'InformeController@store')->name('storeInforme');
  Route::get('informe/show/{id}', 'InformeController@show')->name('showInforme');
  Route::get('informePDF/{fecha}', 'InformeController@informePDF');
  Route::get('informeEnviar', 'InformeController@informeEnviar');
  Route::get('informe/edit/{id}', 'InformeController@edit')->name('editInforme');
  Route::put('informe/update', 'InformeController@update')->name('updateInforme');
  Route::get('informe/listadoRevision', 'InformeController@listadoRevision')->name('listadoRevision');
  Route::get('informe/showRevision/{id}', 'InformeController@showRevision')->name('showRevision');
  Route::get('informe/revisar/{fecha}', 'InformeController@revisar')->name('revisarInforme');
  Route::put('informe/updateAll', 'InformeController@updateAll')->name('updateInformes');
  Route::get('verificaFecha', 'InformeController@verificaFecha');
  Route::get('informe/resumen', 'InformeController@resumen')->name('informeResumen');
  Route::post('informe/generaResumen', 'InformeController@generaResumen')->name('generaResumen');

  Route::get('proyectoAccion/listado', 'ProyectosAccionesController@listado')->name('proyectoAccion');
  Route::get('proyectoAccion/create', 'ProyectosAccionesController@create')->name('createProyectoAccion');
  Route::post('proyectoAccion/store', 'ProyectosAccionesController@store')->name('storeProyAcc');
  Route::get('getObjetivos', 'ProyectosAccionesController@getObjetivos');
  Route::get('getRubros', 'ProyectosAccionesController@getRubros');
  Route::get('getConceptos', 'ProyectosAccionesController@getConceptos');
  Route::get('proyectoAccion/show/{id}', 'ProyectosAccionesController@show')->name('showProyectoAccion');
  Route::get('proyectoAccion/edit/{id}', 'ProyectosAccionesController@edit')->name('editProyectoAccion');
  Route::put('proyectoAccion/update', 'ProyectosAccionesController@update')->name('updateProyectoAccion');
  Route::get('proyectoAccion/delete/{id}', 'ProyectosAccionesController@delete');
  Route::get('proyectoPDF/{id}', 'ProyectosAccionesController@proyectoPDF');

  Route::get('panel', 'PanelController@panel')->name('panel');
  Route::get('panel/showID/{id}', 'PanelController@showID')->name('showID');
  Route::put('panel/updateID', 'PanelController@updateID')->name('updatePanelID');
  Route::get('panel/showEV/{id}', 'PanelController@showEV')->name('showEV');
  Route::get('panel/showPOA/{id}', 'PanelController@showPOA')->name('showPOA');
  Route::get('getPOA', 'PanelController@getPOA');

  Route::get('agenda/listado', 'AgendaController@listado')->name('agenda');
  Route::get('agenda/create', 'AgendaController@create')->name('createAgenda');
  Route::post('agenda/store', 'AgendaController@store')->name('storeAgenda');

  Route::get('agendaPDF/{id}', 'AgendaController@agendaPDF');
  Route::get('showAgenda/{id}', 'AgendaController@show')->name('showAgenda');
  Route::get('editAgenda/{id}', 'AgendaController@edit')->name('editAgenda');
  Route::put('updateAgenda', 'AgendaController@update')->name('updateAgenda');





  Route::get('peticion/acuerdo', 'PeticionAcuerdoController@acuerdo')->name('acuerdo');
  Route::get('peticion/index', 'PeticionAcuerdoController@index')->name('peticionIndex');
  Route::get('peticion/acuerdoCreate', 'PeticionAcuerdoController@acuerdoCreate')->name('createAcuerdo');
  Route::post('peticion/acuerdoStore', 'PeticionAcuerdoController@acuerdoStore')->name('storeAcuerdo');
  Route::get('peticion/acuerdoEdit/{id}', 'PeticionAcuerdoController@acuerdoEdit')->name('editAcuerdo');
  Route::put('peticion/acuerdoUpdate', 'PeticionAcuerdoController@acuerdoUpdate')->name('updateAcuerdo');
  Route::get('peticion/acuerdoShow/{id}', 'PeticionAcuerdoController@acuerdoShow')->name('showAcuerdo');
  Route::get('peticion/acuerdoDelete/{id}', 'PeticionAcuerdoController@acuerdoDelete')->name('deleteAcuerdo');


  Route::get('peticion/listado', 'ListadoAcuerdoController@listado')->name('listado');
  Route::get('peticion/acuerdolistadoCreate', 'ListadoAcuerdoController@acuerdolistadoCreate')->name('createlistadoAcuerdo');
  Route::post('peticion/acuerdolistadoStore', 'ListadoAcuerdoController@acuerdolistadoStore')->name('storelistadoAcuerdo');
  Route::get('peticion/acuerdolistadoEdit/{id}', 'ListadoAcuerdoController@acuerdolistadoEdit')->name('editlistadoAcuerdo');
  Route::put('peticion/acuerdolistadoUpdate', 'ListadoAcuerdoController@acuerdolistadoUpdate')->name('updatelistadoAcuerdo');
  Route::get('peticion/acuerdolistadoShow/{id}', 'ListadoAcuerdoController@acuerdolistadoShow')->name('showlistadoAcuerdo');

  Route::get('acuerdos_gira/acuerdo', 'AcuerdoGiraController@acuerdogira')->name('acuerdogira');
  Route::get('acuerdos_gira/index', 'AcuerdoGiraController@index')->name('indexAcuerdosgira');
  Route::get('acuerdos_gira/acuerdogiraCreate', 'AcuerdoGiraController@acuerdogiraCreate')->name('createAcuerdogira');
  Route::post('acuerdos_gira/acuerdogiraStore', 'AcuerdoGiraController@acuerdogiraStore')->name('storeAcuerdogira');
  Route::get('acuerdos_gira/acuerdogiraEdit/{id}', 'AcuerdoGiraController@acuerdogiraEdit')->name('editAcuerdogira');
  Route::put('acuerdos_gira/acuerdogiraUpdate', 'AcuerdoGiraController@acuerdogiraUpdate')->name('updateAcuerdogira');

  Route::get('peticion/fichaacuerdo/{id}', 'FichaAcuerdoController@fichaacuerdo')->name('fichaacuerdo');
  Route::get('peticion/fichaacuerdoCreate', 'FichaAcuerdoController@fichaacuerdoCreate')->name('createFichaacuerdo');
  Route::post('peticion/fichaacuerdoStore', 'FichaAcuerdoController@fichaacuerdoStore')->name('storeFichaacuerdo');
  Route::get('peticion/fichaacuerdoEdit/{id}', 'FichaAcuerdoController@fichaacuerdoEdit')->name('editFichaacuerdo');
  Route::put('peticion/fichaacuerdoUpdate', 'FichaAcuerdoController@fichaacuerdoUpdate')->name('updateFichaacuerdo');
  Route::get('peticion/fichaacuerdoShow/{id}', 'FichaAcuerdoController@fichaacuerdoShow')->name('showFichaacuerdo');

  Route::get('addLineAV', 'FichaAcuerdoController@addLineAV');


  Route::get('peticion/avances/index', 'AvancesController@index')->name('avancesIndex');
  Route::get('peticion/avances/{id}', 'AvancesController@avance')->name('avance');
  Route::get('peticion/avancesCreate', 'AvancesController@avancesCreate')->name('createAvances');
  Route::post('peticion/avancesStore', 'AvancesController@avancesStore')->name('storeAvances');
  Route::get('peticion/avancesEdit/{id}', 'AvancesController@avancesEdit')->name('editAvances');
  Route::put('peticion/avancesUpdate', 'AvancesController@avancesUpdate')->name('updateAvances');
  Route::get('peticion/avancesShow/{id}', 'AvancesController@avancesShow')->name('showAvances');

  Route::get('peticion/avance_evidencia/index', 'AvanceEvidenciaController@index')->name('avance_evidenciaIndex');

  Route::get('peticion/colaborador/{id}', 'AvanceColaboradorController@index')->name('indexColaborador');
  Route::get('peticion/colaboradorCreate/{id}', 'AvanceColaboradorController@colaboradorCreate')->name('createColaborador');
  Route::post('peticion/colaboradorStore', 'AvanceColaboradorController@colaboradorStore')->name('storeColaborador');
  Route::get('peticion/colaboradorEdit/{id}', 'AvanceColaboradorController@colaboradorEdit')->name('editColaborador');
  Route::put('peticion/colaboradorUpdate', 'AvanceColaboradorController@colaboradorUpdate')->name('updateColaborador');
  Route::get('peticion/colaboradorShow/{id}', 'AvanceColaboradorController@colaboradorShow')->name('showColaborador');


  Route::get('peticion/responsable/{id}', 'AvanceResponsableController@index')->name('indexAvaResponsable');
  Route::get('peticion/responsableCreate/{id}', 'AvanceResponsableController@responsableCreate')->name('createAvyaResponsable');
  Route::post('peticion/responsableStore', 'AvanceResponsableController@responsableStore')->name('storeAvaResponsable');
  Route::get('peticion/responsableEdit/{id}', 'AvanceResponsableController@responsableEdit')->name('editAvaResponsable');
  Route::put('peticion/responsableUpdate', 'AvanceResponsableController@responsableUpdate')->name('updateAvaResponsable');
  Route::get('peticion/responsableShow/{id}', 'AvanceResponsableController@responsableShow')->name('showAvaResponsable');

  Route::get('asistencia', 'CoplademController@asistencia');
  Route::get('invitados/index', 'CoplademController@index')->name('indexInvitados');
  Route::get('invitados/mapa', 'CoplademController@mapa')->name('mapaInvitados');
  Route::get('invitados/ordendia', 'CoplademController@ordendia')->name('ordenInvitados');
  Route::get('invitados/asistentes', 'CoplademController@asistentes')->name('asistentesInvitados');
  Route::get('invitados/alta', 'CoplademController@alta')->name('altaInvitados');
  Route::get('invitados/dashboard', 'CoplademController@dashboard')->name('dashboardInvitados');

  //******* Nuevo Asistente *******
  Route::get('addAsistente', 'CoplademController@create');
  Route::post('asistentes/store', 'CoplademController@store')->name('storeAsistente');
  //*******************************

  Route::get('peticion/acuerdos_actividades/index', 'AcuerdosController@acuerdo_actividades')->name('acuerdo_actividades');
  Route::get('peticion/acuerdos_actividadesShow/{id}', 'FichaAcuerdoController@acuerdos_actividadesShow')->name('showAcuerdos_actividades');


  //###########  FORO SAN LUIS SEGURO  ###########
  Route::get('asistencia', 'PrimerForoController@primerasistencia');
  Route::get('primer_foro/index', 'PrimerForoController@primerindex')->name('indexPrimer');
  Route::get('primer_foro/mapa', 'PrimerForoController@primermapa')->name('mapaPrimer');
  Route::get('primer_foro/ordendia', 'PrimerForoController@primerordendia')->name('ordenPrimer');
  Route::get('primer_foro/asistentes', 'PrimerForoController@primerasistentes')->name('asistentesPrimer');
  Route::get('primer_foro/alta', 'PrimerForoController@primeralta')->name('altaPrimer');
  Route::get('primerForoDashboard', 'PrimerForoController@dashboard')->name('primerForoDashboard');

  //******* Nuevo Asistente Foro Seguro *******
  Route::get('addInvitadoPrimer', 'PrimerForoController@create');
  Route::post('primer_foro/store', 'PrimerForoController@store')->name('storeInvitadoPrimer');
  //*******************************


  //###########  FORO SAN LUIS SOSTENIBLE  ###########
  Route::get('asistenciaSostenible', 'ForoSostenibleController@sostenibleasistencia');
  Route::get('sanluis_sostenible/index', 'ForoSostenibleController@sostenibleindex')->name('indexSostenible');
  Route::get('sanluis_sostenible/ordendia', 'ForoSostenibleController@sostenibleordendia')->name('ordenSostenible');
  Route::get('sanluis_sostenible/asistentes', 'ForoSostenibleController@sostenibleasistentes')->name('asistentesSostenible');
  Route::get('sanluis_sostenible/alta', 'ForoSostenibleController@sosteniblealta')->name('altaSostenible');
  Route::get('sostenibleDashboard', 'ForoSostenibleController@dashboard')->name('sostenibleDashboard');

  //******* Nuevo Asistente Foro Sostenible *******
  Route::get('addInvitadoSostenible', 'ForoSostenibleController@create');
  Route::post('sanluis_sostenible/store', 'ForoSostenibleController@store')->name('storeInvitadoSostenible');


  //###########  FORO SAN LUIS BIENESTAR  ###########
  Route::get('asistenciaBienestar', 'ForoBienestarController@bienestarasistencia');
  Route::get('sanluis_bienestar/index', 'ForoBienestarController@bienestarindex')->name('indexBienestar');
  Route::get('sanluis_bienestar/ordendia', 'ForoBienestarController@bienestarordendia')->name('ordenBienestar');
  Route::get('sanluis_bienestar/asistentes', 'ForoBienestarController@bienestarasistentes')->name('asistentesBienestar');
  Route::get('sanluis_bienestar/alta', 'ForoBienestarController@bienestaralta')->name('altaBienestar');
  Route::get('bienestarDashboard', 'ForoBienestarController@dashboard')->name('bienestarDashboard');

  //******* Nuevo Asistente Foro Bienestar *******
  Route::get('addInvitadoBienestar', 'ForoBienestarController@create');
  Route::post('sanluis_bienestar/store', 'ForoBienestarController@store')->name('storeInvitadoBienestar');


  //###########  FORO DELEGACIONES - POZOS ###########
  Route::get('asistenciaPozos', 'ForoPozosController@pozosasistencia');
  Route::get('pozos/index', 'ForoPozosController@pozosindex')->name('indexPozos');
  Route::get('pozos/ordendia', 'ForoPozosController@pozosordendia')->name('ordenPozos');
  Route::get('pozos/asistentes', 'ForoPozosController@pozosasistentes')->name('asistentesPozos');
  Route::get('pozos/alta', 'ForoPozosController@pozosalta')->name('altaPozos');
  Route::get('pozosDashboard', 'ForoPozosController@dashboard')->name('pozosDashboard');

  //******* Nuevo Asistente Foro Pozos *******
  Route::get('addInvitadoPozos', 'ForoPozosController@create');
  Route::post('pozos/store', 'ForoPozosController@store')->name('storeInvitadoPozos');


  //###########  FORO DELEGACIONES - BOCAS ###########
  Route::get('asistenciaBocas', 'ForoBocasController@bocasasistencia');
  Route::get('bocas/index', 'ForoBocasController@bocasindex')->name('indexBocas');
  Route::get('bocas/ordendia', 'ForoBocasController@bocasordendia')->name('ordenBocas');
  Route::get('bocas/asistentes', 'ForoBocasController@bocasasistentes')->name('asistentesBocas');
  Route::get('bocas/alta', 'ForoBocasController@bocasalta')->name('altaBocas');
  Route::get('bocasDashboard', 'ForoBocasController@dashboard')->name('bocasDashboard');

  //******* Nuevo Asistente Foro Bocas *******
  Route::get('addInvitadoBocas', 'ForoBocasController@create');
  Route::post('bocas/store', 'ForoBocasController@store')->name('storeInvitadoBocas');


  //###########  FORO DELEGACIONES - LA PILA ###########
  Route::get('asistenciaLapila', 'ForoLapilaController@lapilaasistencia');
  Route::get('lapila/index', 'ForoLapilaController@lapilaindex')->name('indexLapila');
  Route::get('lapila/ordendia', 'ForoLapilaController@lapilaordendia')->name('ordenLapila');
  Route::get('lapila/asistentes', 'ForoLapilaController@lapilaasistentes')->name('asistentesLapila');
  Route::get('lapila/alta', 'ForoLapilaController@lapilaalta')->name('altaLapila');
  Route::get('pilaDashboard', 'ForoLapilaController@dashboard')->name('pilaDashboard');

  //******* Nuevo Asistente Foro La Pila *******
  Route::get('addInvitadoLapila', 'ForoLapilaController@create');
  Route::post('lapila/store', 'ForoLapilaController@store')->name('storeInvitadoLapila');


  //###########  FORO SAN LUIS COMPETITIVO  ###########
  Route::get('asistenciaCompetitivo', 'ForoCompetitivoController@competitivoasistencia');
  Route::get('sanluis_competitivo/index', 'ForoCompetitivoController@competitivoindex')->name('indexCompetitivo');
  Route::get('sanluis_competitivo/ordendia', 'ForoCompetitivoController@competitivoordendia')->name('ordenCompetitivo');
  Route::get('sanluis_competitivo/asistentes', 'ForoCompetitivoController@competitivoasistentes')->name('asistentesCompetitivo');
  Route::get('sanluis_competitivo/alta', 'ForoCompetitivoController@competitivoalta')->name('altaCompetitivo');
  Route::get('competitivoDashboard', 'ForoCompetitivoController@dashboard')->name('competitivoDashboard');

  //******* Nuevo Asistente Foro Competitivo *******
  Route::get('addInvitadoCompetitivo', 'ForoCompetitivoController@create');
  Route::post('sanluis_competitivo/store', 'ForoCompetitivoController@store')->name('storeInvitadoCompetitivo');


  //###########  FORO SAN LUIS EN TU COLONIA  ###########
  Route::get('asistenciaColonia', 'ForoColoniaController@coloniaasistencia');
  Route::get('sanluis_colonia/index', 'ForoColoniaController@coloniaindex')->name('indexColonia');
  Route::get('sanluis_colonia/ordendia', 'ForoColoniaController@coloniaordendia')->name('ordenColonia');
  Route::get('sanluis_colonia/asistentes', 'ForoColoniaController@coloniaasistentes')->name('asistentesColonia');
  Route::get('sanluis_colonia/alta', 'ForoColoniaController@coloniaalta')->name('altaColonia');
  Route::get('coloniaDashboard', 'ForoColoniaController@dashboard')->name('coloniaDashboard');

  //******* Nuevo Asistente Foro San Luis en tu Colonia *******
  Route::get('addInvitadoColonia', 'ForoColoniaController@create');
  Route::post('sanluis_colonia/store', 'ForoColoniaController@store')->name('storeInvitadoColonia');


  //###########  FORO JARDÍN DEL ARTE  ###########
  Route::get('asistenciaJardinArte', 'ForoJardinArteController@jardinArteasistencia');
  Route::get('jardinArte/index', 'ForoJardinArteController@jardinArteindex')->name('indexJardinArte');
  Route::get('jardinArte/ordendia', 'ForoJardinArteController@jardinArteordendia')->name('ordenJardinArte');
  Route::get('jardinArte/asistentes', 'ForoJardinArteController@jardinArteasistentes')->name('asistentesJardinArte');
  Route::get('jardinArte/alta', 'ForoJardinArteController@jardinArtealta')->name('altaJardinArte');
  Route::get('jardinArteDashboard', 'ForoJardinArteController@dashboard')->name('jardinArteDashboard');

  //******* Nuevo Asistente Foro Jardín del Arte *******
  Route::get('addInvitadoJardinArte', 'ForoJardinArteController@create');
  Route::post('jardinArte/store', 'ForoJardinArteController@store')->name('storeInvitadoJardinArte');

  //******* Programas Sociales *******
  Route::get('programas', 'ProgramasController@listado')->name("programas");
  Route::get('createPrograma', 'ProgramasController@create')->name('createPrograma');
  Route::post('programa/store', 'ProgramasController@store')->name('storePrograma');
  Route::get('programa/edit/{id}', 'ProgramasController@edit')->name('editPrograma');
  Route::put('programa/update', 'ProgramasController@update')->name('updatePrograma');
  Route::get('programa/delete/{id}', 'ProgramasController@delete')->name('deletePrograma');
  Route::get('programa/vincular/{id}', 'ProgramasController@vincular')->name('vincularPrograma');
  Route::get('programa/desvincular/{id}', 'ProgramasController@desvincular')->name('desvincularPrograma');
  Route::get('programa/beneficiarios/{id}', 'ProgramasController@beneficiarios')->name('beneficiariosPrograma');
  Route::any('programa/beneficiario/store', 'ProgramasController@storeBeneficiario')->name('storeBeneficiario');
  Route::get('beneficiario/edit/{id}', 'ProgramasController@editBeneficiario')->name('editBeneficiario');
  Route::get('beneficiario/delete/{id}', 'ProgramasController@deleteBeneficiario')->name('deleteBeneficiario');
  Route::put('beneficiario/update', 'ProgramasController@updateBeneficiario')->name('updateBeneficiario');
  Route::get('getColoniasB', 'ProgramasController@getColonias');
  Route::get('getDemarcacion', 'ProgramasController@getDemarcacion');

  Route::get('colonias', 'ColoniasController@listado')->name("coloniasB");
  Route::get('getDatosCol', 'ColoniasController@getDatosCol');
  Route::get('informeCol/{id}', 'ColoniasController@informeCol');
  Route::get('informeColRub/{id}/{rub}', 'ColoniasController@informeColRub');

  Route::get('solicitudes', 'SolicitudesController@listado')->name("solicitudes");
  Route::get('solicitud/create', 'SolicitudesController@create')->name('createSolicitud');
  Route::post('solicitud/store', 'SolicitudesController@store')->name('storeSolicitud');
  Route::get('solicitud/show/{id}', 'SolicitudesController@show')->name('showSolicitud');
  Route::get('solicitud/edit/{id}', 'SolicitudesController@edit')->name('editSolicitud');
  Route::put('solicitud/update', 'SolicitudesController@update')->name('updateSolicitud');
  Route::get('solicitud/delete/{id}', 'SolicitudesController@delete');
  Route::get('solicitudPDF/{id}', 'SolicitudesController@solicitudPDF');
  Route::any('solicitud/beneficiario/store', 'SolicitudesController@storeBeneficiario')->name('storeBeneficiarioSol');
  Route::get('beneficiarioSol/edit/{id}', 'SolicitudesController@editBeneficiario')->name('editBeneficiarioSol');
  Route::get('beneficiarioSol/delete/{id}', 'SolicitudesController@deleteBeneficiario')->name('deleteBeneficiarioSol');
  Route::put('beneficiarioSol/update', 'SolicitudesController@updateBeneficiario')->name('updateBeneficiarioSol');
  Route::get('padronBeneficiarios', 'SolicitudesController@beneficiarios')->name("padronBeneficiarios");
  Route::get('padronBenSol/{id}', 'SolicitudesController@padronBenSol')->name('padronBenSol');

  Route::get('rubros', 'RubrosController@listado')->name("rubros");
  Route::get('rubro/create', 'RubrosController@create')->name('createRubro');
  Route::post('rubro/store', 'RubrosController@store')->name('storeRubro');
  Route::get('rubro/edit/{id}', 'RubrosController@edit')->name('editRubro');
  Route::put('rubro/update', 'RubrosController@update')->name('updateRubro');

  Route::get('juntas', 'JuntasPCController@listado')->name("juntas");
  Route::get('cambiaColJunta', 'JuntasPCController@cambiaColJunta');

  

  Route::get('nomina', 'NominaController@consulta')->name("nomina");
  Route::get('cargaNomina', 'NominaController@carga')->name("cargaNomina");
  Route::post('subirNomina', 'NominaController@subir')->name('subirNomina');
  Route::get('buscarNomina', 'NominaController@buscar')->name('buscarNomina');
  Route::post('excelNomina', 'NominaController@excel')->name('excelNomina');
  Route::get('getDeptos', 'NominaController@getDeptos');
  Route::get('nominaAB', 'NominaController@altasBajas')->name("altasBajas");
  Route::get('buscarAB', 'NominaController@buscarAB')->name('buscarAB');
  Route::get('getGrafica', 'NominaController@getGrafica')->name('getGrafica');

  Route::get('respuesta', 'RespuestaRapidaController@listado')->name("respuesta");
  Route::get('respuesta/create', 'RespuestaRapidaController@create')->name('createRespuesta');
  Route::get('respuesta/create2', 'RespuestaRapidaController@create2')->name('createRespuesta2');
  Route::get('respuesta/create3', 'RespuestaRapidaController@create3')->name('createRespuesta3');
  Route::get('getFallas', 'RespuestaRapidaController@getFallas');
  Route::post('respuesta/store', 'RespuestaRapidaController@store')->name('storeRespuesta');
  Route::get('getCalles', 'RespuestaRapidaController@getCalles');
  Route::get('getColonias', 'RespuestaRapidaController@getColonias');
  Route::get('respuesta/ficha/{id}', 'RespuestaRapidaController@ficha')->name('fichaRespuesta');
  Route::get('respuesta/show/{id}', 'RespuestaRapidaController@show')->name('showRespuesta');
  Route::post('avance/store', 'RespuestaRapidaController@storeAvance')->name('storeAvancesReporte');

  Route::any('acciones/{dl?}', 'SeccionesController@index')->name('accionesD');
  Route::any('mapaDist', 'SeccionesController@mapaDist');
  Route::any('mapaSeccAdd', 'SeccionesController@mapaSeccAdd');
  Route::get('coloniaDatos', 'SeccionesController@coloniaDatos');



  Route::get('portadaAreasAtencion', 'AreasAtencionController@portada')->name('portadaAreasAtencion');
  Route::get('areaAtencionIndex/{id}', 'AreasAtencionController@areaIndex')->name('areaAtencionIndex');
  Route::post('storeRespuestaDirectivos', 'AreasAtencionController@respDirectivos')->name('storeRespuestaDirectivos');
  Route::post('changeTimeResponse', 'AreasAtencionController@changeTimeResponse')->name('changeTimeResponse');
  Route::get('seguimiento/{id}', 'AreasAtencionController@seguimiento')->name('seguimiento');
  Route::get('deleteReporte/{id}', 'AreasAtencionController@delete')->name('deleteReporte');
  Route::get('pdfReporteSolicitudes/{tipo}', 'AreasAtencionController@pdf')->name('pdfReporteSolicitudes');



  //******* FICHA INDICADORES DE DESEMPEÑO *******
  Route::get('indexFichaIndicadores', 'FichaIndicadoresController@index')->name('indexFichaIndicadores');
  Route::get('createFichaIndicadores', 'FichaIndicadoresController@create')->name('createFichaIndicadores');
  Route::post('storeFichaIndicadores', 'FichaIndicadoresController@store')->name('storeFichaIndicadores');
  Route::get('getInfoFichaIndicador', 'FichaIndicadoresController@getInfo')->name('getInfoFichaIndicador');
  Route::get('editFichaIndicador/{id}', 'FichaIndicadoresController@edit')->name('editFichaIndicador');
  Route::post('updateFichaIndicadores', 'FichaIndicadoresController@update')->name('updateFichaIndicadores');
  Route::get('deleteFichaIndicador/{id}', 'FichaIndicadoresController@delete')->name('deleteFichaIndicador');
  Route::get('pdfFichaIndicador/{id}', 'FichaIndicadoresController@pdf')->name('pdfFichaIndicador');

  //******* Servicios Municipales *******
  Route::get('indexServiciosMunicipales', 'ServiciosMunicipalesController@index')->name('indexServiciosMunicipales');
  Route::get('createServiciosMunicipales', 'ServiciosMunicipalesController@create')->name('createServiciosMunicipales');
  Route::post('storeServiciosMunicipales', 'ServiciosMunicipalesController@store')->name('storeServiciosMunicipales');
  Route::get('getInfoServiciosMunicipales', 'ServiciosMunicipalesController@getInfo')->name('getInfoServiciosMunicipales');
  Route::get('editServiciosMunicipales/{id}', 'ServiciosMunicipalesController@edit')->name('editServiciosMunicipales');
  Route::post('updateServiciosMunicipales', 'ServiciosMunicipalesController@update')->name('updateServiciosMunicipales');
  Route::get('deleteServiciosMunicipales/{id}', 'ServiciosMunicipalesController@delete')->name('deleteServiciosMunicipales');
  Route::get('pdfServiciosMunicipales/{tipo}', 'ServiciosMunicipalesController@pdf')->name('pdfServiciosMunicipales');
  Route::get('showServiciosMunicipales/{id}', 'ServiciosMunicipalesController@show')->name('showServiciosMunicipales');

  //******* FICHA INDICADORES DE ECOLOGIA *******
  Route::get('indexEcologia', 'EcologiaController@index')->name('indexEcologia');
  Route::get('createEcologia', 'EcologiaController@create')->name('createEcologia');
  Route::post('storeEcologia', 'EcologiaController@store')->name('storeEcologia');
  Route::get('editEcologia/{id}', 'EcologiaController@edit')->name('editEcologia');
  Route::post('updateEcologia', 'EcologiaController@update')->name('updateEcologia');
  Route::get('deleteEcologia/{id}', 'EcologiaController@delete')->name('deleteEcologia');
  Route::get('pdfEcologia/{id}', 'EcologiaController@pdf')->name('pdfEcologia');


  Route::get('indexParqueJardin', 'ParqueJardinController@index')->name('indexParqueJardin');
  Route::get('solicitud', 'ParqueJardinController@create')->name('solicitud');
  Route::post('storeSolicitudParqueJardin', 'ParqueJardinController@store')->name('storeSolicitudParqueJardin');
  Route::get('editSolicitudParqueJardin/{id}', 'ParqueJardinController@edit')->name('editSolicitudParqueJardin');
  Route::post('updateSolicitudParqueJardin', 'ParqueJardinController@update')->name('updateSolicitudParqueJardin');


  Route::get('catalogos/unidades', 'CatalogosController@unidadesIndex')->name('unidades');
  Route::get('unidad/create', 'CatalogosController@unidadCreate')->name('createUnidad');
  Route::post('unidad/store', 'CatalogosController@unidadStore')->name('storeUnidad');
  Route::get('unidad/edit/{id}', 'CatalogosController@unidadEdit')->name('editUnidad');

  Route::get('lineasAccion', 'LineasAccionController@listado')->name("lineasAccion");
  Route::get('lineaAccion/create', 'LineasAccionController@create')->name("createLineaAccion");
  Route::post('lineaAccion/store', 'LineasAccionController@store')->name('storeLineaAccion');
  Route::get('lineaAccion/avance/{id}', 'LineasAccionController@avance')->name('avanceLineaAccion');
  Route::post('avances/store', 'LineasAccionController@storeAvances')->name('storeAvancesAc');

  Route::get('panelAc', 'LineasAccionController@panel')->name("panelAc");
  Route::get('getAccion', 'LineasAccionController@getAccion');
  Route::get('pdfAcciones/{id}', 'LineasAccionController@pdf');

});

Route::get('respuestaShow/{id}', 'AreasAtencionController@show')->name('respuestaShow');
Route::post('storeVoBoSolicitante', 'AreasAtencionController@storeVoBoSolicitante')->name('storeVoBoSolicitante');
