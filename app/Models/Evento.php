<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nome_evento',
        'tipo_evento_id',
        'contratacao_forma_id'
    ];

    public function tipoEvento()
    {
        return $this->belongsTo(TipoEvento::class);
    }

    public function contratacao()
    {
        return $this->belongsTo(ContratacaoForma::class);
    }

    public function projetoEspecial(){
        return $this->belongsTo(ProjetoEspecial::class);
    }
}
