<?php

Route::get('/', 'IndexController@index')->middleware('auth');

Route::get('home', 'IndexController@index')->middleware('primeiroLogin');


Auth::routes();


Route::group(['middleware' => 'auth'], function (){

	Route::group(['middleware' => 'primeiroLogin'], function (){

		Route::any('ativar-user','UserController@ativarUser')->name('ativar.user');

        Route::group(['prefix' => 'usuarios'], function() {
            Route::any('/search', 'UserController@searchUser')->name('search-user');

            Route::get('/{usuario}/vincular', 'UserController@exibeVincular')->name('usuarios.exibeVincular');

            Route::post('/{usuario}/vincular', 'UserController@vinculaEquipamento')->name('usuarios.vincular');

            Route::post('/{usuario}/reset', 'UserController@vinculaEquipamento')->name('usuarios.reset');
        });
	});

});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');