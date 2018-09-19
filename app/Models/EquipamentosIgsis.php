<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class EquipamentosIgsis extends Model
{
    protected $connection = "mysql2";

    protected $table = 'ig_local';

    public $timestamps = false;

    protected $fillable = [
        'idLocal',
        'sala',
        'lotacao',
        'idInstituicao',
        'publicado',
        'rider',
        'rua',
        'cidade',
        'estado',
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
