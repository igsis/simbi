<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\EquipamentoSigla;

class EquipamentoSiglaController extends Controller
{
    public function index(){
    	$equipamentoSiglas = EquipamentoSigla::orderBy('descricao')->get();

    	return view('gerenciar.equipamentoSigla.index', compact('equipamentoSiglas'));
    }
}
