<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class EventosIgsis extends Model
{
    protected $connection = "mysql2";

    protected $table = 'ig_evento';

    public $timestamps = false;

    protected $fillable = [
      'idEvento', 'ig_produtor_idProdutor', 'ig_tipo_evento_idTipoEvento', 'ig_programa_idPrograma',
       'projetoEspecial', 'nomeEvento', 'projeto', 'memorando', 'idResponsavel', 'suplente', 'autor',
       'nomeGrupo', 'fichaTecnica', 'faixaEtaria', 'sinopse', 'releaseCom', 'parecerArtistico',
       'confirmaFinanca', 'confirmaDiretoria', 'confirmaComunicacao', 'confirmaDocumentacao',
       'confirmaProducao', 'numeroProcesso', 'publicado','idUsuario', 'ig_modalidade_IdModalidade',
       'linksCom', 'subEvento', 'dataEnvio', 'justificativa', 'idInstituicao', 'ocupacao', 'statusEvento'
    ];
}
