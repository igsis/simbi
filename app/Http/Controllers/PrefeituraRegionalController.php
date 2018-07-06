<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\PrefeituraRegional;

class PrefeituraRegionalController extends Controller
{
    public function index(){
    	$prefeituraRegional = PrefeituraRegional::orderBy('descricao')->get();
    	dd($prefeituraRegional);
    }
}
