<?php

namespace Simbi\models;

use Illuminate\Database\Eloquent\Model;

class EquipamentoOcorrencia extends Model
{

    protected $fillable = [
    	'equipamento_id'
    	'date',
    	'ocorrencia',
    	'observacao'
    ];


    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
