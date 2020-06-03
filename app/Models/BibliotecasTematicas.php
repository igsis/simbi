<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class BibliotecasTematicas extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'acervo',
        'frequencia_secao',
        'consulta',
        'emprestimo',
        'total',
        'periodo',
        'data',
        'data_envio',
        'equipamento_id',
        'publicado'
    ];
}
