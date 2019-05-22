<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{
    protected $table = 'regioes';

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }
}
