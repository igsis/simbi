<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    public $timestamps = false;

    public $fillable = [
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'subprefeitura_id',
        'distrito_id',
        'macrorregiao_id',
        'regiao_id',
        'regional_id'
    ];

    public function macrorregiao()
    {
        return $this->belongsTo(Macrorregiao::class);
    }

    public function regiao()
    {
        return $this->belongsTo(Regiao::class);
    }

    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }

    public function equipamento()
    {
    	return $this->hasOne(Equipamento::class);
    }
}