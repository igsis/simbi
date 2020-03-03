<?php

Route::group(['prefix' => 'acervo'], function (){

    Route::group(['prefix' => '/consulta'], function (){

        Route::get('/equipamentos', 'ConsultaController@index')->name('consulta.index');
        Route::get('/registrar/{id}', 'ConsultaController@create')->name('consulta.inserir');
        Route::post('/gravar/{id}', 'ConsultaController@store')->name('consulta.gravar');
        Route::get('/registros/{id}', 'ConsultaController@show')->name('consulta.registros');
        Route::get('/{idEquipamento}/editar/{id}', 'ConsultaController@edit')->name('consulta.editar');
        Route::post('/{id}/alterar/{idConsulta}', 'ConsultaController@update')->name('consulta.update');
        Route::get('/{id}/remover/{idConsulta}', 'ConsultaController@destroy')->name('consulta.delete');
        Route::get('/relatorio/{id}', 'ConsultaController@show')->name('consulta.relatorio');
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