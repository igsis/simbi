<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionamento extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'segunda',
        'terca',
        'quarta',
        'quinta',
        'sexta',
        'sabado',
        'domingo',
        'hora_inicial',
        'hora_final',
        'equipamento_id',
        'publicado'
    ];

    public function equipamento(){
        return $this->belongsTo(Equipamento::class);
    }
}
