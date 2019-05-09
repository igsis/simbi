<?php

//Route::resource('funcionarios', 'FuncionarioController', [
//    'names' => [
//        'edit' => 'funcionarios.editar',
//        'create' => 'funcionarios.cadastro',
//    ]]);

Route::group(['prefix' => 'funcionarios'], function (){

    Route::get('/', 'FuncionarioController@index')->name('funcionarios.index');

    Route::get('/editar','FuncionarioController@edit')->name('funcionarios.editar');

    Route::get('/cadastrar','FuncionarioController@create')->name('funcionarios.cadastrar');

});


Route::any('funcionario-search', 'FuncionarioController@searchFuncionario')->name('search-funcionario');