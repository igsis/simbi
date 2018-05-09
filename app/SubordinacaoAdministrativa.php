<?php

namespace Simbi;

use Illuminate\Database\Eloquent\Model;

class SubordinacaoAdministrativa extends Model
{
    protected $table = 'subordinacao_administrativa';

    public $timestamps = false;

    protected $fillable = [
    	'descricao'
    ];
}
