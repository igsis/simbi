<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\PrefeituraRegional;

class PrefeituraRegionalController extends Controller
{
    public function index(){
    	$prefeiturasRegionais = PrefeituraRegional::orderBy('descricao')->get();

    	return view('gerenciar.prefeiturasRegionais.index', compact('prefeiturasRegionais'));
    }
}
