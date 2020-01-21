<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEvento extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tipo_evento'
    ];

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }
}
