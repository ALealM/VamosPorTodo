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



Route::get('/admin', 'HomeController@index');
Route::get('/enviaMensaje', 'MensajeController@enviaMensaje');
Route::get('/home', 'HomeController@index');
Auth::routes();
Route::group(['middleware' => 'auth'], function() {

    Route::get('/', 'HomeController@index');
    Route::get('/index', 'HomeController@index');


    Route::get('usuarios/index', 'ReporteController@usuarios')->name("usuarios");
    Route::get('/usuarios/create', 'ReporteController@create')->name("create");
    Route::post('/usuarios/store', 'ReporteController@store')->name("store");
    Route::get('/usuarios/edit/{id}', 'ReporteController@edit')->name("edit");
    Route::put('/usuarios/update', 'ReporteController@update')->name("update");
    Route::get('/usuarios/delete/{id}', 'ReporteController@delete')->name("delete");
    Route::get('/usuarios/permisos/{id}', 'ReporteController@permisos')->name("permisos");
    Route::post('/usuarios/updatepermisos', 'ReporteController@updatepermisos')->name("updatepermisos");
    Route::post('/usuarios/change_pass', 'ReporteController@change_pass')->name("change_pass");

    Route::get('/costos/costos', 'ReporteController@index')->name("costos");
    Route::get('/costos/create', 'ReporteController@createcostos')->name("createcostos");
    Route::post('/costos/store', 'ReporteController@storecostos')->name("storecostos");
    Route::get('/costos/edit/{id}', 'ReporteController@editcostos')->name("editcostos");
    Route::put('/costos/update', 'ReporteController@updatecostos')->name("updatecostos");

    Route::get('/solicitudVG/index', 'SolicitudVGController@index')->name("indexSVG");
    Route::get('/solicitudVG/create', 'SolicitudVGController@create')->name("createSVG");
    Route::post('/solicitudVG/store', 'SolicitudVGController@store')->name("storeSVG");
    Route::get('/solicitudVG/edit/{id}', 'SolicitudVGController@edit')->name("editSVG");
    Route::put('/solicitudVG/update', 'SolicitudVGController@update')->name("updateSVG");
    Route::get('/solicitudVG/delete/{id}', 'SolicitudVGController@delete')->name("deleteSVG");

    Route::get('costos/costos', 'ReporteController@costos');

    Route::get('/facturasEmitidas/index', 'FacturasEmitidasController@index');
    Route::get('/facturasEmitidas/create', 'FacturasEmitidasController@create');
    Route::post('/facturasEmitidas/store', 'FacturasEmitidasController@store');
    Route::get('/facturasEmitidas/edit/{id}', 'FacturasEmitidasController@edit');
    Route::get('/facturasEmitidas/show/{id}', 'FacturasEmitidasController@show');
    Route::put('/facturasEmitidas/update', 'FacturasEmitidasController@update')->name("updateFE");
    Route::get('/facturasEmitidas/delete/{id}', 'FacturasEmitidasController@delete')->name("deleteFE");

    Route::get('/centroCostos/index', 'CentrosCostosController@index');
    Route::get('centroCostos/create/{id}', 'CentrosCostosController@create');
    Route::post('/centroCostos/store', 'CentrosCostosController@store');
    Route::post('/centroCostos/storeComent', 'CentrosCostosController@storeComent');
    Route::get('/centroCostos/edit/{id}', 'CentrosCostosController@edit');
    Route::get('/centroCostos/editComent/{id}', 'CentrosCostosController@editComent');
    Route::get('/centroCostos/show/{id}', 'CentrosCostosController@show');
    Route::get('/centroCostos/showComent/{id}', 'CentrosCostosController@showComent');
    Route::put('/centroCostos/update', 'CentrosCostosController@update')->name("updateCCD");
    Route::put('/centroCostos/updateComent', 'CentrosCostosController@updateComent')->name("updateComent");
    Route::get('/centroCostos/delete/{id}', 'CentrosCostosController@delete')->name("deleteCC");
    Route::get('/centroCostos/deleteComent/{id}', 'CentrosCostosController@deleteComent')->name("deleteComent");
    Route::get('/centroCostos/createComent/{id}', 'CentrosCostosController@createComent')->name("createComent");

    Route::get('/facturas_recibidas/index', 'FacturasRecibidasController@index');
    Route::get('/facturas_recibidas/create', 'FacturasRecibidasController@create');
    Route::post('/facturas_recibidas/store', 'FacturasRecibidasController@store');
    Route::get('/facturas_recibidas/edit/{id}', 'FacturasRecibidasController@edit');
    Route::get('/facturas_recibidas/show/{id}', 'FacturasRecibidasController@show');
    Route::put('/facturas_recibidas/update', 'FacturasRecibidasController@update')->name("updateFR");
    Route::get('/facturas_recibidas/delete/{id}', 'FacturasRecibidasController@delete')->name("deleteFR");

    Route::get('/depositos/index', 'DepositosController@index');
    Route::get('/depositos/create', 'DepositosController@create');
    Route::post('/depositos/store', 'DepositosController@store');
    Route::get('/depositos/edit/{id}', 'DepositosController@edit');
    Route::get('/depositos/show/{id}', 'DepositosController@show');
    Route::put('/depositos/update', 'DepositosController@update')->name("updateDep");
    Route::get('/depositos/delete/{id}', 'DepositosController@delete')->name("deleteDep");

    Route::get('buscaFactura', 'CentrosCostosController@buscaFactura');
    Route::get('buscaFactura2', 'CentrosCostosController@buscaFactura2');
    Route::get('obtenMonto', 'CentrosCostosController@obtenMonto');

    Route::get('/catalogo_cc/index', 'CatalogoCCController@index');
    Route::get('/catalogo_cc/create', 'CatalogoCCController@create');
    Route::post('/catalogo_cc/store', 'CatalogoCCController@store');
    Route::get('/catalogo_cc/edit/{id}', 'CatalogoCCController@edit');
    Route::put('/catalogo_cc/update', 'CatalogoCCController@update')->name('updateCC');
    Route::get('/catalogo_cc/show/{id}', 'CatalogoCCController@show');
    Route::get('/catalogo_cc/delete/{id}', 'CatalogoCCController@delete');
    Route::get('/catalogo_cc/detalle/{id}', 'CentrosCostosController@index');
    Route::get('/catalogo_cc/comentarios/{id}', 'CentrosCostosController@comentarios');

    Route::get('compras/compras', 'ComprasController@index');
    Route::get('compras/create', 'ComprasController@create');
    Route::post('compras/store', 'ComprasController@store');

//bancos
    Route::get('bancos/index', 'BancosController@index');
    Route::get('bancos/create/{id}', 'BancosController@create');
    Route::post('bancos/store', 'BancosController@store');
    Route::get('bancos/show/{id}', 'BancosController@show');
    Route::get('bancos/edit/{id}', 'BancosController@edit');
    Route::post('bancos/update', 'BancosController@update');
    Route::get('bancos/eliminar/{id}', 'BancosController@eliminar');
    Route::post('datosFactura', 'BancosController@datosFactura');

    Route::get('xml', 'XMLController@index');

    Route::post('cargaXMLFR', 'FacturasRecibidasController@cargaXML');
    Route::post('cargaXMLFE', 'FacturasEmitidasController@cargaXML');


    Route::get('excel', 'ExcelController@excel');
    Route::get('guardaTema', 'HomeController@tema');
    Route::get('verificaCorreo', 'HomeController@verificaCorreo');
    Route::get('verificaCorreoEdit', 'HomeController@verificaCorreoEdit');

    Route::get('proyectos', 'CatalogoCCController@proyectos')->name("proyectos");

    Route::get('calendario/{id}', 'ReporteController@calendario');
    Route::get('guardaEvento', 'ReporteController@guardaEvento');
    Route::get('verEvento', 'ReporteController@verEvento');
    Route::get('editaEvento', 'ReporteController@editaEvento');
    Route::get('/calendario/deleteEvento/{id}', 'ReporteController@deleteEvento')->name("deleteEvento");
    
    Route::get('genero', 'HomeController@genero');
    Route::get('candidatoN', 'HomeController@candidatoN');
    Route::get('candidatoE', 'HomeController@candidatoE');
    Route::get('candidatoDel/{id}', 'HomeController@candidatoDel');
    Route::post('simulador/store', 'HomeController@store');
    
    Route::get('plantilla', 'HomeController@plantilla');
    Route::get('datosMunicipio', 'HomeController@datosMunicipio');
    Route::get('editaPlantilla/{mun}', 'HomeController@editaPlantilla');
    Route::post('plantilla/store', 'HomeController@storePlantilla');
});
