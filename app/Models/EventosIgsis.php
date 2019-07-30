<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;
use Simbi\TipoEventoIgsis;

class EventosIgsis extends Model
{
    protected $connection = "mysql2";
    protected $table = 'ig_evento';
    protected $primaryKey = 'idEvento';

    public $timestamps = false;

    protected $fillable = [
      'idEvento',
        'ig_produtor_idProdutor',
        'ig_tipo_evento_idTipoEvento',
        'ig_programa_idPrograma',
        'projetoEspecial',
        'nomeEvento',
        'projeto',
        'idResponsavel',
        'suplente',
        'autor',
        'nomeGrupo',
        'fichaTecnica',
        'memorando',
        'faixaEtaria',
        'sinopse',
        'releaseCom',
        'parecerArtistico',
        'confirmaFinanca',
        'confirmaDiretoria',
        'confirmaComunicacao',
        'confirmaDocumentacao',
        'confirmaProducao',
        'numeroProcesso',
        'publicado',
        'idUsuario',
        'ig_modalidade_IdModalidade',
        'linksCom',
        'subEvento',
        'dataEnvio',
        'justificativa',
        'idInstituicao',
        'ocupacao',
        'statusEvento'
    ];

    public function eventoOcorrencia()
    {
        return $this->hasMany(EventoOcorrencia::class,'igsis_evento_id','idEvento');
    }

    public function tipoEventoIgsis(){
        return $this->belongsTo(TipoEventoIgsis::class,'ig_tipo_evento_idTipoEvento','idTipoEvento');
    }

}
