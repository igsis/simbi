<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;
use Simbi\Models\Equipamento;
use Simbi\Models\Funcionario;
use Simbi\Models\User;
use Session;
use Auth;

use Simbi\Models\Cargo;
use Simbi\Models\Escolaridade;
use Simbi\Models\Funcao;
use Simbi\Models\PerguntaSeguranca;
use Simbi\Models\ResponsabilidadeTipo;
use Simbi\Models\Secretaria;
use Simbi\Models\SubordinacaoAdministrativa;
use Spatie\Permission\Models\Role;


class FuncionarioController extends Controller
{
    public function index(Request $types)
    {
        $type = $types->type;
        if ($type == 1){
            $users = Funcionario::where('publicado', '=' ,$type)
                ->orWhere('publicado', '=' , 2)
                ->orderBy('id')->get();
        }else{
            $users = Funcionario::where('publicado', '=' ,$type)
                ->orderBy('id')->get();
        }

        $equipamentos = Equipamento::all();
        return view('funcionarios.index', compact('users', 'equipamentos','type'));
    }

    // Filtro de Usuários Ativados
    public function searchUser(Request $request, User $user)
    {
        $dataForm = $request->except('_token');

        $type = $request->types;

        $users = $user->search($dataForm)->orderBy('name')->paginate(10);

        $equipamentos = Equipamento::all();

        return view('funcionarios.index', compact('users', 'equipamentos','dataForm', 'type'));

    }

    public function edit($id)
    {

    }
}
