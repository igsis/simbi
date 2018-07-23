<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class EquipamentoDetalhe extends Model
{
    public $timestamps = false;

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
