<?php

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


Route::group(['prefix' => 'sigla-equipamento'], function(){
    Route::get('/' , 'EquipamentoSiglaController@index')->name('siglaEquipamento');

    Route::get('/desativados' , 'EquipamentoSiglaController@disabled')->name('siglaEquipamentoDisabled');

    Route::post('/' , 'EquipamentoSiglaController@create')->name('createSiglaEquipamento');

    Route::put('/{id}' , 'EquipamentoSiglaController@update')->name('editSiglaEquipamento');

    Route::put('/ativar/{id}' , 'EquipamentoSiglaController@toActivate')->name('toActivateSiglaEquipamento');

    Route::delete('/{id}' , 'EquipamentoSiglaController@destroy')->name('deleteSiglaEquipamento');

    Route::post('/search' , 'EquipamentoSiglaController@search')->name('searchSiglaEquipamento');
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

    Route::group(['prefix' => '{equipamento}/reforma'], function () {
        Route::get('/', 'EquipamentoController@criaReforma')->name('equipamentos.criaReforma');

        Route::post('/', 'EquipamentoController@gravaReforma')->name('equipamentos.gravaReforma');
    });

    Route::group(['prefix' => 'ocorrencias'], function()
    {
        Route::post('/', 'EquipamentoController@equipamentoOcorrencia')->name('equipamento.ocorrencia');

        Route::get('/{equipamento}', 'EquipamentoController@countOcorrencias')->name('ocorrencias.count');
    });


});
