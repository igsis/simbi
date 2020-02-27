<?php

namespace Simbi;

use Illuminate\Database\Eloquent\Model;
use Simbi\Models\Equipamento;

class Consulta extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'audio_visual',
        'jornal',
        'livro',
        'manga',
        'revista',
        'suportes',
        'total',
        'data',
        'data_envio',
        'equipamento_id',
        'publicado'];

    public function equipamento()
    {
        return $this->hasMany(Equipamento::class);
    }
}
