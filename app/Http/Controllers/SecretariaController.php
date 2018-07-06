<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\Secretaria;

class SecretariaController extends Controller
{
    public function index(){
    	$secretarias = Secretaria::orderBy('descricao')->get();

    	return view('gerenciar.secretarias.index', compact('secretarias'));
    }
}
