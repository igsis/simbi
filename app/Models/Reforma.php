<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Reforma extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'inicio_reforma',
        'termino_reforma',
        'descricao'
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
