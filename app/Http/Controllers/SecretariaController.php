<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\Secretaria;

class SecretariaController extends Controller
{
    public function index(){
    	$secretarias = Secretaria::where('publicado', '=', '1')->orderBy('descricao')->paginate(10);

    	return view('gerenciar.secretarias.index', compact('secretarias'));
    }

    public function disabled(){
    	$secretarias = Secretaria::where('publicado', '=', '0')->orderBy('descricao')->paginate(10);

    	return view('gerenciar.secretarias.desativados', compact('secretarias'));
    }

    public function update(Request $request)
    {
        $secretaria = Secretaria::findOrFail($request->id);

        $secretaria->update([
            'sigla'     => $request->sigla,
            'descricao' => $request->descricao
        ]);

        return redirect()->back()
            ->with('flash_message',
            'Secretaria editada com Sucesso!');

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
}
