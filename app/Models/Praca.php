<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Praca extends Model
{
    public $timestamps = false;

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }

    public function classificacao()
    {
        return $this->belongsTo(Classificacao::class);
    }
}
