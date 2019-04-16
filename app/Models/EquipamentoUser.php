<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EquipamentoUser extends Pivot
{

    protected $table = 'equipamento_users';

    protected $fillable = [
        'data_inicio',
        'data_fim',
        'responsabilidade_tipo_id'
    ];

    public function responsabilidadeTipo()
    {
        return $this->belongsTo(ResponsabilidadeTipo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
