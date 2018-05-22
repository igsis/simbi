<?php

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::resource('equipamentos', 'EquipamentoController', [
	'names' => [
		'edit' => 'equipamentos.editar',
		'create' => 'equipamentos.cadastro',
]]);

Route::resource('usuarios', 'UserController', [
	'names' => [
		'edit' => 'usuarios.editar',
		'create' => 'usuarios.cadastro',
]]);

Route::group(['middleware' => 'auth'], function (){

	Route::get('seguranca', 'UserController@testePergunta');

	Route::post('teste', 'UserController@testePergunta');

	Route::group(['middleware' => 'primeiroLogin'], function (){
		Route::get('teste', 'UserController@testePergunta');
	});

});

