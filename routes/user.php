<?php

Route::get('seguranca', 'UserController@perguntaSeguranca');

Route::post('seguranca', 'UserController@updatePergunta')->name('seguranca');