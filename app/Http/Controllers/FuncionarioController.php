<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Simbi\Http\Controllers\Controller;
use Simbi\Models\Equipamento;
use Simbi\Models\Funcionario;
use Simbi\Models\User;
use Session;
use Auth;

use Simbi\Models\Cargo;
use Simbi\Models\Escolaridade;
use Simbi\Models\Funcao;
use Simbi\Models\PerguntaSeguranca;
use Simbi\Models\ResponsabilidadeTipo;
use Simbi\Models\Secretaria;
use Simbi\Models\SubordinacaoAdministrativa;
use Spatie\Permission\Models\Role;


class FuncionarioController extends Controller
{
    public function index(Request $types)
    {
        $type = $types->type;
        if ($type == 1){
            $users = Funcionario::where('publicado', '=' ,$type)
                ->orWhere('publicado', '=' , 2)
                ->orderBy('id')->get();
        }else{
            $users = Funcionario::where('publicado', '=' ,$type)
                ->orderBy('id')->get();
        }

        $equipamentos = Equipamento::all();
        return view('funcionarios.index', compact('users', 'equipamentos','type'));
    }

    // Filtro de Usuários Ativados
    public function searchUser(Request $request, User $user)
    {
        $dataForm = $request->except('_token');

        $type = $request->types;

        $users = $user->search($dataForm)->orderBy('name')->paginate(10);

        $equipamentos = Equipamento::all();

        return view('funcionarios.index', compact('users', 'equipamentos','dataForm', 'type'));

    }

    public function edit($id)
    {

    }

    public function destroy(Request $types)
    {
        $type = $types->type;

        Funcionario::findOrFail($types->id)
            ->update(['publicado' => 0]);
        User::where('funcionario_id','=',$types->id)
            ->update(array('publicado'=> 0));

        return redirect()->route('funcionarios.index',['type'=>$type])->with('flash_message','Funcionário Desativado com Sucesso.');

    }

    public function ativar(Request $request){
            $type = $request->type;
            Funcionario::findOrFail($request->id)
                ->update(['publicado' => 1]);

            return redirect()->route('funcionarios.index',['type'=>$type])->with('flash_message','Funcionário Ativado com Sucesso.');
    }

    public function store(Request $request){
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
        $user->password = 'simbi@2019';
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
    }
}
