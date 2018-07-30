<?php

namespace Simbi\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

/*TODO: Alterar o delete com "publicado = 0" para Soft Delete
  use Illuminate\Database\Eloquent\SoftDeletes
  https://goo.gl/RarucR */

/*TODO: Adicionar campos cargo_id, funcao_id, escolaridade_id, previsão_aposentadoria, secretaria_id e subordinação administrativa*/
/*TODO: Criar Models: Funcao, Cargo, Escolaridade*/
/*TODO: Atualizar 'usuarios.cadastro' e 'usuarios.editar'*/

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
        'name',
        'login',
        'email',
        'password',
        'pergunta_seguranca_id',
        'resposta_seguranca',
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

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function perguntaSeguranca()
    {
        return $this->belongsTo(PerguntaSeguranca::class);
    }

/*TODO: Analisar possibilidade de FK na tabela intermediaria
https://goo.gl/BcqZQr*/
    public function equipamentos()
    {
        return $this->belongsToMany(Equipamento::class)->withPivot('data_inicio', 'data_fim');
    }

    public function frequencias()
    {
        return $this->hasManyThrough(Frequencia::class, Evento::class);
    }



    public function search(Array $data)
    {
        return $this->where(function ($query) use($data)
        {
            $query->where('publicado', $data['types']);

            if (isset($data['name'])) {
                $query->where('name', $data['name']);
            }

            if (isset($data['login'])) {
                $query->where('login', $data['login']);
            }
            
            if (isset($data['email'])) {
                $query->where('email', $data['email']);
            }

        });

    } 
}