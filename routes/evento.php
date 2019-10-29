<?php
Route::group(['prefix' => 'frequencia'], function (){

    Route::get('/evento', 'EventoController@inicio')->name('eventos.index');

    Route::group(['prefix' => '{equipamento_igsis}/eventos'], function (){

        Route::get('/cadastro', 'EventoController@create')->name('eventos.cadastro');

        Route::post('/cadastro', 'EventoController@store')->name('eventos.gravar');

        Route::get('/', 'EventoController@index')->name('eventos.listar');

        Route::group(['prefix' => '/importarIgsis'],function (){

            Route::get('/', 'EventoController@importarIgsis')->name('evento.importar');

            Route::get('/{igsis_id}','EventoController@cadastroImportacao')->name('evento.importar.cadastro');

        });

        Route::get('/editar/{id}', 'EventoController@edit')->name('eventos.editar');

        Route::post('/editar/{id}', 'EventoController@update')->name('eventos.update');

    });
});



