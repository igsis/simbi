<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'email',
        'cargo_id',
        'funcao_id',
        'escolaridade_id',
        'subordinacao_adminstrativa_id',
        'secretaria_id',
        'publicado'
    ];

    public function users()
    {
        return $this->hasOne(User::class);
    }
}
