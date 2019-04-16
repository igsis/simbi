<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Macrorregiao extends Model
{
    protected $table = 'macrorregioes';

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }
}
