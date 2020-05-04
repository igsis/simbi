<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class SalaComum extends Model
{
    protected $table = 'sala_comuns';

    public $timestamps = false;

    protected $fillable = [
        'quantidade',
        'especificacao'
    ];

    public function capacidade()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
