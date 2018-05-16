<?php

namespace Simbi;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
	public function endereco()
	{
		$this->hasOne('Simbi\Endereco', 'idEquipamento', 'idEquipamento');
	}
}
