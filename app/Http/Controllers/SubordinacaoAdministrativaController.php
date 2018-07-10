<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\SubordinacaoAdministrativa;

class SubordinacaoAdministrativaController extends Controller
{
    public function index(){
    	$subordinacaoAdministrativas = SubordinacaoAdministrativa::where('publicado', '=', '1')->orderBy('descricao')->paginate(10);

    	return view('gerenciar.subordinacaoAdministrativa.index', compact('subordinacaoAdministrativas'));
    }

    public function disabled(){
    	$subordinacaoAdministrativas = SubordinacaoAdministrativa::where('publicado', '=', '0')->orderBy('descricao')->paginate(10);

    	return view('gerenciar.subordinacaoAdministrativa.desativados', compact('subordinacaoAdministrativas'));
    }

    public function update(Request $request)
    {
        $subordinacaoAdministrativa = SubordinacaoAdministrativa::findOrFail($request->id);

        $subordinacaoAdministrativa->update([
            'descricao' => $request->descricao
        ]);

        return redirect()->back()
            ->with('flash_message',
            'Subordinação Administrativa editada com Sucesso!');

    }

    public function store(Request $request)
    {
    	if ($request->has('novo')) {
            $data = $this->validate($request, [
                    'descricao' => 'required|unique:subordinacao_administrativas'
                ]);

            SubordinacaoAdministrativa::create($data);
            $data = SubordinacaoAdministrativa::orderBy('descricao')->get();
            return response()->json($data);
        }
	}    
}
