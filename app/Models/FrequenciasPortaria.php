<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class FrequenciasPortaria extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'equipamento_id',
        'periodo',
        'quantidade',
        'data',
        'data_envio'
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }

    public function complementoPortaria()
    {
        return $this->hasOne(ComplementoPortaria::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }
}
