<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;
use Simbi\Models\Endereco;

class PrefeituraRegional extends Model
{
	protected $table = 'prefeitura_regionais';
	
    public $timestamps = false;

    protected $fillable = [
        'descricao'
    ];

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }
}