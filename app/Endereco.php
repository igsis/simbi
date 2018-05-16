<?php

namespace Simbi;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    public function equipamento()
    {
    	return $this->belongsTo('Simbi\Equipamento', 'idEquipamento', 'idEndereco');
    }

    public function user()
    {
    	return $this->belongsTo('Simbi\User')
    }

    public function macrorregiao()
    {
    	$this->hasMany('Simbi\Macrorregiao', 'idMacrorregiao');
    }
}
