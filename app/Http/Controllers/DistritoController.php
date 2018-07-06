<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\Distrito; 

class DistritoController extends Controller
{
    public function index(){
    	$distritos = Distrito::orderBy('descricao')->get();
    	
    	return view('gerenciar.distritos.index', compact('distritos'));
    }
}
