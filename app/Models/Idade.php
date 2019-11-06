<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Idade extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'anos0_6',
        'anos7_14',
        'anos15_17',
        'anos18_29',
        'anos30_59',
        'mais60anos',
        'semInformacao'
    ];

    public function complementoPortaria()
    {
        return $this->hasMany(ComplementoPortaria::class);
    }

}
