<?php
Route::group(['prefix' => 'gerencial/'], function() {

        Route::resource('usuarios', 'UserController', [
            'names' => [
                'edit' => 'usuarios.editar',
                'create' => 'usuarios.cadastro',
            ]]);

        Route::get('seguranca', 'UserController@perguntaSeguranca');

        Route::post('seguranca', 'UserController@updatePergunta')->name('seguranca');

        Route::put('editar/{id}', 'UserController@update')->name('usuario.atualizar');
    });
