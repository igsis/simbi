<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class SalaInfantil extends Model
{
    public $table = 'sala_infantis';

    public $timestamps = false;

    public function capacidade()
    {
        return $this->belongsTo(EquipamentoCapacidade::class);
    }
}
