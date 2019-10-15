<?php

namespace Simbi\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Simbi\Models\EquipamentoFuncionario;
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

    public function nivelAcesso()
    {
        return $this->belongsTo(NivelAcesso::class);
    }
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function perguntaSeguranca()
    {
        return $this->belongsTo(PerguntaSeguranca::class);
    }
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function escolaridade()
    {
        return $this->belongsTo(Escolaridade::class);
    }

    /**
     * Função de relacionamento entre Usuarios e Equipamentos
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function equipamentos()
    {
        return $this->belongsToMany(Equipamento::class)->using(EquipamentoFuncionario::class);
    }

    public function frequencias()
    {
        // return $this->hasManyThrough(Frequencia::class, Evento::class);

        return $this->hasMany(Frequencia::class);
    }

    public function frequenciasPublicos()
    {
        return $this->hasMany(FrequenciasPublico::class);
    }

    public function frequenciasPortarias()
    {
        return $this->hasMany(FrequenciasPortaria::class);
    }

    public function funcao()
    {
        return $this->belongsTo(Funcao::class);
    }

    public function ocorrencia()
    {
        return $this->hasMany(EquipamentoOcorrencia::class);
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