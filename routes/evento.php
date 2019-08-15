<?php

Route::group(['prefix' => '{equipamento_igsis}/eventos'], function (){

    Route::get('/cadastro', 'EventoController@create')->name('eventos.cadastro');

    Route::post('/cadastro', 'EventoController@store')->name('eventos.gravar');

    Route::get('/', 'EventoController@index')->name('eventos.listar');

    Route::get('/eventos/importarIgsis', 'EventoController@importarIgsis')->name('evento.importar');

    Route::get('/editar/{id}', 'EventoController@edit')->name('eventos.editar');

    Route::post('/editar/{id}', 'EventoController@update')->name('eventos.update');

});

