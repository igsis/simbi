<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;
use Simbi\Models\TipoEventoIgsis;

class EventosIgsis extends Model
{
    protected $connection = "mysql2";
    protected $table = 'eventos';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nome_evento',
        'projeto_especial_id',
        'instituicao_id',
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
