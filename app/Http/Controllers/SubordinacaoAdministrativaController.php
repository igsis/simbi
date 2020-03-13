<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\SubordinacaoAdministrativa;

class SubordinacaoAdministrativaController extends Controller
{
    public function index()
    {
    	$subordinacaoAdministrativas = SubordinacaoAdministrativa::where('publicado', '=', '1')->orderBy('descricao')->paginate(10);

    	return view('gerencial.gerenciar.subordinacaoAdministrativa.index', compact('subordinacaoAdministrativas'));
    }

    public function disabled()
    {
    	$subordinacaoAdministrativas = SubordinacaoAdministrativa::where('publicado', '=', '0')->orderBy('descricao')->paginate(10);

    	return view('gerencial.gerenciar.subordinacaoAdministrativa.disabled', compact('subordinacaoAdministrativas'));
    }

    public function create(Request $request)
    {
        $data = $this->validate($request, [
            'descricao'=>'required|unique:subordinacao_administrativas'
        ]);

        SubordinacaoAdministrativa::create($data);

        return redirect()->back() ->with('flash_message','Lotação inserida com sucesso');
        
    }

    public function update(Request $request, $id)
    {
        $subordinacaoAdministrativa = SubordinacaoAdministrativa::findOrFail($id);

        $this->validate($request, [
            'descricao'=>'required|unique:subordinacao_administrativas'
        ]);

        $subordinacaoAdministrativa->update([
            'descricao' => $request->descricao
        ]);

        return redirect()->route('subordinacaoAdministrativa')
            ->with('flash_message','Subordinação Administrativa Editada com Sucesso!');

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

    public function destroy($id)
    {
        SubordinacaoAdministrativa::findOrFail($id)
            ->update(['publicado' => 0]);

        return redirect()->route('subordinacaoAdministrativa')
            ->with('flash_message', 'Subordinação Administrativa Desativada com Sucesso!');
    }

    public function toActivate($id)
    {
        SubordinacaoAdministrativa::findOrFail($id)
            ->update(['publicado' => 1]);

        return redirect()->route('subordinacaoAdministrativaDisabled')
            ->with('flash_message', 'Subordinação Administrativa Ativada com Sucesso!');
    }

    public function search(Request $request, SubordinacaoAdministrativa $subordinacaoAdministrativa)
    {
        $dataForm = $request->all();

        $subordinacaoAdministrativas = $subordinacaoAdministrativa->search($dataForm)->orderBy('descricao')->paginate(10);

        if ($dataForm['publicado'] == 1) 
        {
            return view('gerencial.gerenciar.subordinacaoAdministrativa.index', compact('subordinacaoAdministrativas'));
        }else
        {   
            return view('gerencial.gerenciar.subordinacaoAdministrativa.disabled', compact('subordinacaoAdministrativas'));
        }
    }  
}
