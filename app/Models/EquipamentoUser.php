<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EquipamentoUser extends Pivot
{
    protected $fillable = [
        'data_inicio',
        'data_fim',
        'responsabilidade_tipo_id'
    ];

    public function responsabilidadeTipo()
    {
        return $this->belongsTo(ResponsabilidadeTipo::class);
    }
}
