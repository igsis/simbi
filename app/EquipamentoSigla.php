<?php

namespace Simbi;

use Illuminate\Database\Eloquent\Model;

class EquipamentoSigla extends Model
{
    public $timestamps = false;

    protected $fillable = [
    	'sigla',
    	'descricao',
    	'roteiro'
    ];
}
