<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class SalaInfantil extends Model
{
    public $table = 'sala_infantis';

    public $timestamps = false;

    protected $fillable = [
        'capacidade'
    ];

    public function capacidade()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
