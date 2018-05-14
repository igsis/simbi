<?php

namespace Simbi;

use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{
    public $timestamps = false;

    protected $fillable = [
    	'sigla',
    	'descricao'
    ];
}
