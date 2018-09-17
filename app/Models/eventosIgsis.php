<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class eventosIgsis extends Model
{
    protected $connection = "mysql2";

    protected $table = 'ig_evento';

    public $timestamps = false;

    protected $fillable = [

    ];
}
