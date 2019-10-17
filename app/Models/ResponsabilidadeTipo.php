<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;
use Simbi\Models\EquipamentoFuncionario;

class ResponsabilidadeTipo extends Model
{
    public function equipamentoFuncionario()
    {
        return $this->hasMany(EquipamentoFuncionario::class);
    }
}
