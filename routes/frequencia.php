<?php

Route::group(['prefix' => 'frequencia'], function(){

    Route::get('/', 'FrequenciaController@index')->name('frequencia.index');

    Route::get('/enviadas', 'FrequenciaController@frequenciasEnviadas')->name('frequencia.enviada');

    Route::get('/relatorio', 'FrequenciaController@relatorio')->name('frequencia.relatorio');

    Route::get('/{equipamento_igsis}/ocorrencias', 'FrequenciaController@listarOcorrencias')->name('frequencia.ocorrencias');

    Route::post('/enviar','FrequenciaController@enviarFrequencia')->name('frequencia.enviarFrequencia');

    Route::get('/{evento}/editar', 'FrequenciaController@editarOcorrencia')->name('frequencia.editarOcorrencia');

    Route::post('/{idOcorrencia}/editar', 'FrequenciaController@uploadOcorrencia')->name('frequencia.updateOcorrencia');

    Route::get('/{idOcorrencia}/cadastro', 'FrequenciaController@create')->name('frequencia.cadastro');

    Route::post('/{equipamento}/cadastro', 'FrequenciaController@store')->name('frequencia.gravar');

    Route::get('/{equipamento}/listar', 'FrequenciaController@listar')->name('frequencia.listar');

    Route::get('/{frequencia}/editarFrequencia','FrequenciaController@editaFrequencia')->name('frequencia.editar');

    Route::post('/{frequencia}/editar','FrequenciaController@atualizaFrequencia')->name('frequencia.atualizar');

    Route::post('/remover', 'FrequenciaController@removeOcorrencia')->name('evento.ocorrencia.destroy');

});

Route::group(['prefix' => '{equipamento_igsis}/eventos'], function (){
    Route::get('/cadastro', 'FrequenciaController@cadastrarEvento')->name('eventos.cadastro');

    Route::post('/cadastro', 'FrequenciaController@gravarEvento')->name('eventos.gravar');

    Route::get('/', 'FrequenciaController@listaEventos')->name('eventos.listar');

    Route::get('/cadastro/{evento_igsis}/ocorrencia', 'FrequenciaController@cadastrarOcorrencia')->name('eventos.cadastro.ocorrencia');

    Route::post('/cadastro/{evento_igsis}/ocorrencia', 'FrequenciaController@gravaOcorrencia')->name('eventos.grava.ocorrencia');

});

Route::group(['prefix' => 'portaria'], function(){

    Route::get('/', 'FrequenciaController@index')->name('frequencia.portaria.index');

    Route::get('/relatorio', 'FrequenciasPortariaController@relatorio')->name('frequencia.portaria.relatorio');

    Route::get('/{equipamento}/cadastro', 'FrequenciasPortariaController@create')->name('frequencia.portaria.cadastro')->middleware('portaria');

    Route::get('/{equipamento}/cadastroCompleto', 'FrequenciasPortariaController@criaPortariaCompleta')->name('frequencia.portaria.cadastroCompleto');

    Route::post('/{equipamento}/cadastroCompleto', 'FrequenciasPortariaController@gravaPortariaCompleta')->name('frequencia.portaria.gravaCompleto');

    Route::post('/{equipamento}/cadastro', 'FrequenciasPortariaController@store')->name('frequencia.portaria.gravar');

    Route::get('/{equipamento}/listar', 'FrequenciasPortariaController@listar')->name('frequencia.portaria.listar');

});
