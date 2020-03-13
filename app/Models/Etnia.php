<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Etnia extends Model
{
    public $timestamps = false;

    protected $table = 'etnias_complementos';

    protected $fillable = [
        'amarela',
        'branca',
        'indigena',
        'parda',
        'preta',
        'semInformacao'
    ];

    public function complementoPortaria()
    {
        return $this->hasMany(ComplementoPortaria::class);
    }

}
