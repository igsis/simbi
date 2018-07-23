<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class EquipamentoUtilizacao extends Model
{
    public $table = 'equipamento_utilizacoes';

    public $timestamps = false;

    public function detalhes()
    {
        return $this->hasMany(EquipamentoDetalhe::class);
    }
}
