<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class EquipamentoSigla extends Model
{
	
    public $timestamps = false;

    protected $fillable = [
    	'sigla',
    	'descricao',
    	'roteiro'
    ];
    
    public function equipamento()
    {
        return $this->hasMany('Equipamento::class');
    }
}
