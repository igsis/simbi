<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

/*TODO: Incluir ocorrencia dos equipamentos (nota) na view "equipamentos.editar"*/
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

    public function funcionamentos()
    {
	    return $this->hasMany(Funcionamento::class);
    }

    public function reformas()
    {
        return $this->hasMany(Reforma::class);
    }

    public function detalhe()
    {
        return $this->hasOne(EquipamentoDetalhe::class);
    }

    public function capacidade()
    {
        return $this->hasOne(EquipamentoCapacidade::class);
    }

    public function area()
    {
        return $this->hasOne(EquipamentoArea::class);
    }

    public function ocorrencia()
    {
        return $this->hasMany(EquipamentoOcorrencia::class);
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
}
