<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class SalaEstudoGrupo extends Model
{
    public $timestamps = false;

    public function capacidade()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
