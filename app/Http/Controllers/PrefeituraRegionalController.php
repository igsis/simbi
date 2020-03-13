<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\PrefeituraRegional;

class PrefeituraRegionalController extends Controller
{
    public function index(){
    	$prefeiturasRegionais = PrefeituraRegional::where('publicado', '=', '1')->orderBy('descricao')->get();

    	return view('gerencial.gerenciar.prefeiturasRegionais.index', compact('prefeiturasRegionais'));
    }

    public function disabled(){
    	$prefeiturasRegionais = PrefeituraRegional::where('publicado', '=', '0')->orderBy('descricao')->get();

    	return view('gerencial.gerenciar.prefeiturasRegionais.disabled', compact('prefeiturasRegionais'));
    }

    public function create(Request $request){
        $data = $this->validate($request, [
            'descricao'=>'required|unique:prefeitura_regionais'
        ]);

        PrefeituraRegional::create($data);

        return redirect()->route('prefeituraRegional')
            ->with('flash_message',
            'Subprefeitura Inserida com sucesso!');
        
    }

    public function update(Request $request, $id)
    {
        $prefeituraRegional = PrefeituraRegional::findOrFail($id);

        $this->validate($request, [
            'descricao'=>'required|unique:prefeitura_regionais'
        ]);

        $prefeituraRegional->update([
            'descricao' => $request->descricao
        ]);

        return redirect()->route('prefeituraRegional')
            ->with('flash_message',
            'Subprefeitura Editada com Sucesso!');

    }

    public function store(Request $request)
    {
    	if($request->has('novo')){
            $data = $this->validate($request, [
                'descricao'=>'required'
            ]);

            PrefeituraRegional::create($data);
            $data = PrefeituraRegional::orderBy('descricao')->get();
            return response()->json($data);
        }
	}    

    public function destroy($id)
    {
        PrefeituraRegional::findOrFail($id)
            ->update(['publicado' => 0]);

        return redirect()->route('prefeituraRegional')
            ->with('flash_message',
            'Subprefeitura Desativada com Sucesso!');
    }

    public function toActivate($id)
    {
        PrefeituraRegional::findOrFail($id)
            ->update(['publicado' => 1]);

        return redirect()->route('prefeituraRegionalDisabled')
            ->with('flash_message',
            'Subprefeitura Ativado com Sucesso!');
    }

    public function search(Request $request, PrefeituraRegional $prefeituraRegional)
    {
        $dataForm = $request->all();

        $prefeiturasRegionais = $prefeituraRegional->search($dataForm)->orderBy('descricao')->get();

        if ($dataForm['publicado'] == 1) 
        {
            return view('gerencial.gerenciar.prefeiturasRegionais.index', compact('prefeiturasRegionais'));
        }else
        {   
            return view('gerencial.gerenciar.prefeiturasRegionais.disabled', compact('prefeiturasRegionais'));
        }
    }
}
