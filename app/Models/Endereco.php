<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    public function equipamento()
    {
    	return $this->belongsTo('Simbi\Models\Equipamento', 'idEquipamento', 'idEndereco');
    }

    public function user()
    {
    	return $this->belongsTo('Simbi\Models\User', 'idEndereco', 'idEndereco')
    }

    public function macrorregiao()
    {
    	$this->hasMany('Simbi\Models\Macrorregiao', 'idMacrorregiao');
    }
}
