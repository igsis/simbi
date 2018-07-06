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

		Route::any('ativar-user','UserController@ativarUser')->name('ativar.user');

		Route::any('ativar-equipamento','EquipamentoController@ativarEquipamento')->name('ativar.equipamento');

		Route::any('usuarios/search', 'UserController@searchUser')->name('search-user');


		Route::post('usuarios/{usuario}/vincular', 'UserController@vinculaEquipamento');

		# Gerenciar Selects
		Route::group(['prefix' => 'gerenciar'], function(){
			
			Route::group(['prefix' => 'tipo-servico'], function(){
				Route::get('/' , 'TipoServicoController@index')->name('tipoServico');

				// Route::post()...
			});

			Route::group(['prefix' => 'sigla-equipamento'], function(){
				Route::get('/' , 'EquipamentoSiglaController@index')->name('siglaEquipamento');
			});

			Route::group(['prefix' => 'secretaria'], function(){
				Route::get('/' , 'SecretariaController@index')->name('secretaria');
			});

			Route::group(['prefix' => 'subordinacao-administrativa'], function(){
				Route::get('/' , 'SubordinacaoAdministrativaController@index')->name('subordinacaoAdministrativa');
			});

			Route::group(['prefix' => 'prefeitura-regional'], function(){
				Route::get('/' , 'PrefeituraRegionalController@index')->name('prefeituraRegional');
			});

			Route::group(['prefix' => 'distrito'], function(){
				Route::get('/' , 'DistritoController@index')->name('distrito');
			});

		});
		
	});

});

