<?php

namespace Simbi;

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
