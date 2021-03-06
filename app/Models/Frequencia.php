<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Frequencia extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'evento_ocorrencia_id',
        'crianca',
        'jovem',
        'adulto',
        'idoso',
        'total',
        'observacao',
        'user_id',
        'equipamento_id'
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }

    public function eventoOcorrencia()
    {
        return $this->belongsTo(EventoOcorrencia::class);
    }

    public function projetoEspecial()
    {
        return $this->belongsTo(ProjetoEspecial::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

}
