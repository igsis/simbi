<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Compound;
use Simbi\Http\Controllers\Controller;
use Simbi\Models\Equipamento;
use Auth;

class FrequenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isFunc']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = 1;
        $equipamentos = Equipamento::where('publicado', '=', '1')->orderBy('nome')->paginate(10);
        return view('frequencia.index', compact('equipamentos', 'type'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $equipamento = Equipamento::findOrFail($id);
        return view('frequencia.cadastro', compact('equipamento'));
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
            'hora'          =>  'required'
        ]);

        $user =  Auth::user();

        // dd($request->equipamento);

        $user->frequencias()->create([
            'evento_id' => $request->evento,
            'data' => $request->data,
            'hora' => $request->hora,
            'crianca' => $request->crianca,
            'jovem' => $request->jovem,
            'adulto' => $request->adulto,
            'idoso' => $request->idoso,
            'total' => $request->total,
            'observacao' => $request->observacao,
            'user_id' => $user->id,
            'equipamento_id' => $id
        ]);

        return redirect()->route('frequencia.index')->with('flash_message',
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
        return view('frequencia.index', compact('equipamentos', 'type'));
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
        return view('frequencia.listar', compact('equipamento'));
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
