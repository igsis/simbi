<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    public function equipamento()
    {
    	return $this->belongsTo(Equipamento::class, 'idEquipamento', 'idEndereco');
    }

    public function user()
    {
    	return $this->belongsTo(User::class, 'idEndereco', 'idEndereco');
    }
}