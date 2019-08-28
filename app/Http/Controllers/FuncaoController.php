<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;
use Simbi\Models\Funcao;

class FuncaoController extends Controller
{
    public function create(Request $request)
    {

        $data = $this->validate($request, [
            'funcao'=>'required|unique:funcoes'
        ]);

        Funcao::create($data);

        return redirect()->back()
            ->with('flash_message', 'Função Inserida com sucesso!');
    }
}
