<?php

Route::get('/', function () {
    return view('index');
});


Auth::routes();

Route::get('/cadastroequipamento', 'EquipamentoController@index');

Route::resource('usuarios', 'UserController', [
	'names' => [
		'edit' => 'usuarios.editar',
		'create' => 'usuarios.cadastro',
]]);

Route::resource('cargos', 'RoleController');

Route::resource('permissoes', 'PermissionController');
