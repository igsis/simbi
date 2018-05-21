<?php

namespace Simbi\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Simbi\Models\PerguntaSeguranca;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','idPerguntaSeguranca','respostaSeguranca'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function endereco()
    {
        $this->hasOne('Simbi\Models\Endereco');
    }

    // Cria o relacionamento entre Users & Historics
    public function perguntaSeguranca()
    {
        return $this->belongsTo(PerguntaSeguranca::class);
    }
}