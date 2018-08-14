<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    public $timestamps = false;

    protected $fillable = ['cargo'];

    public function usuario()
    {
        return $this->hasOne(User::class);
    }
}
