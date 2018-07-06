<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\EquipamentoSigla;

class EquipamentoSiglaController extends Controller
{
    public function index(){
    	$equipamentoSiglas = EquipamentoSigla::where('publicado', '=', '1')->orderBy('descricao')->paginate(10);

    	return view('gerenciar.equipamentoSigla.index', compact('equipamentoSiglas'));
    }

    public function disabled(){
    	$equipamentoSiglas = EquipamentoSigla::where('publicado', '=', '0')->orderBy('descricao')->paginate(10);

    	return view('gerenciar.equipamentoSigla.desativados', compact('equipamentoSiglas'));
    }

    public function store(Request $request)
    {
		if ($request->has('novo')){
            $data = $this->validate($request, [
                        'sigla'=>'required|max:6|unique:equipamento_siglas',
                        'descricao'=>'required',
                        'roteiro'=>'nullable'
                    ]);

            EquipamentoSigla::create($data);
            $data = EquipamentoSigla::orderBy('descricao')->get();
            return response()->json($data);
        }
	}
}
