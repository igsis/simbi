<?php

namespace Simbi\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Session;
use Simbi\Models\Cargo;
use Simbi\Models\Equipamento;
use Simbi\Models\Escolaridade;
use Simbi\Models\Funcao;
use Simbi\Models\Funcionamento;
use Simbi\Models\NivelAcesso;
use Simbi\Models\PerguntaSeguranca;
use Simbi\Models\ResponsabilidadeTipo;
use Simbi\Models\Secretaria;
use Simbi\Models\SubordinacaoAdministrativa;
use Simbi\Models\Funcionario;
use Simbi\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware(['isCoord'])->except(['perguntaSeguranca', 'updatePergunta']);
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $types)
    {

        $type = $types->type;
        $users = [];
        $funcionarios = Funcionario::where('publicado',2)->get();
        foreach ($funcionarios as $funcionario){
            foreach ($funcionario->users()->where('publicado',1)->get() as $user){
                array_push($users,$user);
            }
        }

        $equipamentos = Equipamento::orderBy('nome')->get();
        return view('usuarios.index', compact('users', 'equipamentos','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $funcionario = Funcionario::FindOrFail($request->id);

        $roles = Role::all();

        $nivelAcessos = NivelAcesso::all();
        return view('usuarios.cadastro', compact(
            'roles',
            'nivelAcessos',
            'funcionario'
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
            'login' =>'required|max:7|unique:users',
            'nivelAcessos'=> 'required'
        ]);

        $user = new User();

        $user->login = $request->input('login');
        $user->password = 'simbi@2019';
        $user->funcionario_id = $request->input('id_funcionario');
        $user->nivel_acesso_id = $request->input('nivelAcessos');

        if ($user->save()) {

            Funcionario::where('id','=',$request->id_funcionario)
                ->update(['publicado'=>2]);

            return redirect()->route('usuarios.index', ['type' => '1'])->with('flash_message',
                'Usuário Adicionado com Sucesso!  Senha padrão: simbi@2019');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('usuarios');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();
        $perguntas = PerguntaSeguranca::all();
        $secretarias = Secretaria::orderBy('descricao')->get();
        $subordinacoesAdministrativas = SubordinacaoAdministrativa::orderBy('descricao')->get();
        $cargos = Cargo::orderBy('cargo')->get();
        $funcoes = Funcao::orderBy('funcao')->get();
        $escolaridades = Escolaridade::all();



        return view('usuarios.editar', compact(
            'user',
            'roles',
            'perguntas',
            'secretarias',
            'subordinacoesAdministrativas',
            'escolaridades',
            'cargos',
            'funcoes'
        ));
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
        $user = User::findOrFail($id);
        $funcionario = Funcionario::findOrFail($user->funcionario_id);

        if ($request->filled('password'))
        {
            $this->validate($request, [
                'email'=>'required|email|unique:funcionarios,email',
                'password'=>'required|min:6|confirmed',
                'perguntaSeguranca'=>'required',
                'respostaSeguranca'=>'required'
            ]);

            $funcionario->update([
                'nome'=>$request->name,
                'email'=> $request->email,
            ]);

            $user->update([
                'login'=> $request->login,
                'password'=> $request->password,
                'pergunta_seguranca_id'=> $request->perguntaSeguranca,
                'resposta_seguranca'=> $request->respostaSeguranca,
            ]);
        }
        else
        {
            $this->validate($request, [
                'email'=>'required|email|unique:funcionarios,email',
            ]);

            $funcionario->update([
                'nome'=>$request->name,
                'email'=> $request->email,
            ]);

            $user->update([
                'login'=> $request->login,
                'pergunta_seguranca_id'=> $request->perguntaSeguranca,
                'resposta_seguranca'=> $request->respostaSeguranca,
            ]);
        }


        return redirect()->route('usuarios.index', ['type' => '1'])
            ->with('flash_message',
             'Usuário Editado com Sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $types)
    {
        $type = $types->type;

        User::findOrFail($id)
            ->update(['publicado' => 0]);

        return redirect()->route('usuarios.index', ['type' => $type])
            ->with('flash_message',
             'Usuário Desativado com Sucesso.');
    }

    /**
     * Reseta senha do usuario para a senha padrão
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetSenha($id)
    {
        $user = User::findOrFail($id);

        $user->update(['password' => 'simbi@2018']);
        return redirect()->route('usuarios.index', [
            'type' => 1
        ])->with('flash_message', 'Senha Resetada! Senha padrão: simbi@2018');
    }

    /**
     * Atualiza o registro do usuario para 'publicodo = 1'
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ativarUser(Request $request)
    {
        User::findOrFail($request->id)
            ->update(['publicado' => 1]);

        return redirect()->route('usuarios.index', ['type' => $request->type])
            ->with('flash_message',
             'Usuário Ativado com Sucesso.');
    }


    // Pergunta de seguranca para primeiro acesso
    public function perguntaSeguranca()
    {
        $perguntas = PerguntaSeguranca::all();
        return view('auth.pergunta_resposta', compact('perguntas'));
    }

    public function updatePergunta(Request $request)
    {
        $user = auth()->user();

        $this->validate($request, ([
            'perguntaSeguranca'=>'required',
            'respostaSeguranca'=>'required'
        ]));

        $user->update([
            'pergunta_seguranca_id' => $request->perguntaSeguranca,
            'resposta_seguranca' => $request->respostaSeguranca
        ]);

        return redirect('home');
    }

    // Filtro de Usuários Ativados
    public function searchUser(Request $request, User $user)
    {
        $dataForm = $request->except('_token');

        $type = $request->types;

        $users = $user->search($dataForm)->orderBy('name')->paginate(10);

        $equipamentos = Equipamento::all();

        return view('usuarios.index', compact('users', 'equipamentos','dataForm', 'type'));

    }

    public function exibeVincular($id)
    {
        $user = User::findOrFail($id);
        $equipamentos = Equipamento::all();
        $cargos = ResponsabilidadeTipo::all();

        return view('usuarios.vincular', compact('user', 'equipamentos', 'cargos'));
    }

    public function vinculaEquipamento(Request $request, $id)
    {
        /** @var User $usuario */
        $usuario = User::findOrFail($id);
        $equipamentos = $request['equipamento'];

        $this->validate($request, [
            'dataInicio'            =>  'required_with:equipamento',
            'dataFim'               =>  'required_with:equipamento',
            'responsabilidadeTipo'  =>  'required_with:equipamento'
        ]);

        $syncData = [];

        if ($equipamentos != 0)
        {

            foreach ($equipamentos as $id)
            {
                $pivotData = [
                    'data_inicio'               =>  $request->dataInicio,
                    'data_fim'                  =>  $request->dataFim,
                    'responsabilidade_tipo_id'  =>  $request->responsabilidadeTipo
                ];
                $syncData[$id] = $pivotData;
            }
        }

        $usuario->equipamentos()->sync($syncData);

        return redirect()->route('usuarios.index', ['type' => 1])
            ->with('flash_message',
                'Equipamentos Vinculados com sucesso.');
    }
}
