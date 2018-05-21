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

Route::resource('cargos', 'RoleController');

Route::resource('permissoes', 'PermissionController');




$this->get('teste', 'UserController@testePergunta');