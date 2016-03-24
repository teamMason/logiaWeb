<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'uses' => 'navegacion@home',
    'as'   => 'home',

]);

//Secciónes PUBLICAS

Route::get('news', [
    'uses' => 'navegacion@news',
    'as'   => 'news'
]);
Route::get('/tag', 'navegacion@news');

Route::get('news/{slug}', [
    'as'   => 'article',
    'uses' => 'navegacion@article'
]);

Route::get('/tag/{tag}', [
    'as'   => 'tagged',
    'uses' => 'navegacion@tags'

]);




Route::group([ 'middleware' => 'auth' ], function () {
    Route::get('admin', [
        'as'   => 'adminSite',
        'uses' => 'adminController@admin'

    ]);
});

//contacto

Route::post('/contacto', [
    'uses' => 'navegacion@guardarContacto',
    'as'   => 'SendBuzon'
]);

Route::get('contacto/gracias', [
    'uses' => 'navegacion@redirect',
    'as'   => 'gracias'
]);

Route::get('/buzon/{id}', 'adminController@leido');
Route::post('admin/buzon/', 'adminController@borrarMensaje');

/*SECCION CON LOGUIN PARA BIBLIOTECA*/
Route::group([ 'middleware' => [ 'auth' ], 'role:maestro', 'role:companero', 'role:aprendiz' ], function () {
    Route::get('admin/bibliotecaMiembros', [
        'uses' => 'navegacion@bibliotecaMiembros',
        'as'   => 'bibliotecaMiembros'
    ]);

    Route::post('admin/bibliotecaMiembros/busqueda', [
        'uses' => 'navegacion@buscadorPorNombre',
        'as'   => 'l'
    ]);
});

