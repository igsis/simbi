<?php

namespace Simbi\Models;

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
        'periodo',
        'data',
        'data_envio',
        'equipamento_id',
        'publicado'];

    public function equipamento()
    {
        return $this->hasMany(Equipamento::class);
    }
}
