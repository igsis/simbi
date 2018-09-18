<?php



Route::resource('equipamentos', 'EquipamentoController', [
    'names' => [
        'edit' => 'equipamentos.editar',
        'create' => 'equipamentos.cadastro',
    ]]);

    Route::any('ativar-equipamento','EquipamentoController@ativarEquipamento')->name('ativar.equipamento');

    Route::any('equipamentos-search', 'EquipamentoController@searchEquipamento')->name('search-equipamento');

    Route::get('importar/equipamentos', 'EquipamentoController@importarEquipamentos')->name('equipamentos.importar');

Route::group(['prefix' => 'equipamentos'], function() {

    Route::put('/{funcionamento}/funcionamento', 'EquipamentoController@removeFuncionamento')->name('equipamentos.removeFuncionamento');

    Route::group(['prefix' => 'detalhes/{equipamento}'], function(){
        Route::get('/', 'EquipamentoController@criaDetalhes')->name('equipamentos.criaDetalhes');

        Route::post('/novo', 'EquipamentoController@gravaDetalhes')->name('equipamentos.gravaDetalhes');

        Route::put('/editar', 'EquipamentoController@atualizaDetalhes')->name('equipamentos.atualizaDetalhes');
    });

    Route::put('/{equipamento}' , 'EquipamentoController@editPortaria')->name('equipamentos.editPortaria');

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
