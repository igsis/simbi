<?php
Route::group(['prefix' => 'gerencial'], function (){
    Route::resource('equipamentos', 'EquipamentoController', [
        'names' => [
            'edit' => 'equipamentos.editar',
            'create' => 'equipamentos.cadastro',
        ]]);

    Route::any('ativar-equipamento','EquipamentoController@ativarEquipamento')->name('ativar.equipamento');

    Route::any('equipamentos-search', 'EquipamentoController@searchEquipamento')->name('search-equipamento');

    Route::group(['prefix' => 'importar/equipamentos'], function(){

        Route::get('/', 'EquipamentoController@importarEquipamentos')->name('equipamentos.importar');

        Route::get('/{igsis_id}', 'EquipamentoController@createIgsis')->name('equipamentos.cadastro,importe');
    });

    Route::group(['prefix' => 'equipamentos'], function() {

        Route::put('/{funcionamento}/funcionamento', 'EquipamentoController@removeFuncionamento')->name('equipamentos.removeFuncionamento');

        Route::group(['prefix' => 'detalhes/{equipamento}'], function(){
            Route::get('/', 'EquipamentoController@criaDetalhes')->name('equipamentos.criaDetalhes');

            Route::put('/formulario' , 'EquipamentoController@editPortaria')->name('equipamentos.editPortaria');

            Route::put('/formulario/lote', 'EquipamentoController@editPortariaLote')->name('equipamentos.editPortariaLote');

            Route::post('/novo', 'EquipamentoController@gravaDetalhes')->name('equipamentos.gravaDetalhes');

            Route::put('/editar', 'EquipamentoController@atualizaDetalhes')->name('equipamentos.atualizaDetalhes');
        });

        Route::get('/{equipamento}/acessibilidade', 'EquipamentoController@criaAcessibilidade')->name('equipamentos.criaAcessibilidade');

        Route::post('/{equipamento}/acessibilidade', 'EquipamentoController@gravaAcessibilidade')->name('equipamentos.gravaAcessibilidade');

        Route::get('/{equipamento}/capacidade', 'EquipamentoController@criaCapacidade')->name('equipamentos.criaCapacidade');

        Route::post('/{equipamento}/capacidade', 'EquipamentoController@gravaCapacidade')->name('equipamentos.gravaCapacidade');

        Route::post('/{equipamento}/capacidadeAuditorio','EquipamentoController@gravaAuditorio')->name('equipamentos.gravaAuditorio');

        Route::post('/{equipamento}/gravarEstacionamento','EquipamentoController@gravaEstacionamento')->name('equipamentos.gravaEstacionamento');

        Route::post('/{equipamento}/gravaPraca','EquipamentoController@gravaPraca')->name('equipamentos.gravaPraca');

        Route::post('/{equipamento}/gravaSalaEstudoGrupo','EquipamentoController@gravaEstudoGrupo')->name('equipamentos.gravaEstudoGrupo');

        Route::post('/{equipamento}/gravaSalaEstudoIndividual','EquipamentoController@gravaEstudoIndividual')->name('equipamentos.gravaEstudoIndividual');

        Route::post('/{equipamento}/gravaSalaInfantil','EquipamentoController@gravaSalaInfantil')->name('equipamentos.gravaSalaInfantil');

        Route::post('/{equipamento}/gravaSalaMultiuso','EquipamentoController@gravaSalaMultiuso')->name('equipamentos.gravaSalaMultiuso');

        Route::post('/{equipamento}/gravaTeatro','EquipamentoController@gravaTeatro')->name('equipamentos.gravaTeatro');

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

    Route::put('/equipamentos','EquipamentoController@alterarFormulario')->name('equipamento.altPortaria');
});

