<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;
use Simbi\Models\Equipamento;

class Telecentro extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'quantidade'
    ];

    public function capacidade()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
