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
	'uses' 	=> 'navegacion@news',
	'as' 	=> 'news'
]);
Route::get('/tag', 'navegacion@news');

Route::get('news/{slug}', [
		'as' 	=> 'article',
		'uses' 	=> 'navegacion@article'
]);

Route::get('/tag/{tag}',[
	'as' 	=> 'tagged',
	'uses' 	=> 'navegacion@tags'

]);

Route::group(['middleware' => 'auth'], function(){
	Route::get('admin', [
		'as' 	=> 'adminSite',
		'uses'  => 'adminController@admin'

	]);
});


//contacto

Route::post('/contacto', [
	'uses'  => 'navegacion@guardarContacto',
	'as'	=> 'SendBuzon'
]);

Route::get('contacto/gracias', [
	'uses' => 'navegacion@redirect',
	'as'   => 'gracias'
]);

Route::get('/buzon/{id}', 'adminController@leido');
Route::post('admin/buzon/', 'adminController@borrarMensaje');





//Sección de ADMINISTRADOR
Route::group(['middleware' => ['auth', 'is_Admin']], function(){

/*ADMINISTRACION DEL BLOG*/
	Route::get('admin/admin/post/{id}/edit', 'adminController@edit');

	Route::get('/admin/adminBlog', [
			'as' 	=> 'adminBlog',
			'uses'  => 'adminController@blog'
		]);

	Route::post('admin/admin/post/{id}/refresh', [
		'uses' => 'adminController@refresh',
		'as' => 'refresh'
	]); 
	
	Route::get('/admin/admin/post/nuevo', [
		'uses' => 'adminController@nuevoArticulo',
		'as' => 'crearArticle'
		
	]); 

	Route::post('/admin/admin/post/nuevo', 'adminController@crearArticulo'); 

	Route::post('/admin/adminBlog', 'adminController@borrarArticulo');

	/*ADMINISTRACION DE MIEMBROS*/

	Route::get('miembros/crear',[

		'uses' => 'adminMiembros@registrarMiembros',
		'as' => 'registrarMiembros'
 	]); 

 	Route::post('/miembros/crear', 'adminMiembros@enviarRegistro' );

    /*ADMINISTRACION DE PDF'S*/

    Route::get('admin/biblioteca',[
        'uses' => 'adminController@biblioteca',
        'as'   => 'biblioteca'
    ]);

    Route::post('admin/biblioteca',[
        'as' => 'uploadBook',
        'uses' => 'adminController@uploadBook'

    ]);

 	


});



//Sección de TESORERO
Route::group(['middleware' => ['auth', 'is_Tesorero'], 'prefix' => 'tes'], function(){	
	Route::get('admin', function(){


	});


});



//Sección de SECRETARIO

Route::group(['middleware' => ['auth', 'is_Secretario']], function(){	
	
	/*APROBACION DE MIEMBROS */
 	Route::get('/admin/aprobaciones', [
 		'uses'  => 'adminMiembros@aprobarMiembros',
 		'as'    => 'aprobaciones'
 	]);

 	Route::post('/admin/aprobaciones/', 'adminMiembros@borrarSolicitud');
 	Route::post('admin/verVotacion',  'adminMiembros@borrarVotacion');


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

Route::group(['middleware' => ['auth', 'is_Venerable']], function(){

	Route::get('miembros/solicitud', [
		'uses' => 'venerableController@registrarSolicitud',
		'as'   => 'registrarSolicitud'
  
	]);	

	Route::post('miembros/solicitud', 'venerableController@enviarSolicitud');
	Route::get('admin/votacionesMiembros', [
 		'uses' => 'venerableController@verProspectos',
 		'as'    => 'votaciones'
 	]);

 	Route::post('admin/votacionesMiembros/{id}/{taller}','venerableController@enviarVotacion');

 	Route::get('admin/votacionesMiembros', [
 		'uses' => 'venerableController@verProspectos',
 		'as'    => 'votaciones'
 	]);

 	Route::get('admin/votacionesMiembros', [
 		'uses' => 'venerableController@verProspectos',
 		'as'    => 'votaciones'
 	]);

 	Route::get('admin/iniciaciones', [
 		'uses' => 'venerableController@estatusIniciacion',
 		'as'   => 'iniciaciones'
 
 	]);

 	Route::get('admin/iniciaciones/{id}', [
 		'uses' => 'venerableController@finDeIniciacion',
 		'as'    => 'finInic'
 	]);

	Route::get('admin/consultas/', [
		'uses' => 'venerableController@consultaMiembrosTaller',
		'as'    => 'consultaMTaller'
	]);

	Route::post('admin/update/{id}', 'venerableController@actualizaMiembros');

 


	
	
	

});


// AUTHENTICATION ROUTES
Route::get('login',  [
	'uses' => 'Auth\AuthController@getLogin',
	'as'	=> 'login'
]);
Route::post('login', [
	'uses' => 'Auth\AuthController@postLogin',
	'as'  => 'login'
]);

// Registration routes...
Route::get('register', [
	'uses' => 'Auth\AuthController@getRegister',
	'as' => 'register'
]);
Route::post('register', [
	'uses' => 'Auth\AuthController@postRegister',
	'as'	=> 'register'
 
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



 /* ROUTES ADD CESAR */

Route::get('/reportes/index', 'ReportesController@getIndex');

Route::get('/PDF/invoice', 'PdfController@invoice');

Route::resource('/index','ExcelController@index');

Route::get('generarPDF', function()
{
    $html = '<html><body>';
    $html.= '<p style="color:red">Generando un sencillo pdf ';
    $html.= 'de forma realmente sencilla.</p>';
    $html.= '</body></html>';
    return PDF::load($html, 'A4', 'portrait')->show();
});

Route::get('descargar', function()
{
    $html = '<html><body>';
    $html.= '<p style="color:red">Generando un sencillo pdf ';
    $html.= 'de forma realmente sencilla.</p>';
    $html.= '</body></html>';
    return PDF::load($html, 'A4', 'portrait')->download('nombreArchivoPdf');
});

Route::get('vista', function()
{
    $html = View::make("hello");
    return PDF::load($html, 'A4', 'portrait')->show();
});
/* ------------------------fIN ROUTES CESAR----------------------------------------------------------*/