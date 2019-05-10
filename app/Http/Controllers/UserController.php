<?php

namespace Simbi\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Session;
use Simbi\Models\Cargo;
use Simbi\Models\Equipamento;
use Simbi\Models\Escolaridade;
use Simbi\Models\Funcao;
use Simbi\Models\PerguntaSeguranca;
use Simbi\Models\ResponsabilidadeTipo;
use Simbi\Models\Secretaria;
use Simbi\Models\SubordinacaoAdministrativa;
use Simbi\Models\Funcionario;
use Simbi\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['isCoord'])->except(['perguntaSeguranca', 'updatePergunta']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $types)
    {
        $type = $types->type;

        $users = User::where('publicado', '=', $type)->orWhere()->orderBy('id')->get();
        $equipamentos = Equipamento::all();
        return view('usuarios.index', compact('users', 'equipamentos','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $secretarias = Secretaria::orderBy('descricao')->get();
        $subordinacoesAdministrativas = SubordinacaoAdministrativa::orderBy('descricao')->get();
        $escolaridades = Escolaridade::all();
        $cargos = Cargo::orderBy('cargo')->get();
        $funcoes = Funcao::orderBy('funcao')->get();
        return view('usuarios.cadastro', compact(
            'roles',
            'secretarias',
            'subordinacoesAdministrativas',
            'escolaridades',
            'cargos',
            'funcoes'
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
            'name'  =>'required',
            'login' =>'required|max:7|unique:users',
            'email' =>'required|email|unique:users',
            'subordinacaoAdministrativa' => 'required',
            'identificacaoSecretaria' => 'required',
            'cargo' => 'required',
            'funcao' => 'required',
            'escolaridade' => 'required',
        ]);

        $user = new User();

        $cargo = Cargo::findOrNew($request->cargo);
        if (!($cargo->exists))
        {
            $cargo->cargo = $request->novoCargo;
            $cargo->save();
        }

        $funcao = Funcao::findOrNew($request->funcao);
        if (!($funcao->exists))
        {
            $funcao->funcao = $request->novaFuncao;
            $funcao->save();
        }

        $subAdm = SubordinacaoAdministrativa::findOrNew($request->subordinacaoAdministrativa);
        if (!($subAdm->exists))
        {
            $subAdm->descricao = $request->novaSubAdm;
            $subAdm->save();
        }

        $secretaria = Secretaria::findOrNew($request->identificacaoSecretaria);
        if (!($secretaria->exists))
        {
            $secretaria->sigla = $request->siglaSecretaria;
            $secretaria->descricao = $request->descricaoSecretaria;
            $secretaria->save();
        }

        $user->name = $request->name;
        $user->login = $request->login;
        $user->email = $request->email;
        $user->password = 'simbi@2018';
        $user->cargo_id = $cargo->id;
        $user->funcao_id = $funcao->id;
        $user->secretaria_id = $secretaria->id;
        $user->subordinacao_administrativa_id = $subAdm->id;
        $user->escolaridade_id = $request->escolaridade;

        $user->save();

        $roles = $request['roles'];

        if (isset($roles))
        {
             $role_r = Role::where('id', '=', $roles)->firstorFail();
                $user->assignRole($role_r);
        }

        return redirect()->route('usuarios.index', ['type' => '1'])->with('flash_message',
            'Usuário Adicionado com Sucesso!  Senha padrão: simbi@2018');
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
//        $funcionario =

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

        $cargo = Cargo::findOrNew($request->cargo);
        if (!($cargo->exists))
        {
            $cargo->cargo = $request->novoCargo;
            $cargo->save();
        }

        /** @var Funcao $funcao */
        $funcao = Funcao::findOrNew($request->funcao);
        if (!($funcao->exists))
        {
            $funcao->funcao = $request->novaFuncao;
            $funcao->save();
        }

        $subAdm = SubordinacaoAdministrativa::findOrNew($request->subordinacaoAdministrativa);
        if (!($subAdm->exists))
        {
            $subAdm->descricao = $request->novaSubAdm;
            $subAdm->save();
        }

        $secretaria = Secretaria::findOrNew($request->identificacaoSecretaria);
        if (!($secretaria->exists))
        {
            $secretaria->sigla = $request->siglaSecretaria;
            $secretaria->descricao = $request->descricaoSecretaria;
            $secretaria->save();
        }

        if ($request->filled('password'))
        {
            $this->validate($request, [
                'name'=>'required',
                'email'=>'required|email|unique:users,email,'.$id,
                'password'=>'required|min:6|confirmed',
                'subordinacaoAdministrativa'=>'required',
                'identificacaoSecretaria'=>'required',
                'cargo'=>'required',
                'funcao'=>'required',
                'perguntaSeguranca'=>'required',
                'respostaSeguranca'=>'required'
            ]);

            $user->update([
                'name'=> $request->name,
                'login'=> $request->login,
                'email'=> $request->email,
                'password'=> $request->password,
                'cargo_id' => $cargo->id,
                'funcao_id' => $funcao->id,
                'secretaria_id' => $secretaria->id,
                'subordinacao_administrativa_id' => $subAdm->id,
                'pergunta_seguranca_id'=> $request->perguntaSeguranca,
                'resposta_seguranca'=> $request->respostaSeguranca,
            ]);
        }
        else
        {
            $this->validate($request, [
                'name'=>'required',
                'email'=>'required|email|unique:users,email,'.$id,
                'subordinacaoAdministrativa'=>'required',
                'identificacaoSecretaria'=>'required',
                'cargo'=>'required',
                'funcao'=>'required',
            ]);

            $user->update([
                'name'=> $request->name,
                'login'=> $request->login,
                'email'=> $request->email,
                'cargo_id' => $cargo->id,
                'funcao_id' => $funcao->id,
                'secretaria_id' => $secretaria->id,
                'subordinacao_administrativa_id' => $subAdm->id,
                'escolaridade_id'=>$request->escolaridade
            ]);
        }

        $roles = $request['roles'];

        if ($roles != 0)
        {
            $user->roles()->sync($roles);
        }
        else
        {
            $user->roles()->detach();
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
