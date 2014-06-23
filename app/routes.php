<?php

Route::group(array('before' => 'guest'), function()
{
	// Nos mostrará el formulario de login.
	Route::get('login', 'AuthController@showLogin');

	// Validamos los datos de inicio de sesión.
	Route::post('login', 'AuthController@postLogin');
});

// Nos indica que las rutas que están dentro de él sólo serán mostradas si antes el usuario se ha autenticado.
Route::group(array('before' => 'auth'), function()
{
    // Esta será nuestra ruta de bienvenida.
    Route::get('/', 'PersonaController@index');
    Route::get('/persona/get_ajax_personas', 'PersonaController@get_ajax_personas');
    // Esta ruta nos servirá para cerrar sesión.
    Route::get('logout', 'AuthController@logOut');

    Route::resource('visita', 'VisitaController');

    Route::post('persona/ajax_store', 'PersonaController@ajaxStore');
    Route::post('publicador/ajax_store', 'PublicadorController@ajaxStore');

    Route::get('registros/pdf','ReportesController@registros');

    Route::get('persona/pdf/{id}','ReportesController@persona');
    Route::get('persona/','PersonaController@index');
    
    Route::get('excel','ReportesController@excel');

    Route::get('angular', function(){

        return View::make('angular.angular');

    });

    Route::get('angular/getData', function(){

        return Response::json(array('date' => date('r')));
    
    });

});