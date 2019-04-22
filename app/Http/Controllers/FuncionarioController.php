<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

class FuncionarioController extends Controller
{
    // Filtro de Usuários Ativados
    public function searchFuncionario(Request $request, User $user)
    {
        $dataForm = $request->except('_token');

        $type = $request->types;

        $users = $user->search($dataForm)->orderBy('name')->paginate(10);

        $equipamentos = Equipamento::all();

        return view('funcionarios.index', compact('users', 'equipamentos','dataForm', 'type'));

    }
}
