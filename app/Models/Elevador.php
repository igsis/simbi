<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Elevador extends Model
{
    protected $table = 'elevadores';

    public $timestamps = false;

    public function acessibilidades()
    {
        return $this->hasMany(Acessibilidade::class);
    }
}
