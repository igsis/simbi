<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Idade extends Model
{

    public $timestamps = false;

    protected $fillable = [
        '0_6anos',
        '7_14anos',
        '15_17anos',
        '18_29anos',
        '30_59anos',
        '60_mais_anos',
        'semInformacao'
    ];

    public function complementoPortaria()
    {
        return $this->hasMany(ComplementoPortaria::class);
    }

}
