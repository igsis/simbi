<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;
use Simbi\Models\Endereco;

class PrefeituraRegional extends Model
{
	protected $table = 'prefeitura_regionais';
	
    public $timestamps = false;

    protected $fillable = [
        'descricao',
        'publicado'
    ];

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }

    public function search(Array $data)
    {
        return $this->where(function($query) use ($data) {
            if (isset($data['descricao'])) {
                $query->where('descricao', 'LIKE', '%'.$data['descricao'].'%');
            }
            if (isset($data['publicado'])) {
                $query->where('publicado', '=', $data['publicado']);
            }
        });
    }
}
