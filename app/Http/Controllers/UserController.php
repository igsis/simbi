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
        if ($type == 1){
            $users = User::where('publicado', '=' ,$type)
                ->orWhere('publicado', '=' , 2)
                ->orderBy('id')->get();
        }else{
            $users = User::where('publicado', '=' ,$type)
                ->orderBy('id')->get();
        }

        $equipamentos = Equipamento::orderBy('nome')->get();
        return view('gerencial.usuarios.index', compact('users', 'equipamentos','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $funcionario = Funcionario::FindOrFail($request->id);
        $RF = trim($funcionario->RF);
        $RF = str_replace(".", "", $RF);
        $RF = substr($RF,0,6);
        $login = 'd'.$RF;
        $roles = Role::all();

        $nivelAcessos = NivelAcesso::all();

        return view('gerencial.usuarios.cadastro', compact(
            'roles',
            'nivelAcessos',
            'funcionario',
            'login'
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
            'email' =>'required|email|unique:users',
            'nivelAcessos'=> 'required'
        ]);

        $user = new User();

        $user->login = $request->input('login');
        $user->email = $request->email;
        $user->password = 'simbi@2020';
        $user->funcionario_id = $request->input('id_funcionario');
        $user->nivel_acesso_id = $request->input('nivelAcessos');

        if ($user->save()) {

            Funcionario::where('id','=',$request->id_funcionario)
                ->update(['publicado'=>2]);

            return redirect()->route('usuarios.index', ['type' => '1'])->with('flash_message',
                'Usuário adicionado com sucesso! Senha padrão: simbi@2020');
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

        return view('gerencial.usuarios.editar', compact(
            'user',
            'roles',
            'perguntas',
            'secretarias',
            'subordinacoesAdministrativas',
            'cargos'
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
                'email'=>'required|email',
                'password'=>'required|min:6|confirmed',
                'perguntaSeguranca'=>'required',
                'respostaSeguranca'=>'required'
            ]);

            $user->update([
                'login'=> $request->login,
                'email'=> $request->email,
                'password'=> $request->password,
                'pergunta_seguranca_id'=> $request->perguntaSeguranca,
                'resposta_seguranca'=> $request->respostaSeguranca,
                'nivel_acesso_id' => $request->roles,
            ]);
        }
        else
        {
            $this->validate($request, [
                'email' => 'required|email|unique:users,email,'.$user->id,
            ]);

            $user->update([
                'login'=> $request->login,
                'email'=> $request->email,
                'pergunta_seguranca_id'=> $request->perguntaSeguranca,
                'resposta_seguranca'=> $request->respostaSeguranca,
                'nivel_acesso_id' => $request->roles,
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

        $user->update(['password' => 'simbi@2020']);
        return redirect()->route('usuarios.index', [
            'type' => 1
        ])->with('flash_message', 'Senha Resetada! Senha padrão: simbi@2020');
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

        return redirect()->route('funcionarios.index', ['type' => '1']);
    }

    // Filtro de Usuários Ativados
    public function searchUser(Request $request, User $user)
    {
        $dataForm = $request->except('_token');

        $type = $request->types;

        $users = $user->search($dataForm)->orderBy('name')->get();

        $equipamentos = Equipamento::all();

        return view('gerencial.usuarios.index', compact('users', 'equipamentos','dataForm', 'type'));

    }

}
