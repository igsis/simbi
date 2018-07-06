<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class TipoServico extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'descricao',
        'publicado'
    ];

    public function equipamento()
    {
        return $this->hasMany(Equipamento::class);
    }
}
