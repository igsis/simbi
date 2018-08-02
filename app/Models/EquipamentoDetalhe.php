<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class EquipamentoDetalhe extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'contrato_uso_id',
        'equipamento_utilizacao_id',
        'equipamento_porte_id',
        'equipamento_padrao_id',
        'pavimento',
        'acessibilidade_id',
        'validade_avcb'
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }

    public function contratoUso()
    {
        return $this->belongsTo(ContratoUso::class);
    }

    public function utilizacao()
    {
        return $this->belongsTo(EquipamentoUtilizacao::class);
    }

    public function porte()
    {
        return $this->belongsTo(EquipamentoPorte::class);
    }

    public function padrao()
    {
        return $this->belongsTo(EquipamentoPadrao::class);
    }

    public function acessibilidade()
    {
        return $this->belongsTo(Acessibilidade::class);
    }
}
