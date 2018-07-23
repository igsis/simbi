<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class EquipamentoPadrao extends Model
{
    public $table = 'equipamento_padroes';

    public $timestamps = false;

    public function detalhes()
    {
        return $this->hasMany(EquipamentoDetalhe::class);
    }
}
