<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class igProjetoEspecial extends Model
{
    // Definimos a conexão "another" para este model
    protected $connection = 'mysql2';

    public $table = 'ig_projeto_especial';

    public $timestamps = false;
}
