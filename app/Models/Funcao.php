<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Funcao extends Model
{
    protected $table = 'funcoes';

    protected $fillable = ['funcao'];

    public $timestamps = false;

    public function usuario()
    {
        return $this->hasOne(User::class);
    }
}
