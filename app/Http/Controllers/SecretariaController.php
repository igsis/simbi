<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\Secretaria;

class SecretariaController extends Controller
{
    public function index()
    {
    	$secretarias = Secretaria::where('publicado', '=', '1')->orderBy('descricao')->paginate(10);

    	return view('gerencial.gerenciar.secretarias.index', compact('secretarias'));
    }

    public function disabled()
    {
    	$secretarias = Secretaria::where('publicado', '=', '0')->orderBy('descricao')->paginate(10);

    	return view('gerencial.gerenciar.secretarias.disabled', compact('secretarias'));
    }

    public function create(Request $request)
    {
        $data = $this->validate($request, [
            'sigla'=>'required|max:6|unique:secretarias',
            'descricao'=>'required'
        ]);

        Secretaria::create($data);

        return redirect()->back()->with('flash_message','Secretaria Inserida com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $secretaria = Secretaria::findOrFail($id);

        $this->validate($request, [
            'sigla'=>'required|max:6|unique:secretarias',
            'descricao'=>'required'
        ]);

        $secretaria->update([
            'sigla'     => $request->sigla,
            'descricao' => $request->descricao
        ]);

        return redirect()->route('secretaria')
            ->with('flash_message',
            'Secretaria editada com sucesso!');

    }

    public function store(Request $request)
    {
		if ($request->has('novo')) {
            $data = $this->validate($request, [
                        'sigla'     => 'required|max:6|unique:secretarias',
                        'descricao' => 'required'
                    ]);

        	Secretaria::create($data);
			$data = Secretaria::orderBy('descricao')->get();
        	return response()->json($data);
        }
	}    

    public function destroy($id)
    {
        Secretaria::findOrFail($id)
            ->update(['publicado' => 0]);

        return redirect()->route('secretaria')
            ->with('flash_message',
            'Secretaria desativada com sucesso!');
    }

    public function toActivate($id)
    {
        Secretaria::findOrFail($id)
            ->update(['publicado' => 1]);

        return redirect()->route('secretariaDisabled')
            ->with('flash_message',
            'Secretaria ativada com sucesso!');
    }

    public function search(Request $request, Secretaria $secretaria)
    {
        $dataForm = $request->all();

        $secretarias = $secretaria->search($dataForm)->orderBy('descricao')->paginate(10);

        if ($dataForm['publicado'] == 1) 
        {
            return view('gerencial.gerenciar.secretarias.index', compact('secretarias'));
        }else
        {   
            return view('gerencial.gerenciar.secretarias.disabled', compact('secretarias'));
        }
    }
}
