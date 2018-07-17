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

    public function search(Array $data)
    {
        return $this->where(function($query) use ($data) {
            if (isset($data['sigla'])) {
                $query->where('sigla', 'LIKE', '%'.$data['sigla'].'%');
            }
            if (isset($data['descricao'])) {
                $query->where('descricao', 'LIKE', '%'.$data['descricao'].'%');
            }
            if (isset($data['publicado'])) {
                $query->where('publicado', '=', $data['publicado']);
            }
        });
    }
}
