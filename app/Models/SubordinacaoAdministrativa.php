<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class SubordinacaoAdministrativa extends Model
{
    public $timestamps = false;

    protected $fillable = [
    	'descricao',
		'publicado'
    ];

    public function equipamentos()
    {
        return $this->hasMany(Equipamento::class);
    }
}
