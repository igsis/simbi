<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class EquipamentoArea extends Model
{
    public $timestamps = false;

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
