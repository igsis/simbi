<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class EquipamentoSigla extends Model
{
	protected $table = 'equipamento_siglas';
	
    public $timestamps = false;

    protected $fillable = [
    	'sigla',
    	'descricao',
    	'roteiro'
    ];
}
