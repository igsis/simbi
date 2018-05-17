<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;
use Simbi\Models\EquipamentoSigla;
use Simbi\Models\Endereco;

class Equipamento extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'nome',
        'tipoServico',
        'equipamentoSigla',
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

    public function tipoServico()
    {
        $this->hasOne(TipoServico::class);
    }
}
