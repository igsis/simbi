<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class AcessibilidadeArquitetonica extends Model
{
    public $timestamps = false;

    public function acessibilidades()
    {
        return $this->hasMany(Acessibilidade::class);
    }
}
