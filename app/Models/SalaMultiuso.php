<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class SalaMultiuso extends Model
{
    public $timestamps = false;

    public function capacidade()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
