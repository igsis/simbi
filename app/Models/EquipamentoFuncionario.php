<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Simbi\Models\Funcionario;
use Simbi\Models\ResponsabilidadeTipo;
use Simbi\Models\User;

class EquipamentoFuncionario extends Pivot
{
    protected $table = 'equipamento_funcionario';

    protected $fillable = [
        'funcionario_id',
        'equipamento_id',
        'responsabilidade_tipo_id'
    ];

    public function responsabilidadeTipo()
    {
        return $this->hasMany(ResponsabilidadeTipo::class, 'id', 'responsabilidade_tipo_id');
    }

    public function user()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function equipamentos()
    {
        return $this->hasMany(Equipamento::class, 'id', 'equipamento_id');
    }

}
