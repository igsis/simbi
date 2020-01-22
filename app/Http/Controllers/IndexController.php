<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Models\EventoOcorrencia;
use Simbi\Models\Frequencia;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function gerencialIndex()
    {
        $frequenciasCadastradas = Frequencia::all()->pluck('evento_ocorrencia_id')->toArray();

        $ocorrencias = EventoOcorrencia::all();

        //return view('teste');
        return view('gerencial.index', compact('frequenciasCadastradas', 'ocorrencias'));
    }

    public function frequenciaIndex()
    {
        $frequenciasCadastradas = Frequencia::all()->pluck('evento_ocorrencia_id')->toArray();

        $ocorrencias = EventoOcorrencia::all();

        //return view('teste');
        return view('gerencial.index', compact('frequenciasCadastradas', 'ocorrencias'));
    }
}
