<?php

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
  Route::group(['prefix' => 'sigla-equipamento'], function(){
      Route::get('/' , 'EquipamentoSiglaController@index')->name('siglaEquipamento');

      Route::get('/desativados' , 'EquipamentoSiglaController@disabled')->name('siglaEquipamentoDisabled');

      Route::post('/' , 'EquipamentoSiglaController@create')->name('createSiglaEquipamento');

      Route::put('/{id}' , 'EquipamentoSiglaController@update')->name('editSiglaEquipamento');

      Route::put('/ativar/{id}' , 'EquipamentoSiglaController@toActivate')->name('toActivateSiglaEquipamento');

      Route::delete('/{id}' , 'EquipamentoSiglaController@destroy')->name('deleteSiglaEquipamento');

      Route::post('/search' , 'EquipamentoSiglaController@search')->name('searchSiglaEquipamento');
  });

});
