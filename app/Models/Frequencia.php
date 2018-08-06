<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Frequencia extends Model
{
    protected $table = 'frequencia';

    public $timestamps = false;

    protected $fillable = [
        'evento_id',
        'data',
        'hora',
        'crianca',
        'jovem',
        'adulto',
        'idoso',
        'total',
        'observacao',
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
