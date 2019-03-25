<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Deficiencia extends Model
{
    public $timestamps = false;

    protected $table = "deficiencias_complementos";

    public function complementoPortaria()
    {
        return $this->hasMany(ComplementoPortaria::class);
    }

}
