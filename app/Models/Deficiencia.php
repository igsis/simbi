<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Deficiencia extends Model
{
    public $timestamps = false;

    public function complementoPortaria()
    {
        return $this->hasMany(ComplementoPortaria::class);
    }

}
