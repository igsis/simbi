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

    public function store(Request $request)
    {
    	if($request->has('novo')){
            $data = $this->validate($request, [
                'descricao'=>'required|unique:distritos'
            ]);

            Distrito::create($data);
            $data = Distrito::orderBy('descricao')->get();
            return response()->json($data);
        }
	}

    public function destroy($id)
    {
        Distrito::findOrFail($id)
            ->update(['publicado' => 0]);

        return view('gerenciar.distritos.index', compact('distritos'));
    }
}
