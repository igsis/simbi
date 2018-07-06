<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;
use Simbi\Models\Endereco;

class Distrito extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'descricao',
        'publicado'
    ];

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }
}
