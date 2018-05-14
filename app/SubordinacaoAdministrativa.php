<?php

namespace Simbi;

use Illuminate\Database\Eloquent\Model;

class SubordinacaoAdministrativa extends Model
{
    public $timestamps = false;

    protected $fillable = [
    	'descricao'
    ];
}
