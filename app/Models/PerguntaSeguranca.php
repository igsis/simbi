<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;


class PerguntaSeguranca extends Model
{
    public function users()
    {
    	return $this->hasMany(User::class);
    }

}
