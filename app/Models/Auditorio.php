<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Auditorio extends Model
{
    public $timestamps = false;

    public function capacidade()
    {
        return $this->belongsTo(EquipamentoCapacidade::class);
    }
}
