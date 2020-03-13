<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Deficiencia extends Model
{
    public $timestamps = false;

    protected $table = "deficiencias_complementos";

    protected $fillable = [
        'visual',
        'auditiva',
        'motora',
        'mental'
    ];

    public function complementoPortaria()
    {
        return $this->hasMany(ComplementoPortaria::class);
    }

}
