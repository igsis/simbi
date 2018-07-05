<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\TipoServico;

class TipoServicoController extends Controller
{
    public function index(){
    	$tipoServico = TipoServico::orderBy('descricao')->get();
    	dd($tipoServico);
    }
}
