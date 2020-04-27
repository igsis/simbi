<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Praca extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'equipamento_id',
        'praca',
        'praca_classificacao_id'
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }

    public function classificacao()
    {
        return $this->belongsTo(Classificacao::class,'praca_classificacao_id','id');
    }
}
