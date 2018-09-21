<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class ProjetoEspecial extends Model
{
    protected $table = 'projeto_especiais';

    public $timestamps = false;

    public function evento()
    {
        return $this->hasMany(Evento::class);
    }
}
