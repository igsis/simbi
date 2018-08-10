<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

/*TODO: Criar Model "Legislacao"*/

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
        'nome_tematica',
        'telefone',
        'telecentro',
        'acervoespecializado',
        'nucleobraile',
        'status_id',
        'publicado',
        'observacao'
	];

    public function area()
    {
        return $this->hasOne(Area::class);
    }

	public function detalhe()
    {
        return $this->hasOne(Detalhe::class);
    }

	public function endereco()
	{
		return $this->belongsTo(Endereco::class);
	}

	public function equipamentoSigla()
	{
		return $this->belongsTo(EquipamentoSigla::class);
	}

    public function frequencias()
    {
        return $this->hasMany(Frequencia::class);
    }

    public function funcionamentos()
    {
        return $this->hasMany(Funcionamento::class);
    }

    public function ocorrencias()
    {
        return $this->hasMany(EquipamentoOcorrencia::class);
    }

    public function reformas()
    {
        return $this->hasMany(Reforma::class);
    }

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function subordinacaoAdministrativa()
    {
        return $this->belongsTo(SubordinacaoAdministrativa::class);
    }

    public function tipoServico()
    {
        return $this->belongsTo(TipoServico::class);
    }

    public function users()
    {
        $this->belongsToMany(User::class);
    }

    public function search(Array $data)
    {
        return $this->where(function ($query) use($data)
        {
            $query->where('publicado', $data['types']);

            if (isset($data['nome'])) {
                $query->where('nome', $data['nome']);
            }

            if (isset($data['sigla'])) {
                $query->where('equipamento_sigla_id', $data['sigla']);
            }
            
            if (isset($data['status'])) {
                $query->where('status_id', $data['status']);
            }

        });
    }

    public function auditorio()
    {
        return $this->hasOne(Auditorio::class);
    }

    public function teatro()
    {
        return $this->hasOne(Teatro::class);
    }

    public function multiuso()
    {
        return $this->hasOne(SalaMultiuso::class);
    }

    public function estudoGrupo()
    {
        return $this->hasOne(SalaEstudoGrupo::class);
    }

    public function estudoIndividual()
    {
        return $this->hasOne(SalaEstudoIndividual::class);
    }

    public function infantil()
    {
        return $this->hasOne(SalaInfantil::class);
    }

    public function estacionamento()
    {
        return $this->hasOne(Estacionamento::class);
    }

    public function praca()
    {
        return $this->hasOne(Praca::class);
    }

}
