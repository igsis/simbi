<?php

namespace Simbi\models;

use Illuminate\Database\Eloquent\Model;

class EquipamentoOcorrencia extends Model
{

	public $timestamps = false;

    protected $fillable = [
    	'equipamento_id',
    	'data',
    	'ocorrencia',
    	'observacao'
    ];


    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
