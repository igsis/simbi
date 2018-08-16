<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class FrequenciasPublico extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'data',
        'hora',
        'crianca',
        'jovem',
        'adulto',
        'idoso',
        'total',
        'user_id',
        'equipamento_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
