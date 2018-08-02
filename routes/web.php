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

		Route::get('frequencia', 'UserController@frequencia')->name('frequencia');

		Route::post('frequencia', 'UserController@createFrequencia')->name('createFrequencia');

        Route::get('equipamentos/{equipamento}/detalhes', 'EquipamentoController@criaDetalhes')->name('equipamentos.criaDetalhes');

        Route::post('equipamentos/{equipamento}/detalhes', 'EquipamentoController@gravaDetalhes')->name('equipamentos.gravaDetalhes');

        Route::get('equipamentos/{equipamento}/acessibilidade', 'EquipamentoController@criaAcessibilidade')->name('equipamentos.criaAcessibilidade');

        Route::post('equipamentos/{equipamento}/acessibilidade', 'EquipamentoController@gravaAcessibilidade')->name('equipamentos.gravaAcessibilidade');

        Route::get('equipamentos/{equipamento}/capacidade', 'EquipamentoController@criaCapacidade')->name('equipamentos.criaCapacidade');

        Route::post('equipamentos/{equipamento}/capacidade', 'EquipamentoController@gravaCapacidade')->name('equipamentos.gravaCapacidade');

        Route::get('equipamentos/{equipamento}/area', 'EquipamentoController@criaArea')->name('equipamentos.criaArea');

        Route::post('equipamentos/{equipamento}/area', 'EquipamentoController@gravaArea')->name('equipamentos.gravaArea');

        Route::get('equipamentos/{equipamento}/reforma', 'EquipamentoController@criaReforma')->name('equipamentos.criaReforma');

        Route::post('equipamentos/{equipamento}/reforma', 'EquipamentoController@gravaReforma')->name('equipamentos.gravaReforma');

        Route::post('equipamentos/ocorrencia', 'EquipamentoController@equipamentoOcorrencia')->name('equipamento.ocorrencia');
        


        # Gerenciar Selects
		Route::group(['prefix' => 'gerenciar'], function(){
			
			Route::group(['prefix' => 'tipo-servico'], function(){
				Route::get('/' , 'TipoServicoController@index')->name('tipoServico');

				Route::get('/desativados' , 'TipoServicoController@disabled')->name('tipoServicoDisabled');

				Route::post('/' , 'TipoServicoController@create')->name('createTipoServico');

				Route::put('/{id}' , 'TipoServicoController@update')->name('editTipoServico');

				Route::put('/ativar/{id}' , 'TipoServicoController@toActivate')->name('toActivateTipoServico');

				Route::delete('/{id}' , 'TipoServicoController@destroy')->name('deleteTipoServico');

				Route::post('/search' , 'TipoServicoController@search')->name('searchTipoServico');
			});

			Route::group(['prefix' => 'sigla-equipamento'], function(){
				Route::get('/' , 'EquipamentoSiglaController@index')->name('siglaEquipamento');

				Route::get('/desativados' , 'EquipamentoSiglaController@disabled')->name('siglaEquipamentoDisabled');

				Route::post('/' , 'EquipamentoSiglaController@create')->name('createSiglaEquipamento');				

				Route::put('/{id}' , 'EquipamentoSiglaController@update')->name('editSiglaEquipamento');

				Route::put('/ativar/{id}' , 'EquipamentoSiglaController@toActivate')->name('toActivateSiglaEquipamento');

				Route::delete('/{id}' , 'EquipamentoSiglaController@destroy')->name('deleteSiglaEquipamento');

				Route::post('/search' , 'EquipamentoSiglaController@search')->name('searchSiglaEquipamento');
			});

			Route::group(['prefix' => 'secretaria'], function(){
				Route::get('/' , 'SecretariaController@index')->name('secretaria');

				Route::get('/desativados' , 'SecretariaController@disabled')->name('secretariaDisabled');

				Route::post('/' , 'SecretariaController@create')->name('createSecretaria');

				Route::put('/{id}' , 'SecretariaController@update')->name('editSecretaria');

				Route::put('/ativar/{id}' , 'SecretariaController@toActivate')->name('toActivateSecretaria');

				Route::delete('/{id}' , 'SecretariaController@destroy')->name('deleteSecretaria');

				Route::post('/search' , 'SecretariaController@search')->name('searchSecretaria');
			});

			Route::group(['prefix' => 'subordinacao-administrativa'], function(){
				Route::get('/' , 'SubordinacaoAdministrativaController@index')->name('subordinacaoAdministrativa');

				Route::get('/desativados' , 'SubordinacaoAdministrativaController@disabled')->name('subordinacaoAdministrativaDisabled');

				Route::post('/' , 'SubordinacaoAdministrativaController@create')->name('createSubordinacaoAdministrativa');

				Route::put('/{id}' , 'SubordinacaoAdministrativaController@update')->name('editSubordinacaoAdministrativa');

				Route::put('/ativar/{id}' , 'SubordinacaoAdministrativaController@toActivate')->name('toActivateSubordinacaoAdministrativa');

				Route::delete('/{id}' , 'SubordinacaoAdministrativaController@destroy')->name('deleteSubordinacaoAdministrativa');

				Route::post('/search' , 'SubordinacaoAdministrativaController@search')->name('searchSubordinacaoAdministrativa');
			});

			Route::group(['prefix' => 'prefeitura-regional'], function(){
				Route::get('/' , 'PrefeituraRegionalController@index')->name('prefeituraRegional');

				Route::get('/desativados' , 'PrefeituraRegionalController@disabled')->name('prefeituraRegionalDisabled');

				Route::post('/' , 'PrefeituraRegionalController@create')->name('createPrefeituraRegional');

				Route::put('/{id}' , 'PrefeituraRegionalController@update')->name('editPrefeituraRegional');

				Route::put('/ativar/{id}' , 'PrefeituraRegionalController@toActivate')->name('toActivatePrefeituraRegional');

				Route::delete('/{id}', 'PrefeituraRegionalController@destroy')->name('deletePrefeituraRegional');

				Route::post('/search' , 'PrefeituraRegionalController@search')->name('searchPrefeituraRegional');
			});

			Route::group(['prefix' => 'distrito'], function(){
				Route::get('/' , 'DistritoController@index')->name('distrito');

				Route::get('/desativados' , 'DistritoController@disabled')->name('distritoDisabled');

				Route::post('/', 'DistritoController@create')->name('createDistrito');

				Route::put('/{id}', 'DistritoController@update')->name('editDistrito');

				Route::put('/ativar/{id}', 'DistritoController@toActivate')->name('toActivateDistrito');

				Route::delete('/{id}', 'DistritoController@destroy')->name('deleteDistrito');

				Route::post('/search', 'DistritoController@search')->name('searchDistrito');
			});

		});
		
	});

});

