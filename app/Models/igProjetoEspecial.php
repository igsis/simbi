<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class igProjetoEspecial extends Model
{
    // Definimos a conexão "another" para este model
    protected $connection = 'another';

    public $table = 'ig_projeto_especial';

    public $timestamps = false;
}
