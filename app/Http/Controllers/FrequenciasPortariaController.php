<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Models\Deficiencia;
use Simbi\Models\Equipamento;
use Auth;
use Simbi\Models\Escolaridade;
use Simbi\Models\Etnia;
use Simbi\Models\Idade;
use Simbi\Models\Sexo;


class FrequenciasPortariaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isFunc']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $equipamento = Equipamento::findOrFail($id);
        return view('frequencia.portaria.cadastro', compact('equipamento'));
    }

    public function criaPortariaCompleta($id)
    {
        $equipamento = Equipamento::find($id);
        $etnias = Etnia::all();
        $idades = Idade::all();
        $escolaridades = Escolaridade::all();
        $sexos = Sexo::all();
        $deficiencias = Deficiencia::all();

        return view('frequencia.portaria.cadastroCompleto', compact(
            'equipamento',
            'etnias',
            'idades',
            'escolaridades',
            'sexos',
            'deficiencias'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'data'          =>  'required',
            'nome'          =>  'required'
        ]);

        $user =  Auth::user();

        // dd($request->equipamento);

        $user->frequenciasPortarias()->create([
            'data' => $request->data,
            'nome' => $request->nome,
            'equipamento_id' => $id
        ]);

        return redirect()->route('frequencia.portaria.index')->with('flash_message',
            'Frequência Inserida Com Sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function relatorio()
    {
        $type = 2;
        $equipamentos = Equipamento::where('publicado', '=', '1')->orderBy('nome')->paginate(10);
        return view('frequencia.portaria.index', compact('equipamentos', 'type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listar($id)
    {
        $equipamento = Equipamento::findOrFail($id);
        return view('frequencia.portaria.listar', compact('equipamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
