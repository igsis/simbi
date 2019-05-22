<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class OcorrenciasIgsis extends Model
{
    protected $connection = "mysql2";

    protected $table = 'ig_ocorrencia';
    protected $primaryKey = 'idOcorrencia';

    public $timestamps = false;

    protected $fillable = [
        'idOcorrencia',
        'idTipoOcorrencia',
        'ig_comunicao_idCom',
        'local',
        'idEvento',
        'segunda',
        'terca',
        'quarta',
        'quinta',
        'sexta',
        'sabado',
        'domingo',
        'dataInicio',
        'dataFinal',
        'horaInicio',
        'horaFinal',
        'timezone',
        'diaInteiro',
        'diaEspecial',
        'libras',
        'audiodescricao',
        'valorIngresso',
        'retiradaIngresso',
        'localOutros',
        'lotacao',
        'reservados',
        'duracao',
        'precoPopular',
        'frequencia',
        'publicado',
        'idSubEvento',
        'idCinema',
        'virada',
        'observacao'
    ];
}
