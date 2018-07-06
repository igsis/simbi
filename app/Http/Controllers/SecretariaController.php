<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\Secretaria;

class SecretariaController extends Controller
{
    public function index(){
    	$secretaria = Secretaria::orderBy('descricao')->get();
    	dd($secretaria);
    }
}
