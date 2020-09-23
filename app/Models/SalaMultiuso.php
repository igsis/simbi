<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class SalaMultiuso extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'capacidade',
        'especificacao'
    ];

    public function capacidade()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
