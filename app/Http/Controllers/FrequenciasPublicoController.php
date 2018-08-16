<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Compound;
use Simbi\Http\Controllers\Controller;
use Simbi\Models\Equipamento;
use Auth;

class FrequenciasPublicoController extends Controller
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
        return view('frequencia.publico.cadastro', compact('equipamento'));
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
            'hora'          =>  'required',
            'crianca'       =>  'required|integer|between: 0, 9999',
            'jovem'         =>  'required|integer|between: 0, 9999',
            'adulto'        =>  'required|integer|between: 0, 9999',
            'idoso'         =>  'required|integer|between: 0, 9999',
            'total'         =>  'required|integer|between: 0, 99999'
        ]);

        $user =  Auth::user();

        // dd($request->equipamento);

        $user->frequencias_publicos()->create([
            'data' => $request->data,
            'hora' => $request->hora,
            'crianca' => $request->crianca,
            'jovem' => $request->jovem,
            'adulto' => $request->adulto,
            'idoso' => $request->idoso,
            'total' => $request->total,
            'equipamento_id' => $id
        ]);

        return redirect()->route('frequencia.publico.index')->with('flash_message',
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
        return view('frequencia.publico.index', compact('equipamentos', 'type'));
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
        return view('frequencia.publico.listar', compact('equipamento'));
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
