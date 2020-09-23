<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'interna',
        'auditorio',
        'teatro',
        'total_construida',
        'total_terreno',
        'especificacao'
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
