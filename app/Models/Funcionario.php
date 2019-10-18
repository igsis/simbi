<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;
use Simbi\Models\EquipamentoFuncionario;

class Funcionario extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'email',
        'cargo_id',
        'subordinacao_adminstrativa_id',
        'secretaria_id',
        'publicado'
    ];

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
        return $this->belongsTo(Funcao::class,'funcao_id','id');
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



    public function users()
    {
        return $this->hasOne(User::class);
    }
}
