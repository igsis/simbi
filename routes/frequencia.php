<?php

Route::group(['prefix' => 'frequencia'], function(){

    Route::get('/equipamentos/enviadas', 'FrequenciaController@frequenciasEnviadas')->name('frequencias.enviadas');

    Route::get('/{idEquipamento}/enviadas','FrequenciaController@listarFrequenciasEnviadas')->name('frequencia.enviada');

    Route::get('/relatorio', 'FrequenciaController@relatorio')->name('frequencia.relatorio');

    Route::get('/{equipamento_igsis}/ocorrencias/{type}', 'FrequenciaController@listarOcorrencias')->name('frequencia.ocorrencias');

    Route::get('/{equipamento_igsis}/ocorrenciasEnviadas/{type}', 'FrequenciaController@listarOcorrenciasEnviadas')->name('frequencia.ocorrenciasEnviadas');

    Route::post('/enviar','FrequenciaController@enviarFrequencia')->name('frequencia.enviarFrequencia');

    Route::get('/{evento}/editar', 'FrequenciaController@editarOcorrencia')->name('frequencia.editarOcorrencia');

    Route::post('/{idOcorrencia}/editar', 'FrequenciaController@uploadOcorrencia')->name('frequencia.updateOcorrencia');

    Route::get('/{idOcorrencia}/cadastro', 'FrequenciaController@create')->name('frequencia.cadastro');

    Route::post('/{equipamento}/cadastro', 'FrequenciaController@store')->name('frequencia.gravar');

    Route::get('/{equipamento}/listar', 
    'FrequenciaController@listar')
    ->name('frequencia.listar');

    Route::post('/{frequencia}/editar','FrequenciaController@atualizaFrequencia')->name('frequencia.atualizar');

    Route::post('/remover', 'FrequenciaController@removeOcorrencia')->name('evento.ocorrencia.destroy');

});

Route::group(['prefix' => '{equipamento_igsis}/ocorrencia'], function (){

    Route::get('/cadastro/ocorrencia/{evento_id}', 'FrequenciaController@cadastrarOcorrencia')->name('eventos.cadastro.ocorrencia');

    Route::post('/cadastro/ocorrencia/{evento_id}', 'FrequenciaController@gravaOcorrencia')->name('eventos.grava.ocorrencia');

});

Route::group(['prefix' => 'portaria'], function(){

    Route::get('/', 'FrequenciaController@index')->name('frequencia.portaria.index');

    Route::get('/relatorio', 'FrequenciasPortariaController@relatorio')->name('frequencia.portaria.relatorio');

    Route::get('/{equipamento}/cadastro', 'FrequenciasPortariaController@create')->name('frequencia.portaria.cadastro')->middleware('portaria');

    Route::get('/{equipamento}/cadastroCompleto', 'FrequenciasPortariaController@criaPortariaCompleta')->name('frequencia.portaria.cadastroCompleto');

    Route::post('/{equipamento}/cadastroCompleto', 'FrequenciasPortariaController@gravaPortariaCompleta')->name('frequencia.portaria.gravaCompleto');

    Route::post('/cadastroSimples', 'FrequenciasPortariaController@store')->name('frequencia.portaria.gravar');

    Route::get('/{equipamento}/publicoRecepcao', 'FrequenciasPortariaController@listarRecepcao')->name('frequencia.portaria.listar');

    Route::post('/publicoRecepcao/update', 'FrequenciasPortariaController@updateRecepcao')->name('frequencia.portaria.updateRecepcao');

    Route::post('/publicoRecepcao/destroy', 'FrequenciasPortariaController@destroyRecepcao')->name('frequencia.portaria.destroyRecepcao');

    Route::post('/cadastroSimples/secaoBraile', 'FrequenciasPortariaController@storeSecaoBraile')->name('frequencia.secaoBraile.gravar');

    Route::post('/cadastroSimples/telecentro', 'FrequenciasPortariaController@storeTelecentro')->name('frequencia.telecentro.gravar');

    Route::post('/cadastroSimples/tematica', 'FrequenciasPortariaController@storeTematica')->name('frequencia.tematica.gravar');

    Route::post('/cadastroSimples/oculos', 'FrequenciasPortariaController@storeOculos')->name('frequencia.oculos.gravar');

    Route::get('/{equipamento}/secaoBraile', 'FrequenciasPortariaController@listarSecaoBraile')->name('frequencia.portaria.secaoBraile');

    Route::post('/secaoBraile/update', 'FrequenciasPortariaController@updateBraile')->name('frequencia.portaria.updateBraile');

    Route::post('/secaoBraile/destroy', 'FrequenciasPortariaController@destroyBraile')->name('frequencia.portaria.destroyBraile');

    Route::get('/{equipamento}/telecentro', 'FrequenciasPortariaController@listarTelecentro')->name('frequencia.portaria.telecentro');

    Route::post('/telecentro/update', 'FrequenciasPortariaController@updateTelecentro')->name('frequencia.portaria.updateTelecentro');

    Route::post('/telecentro/destroy', 'FrequenciasPortariaController@destroyTelecentro')->name('frequencia.portaria.destroyTelecentro');

     Route::get('/{equipamento}/tematica', 'FrequenciasPortariaController@listarTematica')->name('frequencia.portaria.tematica');

    Route::post('/tematica/update', 'FrequenciasPortariaController@updateTematica')->name('frequencia.portaria.updateTematica');

    Route::post('/tematica/destroy', 'FrequenciasPortariaController@destroyTematica')->name('frequencia.portaria.destroyTematica');

    Route::get('/{equipamento}/oculos', 'FrequenciasPortariaController@listarOculos')->name('frequencia.portaria.oculos');

    Route::post('/oculos/update', 'FrequenciasPortariaController@updateOculos')->name('frequencia.portaria.updateOculos');

    Route::post('/oculos/destroy', 'FrequenciasPortariaController@destroyOculos')->name('frequencia.portaria.destroyOculos');

});
