<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Porte extends Model
{
    public $timestamps = false;

    public function detalhes()
    {
        return $this->hasMany(Detalhe::class);
    }
}
