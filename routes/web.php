<?php

Route::get('/', function () {
    return view('index');
});

Route::get('home', function () {
    return view('index');
})->middleware('primeiroLogin');


Auth::routes();


Route::group(['middleware' => 'auth'], function (){

	Route::get('seguranca', 'UserController@perguntaSeguranca');

	Route::post('seguranca', 'UserController@updatePergunta')->name('seguranca');

	Route::group(['middleware' => 'primeiroLogin'], function (){

		Route::resource('equipamentos', 'EquipamentoController', [
			'names' => [
				'edit' => 'equipamentos.editar',
				'create' => 'equipamentos.cadastro',
		]]);

		Route::any('equipamentos-search', 'EquipamentoController@searchEquipamento')->name('search-equipamento');

		Route::resource('usuarios', 'UserController', [
			'names' => [
				'edit' => 'usuarios.editar',
				'create' => 'usuarios.cadastro',
		]]);

		// Route::any('desativados','UserController@disabled')->name('usuarios.desativados');

		Route::any('ativar-user','UserController@ativarUser')->name('ativar.user');

		Route::any('ativar-equipamento','UserController@ativarEquipamento')->name('ativar.equipamento');

		Route::any('usuarios/search', 'UserController@searchUser')->name('search-user');

		// Route::any('usuarios/search/disabled', 'UserController@userDisabled')->name('users.disabled');


		Route::post('usuarios/vincula', 'UserController@vinculaEquipamento');
		
	});

});

