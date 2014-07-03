<?php

Route::group(array('before' => 'guest'), function()
{
	// Nos mostrará el formulario de login.
	Route::get('login', 'AuthController@showLogin');

	// Validamos los datos de inicio de sesión.
	Route::post('login', 'AuthController@postLogin');

    Route::post('/api_sms/direccion/{id}', 'SmsController@getDireccion');
});

// Nos indica que las rutas que están dentro de él sólo serán mostradas si antes el usuario se ha autenticado.
Route::group(array('before' => 'auth'), function()
{
    // Esta será nuestra ruta de bienvenida.
    Route::get('/', 'PersonaController@index');
    Route::get('/personas', ['as' => 'persona.admin', 'uses' => 'PersonaController@index']);
    Route::get('/persona/get_ajax_personas/{trash?}', 'PersonaController@get_ajax_personas');
    Route::get('/persona/delete/{id}', ['as' => 'persona.delete', 'uses' => 'PersonaController@delete']);
    Route::get('/personas/{trash}', ['as' => 'persona.trash', 'apluses' => 'PersonaController@index'])->where('trash', 'trash');
    Route::get('/persona/get_ajax_personas_trash', 'PersonaController@get_ajax_personas_trash');
    Route::get('/persona/restore/{id}', ['as' => 'persona.restore', 'uses' => 'PersonaController@restore']);
    Route::get('/persona/show/{id}', ['as' => 'persona.show', 'uses' => 'PersonaController@show']);

    // Esta ruta nos servirá para cerrar sesión.
    Route::get('logout', 'AuthController@logOut');

    Route::get('/visita/create/{id_persona?}', ['as' => 'visita.create', 'uses' => 'VisitaController@create']);
    Route::post('/visita/store', ['as' => 'visita.store', 'uses' => 'VisitaController@store']);

    Route::post('persona/ajax_store', 'PersonaController@ajaxStore');
    Route::post('publicador/ajax_store', 'PublicadorController@ajaxStore');

    Route::get('registros/pdf','ReportesController@registros');

    Route::get('persona/pdf/{id}','ReportesController@persona');
    Route::get('persona/','PersonaController@index');
    
    Route::get('excel','ReportesController@excel');

});