<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'nome',
        'tipo_servico_id',
        'equipamento_sigla_id',
        'secretaria_id',
        'subordinacao_administrativa_id',
        'tematico',
        'nomeTematica',
        'telefone',
        'telecentro',
        'acervoespecializado',
        'nucleobraile',
        'status_id'
	];

	public function endereco()
	{
		return $this->belongsTo(Endereco::class);
	}

	public function equipamentoSigla()
	{
		return $this->belongsTo(EquipamentoSigla::class);
	}

    public function tipoServico()
    {
        return $this->belongsTo(TipoServico::class);
    }

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class);
    }

    public function subordinacaoAdministrativa()
    {
        return $this->belongsTo(SubordinacaoAdministrativa::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function users()
    {
        $this->belongsToMany(User::class);
    }
}
