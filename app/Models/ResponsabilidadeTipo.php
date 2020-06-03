<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;
use Simbi\Models\EquipamentoFuncionario;

class ResponsabilidadeTipo extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'responsabilidade_tipo'
    ];
    public function equipamentoFuncionario()
    {
        return $this->hasMany(EquipamentoFuncionario::class);
    }

    public function funcionario()
    {
        $this->belongsToMany(Funcionario::class);
    }
}
