<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class TelecentroDiglab extends Model
{
    protected $table = "telecentros_diglabs";

    public $timestamps = false;

    protected $fillable = [
        'quantidade'
    ];

    public function capacidade()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
