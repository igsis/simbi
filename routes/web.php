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

				Route::post('/' , 'TipoServicoController@create')->name('createTipoServico');

				Route::put('/{id}' , 'TipoServicoController@update')->name('editTipoServico');

				Route::delete('/{id}' , 'TipoServicoController@destroy')->name('deleteTipoServico');
			});

			Route::group(['prefix' => 'sigla-equipamento'], function(){
				Route::get('/' , 'EquipamentoSiglaController@index')->name('siglaEquipamento');

				Route::post('/' , 'EquipamentoSiglaController@create')->name('createSiglaEquipamento');

				Route::put('/{id}' , 'EquipamentoSiglaController@update')->name('editSiglaEquipamento');

				Route::delete('/{id}' , 'EquipamentoSiglaController@destroy')->name('deleteSiglaEquipamento');
			});

			Route::group(['prefix' => 'secretaria'], function(){
				Route::get('/' , 'SecretariaController@index')->name('secretaria');

				Route::post('/' , 'SecretariaController@create')->name('createSecretaria');

				Route::put('/{id}' , 'SecretariaController@update')->name('editSecretaria');

				Route::delete('/{id}' , 'SecretariaController@destroy')->name('deleteSecretaria');
			});

			Route::group(['prefix' => 'subordinacao-administrativa'], function(){
				Route::get('/' , 'SubordinacaoAdministrativaController@index')->name('subordinacaoAdministrativa');

				Route::post('/' , 'SubordinacaoAdministrativaController@create')->name('createSubordinacaoAdministrativa');

				Route::put('/{id}' , 'SubordinacaoAdministrativaController@update')->name('editSubordinacaoAdministrativa');

				Route::delete('/{id}' , 'SubordinacaoAdministrativaController@destroy')->name('deleteSubordinacaoAdministrativa');
			});

			Route::group(['prefix' => 'prefeitura-regional'], function(){
				Route::get('/' , 'PrefeituraRegionalController@index')->name('prefeituraRegional');

				Route::post('/' , 'PrefeituraRegionalController@create')->name('createPrefeituraRegional');

				Route::put('/{id}' , 'PrefeituraRegionalController@update')->name('editPrefeituraRegional');

				Route::delete('/{id}', 'PrefeituraRegionalController@destroy')->name('deletePrefeituraRegional');
			});

			Route::group(['prefix' => 'distrito'], function(){
				Route::get('/' , 'DistritoController@index')->name('distrito');

				Route::post('/', 'DistritoController@create')->name('createDistrito');

				Route::put('/{id}', 'DistritoController@update')->name('editDistrito');

				Route::delete('/{id}', 'DistritoController@destroy')->name('deleteDistrito');
			});

		});
		
	});

});

