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
        'idTipoServico',
        'idSigla',
        'idSecretaria',
        'idSubordinacaoAdministrativa',
        'tematico',
        'nomeTematica',
        'telefone',
        'telecentro',
        'acervoespecializado',
        'nucleobraile',
        'idStatus'
	];

	public function endereco()
	{
		return $this->belongsTo(Endereco::class);
	}

	public function equipamentoSigla()
	{
		return $this->belongsTo(EquipamentoSigla::class, 'idSigla');
	}

    public function tipoServico()
    {
        return $this->belongsTo(TipoServico::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'idStatus');
    }

    public function users()
    {
        $this->belongsToMany(User::class);
    }
}
