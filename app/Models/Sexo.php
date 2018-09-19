<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    public $timestamps = false;

    public function complementoPortaria()
    {
        return $this->hasMany(ComplementoPortaria::class);
    }

}