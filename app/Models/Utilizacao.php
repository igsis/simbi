<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Utilizacao extends Model
{
    protected $table = 'utilizacoes';

    public $timestamps = false;

    public function detalhes()
    {
        return $this->hasMany(Detalhe::class);
    }
}
