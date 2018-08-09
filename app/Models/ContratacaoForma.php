<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class ContratacaoForma extends Model
{
    public $timestamps = false;

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }
}
