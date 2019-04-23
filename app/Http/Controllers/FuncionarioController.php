<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;
use Simbi\Models\Equipamento;
use Simbi\Models\Funcionario;
use Simbi\Models\User;

class FuncionarioController extends Controller
{
    public function index(Request $types)
    {
        $type = $types->type;
        $users = Funcionario::where('publicado', '=', $type)->orderBy('id')->paginate(10);
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
}
