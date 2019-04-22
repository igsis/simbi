<?php

Route::resource('funcionarios', 'FuncionarioController', [
    'names' => [
        'edit' => 'funcionarios.editar',
        'create' => 'funcionarios.cadastro',
    ]]);

Route::any('funcionario-search', 'FuncionarioController@searchFuncionario')->name('search-funcionario');