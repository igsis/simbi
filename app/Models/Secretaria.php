<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{
    public $timestamps = false;

    protected $fillable = [
    	'sigla',
    	'descricao',
		'publicado'
    ];

    public function equipamentos()
    {
        return $this->hasMany(Equipamento::class);
    }
}
