<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class SalaEstudoIndividual extends Model
{
    public $table = 'sala_estudo_individuais';

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
