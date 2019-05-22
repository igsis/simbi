<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    public $timestamps = false;

    protected $fillable = ['cargo',
        'publicado'];

    public function funcionario()
    {
        return $this->hasMany(Funcionario::class);
    }

    public function search(Array $data)
    {
        return $this->where(function($query) use ($data) {
            if (isset($data['cargo'])) {
                $query->where('cargo', 'LIKE', '%'.$data['cargo'].'%');
            }
            if (isset($data['publicado'])) {
                $query->where('publicado', '=', $data['publicado']);
            }
        });

    }
}
