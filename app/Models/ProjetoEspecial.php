<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class ProjetoEspecial extends Model
{
    protected $connection = "mysql2";
    protected $table = 'projeto_especiais';
    protected $primaryKey = 'id';

    public $timestamps = false;

    public function evento()
    {
        return $this->hasMany(Evento::class, 'projeto_especial_id', 'id');
    }
}
