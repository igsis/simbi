<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\PrefeituraRegional;

class PrefeituraRegionalController extends Controller
{
    public function index(){
    	$prefeiturasRegionais = PrefeituraRegional::where('publicado', '=', '1')->orderBy('descricao')->paginate(10);

    	return view('gerenciar.prefeiturasRegionais.index', compact('prefeiturasRegionais'));
    }

    public function disabled(){
    	$prefeiturasRegionais = PrefeituraRegional::where('publicado', '=', '0')->orderBy('descricao')->paginate(10);

    	return view('gerenciar.prefeiturasRegionais.desativados', compact('prefeiturasRegionais'));
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
}
