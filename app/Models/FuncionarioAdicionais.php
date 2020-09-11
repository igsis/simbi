<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class FuncionarioAdicionais extends Model
{
    public $timestamps = false;

    protected $table = "funcionario_adicionais";

    protected $fillable = [
        'funcionario_id',
        'data_aposentadoria',
        'observacao'
    ];

}
