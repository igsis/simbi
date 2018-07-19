<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Frequencia extends Model
{
    protected $table = 'frequencia';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
