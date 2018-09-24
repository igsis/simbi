<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Models\EventoOcorrencia;
use Simbi\Models\Frequencia;

class IndexController extends Controller
{
    public function index()
    {
        $frequenciasCadastradas = Frequencia::all()->pluck('evento_ocorrencia_id')->toArray();

        $ocorrencias = EventoOcorrencia::all();

        return view('index', compact('frequenciasCadastradas', 'ocorrencias'));
    }
}
