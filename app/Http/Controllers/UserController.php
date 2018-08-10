<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;

use Simbi\Models\Equipamento;
use Simbi\Models\Escolaridade;
use Simbi\Models\Secretaria;
use Simbi\Models\SubordinacaoAdministrativa;
use Simbi\Models\User;
use Simbi\Models\PerguntaSeguranca;
use Simbi\Models\Frequencia;
use Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

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
        $users = User::where('publicado', '=', $type)->orderBy('name')->paginate(10);
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
        $roles = Role::get();
        $secretarias = Secretaria::all();
        $subordinacoesAdministrativas = SubordinacaoAdministrativa::all();
        $escolaridades = Escolaridade::all();
        return view('usuarios.cadastro', compact(
            'roles',
            'secretarias',
            'subordinacoesAdministrativas',
            'escolaridades'
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
            'cargo' => 'required',
            'funcao' => 'required',
            'subordinacaoAdministrativa' => 'required',
            'identificacaoSecretaria' => 'required',
            'escolaridade' => 'required',
            'aposentadoria' => 'required'
        ]);


        $user = new User();
        
        $user->name = $request->name;
        $user->login = $request->login;
        $user->email = $request->email;
        $user->password = 'simbi@2018';
        $user->cargo_id = $request->cargo;
        $user->funcao_id = $request->funcao;
        $user->escolaridade_id = $request->escolaridade;
        $user->previsao_aposentadoria = $request->aposentadoria;
        $user->secretaria_id = $request->identificacaoSecretaria;
        $user->subordinacao_administrativa_id = $request->subordinacaoAdministrativa;

        $user->save();

        $roles = $request['roles'];

        if (isset($roles))
        {
             $role_r = Role::where('id', '=', $roles)->firstorFail();
                $user->assignRole($role_r);
        }

        return redirect()->back()->with('flash_message',
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
        $secretarias = Secretaria::all();
        $subordinacoesAdministrativas = SubordinacaoAdministrativa::all();
        $escolaridades = Escolaridade::all();

        return view('usuarios.editar', compact(
            'user',
            'roles',
            'perguntas',
            'secretarias',
            'subordinacoesAdministrativas',
            'escolaridades'
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
        
        if ($request->filled('password'))
        {
            $data = $this->validate($request, [
                    'name'=>'required',
                    'email'=>'required|email|unique:users,email,'.$id,
                    'password'=>'required|min:6|confirmed',
                    'perguntaSeguranca'=>'required',
                    // 'respostaSeguranca'=>'required'
            ]);
            $input = $request->only($data);

            $user->update([
                    'name'=> $request->name,
                    'login'=> $request->login,
                    'email'=> $request->email,
                    'password'=> $request->password,
                    'pergunta_seguranca_id'=> $request->perguntaSeguranca,
                    'resposta_seguranca'=> $request->respostaSeguranca,
            ]);
        }
        else
        {
            $data = $this->validate($request, [
                    'name'=>'required',
                    'email'=>'required|email|unique:users,email,'.$id,
                    'perguntaSeguranca'=>'required',
                    // 'respostaSeguranca'=>'required'
            ]);
            $input = $request->only($data);

            $user->update([
                    'name'=> $request->name,
                    'login'=> $request->login,
                    'email'=> $request->email,
                    'pergunta_seguranca_id'=> $request->perguntaSeguranca,
                    'resposta_seguranca'=> $request->respostaSeguranca,
                ]);
        }

        $roles = $request['roles'];
        // $user->fill($input)->save();

        if ($roles != 0)
        {
            $user->roles()->sync($roles);
        }
        else
        {
            $user->roles()->detach();
        }

        return redirect()->back()
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
             'Usuário Excluido com Sucesso.');
    }

    public function resetSenha($id)
    {
        $user = User::findOrFail($id);

        $user->update(['password' => 'simbi@2018']);
        return redirect()->back()->with('flash_message', 'Senha Resetada! Senha padrão: simbi@2018');
    }

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

    public function vinculaEquipamento(Request $request, $id)
    {
        /** @var User $usuario */
        $usuario = User::findOrFail($id);
        $equipamentos = $request['equipamento'];

        if ($equipamentos != 0)
        {
            $usuario->equipamentos()->sync($equipamentos);
        }
        else
        {
            $usuario->equipamentos()->detach();
        }

        return redirect()->route('usuarios.index', ['type' => $request->type])
            ->with('flash_message',
                'Equipamentos Vinculados com sucesso.');
    }
}
