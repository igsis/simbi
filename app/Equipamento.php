<?php

namespace Simbi;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
	public $timestamps = false;

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
		$this->hasOne(Endereco::class, 'idEquipamento', 'idEquipamento');
	}

	public function sigla()
	{
		$this->hasOne(EquipamentoSigla::class);
	}
}
