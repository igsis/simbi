<?php

Route::get('/', 'IndexController@index')->middleware('auth');

Route::get('/gerencial', 'IndexController@gerencialIndex')->middleware('auth');

Route::get('/frequencia', 'IndexController@frequenciaIndex')->middleware('auth');

Route::get('home', 'IndexController@index')->middleware('primeiroLogin');


Auth::routes();


Route::group(['middleware' => 'auth'], function (){

	Route::group(['middleware' => 'primeiroLogin'], function (){

		Route::any('ativar-user','UserController@ativarUser')->name('ativar.user');

        Route::group(['prefix' => 'gerencial/'], function() {

            Route::group(['prefix' => 'usuarios'], function() {

                Route::any('/search', 'UserController@searchUser')->name('search-user');

                Route::put('/{usuario}/reset', 'UserController@resetSenha')->name('usuarios.reset');
            });

        });

	});

});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');