<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Acessibilidade extends Model
{
    public $timestamps = false;

    public function detalhes()
    {
        return $this->hasMany(EquipamentoDetalhe::class);
    }

    public function acessibilidadeArquitetonica()
    {
        return $this->belongsTo(AcessibilidadeArquitetonica::class);
    }
}
