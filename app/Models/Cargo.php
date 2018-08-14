<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    public $timestamps = false;

    protected $fillable = ['cargo',
        'publicado'];

    public function usuario()
    {
        return $this->hasOne(User::class);
    }

    public function search(Array $data)
    {
        return $this->where(function ($query) use($data)
        {

            if (isset($data['cargo'])) {
                $query->where('cargo', $data['cargo']);
            }

        });

    }
}
