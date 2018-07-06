<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\TipoServico;

class TipoServicoController extends Controller
{
    public function index(){
    	$tipoServicos = TipoServico::orderBy('descricao')->get();
    	
    	return view('gerenciar.tipoServico.index', compact('tipoServicos'));

    }
}
