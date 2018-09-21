<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class ResponsabilidadeTipo extends Model
{
    public function equipamentoUser()
    {
        return $this->hasMany(EquipamentoUser::class);
    }
}
