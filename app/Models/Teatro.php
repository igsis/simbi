<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Teatro extends Model
{
    public $timestamps = false;

    protected $fillable = [
      'nome',
      'capacidade'
    ];

    public function capacidade()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
