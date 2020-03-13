<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class NivelAcesso extends Model
{
    public $timestamps = false;

    protected $table = 'nivel_acessos';

    protected $fillable = [
        'nivel_acesso'
        ];

    public function users()
    {
    return $this->hasMany(User::class);
    }

}