//Sección de ADMINISTRADOR
Route::group([ 'middleware' => [ 'auth', 'role:administrador' ] ], function () {



    /*ADMINISTRACION DEL BLOG*/
    Route::get('admin/admin/post/{id}/edit', 'adminController@edit');

    Route::get('/admin/adminBlog', [
        'as'   => 'adminBlog',
        'uses' => 'adminController@blog'
    ]);

    Route::post('admin/admin/post/{id}/refresh', [
        'uses' => 'adminController@refresh',
        'as'   => 'refresh'
    ]);

    Route::get('/admin/admin/post/nuevo', [
        'uses' => 'adminController@nuevoArticulo',
        'as'   => 'crearArticle'

    ]);

    Route::post('/admin/admin/post/nuevo', 'adminController@crearArticulo');

    Route::post('/admin/adminBlog', 'adminController@borrarArticulo');

    /*ADMINISTRACION DE MIEMBROS*/

    Route::get('miembros/crear', [

        'uses' => 'adminMiembros@registrarMiembros',
        'as'   => 'registrarMiembros'
    ]);

    Route::post('/miembros/crear', 'adminMiembros@enviarRegistro');

    /*ADMINISTRACION DE PDF'S*/

    Route::get('admin/biblioteca', [
        'uses' => 'adminController@biblioteca',
        'as'   => 'biblioteca'
    ]);

    Route::post('admin/biblioteca/', 'adminController@deleteBook');
    Route::post('admin/biblioteca/editar/{id}', 'adminController@editBook');

    Route::post('admin/biblioteca/upload', [
        'uses' => 'adminController@uploadBook',
        'as'   => 'uploadBook'
    ]);
    /*APROBACION DE MIEMBROS */
    Route::get('/admin/aprobaciones', [
        'uses' => 'adminMiembros@aprobarMiembros',
        'as'   => 'aprobaciones'
    ]);

    Route::post('/admin/aprobaciones/', 'adminMiembros@borrarSolicitud');
    Route::post('admin/verVotacion', 'adminMiembros@borrarVotacion');

    Route::post('enviarAVotacion/{id}', 'adminMiembros@enviarAVotacion');

    Route::get('admin/verVotacion', [
        'uses' => 'adminMiembros@verVotaciones',
        'as'   => 'votaNeofitos'
    ]);

    Route::get('admin/buzon', [
        'uses' => 'adminController@verBuzon',
        'as'   => 'buzon'

    ]);

    Route::get('verVotacion/{id}', 'adminMiembros@verVotosMiembro');
    Route::get('verVotacion/aprobarIniciacion/{id}/', 'adminMiembros@aprobarIniciacion');
    Route::get('/verVotacion/{id_taller}/{id_sol}', 'adminMiembros@miembroAceptado');

    Route::get('admin/miembros/consulta', [
        'uses' => 'adminMiembros@consultaMiembros',
        'as'   => 'consulta'

    ]);

    Route::post('admin/miembros/consulta/{id}', 'adminMiembros@actualizaMiembros');

<<<<<<< HEAD
    
=======


    /*APROBACIÓN DE VENERABLES MAESTROS*/

    Route::get('admin/aprobaciones/venerables',[
        'uses' => 'adminMiembros@aprobarVen',
        'as'   => 'confirmVen'
    ]);


    Route::get('admin/confirmacion/{token}',[
        'uses' => 'adminMiembros@getConfirmacion',
        'as'   => 'confirmacion'
    ]);

    Route::get('admin/confirmacion/borrar/{id}',[
        'uses' => 'adminMiembros@borrarRegistro',
        'as'   => 'rechazarRegistro'
    ]);


    Route::get('admin/confirmacion/rechazar/{id}',[
        'uses' => 'adminMiembros@rechazarRegistro',
        'as'   => 'rechazarRegistro'
    ]);

    Route::get('admin/alta/administrativos',[
        'uses' => 'adminMiembros@registroAdministrativos',
        'as'   => 'registraAdministrativa'
    ]);
    Route::post('admin/alta/success',[
        'uses' => 'adminMiembros@altaAdministrativos',
        'as'   => 'altaAdministrativa'
    ]);








>>>>>>> 9a8b8cb04948f94002a1fa5ee34663740333cd59
    /* ROUTES ADD CESAR */

    Route::get('/reportes/index', 'ReportesController@getIndex');

    //Route::get('/administrador/mostrarpdf', 'pdfControllerTodos@mostrarFacturas');
    Route::get('/administrador/mostrarpdf', [
        'uses' => 'pdfControllerTodos@mostrarFacturas',
        'as' => 'listaFacturas'
    ]);

    //generar una factura individual por taller
    Route::post('/PDF/create', 'pdfListaController@invoiceIndividual');

    //gnerar una factura individual por taller
    Route::get('/PDF/create', 'pdfListaController@create');

    //generar las facturas del mes de todos los talleres
    Route::get('/PDF/downloadAll', 'pdfControllerTodos@invoiceAll');

    Route::post('/PDF/mostrarRecibos', 'pdfListaPagosAdeudosController@mostrarRecibos');

//mostrar lista para seleccionar un taller que realizara un pago y te envia a administrador/mostrarRecibo
    Route::get('/PDF/enviaTalleres', 'pdfListaPagosAdeudosController@enviaTalleres');

//enviar el monto del taller que desea introducir y te envia a administrador/recibePago/{id}
<<<<<<< HEAD
    Route::post('/administrador/mostrarRecibo', 'listaIntroducePagoController@mostrarRecibo');//muestra el monto a pagar y el input para el valor

    Route::post('/administrador/recibePago/{id}', 'listaIntroducePagoController@recibePago');
=======
    Route::post('/administrador/mostrarRecibo',
        'listaIntroducePagoController@mostrarRecibo');//muestra el monto a pagar y el input para el valor
>>>>>>> 9a8b8cb04948f94002a1fa5ee34663740333cd59

    Route::get('/administrador/enviaTaller', 'listaIntroducePagoController@enviaListaTalleres');

    

    Route::get('/PDF/invoice', 'PdfController@invoice');

    Route::resource('/index', 'ExcelController@index');


});

<<<<<<< HEAD
Route::get('dashboard', 'DashboardController@index');//GRAFICAS



=======
>>>>>>> 9a8b8cb04948f94002a1fa5ee34663740333cd59
//Sección de TESORERO
Route::group([ 'middleware' => [ 'auth', 'role:tesorero' ], 'prefix' => 'tes' ], function () {
    /* ROUTES ADD CESAR */

    Route::get('/reportes/index', 'ReportesController@getIndex');

    Route::get('/administrador/mostrarpdf', 'pdfControllerTodos@mostrarFacturas');
    //gnerar una factura individual por taller
    Route::post('/PDF/create', 'pdfListaController@invoiceIndividual');
    //gnerar una factura individual por taller
    Route::get('/PDF/create', 'pdfListaController@create');

    //generar las facturas del mes de todos los talleres
    Route::get('/PDF/downloadAll', 'pdfControllerTodos@invoiceAll');

    Route::post('/PDF/mostrarRecibos', 'pdfListaPagosAdeudosController@mostrarRecibos');

//mostrar lista para seleccionar un taller que realizara un pago y te envia a administrador/mostrarRecibo
    Route::get('/PDF/enviaTalleres', 'pdfListaPagosAdeudosController@enviaTalleres');

//enviar el monto del taller que desea introducir y te envia a administrador/recibePago/{id}
    Route::post('/administrador/mostrarRecibo',
        'listaIntroducePagoController@mostrarRecibo');//muestra el monto a pagar y el input para el valor

    Route::get('/administrador/enviaTaller', 'listaIntroducePagoController@enviaListaTalleres');

    Route::post('/administrador/recibePago/{id}', 'listaIntroducePagoController@recibePago');

    Route::get('/PDF/invoice', 'PdfController@invoice');

    Route::resource('/index', 'ExcelController@index');


});

