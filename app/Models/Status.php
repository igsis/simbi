<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    public function equipamento()
    {
        $this->hasMany(Equipamento::class);
    }
}
