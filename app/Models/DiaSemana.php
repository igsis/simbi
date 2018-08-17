<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class DiaSemana extends Model
{

    public $timestamps = false;

    public function frequenciasPublicos()
    {
        return $this->hasMany(FrequenciasPublico::class);
    }
}
