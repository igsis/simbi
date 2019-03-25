<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Etnia extends Model
{
    public $timestamps = false;

    protected $table = 'etnias_complementos';

    public function complementoPortaria()
    {
        return $this->hasMany(ComplementoPortaria::class);
    }

}
