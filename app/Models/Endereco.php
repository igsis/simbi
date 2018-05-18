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
        'idSubprefeitura',
        'idDistrito',
        'idMacrorregiao',
        'idRegiao',
        'idRegional'
    ];

    public function equipamento()
    {
    	return $this->hasOne(Equipamento::class, 'idEndereco');
    }

    public function user()
    {
    	return $this->belongsTo(User::class, 'idEndereco', 'idEndereco');
    }
}