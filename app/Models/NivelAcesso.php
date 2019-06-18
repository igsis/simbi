<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class NivelAcesso extends Model
{
    public function users()
    {
    return $this->hasMany(User::class);
    }

}