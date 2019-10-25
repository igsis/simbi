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
        return view('frequencia.frequencia.portaria.cadastro', compact('equipamento'));
    }

    public function criaPortariaCompleta($id)
    {
        $equipamento = Equipamento::find($id);
        $etnias = Etnia::all();
        $idades = Idade::all();
        $sexos = Sexo::all();
        $deficiencias = Deficiencia::all();

        return view('frequencia.frequencia.portaria.cadastroCompleto', compact(
            'equipamento',
            'etnias',
            'idades',
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'data'          =>  'required',
            'quantidade'          =>  'required|integer|between: 0, 9999'
        ]);

        $user =  Auth::user();

        $user->frequenciasPortarias()->create([
            'data' => $request->data,
            'quantidade' => $request->quantidade,
            'equipamento_id' => $request->id
        ]);

        return redirect()->route('frequencias.enviadas',['type'=>'1'])->with('flash_message',
            'Frequência Inserida Com Sucesso!');
    }

    public function gravaPortariaCompleta(Request $request, $id)
    {
        $this->validate($request, [
            'data'     =>  'required',
            'fundamental'       =>  'required|integer|between: 0, 9999',
            'medio'         =>  'required|integer|between: 0, 9999',
            'superior'        =>  'required|integer|between: 0, 9999',
            'naoInformadoEscolaridade'         =>  'required|integer|between: 0, 9999',
            'idade0_6'         =>  'required|integer|between: 0, 99999',
            'idade7_14'         =>  'required|integer|between: 0, 99999',
            'idade15_17'         =>  'required|integer|between: 0, 99999',
            'idade18_29'         =>  'required|integer|between: 0, 99999',
            'idade30_59'         =>  'required|integer|between: 0, 99999',
            'idade60ouMais'         =>  'required|integer|between: 0, 99999',
            'naoInformadoIdade'         =>  'required|integer|between: 0, 99999',
            'amarela'         =>  'required|integer|between: 0, 99999',
            'branca'         =>  'required|integer|between: 0, 99999',
            'indigena'         =>  'required|integer|between: 0, 99999',
            'parda'         =>  'required|integer|between: 0, 99999',
            'preta'         =>  'required|integer|between: 0, 99999',
            'naoInformadoCor'         =>  'required|integer|between: 0, 99999',
            'feminino'         =>  'required|integer|between: 0, 99999',
            'masculino'         =>  'required|integer|between: 0, 99999',
            'naoInformadoSexo'         =>  'required|integer|between: 0, 99999',
            'visual'         =>  'required|integer|between: 0, 99999',
            'auditiva'         =>  'required|integer|between: 0, 99999',
            'motora'         =>  'required|integer|between: 0, 99999',
            'mental'         =>  'required|integer|between: 0, 99999',
            'total'         =>  'required|integer|between: 0, 99999'
        ]);

        $user =  Auth::user();

        $data = $request->data;
        $dt = explode('/', $data);
        $data = $dt[1].'-'.$dt[0].'-01';

        $user->frequenciasPortarias()->create([
            'data' => $data,
            'quantidade' => $request->total,
            'equipamento_id' => $id
        ])->complementoPortaria()->create([
            'idades_id' => $request->idade,
            'sexos_id'  => $request->sexo,
            'etnias_id' => $request->etnia,
            'escolaridades_id' => $request->escolaridade,
            'deficiencias_id' => $request->deficiencia
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
        $equipamentos = Equipamento::where('publicado', '=', '1')->orderBy('nome')->get();
        return view('frequencia.frequencia.portaria.index', compact('equipamentos', 'type'));
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
        return view('frequencia.frequencia.portaria.listar', compact('equipamento'));
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
