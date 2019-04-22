<?php

namespace Simbi\models;

use Illuminate\Database\Eloquent\Model;

class EquipamentoOcorrencia extends Model
{

	public $timestamps = false;

    protected $fillable = [
        'user_id',
    	'equipamento_id',
    	'data',
    	'ocorrencia',
    	'observacao'
    ];


    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }


    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }
}
