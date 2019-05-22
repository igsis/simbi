<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
    protected $table = 'regionais';

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }
}
