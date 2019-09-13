<?php

namespace Simbi;

use Illuminate\Database\Eloquent\Model;
use Simbi\Models\ComplementoPortaria;
use Simbi\Models\Equipamento;

class EscolaridadeComplementos extends Model
{
    public $timestamps = false;

    protected $table = 'escolaridade_complementos';

    protected $fillable = [
        'fundamental',
        'medio',
        'superior',
        'semInformacao'
    ];

    public function complementoPortaria()
    {
        return $this->hasMany(ComplementoPortaria::class);
    }

}
