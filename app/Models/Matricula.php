<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nova',
        'renovacao',
        'total',
        'periodo',
        'data',
        'data_envio',
        'equipamento_id',
        'publicado'
    ];
}
