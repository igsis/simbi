<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Reforma extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'inicio_reforma',
        'termino_reforma',
        'descricao'
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
