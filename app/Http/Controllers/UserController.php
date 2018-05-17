<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;

use Simbi\Models\User;
use Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isCoord']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('publicado', '=', 1)->orderBy('name')->paginate(10);
        return view('usuarios.index')->with('users', $users);
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
            'email'=>'required|email|unique:users',
        ]);

        $user = new User();
        
        $user->name = $request->name;
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

        return view('usuarios.editar', compact('user', 'roles'));
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
            $user->password = 'simbi@2018';
            $user->save();
            return redirect()->route('usuarios.index')
            ->with('flash_message',
            'Senha Resetada! Senha padrão: simbi@2018');
        }
        
        if ($request->filled('password'))
        {
            $this->validate($request, [
                'name'=>'required',
                'email'=>'required|email|unique:users,email,'.$id,
                'password'=>'required|min:6|confirmed'
            ]);
            $input = $request->only(['name', 'email', 'password']);
        }
        else
        {
            $this->validate($request, [
                'name'=>'required',
                'email'=>'required|email|unique:users,email,'.$id,
            ]);
            $input = $request->only(['name', 'email']);
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
        $user = User::findOrFail($id);
        $user->publicado = 0;
        $user->save();

        return redirect()->route('usuarios.index')
            ->with('flash_message',
             'Usuario Excluido com Sucesso.');
    }
}
