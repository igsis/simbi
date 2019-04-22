<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class FrequenciasPublico extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'dia_semana_id',
        'crianca',
        'jovem',
        'adulto',
        'idoso',
        'total',
        'user_id',
        'equipamento_id'
    ];

    public function diaSemana(){
        return $this->belongsTo(DiaSemana::class);
    }

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }
}
