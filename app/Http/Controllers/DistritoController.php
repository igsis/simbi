<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\Distrito; 

class DistritoController extends Controller
{
    public function index()
    {
    	$distritos = Distrito::where('publicado', '=', '1')->orderBy('descricao')->get();
    	
    	return view('gerenciar.distritos.index', compact('distritos'));
    }

    public function disabled()
    {
    	$distritos = Distrito::where('publicado', '=', '0')->orderBy('descricao')->get();
    	
    	return view('gerenciar.distritos.disabled', compact('distritos'));
    }


    public function create(Request $request)
    {

        $data = $this->validate($request, [
            'descricao'=>'required|unique:distritos'
        ]);

        Distrito::create($data);
        
        return redirect()->route('distrito')
            ->with('flash_message', 'Distrito Inserido com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $distrito = Distrito::findOrFail($id);

        $this->validate($request, [
            'descricao'=>'required|unique:distritos'
        ]);

        $distrito->update([
            'descricao' => $request->descricao
        ]);

        return redirect()->route('distrito')
            ->with('flash_message', 'Distrito Editado com Sucesso!');

    }

    public function destroy($id)
    {
        Distrito::findOrFail($id)
            ->update(['publicado' => 0]);

        return redirect()->route('distrito')
            ->with('flash_message', 'Distrito Desativado com Sucesso!');
    }

    public function toActivate($id)
    {
        Distrito::findOrFail($id)
            ->update(['publicado' => 1]);

        return redirect()->route('distritoDisabled')
            ->with('flash_message', 'Distrito Ativado com Sucesso!');
    }

    public function search(Request $request, Distrito $distrito)
    {
        $dataForm = $request->all();

        $distritos = $distrito->search($dataForm)->orderBy('descricao')->get();

        if ($dataForm['publicado'] == 1) 
        {
            return view('gerenciar.distritos.index', compact('distritos'));
        }else
        {   
            return view('gerenciar.distritos.disabled', compact('distritos'));
        }
    }
}
