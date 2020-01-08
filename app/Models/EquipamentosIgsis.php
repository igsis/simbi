<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class EquipamentosIgsis extends Model
{
    protected $connection = "mysql2";

    protected $table = 'locais';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'local',
        'instituicao_id',
        'publicado',
        'rider',
        'rua',
        'cidade',
        'uf',
        'cep',
        'pais',
        'telefone',
        'spcultura'
    ];

    public function equipamento()
    {
        return $this->hasOne(Equipamento::class);
    }

}
