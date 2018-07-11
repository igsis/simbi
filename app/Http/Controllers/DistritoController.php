<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\Distrito; 

class DistritoController extends Controller
{
    public function index(){
    	$distritos = Distrito::where('publicado', '=', '1')->orderBy('descricao')->paginate(10);
    	
    	return view('gerenciar.distritos.index', compact('distritos'));
    }

    public function disabled(){
    	$distritos = Distrito::where('publicado', '=', '0')->orderBy('descricao')->paginate(10);
    	
    	return view('gerenciar.distritos.desativados', compact('distritos'));
    }


    public function create(Request $request){

        $data = $this->validate($request, [
            'descricao'=>'required|unique:distritos'
        ]);

        Distrito::create($data);
        
        return redirect()->back()->with('flash_message',
            'Distrito inserido com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $distrito = Distrito::findOrFail($id);

        $distrito->update([
            'descricao' => $request->descricao
        ]);

        return redirect()->back()
            ->with('flash_message',
            'Distrito atualizado com Sucesso!');

    }


    public function destroy($id)
    {
        Distrito::findOrFail($id)
            ->update(['publicado' => 0]);

        return redirect()->back()
            ->with('flash_message',
            'Distrito desativado com Sucesso!');
    }
}
