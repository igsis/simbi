<?php


    Route::resource('usuarios', 'UserController', [
        'names' => [
            'edit' => 'usuarios.editar',
            'create' => 'usuarios.cadastro',
        ]]);
    Route::group(['prefix' => 'gerencial/'], function () {
        Route::get('seguranca', 'UserController@perguntaSeguranca');

        Route::post('seguranca', 'UserController@updatePergunta')->name('seguranca');
    });
