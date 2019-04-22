<?php

namespace Simbi\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/*TODO: Alterar o delete com "publicado = 0" para Soft Delete
  use Illuminate\Database\Eloquent\SoftDeletes
  https://goo.gl/RarucR */


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
        'login',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'pergunta_seguranca_id',
        'resposta_seguranca',
        'funcionario_id',
        'nivel_acesso_id',
        'publicado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function perguntaSeguranca()
    {
        return $this->belongsTo(PerguntaSeguranca::class);
    }
}