<?php

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