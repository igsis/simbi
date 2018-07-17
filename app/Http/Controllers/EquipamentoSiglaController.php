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

    public function create(Request $request){
        $data = $this->validate($request, [
            'sigla'=>'required|max:6|unique:equipamento_siglas',
            'descricao'=>'required',
            'roteiro'=>'nullable'
        ]);

        EquipamentoSigla::create($data);

        return redirect()->route('siglaEquipamento')
        ->with('flash_message',
         'Sigla do Equipamento Inserida com sucesso!');
        
    }

    public function update(Request $request, $id)
    {
        $equipamentoSigla = EquipamentoSigla::findOrFail($id);

        $this->validate($request, [
            'sigla'=>'required|max:6|unique:equipamento_siglas',
            'descricao'=>'required',
            'roteiro'=>'nullable'
        ]);

        $equipamentoSigla->update([
            'sigla' => $request->sigla,
            'descricao' => $request->descricao,
            'roteiro' => $request->roteiro
        ]);

        return redirect()->route('siglaEquipamento')
            ->with('flash_message',
            'Sigla do Equipamento Editado com Sucesso!');

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

    public function destroy($id)
    {
        EquipamentoSigla::findOrFail($id)
            ->update(['publicado' => 0]);

        return redirect()->route('siglaEquipamento')
            ->with('flash_message',
            'Sigla do Equipamento Desativada com Sucesso!');
    }

    public function toActivate($id)
    {
        EquipamentoSigla::findOrFail($id)
            ->update(['publicado' => 1]);

        return redirect()->route('siglaEquipamentoDisabled')
            ->with('flash_message',
            'Sigla do Equipamento Ativada com Sucesso!');
    }

    public function search(Request $request, EquipamentoSigla $equipamentoSigla)
    {
        $dataForm = $request->all();

        $equipamentoSiglas = $equipamentoSigla->search($dataForm)->orderBy('sigla')->paginate(10);

        if ($dataForm['publicado'] == 1) 
        {
            return view('gerenciar.equipamentoSigla.index', compact('equipamentoSiglas'));
        }else
        {   
            return view('gerenciar.equipamentoSigla.disabled', compact('equipamentoSiglas'));
        }
    }
}
