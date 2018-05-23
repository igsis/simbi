<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{
    protected $table = 'regiao';

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }
}
