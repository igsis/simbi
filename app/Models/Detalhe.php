<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Detalhe extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'contrato_uso_id',
        'utilizacao_id',
        'porte_id',
        'padrao_id',
        'pavimento',
        'acessibilidade_id',
        'validade_avcb',
        'predio_tombado',
        'lei'
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
        return $this->belongsTo(Utilizacao::class);
    }

    public function porte()
    {
        return $this->belongsTo(Porte::class);
    }

    public function padrao()
    {
        return $this->belongsTo(Padrao::class);
    }

    public function acessibilidade()
    {
        return $this->belongsTo(Acessibilidade::class);
    }
}
