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
        return view('gerencial.pessoas.index', compact('users', 'equipamentos','type'));
    }

    // Filtro de Usuários Ativados
    public function searchUser(Request $request, User $user)
    {
        $dataForm = $request->except('_token');

        $type = $request->types;

        $users = $user->search($dataForm)->orderBy('name')->paginate(10);

        $equipamentos = Equipamento::all();

        return view('gerencial.pessoas.index', compact('users', 'equipamentos','dataForm', 'type'));

    }

    public function edit($id)
    {
        $user = Funcionario::findOrFail($id);
        $roles = Role::get();
        $perguntas = PerguntaSeguranca::all();
        $secretarias = Secretaria::orderBy('descricao')->get();
        $subordinacoesAdministrativas = SubordinacaoAdministrativa::orderBy('descricao')->get();
        $cargos = Cargo::orderBy('cargo')->get();
        $funcoes = Funcao::orderBy('funcao')->get();
        $escolaridades = Escolaridade::all();

        return view('gerencial.pessoas.editar', compact(
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

    public function destroy(Request $types)
    {
        $type = $types->type;

        Funcionario::findOrFail($types->id)
            ->update(['publicado' => 0]);
        User::where('funcionario_id','=',$types->id)
            ->update(array('publicado'=> 0));

        return redirect()->route('gerencial.pessoas.index',['type'=>$type])->with('flash_message','Funcionário Desativado com Sucesso.');

    }

    public function ativar(Request $request){
            $type = $request->type;
            Funcionario::findOrFail($request->id)
                ->update(['publicado' => 1]);

            return redirect()->route('gerencial.pessoas.index',['type'=>$type])->with('flash_message','Funcionário Ativado com Sucesso.');
    }

    public function store(Request $request){
        $this->validate($request, [
            'nome'  =>'required',
            'email' =>'required|email|unique:funcionarios',
            'subordinacaoAdministrativa' => 'required',
            'identificacaoSecretaria' => 'required',
            'cargo' => 'required',
            'funcao' => 'required',
            'escolaridade' => 'required'
        ]);

        $user = new Funcionario();

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

        $user->nome = $request->input('nome');
        $user->email = $request->input('email');
        $user->cargo_id = $cargo->id;
        $user->funcao_id = $funcao->id;
        $user->secretaria_id = $secretaria->id;
        $user->subordinacao_administrativa_id = $subAdm->id;
        $user->escolaridade_id = $request->escolaridade;

        if($user->save()){
            return redirect()->route('gerencial.pessoas.index',['type'=>1])->with('flash_message','Funcionário Cadastrado com Sucesso.');
        }
        return view('gerencial.pessoas.cadastro',compact('request'))->with('flash_message','Erro ao cadastrar funcionario');

    }

    public function create()
    {
        $secretarias = Secretaria::orderBy('descricao')->get();
        $subordinacoesAdministrativas = SubordinacaoAdministrativa::orderBy('descricao')->get();
        $escolaridades = Escolaridade::all();
        $cargos = Cargo::orderBy('cargo')->get();
        $funcoes = Funcao::orderBy('funcao')->get();

        return view('gerencial.pessoas.cadastro', compact(
            'secretarias',
            'subordinacoesAdministrativas',
            'escolaridades',
            'cargos',
            'funcoes'
        ));

    }

    public function update(Request $request, $id){

        $funcionario = Funcionario::findOrFail($id);

        $this->validate($request, [
            'name'  =>'required',
            'email' =>'required|email',
            'subordinacaoAdministrativa' => 'required',
            'identificacaoSecretaria' => 'required',
            'cargo' => 'required',
            'funcao' => 'required',
            'escolaridade' => 'required'
        ]);



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

        $funcionario->nome = $request->input('name');
        $funcionario->email = $request->input('email');
        $funcionario->cargo_id = $cargo->id;
        $funcionario->funcao_id = $funcao->id;
        $funcionario->secretaria_id = $secretaria->id;
        $funcionario->subordinacao_administrativa_id = $subAdm->id;
        $funcionario->escolaridade_id = $request->escolaridade;


        if($funcionario->save()){
            return redirect()->route('gerencial.pessoas.index', ['type' => '1'])
                ->with('flash_message',
                    'Funcionario Editado com Sucesso!');
        }

    }
}
