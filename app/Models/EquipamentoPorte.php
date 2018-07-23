<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class EquipamentoPorte extends Model
{
    public $timestamps = false;

    public function detalhes()
    {
        return $this->hasMany(EquipamentoDetalhe::class);
    }
}
