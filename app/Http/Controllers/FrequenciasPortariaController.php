<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Models\ComplementoPortaria;
use Simbi\Models\Deficiencia;
use Simbi\Models\Equipamento;
use Auth;
use Simbi\Models\Escolaridade;
use Simbi\Models\EscolaridadeComplementos;
use Simbi\Models\Etnia;
use Simbi\Models\FrequenciasPortaria;
use Simbi\Models\Idade;
use Simbi\Models\Sexo;
use Simbi\Http\Requests\SecaoBraile\ValidateStore;
use Simbi\Models\{SecaoBraile, Telecentro, Tematica, Oculos};
use Simbi\Service\Helper;


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

        $data = $request->data;
        $dt = explode('/', $data);
        $data = $dt[2].'-'.$dt[1].'-'.$dt[0];

        $dataFormatada = strtotime($data);
        $dia = date("w", $dataFormatada);
        if ($dia == 0)// domingo
            $periodo = 3;
        elseif ($dia == 6)//sabado
            $periodo = 2;
        else
            $periodo = 1;

        $user->frequenciasPortarias()->create([
            'data' => $data,
            'periodo'=> $periodo,
            'quantidade' => $request->quantidade,
            'equipamento_id' => $request->id,
            'data_envio' => date("Y-m-d")
        ]);

        return redirect()->route('frequencias.enviadas',['type'=>'1'])->with('flash_message',
            'Público de recepção inserida com sucesso!');
    }

    public function storeSecaoBraile(ValidateStore $req)
    :object{
      
      $dados = $req->all();
      
      $dados['periodo'] = 
      (new Helper())->splitPeriod($req->data); 

      $dados['data'] = 
      (new Helper())->setDatePtBR($req->data);

      $dados['data_envio'] = date("Y-m-d");
      
      $insert = (new SecaoBraile())->insert($dados);

      if($insert)
        return redirect()
        ->route('frequencias.enviadas',['type'=>'1'])
        ->with('flash_message',
        'Seção Braile inserida com sucesso!');

     return redirect()
        ->route('frequencias.enviadas',['type'=>'1'])
        ->with('flash_message',
        'Seção Braile não foi cadastrada!');          
    }

    public function storeTelecentro(ValidateStore $req)
    :object{

      $dados = $req->all();
      
      $dados['periodo'] = 
      (new Helper())->splitPeriod($req->data);

      $dados['data'] = 
      (new Helper())->setDatePtBR($req->data);

      $dados['data_envio'] = date("Y-m-d");

        $insert = (new Telecentro())->insert($dados);

      if($insert)
        return redirect()
        ->route('frequencias.enviadas',['type'=>'1'])
        ->with('flash_message',
        'Telecentro inserida Com sucesso!');

     return redirect()
        ->route('frequencias.enviadas',['type'=>'1'])
        ->with('flash_message',
        'Telecentro não foi cadastrada!');         
    }

    public function storeTematica(ValidateStore $req)
    :object {

      $dados = $req->all();

      $dados['periodo'] = 
      (new Helper())->splitPeriod($req->data); 

      $dados['data'] = 
      (new Helper())->setDatePtBR($req->data);

       $dados['data_envio'] = date("Y-m-d");

        $insert = (new Tematica())->insert($dados);

      if($insert)
        return redirect()
        ->route('frequencias.enviadas',['type'=>'1'])
        ->with('flash_message',
        'Temática inserida Com sucesso!');

     return redirect()
        ->route('frequencias.enviadas',['type'=>'1'])
        ->with('flash_message',
        'Temática não foi cadastrada!');         
    }

    public function storeOculos(ValidateStore $req)
    :object{

      $dados = $req->all();

      $dados['periodo'] = 
      (new Helper())->splitPeriod($req->data);    

      $dados['data'] = 
      (new Helper())->setDatePtBR($req->data);

      $dados['data_envio'] = date("Y-m-d");

        $insert = (new Oculos())->insert($dados);

      if($insert)
        return redirect()
        ->route('frequencias.enviadas',['type'=>'1'])
        ->with('flash_message',
        'Óculos inserida com sucesso!');

     return redirect()
        ->route('frequencias.enviadas',['type'=>'1'])
        ->with('flash_message',
        'Óculos não foi cadastrada!');         
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
        $data = $dt[2].'-'.$dt[1].'-'.$dt[0];

        $dataFormatada = strtotime($data);
        $dia = date("w", $dataFormatada);
        if ($dia == 0)// domingo
            $periodo = 3;
        elseif ($dia == 6)//sabado
            $periodo = 2;
        else
            $periodo = 1;

        $frequenciaPortaria = new FrequenciasPortaria();
        $complementoPortaria = new ComplementoPortaria();
        $idades = new Idade();
        $etinias = new Etnia();
        $deficiencias = new Deficiencia();
        $sexos = new Sexo();
        $escolaridades = new EscolaridadeComplementos();

        $frequenciaPortaria->user_id = $user->id;
        $frequenciaPortaria->data = $data;
        $frequenciaPortaria->periodo = $periodo;
        $frequenciaPortaria->quantidade = $request->total;
        $frequenciaPortaria->equipamento_id = $id;
        $frequenciaPortaria->data_envio = date("Y-m-d");
        $frequenciaPortaria->save();

        $idades->anos0_6 = $request->idade0_6;
        $idades->anos7_14 = $request->idade7_14;
        $idades->anos15_17 = $request->idade15_17;
        $idades->anos18_29 = $request->idade18_29;
        $idades->anos30_59 = $request->idade30_59;
        $idades->mais60anos = $request->idade60ouMais;
        $idades->semInformacao = $request->naoInformadoIdade;
        $idades->save();

        $sexos->masculino = $request->masculino;
        $sexos->feminino = $request->feminino;
        $sexos->semInformacao = $request->naoInformadoSexo;
        $sexos->save();

        $etinias->amarela = $request->amarela;
        $etinias->branca = $request->branca;
        $etinias->indigena = $request->indigena;
        $etinias->parda = $request->parda;
        $etinias->preta = $request->preta;
        $etinias->semInformacao = $request->naoInformadoCor;
        $etinias->save();

        $deficiencias->visual = $request->visual;
        $deficiencias->auditiva = $request->auditiva;
        $deficiencias->motora = $request->motora;
        $deficiencias->mental = $request->mental;
        $deficiencias->save();

        $escolaridades->fundamental = $request->fundamental;
        $escolaridades->medio = $request->medio;
        $escolaridades->superior = $request->superior;
        $escolaridades->semInformacao = $request->naoInformadoEscolaridade;
        $escolaridades->save();

        $complementoPortaria->frequencias_portaria_id = $frequenciaPortaria->id;
        $complementoPortaria->idades_id = $idades->id;
        $complementoPortaria->etnias_id = $etinias->id;
        $complementoPortaria->deficiencias_id = $deficiencias->id;
        $complementoPortaria->sexos_id = $sexos->id;
        $complementoPortaria->escolaridades_id = $escolaridades->id;
        $complementoPortaria->save();

        return redirect()->route('frequencias.enviadas',['type'=>'1'])->with('flash_message',
            'Frequência inserida com sucesso!');
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
    public function listarRecepcao($id)
    {
        $equipamento = Equipamento::findOrFail($id);
        return view('frequencia.frequencia.portaria.listar', compact('equipamento'));
    }

    public function updateRecepcao(Request $request){
        $this->validate($request, [
            'data' =>  'required',
            'quantidade' =>  'required|integer|between: 0, 9999'
        ]);

        $user =  Auth::user();

        $data = $request->data;
        $dt = explode('/', $data);
        $data = $dt[2].'-'.$dt[1].'-'.$dt[0];

        $dataFormatada = strtotime($data);
        $dia = date("w", $dataFormatada);
        if ($dia == 0)// domingo
            $periodo = 3;
        elseif ($dia == 6)//sabado
            $periodo = 2;
        else
            $periodo = 1;

        $idPublico = $request->idPublico;

        FrequenciasPortaria::where('id', $idPublico)
            ->update([
            'user_id' => $user->id,
            'data' => $data,
            'periodo'=> $periodo,
            'quantidade' => $request->quantidade,
            'equipamento_id' => $request->id,
            'data_envio' => date("Y-m-d")
        ]);

        return redirect()->back()->with('flash_message', 'Público de recepção editado com sucesso!');
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
