<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class EquipamentosCapacidade extends Model
{
    public $timestamps = false;

    protected $fillable =[
        'equipamento_id',
        'capacidade'
    ];

    public function capacidade()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
