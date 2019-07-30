<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;
use Simbi\Models\EventosIgsis;
use Symfony\Component\EventDispatcher\Event;

class TipoEventoIgsis extends Model
{
    protected $connection = "mysql2";
    protected $table = 'ig_tipo_evento';
    protected $primaryKey = 'idTipoEvento';

    public $timestamps = false;

    protected $fillable = [
        'idTipoEvento',
        'tipoEvento',
        'spcultura',
        'publicado'
    ];

    public function eventoIgsis(){
        return $this->hasMany(EventosIgsis::class,'ig_tipo_evento_idTipoEvento','ig_tipo_evento');
    }
}
