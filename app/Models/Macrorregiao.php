<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Macrorregiao extends Model
{
    protected $table = 'macrorregiao';

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }
}
