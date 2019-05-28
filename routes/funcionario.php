<?php

//Route::resource('funcionarios', 'FuncionarioController', [
//    'names' => [
//        'edit' => 'funcionarios.editar',
//        'create' => 'funcionarios.cadastro',
//    ]]);

Route::group(['prefix' => 'funcionarios'], function (){

    Route::get('/', 'FuncionarioController@index')->name('funcionarios.index');

    Route::get('/editar/{id}','FuncionarioController@edit')->name('funcionarios.editar');

    Route::get('/cadastrar','FuncionarioController@create')->name('funcionarios.cadastrar');

    Route::delete('/delete','FuncionarioController@destroy')->name('funcionarios.delete');

    Route::put('/ativar', 'FuncionarioController@ativar')->name('funcionarios.ativar');
});

Route::post('/funcionarios/','FuncionarioController@store')->name('funcionarios.cadastra');


Route::any('funcionario-search', 'FuncionarioController@searchFuncionario')->name('search-funcionario');