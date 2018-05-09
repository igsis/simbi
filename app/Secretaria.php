<?php

namespace Simbi;

use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{
    protected $table = 'secretaria';

    public $timestamps = false;

    protected $fillable = [
    	'sigla',
    	'descricao'
    ];
}