<<<<<<< HEAD


=======
>>>>>>> 9a8b8cb04948f94002a1fa5ee34663740333cd59
//Sección de SECRETARIO

Route::group([ 'middleware' => [ 'auth', 'role:secretario' ] ], function () {

    /*APROBACION DE MIEMBROS */
    Route::get('/admin/aprobaciones', [
        'uses' => 'adminMiembros@aprobarMiembros',
        'as'   => 'aprobaciones'
    ]);

    Route::post('/admin/aprobaciones/', 'adminMiembros@borrarSolicitud');
    Route::post('admin/verVotacion', 'adminMiembros@borrarVotacion');

    Route::post('enviarAVotacion/{id}', 'adminMiembros@enviarAVotacion');

    Route::get('admin/verVotacion', [
        'uses' => 'adminMiembros@verVotaciones',
        'as'   => 'votaNeofitos'
    ]);

    Route::get('admin/buzon', [
        'uses' => 'adminController@verBuzon',
        'as'   => 'buzon'

    ]);

    Route::get('verVotacion/{id}', 'adminMiembros@verVotosMiembro');
    Route::get('verVotacion/aprobarIniciacion/{id}/', 'adminMiembros@aprobarIniciacion');
    Route::get('/verVotacion/{id_taller}/{id_sol}', 'adminMiembros@miembroAceptado');

    Route::get('admin/miembros/consulta', [
        'uses' => 'adminMiembros@consultaMiembros',
        'as'   => 'consulta'

    ]);

    Route::post('admin/miembros/consulta/{id}', 'adminMiembros@actualizaMiembros');


});

//Sección de VENERABLE

Route::group([ 'middleware' => [ 'auth', 'role:venerable' ] ], function () {

    //Mostrar la factura del taller dependiendo del venerable
    Route::get('/venerable/factura', 'facturaVenerableController@envia');
    
    Route::get('miembros/solicitud', [
        'uses' => 'venerableController@registrarSolicitud',
        'as'   => 'registrarSolicitud'

    ]);

    Route::post('miembros/solicitud', 'venerableController@enviarSolicitud');
    Route::get('admin/votacionesMiembros', [
        'uses' => 'venerableController@verProspectos',
        'as'   => 'votaciones'
    ]);

    Route::post('admin/votacionesMiembros/{id}/{taller}', 'venerableController@enviarVotacion');

    Route::get('admin/votacionesMiembros', [
        'uses' => 'venerableController@verProspectos',
        'as'   => 'votaciones'
    ]);

    Route::get('admin/votacionesMiembros', [
        'uses' => 'venerableController@verProspectos',
        'as'   => 'votaciones'
    ]);

    Route::get('admin/iniciaciones', [
        'uses' => 'venerableController@estatusIniciacion',
        'as'   => 'iniciaciones'

    ]);

    Route::get('admin/iniciaciones/{id}', [
        'uses' => 'venerableController@finDeIniciacion',
        'as'   => 'finInic'
    ]);

    Route::get('admin/consultas/', [
        'uses' => 'venerableController@consultaMiembrosTaller',
        'as'   => 'consultaMTaller'
    ]);

    Route::post('admin/update/{id}', 'venerableController@actualizaMiembros');

    Route::get('admin/estatus/{id}', 'venerableController@bajaMiembro');

    /*MOVIMIENTOS CON CARGOS*/

    Route::get('admin/aumentos/{id_taller}/{id_miembro}', 'venerableController@aumentosSalario');

    Route::get('admin/estatus/alta/{id}', 'venerableController@altaMiembro');


});

// AUTHENTICATION ROUTES
Route::get('login', [
    'uses' => 'Auth\AuthController@getLogin',
    'as'   => 'login'
]);
Route::post('login', [
    'uses' => 'Auth\AuthController@postLogin',
    'as'   => 'login'
]);

// Registration routes...
Route::get('registrar/venerable/', [
    'uses' => 'Auth\AuthController@getRegister',
    'as'   => 'register'
]);
Route::post('registrar/venerable/', [
    'uses' => 'Auth\AuthController@postRegister',
    'as'   => 'register'
]);







//Logout
Route::get('logout', [
    'uses' => 'Auth\AuthController@getLogout',
    'as'   => 'logout'
]);

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');



