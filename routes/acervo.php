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
        Route::get('/relatorio/{id}', 'ConsultaController@relatorio')->name('consulta.relatorio');
    });

    Route::group(['prefix' => 'emprestimo'], function (){
        Route::get('/equipamentos', 'EmprestimoController@index')->name('emprestimo.index');
        Route::get('/registrar/{id}', 'EmprestimoController@create')->name('emprestimo.inserir');
        Route::post('/gravar/{id}', 'EmprestimoController@store')->name('emprestimo.gravar');
        Route::get('/registros/{id}', 'EmprestimoController@show')->name('emprestimo.registros');
        Route::get('/relatorio/{id}', 'EmprestimoController@relatorio')->name('emprestimo.relatorio');
        Route::get('/{idEquipamento}/editar/{id}', 'EmprestimoController@edit')->name('emprestimo.editar');
        Route::post('/{id}/alterar/{idEmprestimo}', 'EmprestimoController@update')->name('emprestimo.update');
        Route::get('/{id}/remover/{idEmprestimo}', 'EmprestimoController@destroy')->name('emprestimo.delete');
    });

    Route::group(['prefix' => 'bibliotecas'], function (){
        Route::get('/equipamentos', 'BibliotecasTematicasController@index')->name('bibliotecas.index');
        Route::get('/relatorio/{id}', 'BibliotecasTematicasController@relatorio')->name('bibliotecas.relatorio');
        Route::get('/registrar/{id}', 'BibliotecasTematicasController@create')->name('bibliotecas.inserir');
        Route::post('/gravar/{id}', 'BibliotecasTematicasController@store')->name('bibliotecas.gravar');
        Route::get('/registros/{id}', 'BibliotecasTematicasController@show')->name('bibliotecas.registros');
        Route::get('/{idEquipamento}/editar/{id}', 'BibliotecasTematicasController@edit')->name('bibliotecas.editar');
        Route::post('/{id}/alterar/{idBiblioteca}', 'BibliotecasTematicasController@update')->name('bibliotecas.update');
        Route::get('/{id}/remover/{idBiblioteca}', 'BibliotecasTematicasController@destroy')->name('bibliotecas.delete');
    });

    Route::group(['prefix' => 'matricula'], function (){
        Route::get('/equipamentos', 'MatriculaController@index')->name('matricula.index');
        Route::get('/relatorio/{id}', 'MatriculaController@relatorio')->name('matricula.relatorio');
        Route::get('/registrar/{id}', 'MatriculaController@create')->name('matricula.inserir');
        Route::post('/gravar/{id}', 'MatriculaController@store')->name('matricula.gravar');
        Route::get('/registros/{id}', 'MatriculaController@show')->name('matricula.registros');
        Route::get('/{idEquipamento}/editar/{id}', 'MatriculaController@edit')->name('matricula.editar');
        Route::post('/{id}/alterar/{idMatricula}', 'MatriculaController@update')->name('matricula.update');
        Route::get('/{id}/remover/{idMatricula}', 'MatriculaController@destroy')->name('matricula.delete');
    });

});

?>