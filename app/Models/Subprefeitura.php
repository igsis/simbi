<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;
use Simbi\Models\Endereco;

class Subprefeitura extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'descricao'
    ];

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }
}