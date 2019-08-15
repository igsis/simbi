<?php

Route::group(['prefix' => '{equipamento_igsis}/eventos'], function (){

    Route::get('/cadastro', 'FrequenciaController@cadastrarEvento')->name('eventos.cadastro');

    Route::post('/cadastro', 'FrequenciaController@gravarEvento')->name('eventos.gravar');

    Route::get('/', 'FrequenciaController@listaEventos')->name('eventos.listar');

});