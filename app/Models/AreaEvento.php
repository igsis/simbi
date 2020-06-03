<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;
use Simbi\Models\Evento;

class AreaEvento extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'area'
    ];

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }
}
