<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Acessibilidade extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'acessibilidade_arquitetonica_id',
        'banheiros_adaptados',
        'rampas_acesso',
        'elevador_id',
        'piso_tatil',
        'estacionamento_acessivel',
        'quantidade_vagas'
    ];

    public function detalhes()
    {
        return $this->hasMany(Detalhe::class);
    }

    public function acessibilidadeArquitetonica()
    {
        return $this->belongsTo(AcessibilidadeArquitetonica::class);
    }

    public function elevador()
    {
        return $this->belongsTo(Elevador::class);
    }
}
