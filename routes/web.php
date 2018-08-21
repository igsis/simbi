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

        Route::group(['prefix' => 'usuarios'], function() {
            Route::any('/search', 'UserController@searchUser')->name('search-user');

            Route::post('/{usuario}/vincular', 'UserController@vinculaEquipamento');

            Route::post('/{usuario}/reset', 'UserController@vinculaEquipamento')->name('usuarios.reset');
        });

        Route::group(['prefix' => 'equipamentos'], function() {

            Route::group(['prefix' => 'detalhes/{equipamento}'], function(){
              Route::get('/', 'EquipamentoController@criaDetalhes')->name('equipamentos.criaDetalhes');

              Route::post('/novo', 'EquipamentoController@gravaDetalhes')->name('equipamentos.gravaDetalhes');

              Route::post('/editar', 'EquipamentoController@atualizaDetalhes')->name('equipamentos.atualizaDetalhes');

            });

            Route::get('/{equipamento}/acessibilidade', 'EquipamentoController@criaAcessibilidade')->name('equipamentos.criaAcessibilidade');

            Route::post('/{equipamento}/acessibilidade', 'EquipamentoController@gravaAcessibilidade')->name('equipamentos.gravaAcessibilidade');

            Route::get('/{equipamento}/capacidade', 'EquipamentoController@criaCapacidade')->name('equipamentos.criaCapacidade');

            Route::post('/{equipamento}/capacidade', 'EquipamentoController@gravaCapacidade')->name('equipamentos.gravaCapacidade');

            Route::group(['prefix' => 'area/{equipamento}'], function(){
              Route::get('/', 'EquipamentoController@criaArea')->name('equipamentos.criaArea');

              Route::post('/novo', 'EquipamentoController@gravaArea')->name('equipamentos.gravaArea');

              Route::post('/editar', 'EquipamentoController@atualizaArea')->name('equipamentos.atualizaArea');
            });

            Route::get('/{equipamento}/reforma', 'EquipamentoController@criaReforma')->name('equipamentos.criaReforma');

            Route::post('/{equipamento}/reforma', 'EquipamentoController@gravaReforma')->name('equipamentos.gravaReforma');

            Route::post('/ocorrencia', 'EquipamentoController@equipamentoOcorrencia')->name('equipamento.ocorrencia');

            Route::get('/ocorrencias/{equipamento}', 'EquipamentoController@countOcorrencias')->name('ocorrencias.count');
        });


        # Gerenciar Selects
		Route::group(['prefix' => 'gerenciar'], function(){

            Route::group(['prefix' => 'cargo'], function(){
                Route::get('/' , 'CargoController@index')->name('cargo');

                Route::get('/desativados' , 'CargoController@disabled')->name('cargoDisabled');

                Route::post('/' , 'CargoController@create')->name('createCargo');

                Route::put('/{id}' , 'CargoController@update')->name('editCargo');

                Route::put('/ativar/{id}' , 'CargoController@toActivate')->name('toActivateCargo');

                Route::delete('/{id}' , 'CargoController@destroy')->name('deleteCargo');

                Route::post('/search' , 'CargoController@search')->name('searchCargo');
            });

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

        Route::group(['prefix' => 'frequencia'], function(){

            Route::get('/', 'FrequenciaController@index')->name('frequencia.index');

            Route::get('/relatorio', 'FrequenciaController@relatorio')->name('frequencia.relatorio');

            Route::get('/{equipamento}/cadastro', 'FrequenciaController@create')->name('frequencia.cadastro');

            Route::post('/{equipamento}/cadastro', 'FrequenciaController@store')->name('frequencia.gravar');

            Route::get('/{equipamento}/listar', 'FrequenciaController@listar')->name('frequencia.listar');

        });

        Route::group(['prefix' => 'frequencia-publico-atendido'], function(){

            Route::get('/', 'FrequenciaController@index')->name('frequencia.publico.index');

            Route::get('/relatorio', 'FrequenciasPublicoController@relatorio')->name('frequencia.publico.relatorio');

            Route::get('/{equipamento}/cadastro', 'FrequenciasPublicoController@create')->name('frequencia.publico.cadastro');

            Route::post('/{equipamento}/cadastro', 'FrequenciasPublicoController@store')->name('frequencia.publico.gravar');

            Route::get('/{equipamento}/listar', 'FrequenciasPublicoController@listar')->name('frequencia.publico.listar');

        });

	});

});
