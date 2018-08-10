<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Classificacao extends Model
{
    public $table = 'classificacoes';

    public $timestamps = false;

    public function praca()
    {
        return $this->hasOne(Praca::class);
    }
}
