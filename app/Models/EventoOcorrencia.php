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
        'horario',
        'data_envio',
        'publicado',
        'periodo',
        'observacao'
    ];

    public function frequencia()
    {
        return $this->hasMany(Frequencia::class);
    }

    public function eventosIgsis()
    {
        return $this->belongsTo(EventosIgsis::class,'igsis_evento_id','idEvento');
    }
}
