<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class SalaEstudoGrupo extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'capacidade'
    ];

    public function capacidade()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
