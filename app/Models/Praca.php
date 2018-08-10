<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Praca extends Model
{
    public $timestamps = false;

    public function capacidade()
    {
        return $this->belongsTo(Equipamento::class);
    }

    public function classificacao()
    {
        return $this->belongsTo(PracaClassificacao::class);
    }
}
