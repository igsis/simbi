<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class EquipamentosIgsis extends Model
{
    protected $connection = "mysql2";

    protected $table = 'ig_local';

    public $timestamps = false;

    protected $fillable = [
        
    ];

}
