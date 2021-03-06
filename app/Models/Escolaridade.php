<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Escolaridade extends Model
{
    public $timestamps = false;

    public function complementoPortaria()
    {
        return $this->hasMany(ComplementoPortaria::class);
    }

    public function usuarios()
    {
        return $this->hasMany(Equipamento::class);
    }
}
