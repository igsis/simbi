<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\SubordinacaoAdministrativa;

class SubordinacaoAdministrativaController extends Controller
{
    public function index(){
    	$subordinacaoAdministrativas = SubordinacaoAdministrativa::orderBy('descricao')->get();

    	return view('gerenciar.subordinacaoAdministrativa.index', compact('subordinacaoAdministrativas'));
    }
}
