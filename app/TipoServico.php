<?php

namespace Simbi;

use Illuminate\Database\Eloquent\Model;

class TipoServico extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'descricao'
    ];
}
