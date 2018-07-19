<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Frequencia extends Model
{
    protected $table = 'frequencia';

    protected $fillable = [
        'data',
        'hora',
        'crianca',
        'jovem',
        'adulto',
        'idoso',
        'total',
        'observacao'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
