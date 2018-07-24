<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class EquipamentoCapacidade extends Model
{
    public $timestamps = false;

    public function auditorio()
    {
        return $this->hasOne(Auditorio::class);
    }

    public function teatro()
    {
        return $this->hasOne(Teatro::class);
    }

    public function multiuso()
    {
        return $this->hasOne(SalaMultiuso::class);
    }

    public function estudoGrupo()
    {
        return $this->hasOne(SalaEstudoGrupo::class);
    }

    public function estudoIndividual()
    {
        return $this->hasOne(SalaEstudoIndividual::class);
    }

    public function infantil()
    {
        return $this->hasOne(SalaInfantil::class);
    }

    public function estacionamento()
    {
        return $this->hasOne(Estacionamento::class);
    }

    public function praca()
    {
        return $this->hasOne(Praca::class);
    }

}
