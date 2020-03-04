<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'audio_visual',
        'livro',
        'manga',
        'revista',
        'suportes',
        'total',
        'periodo',
        'data',
        'data_envio',
        'equipamento_id',
        'publicado'
    ];
}
