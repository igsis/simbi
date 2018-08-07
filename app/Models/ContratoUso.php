<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class ContratoUso extends Model
{
    public $timestamps = false;

    public function detalhes()
    {
        return $this->hasMany(Detalhe::class);
    }
}
