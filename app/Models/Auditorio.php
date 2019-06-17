<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Auditorio extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'equipamento_id',
        'nome',
        'capacidade'
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
