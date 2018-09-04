<?php

Route::group(['prefix' => 'frequencia'], function(){

    Route::get('/', 'FrequenciaController@index')->name('frequencia.index');

    Route::get('/relatorio', 'FrequenciaController@relatorio')->name('frequencia.relatorio');

    Route::get('/{equipamento}/cadastro', 'FrequenciaController@create')->name('frequencia.cadastro');

    Route::post('/{equipamento}/cadastro', 'FrequenciaController@store')->name('frequencia.gravar');

    Route::get('/{equipamento}/listar', 'FrequenciaController@listar')->name('frequencia.listar');

});

Route::group(['prefix' => 'portaria'], function(){

    Route::get('/', 'FrequenciaController@index')->name('frequencia.portaria.index');

    Route::get('/relatorio', 'FrequenciasPortariaController@relatorio')->name('frequencia.portaria.relatorio');

    Route::get('/{equipamento}/cadastro', 'FrequenciasPortariaController@create')->name('frequencia.portaria.cadastro');

    Route::post('/{equipamento}/cadastro', 'FrequenciasPortariaController@store')->name('frequencia.portaria.gravar');

    Route::get('/{equipamento}/listar', 'FrequenciasPortariaController@listar')->name('frequencia.portaria.listar');

});
