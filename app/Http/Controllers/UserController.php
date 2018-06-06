<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;

use Simbi\Models\Equipamento;
use Simbi\Models\User;
use Simbi\Models\PerguntaSeguranca;
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
        return view('usuarios.cadastro', ['roles'=>$roles]);
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
            'name'=>'required',
            'login'=>'required|max:7|unique:users',
            'email'=>'required|email|unique:users'
        ]);

        $user = new User();
        
        $user->name = $request->name;
        $user->login = $request->login;
        $user->email = $request->email;
        $user->password = 'simbi@2018';

        $user->save();

        $roles = $request['roles'];

        if (isset($roles))
        {
             $role_r = Role::where('id', '=', $roles)->firstorFail();
                $user->assignRole($role_r);
        }

        return redirect()->route('usuarios.index')->with('flash_message',
             'Usuario Adicionado com Sucesso!  Senha padrão: simbi@2018');
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

        return view('usuarios.editar', compact('user', 'roles', 'perguntas'));
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

        if($request->has('novaSenha'))
        {
            $user->update(['password' => 'simbi@2018']);
            return redirect()->route('usuarios.index')
            ->with('flash_message',
            'Senha Resetada! Senha padrão: simbi@2018');
        }
        
        if ($request->filled('password'))
        {
            $data = $this->validate($request, [
                    'name'=>'required',
                    'email'=>'required|email|unique:users,email,'.$id,
                    'password'=>'required|min:6|confirmed',
                    'perguntaSeguranca'=>'required',
                    'respostaSeguranca'=>'required'
            ]);
            $input = $request->only($data);
        }
        else
        {
            $data = $this->validate($request, [
                    'name'=>'required',
                    'email'=>'required|email|unique:users,email,'.$id,
                    'perguntaSeguranca'=>'required',
                    'respostaSeguranca'=>'required'
            ]);
            $input = $request->only($data);
        }

        $roles = $request['roles'];
        $user->fill($input)->save();

        if ($roles != 0)
        {
            $user->roles()->sync($roles);
        }
        else
        {
            $user->roles()->detach();
        }

        return redirect()->route('usuarios.index')
            ->with('flash_message',
             'Usuario Editado com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)
            ->update(['publicado' => 0]);

        return redirect()->route('usuarios.index')
            ->with('flash_message',
             'Usuario Excluido com Sucesso.');
    }

    public function active($id)
    {
        User::findOrFail($id)
            ->update(['publicado' => 1]);

        return redirect()->route('usuarios.desativados')
            ->with('flash_message',
             'Usuario Ativado com Sucesso.');
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

    // Filtro de Usuários Desativados
    public function userDisabled(Request $request, User $user)
    {
        $dataForm = $request->except('_token');

        $users = $user->searchUsersDisabled($dataForm)->orderBy('name')->paginate(10);

        $equipamentos = Equipamento::all();

        return view('usuarios.desativados', compact('users', 'equipamentos','dataForm'));

    }
    // Usuários Desativados
    public function disabled()
    {
        $users = User::where('publicado', '=', 0)->orderBy('name')->paginate(10);
        $equipamentos = Equipamento::all();
        return view('usuarios.desativados', compact('users', 'equipamentos'));
    }

    public function ativarUser(Request $login, User $users)
    {
        // $users->where('login', '=', $login);
        // $user->update(['publicado' => '1']);

        // dd($users->name);
        // return redirect()->route('usuarios.index')
        //             ->with('flash_message',
        //                 'Usuário ativado com Sucesso');
        
    }
}
