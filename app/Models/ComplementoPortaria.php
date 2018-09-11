<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class ComplementoPortaria extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'portaria_id',
        'idade_id',
        'sexo_id',
        'etnia_id',
        'escolaridade_id',
        'deficiencia_id'
    ];
    public function deficiencia()
    {
        return $this->belongsTo(Deficiencia::class);
    }

    public function escolaridade()
    {
        return $this->belongsTo(Escolaridade::class);
    }

    public function etnia()
    {
        return $this->belongsTo(Etnia::class);
    }

    public function frequenciasPortarias()
    {
        return $this->belongsTo(FrequenciasPortaria::class);
    }

    public function idade()
    {
        return $this->belongsTo(Idade::class);
    }

    public function sexo()
    {
        return $this->belongsTo(Sexo::class);
    }
}
