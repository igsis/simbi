<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class PracaClassificacao extends Model
{
    public $table = 'praca_classificacoes';

    public $timestamps = false;

    public function praca()
    {
        return $this->hasOne(Praca::class);
    }
}
