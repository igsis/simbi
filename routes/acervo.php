<?php

Route::group(['prefix' => 'acervo'], function (){

    Route::group(['prefix' => '/consulta'], function (){

        Route::get('/equipamentos', 'ConsultaController@index')->name('consulta.index');
    });

    Route::group(['prefix' => 'emprestimo'], function (){
        //Route::get('/evento', 'EventoController@inicio')->name('eventos.index');
    });

    Route::group(['prefix' => 'bibliotecas'], function (){
        //Route::get('/evento', 'EventoController@inicio')->name('eventos.index');
    });

    Route::group(['prefix' => 'matricula'], function (){
        //Route::get('/evento', 'EventoController@inicio')->name('eventos.index');
    });

});

?>