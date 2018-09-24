<?php

Route::group(['prefix' => 'frequencia'], function(){

    Route::get('/', 'FrequenciaController@index')->name('frequencia.index');

    Route::get('/relatorio', 'FrequenciaController@relatorio')->name('frequencia.relatorio');

    Route::get('/{equipamento_igsis}/eventos', 'FrequenciaController@listarEventos')->name('frequencia.eventos');

    Route::get('/{evento}/editar', 'FrequenciaController@editarEvento')->name('frequencia.editaEvento');

    Route::post('/{idOcorrencia}/editar', 'FrequenciaController@uploadOcorrencia')->name('frequencia.updateOcorrencia');

    Route::delete('/{idOcorrencia}/remover', 'FrequenciaController@removeOcorrencia')->name('evento.ocorrencia.destroy');

    Route::get('/{idOcorrencia}/cadastro', 'FrequenciaController@create')->name('frequencia.cadastro');

    Route::post('/{equipamento}/cadastro', 'FrequenciaController@store')->name('frequencia.gravar');

    Route::get('/{equipamento}/listar', 'FrequenciaController@listar')->name('frequencia.listar');
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
