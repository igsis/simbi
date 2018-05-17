<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\Endereco;
use Simbi\Models\Macrorregiao;
use Simbi\Models\Regiao;
use Simbi\Models\Regional;
use Simbi\Models\Equipamento;

class EnderecoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $macrorregioes = Macrorregiao::orderBy('descricao')->get();
        $regioes = Regiao::orderBy('descricao')->get();
        $regionais = Regional::orderBy('descricao')->get();
        return view('endereco.cadastro', 
            compact(
                'macrorregioes',
                'regioes',
                'regionais'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $endereco = new Endereco;
        $this->validate($request, [
            'cep'=>'required',
            'logradouro'=>'required',
            'bairro'=>'required',
            'numero'=>'required',
            'complemento'=>'nullable',
            'cidade'=>'required',
            'uf'=>'max:2',
            'macrorregiao'=>'required',
            'regiao'=>'required',
            'regional'=>'required',
            'subprefeitura'=>'required',
            'distrito'=>'required'
        ]);
        $endereco->equipamento();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
