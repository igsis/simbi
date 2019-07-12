<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Estacionamento extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'equipamento_id',
        'capacidade'
    ];

    public function capacidade()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
