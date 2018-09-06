<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class FrequenciasPortaria extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'equipamento_id',
        'nome',
        'data'
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
