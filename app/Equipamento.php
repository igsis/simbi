<?php

namespace Simbi;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
	public $timestamps = false;
	protected $primaryKey = 'idEquipamento';

	protected $fillable = [
		'nome',
        'idTipoServico',
        'idEquipamentoSigla',
        'identificacaoSecretaria',
        'subordinaçãoAdministrativa',
        'tematico',
        'nomeTematica',
        'telefone',
        'telecentro',
        'nucleobraile',
        'acervoespecializado'
	];

	public function endereco()
	{
		$this->hasOne('Simbi\Endereco', 'idEquipamento', 'idEquipamento');
	}

	public function endereco()
	{
		$this->hasOne('Simbi\EquipamentoSigla');
	}
}
