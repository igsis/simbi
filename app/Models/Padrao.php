<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Padrao extends Model
{
    public $table = 'padroes';

    public $timestamps = false;

    public function detalhes()
    {
        return $this->hasMany(Detalhe::class);
    }
}
