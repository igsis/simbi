<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class EventoOcorrencia extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'igsis_evento_id',
        'igsis_id',
        'data',
        'horario'
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
