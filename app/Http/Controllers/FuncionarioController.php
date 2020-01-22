<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Simbi\Http\Controllers\Controller;
use Simbi\Models\Equipamento;
use Simbi\Models\EquipamentoFuncionario;
use Simbi\Models\Funcionario;
use Simbi\Models\FuncionarioAdicionais;
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

        $equipamentos = Equipamento::orderBy('nome')->get();
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

        return view('gerencial.pessoas.editar', compact(
            'user',
            'roles',
            'perguntas',
            'secretarias',
            'subordinacoesAdministrativas',
            'cargos'
        ));

    }

    public function destroy(Request $types)
    {
        $type = $types->type;

        Funcionario::findOrFail($types->id)
            ->update(['publicado' => 0]);
        User::where('funcionario_id','=',$types->id)
            ->update(array('publicado'=> 0));

        return redirect()->route('funcionarios.index',['type'=>$type])->with('flash_message','Desativado com Sucesso.');

    }

    public function ativar(Request $request)
    {
            $type = $request->type;
            Funcionario::findOrFail($request->id)
                ->update(['publicado' => 1]);
            return redirect()->route('funcionarios.index',['type'=>$type])->with('flash_message',' Ativado com Sucesso.');
    }

    public function store(Request $request){

        $this->validate($request, [
            'nome'  =>'required',
            'RF' => 'required|unique:funcionarios',
            'vinculo' => 'required',
            'subordinacaoAdministrativa' => 'required', //lotacao
            'cargo' => 'required'
        ]);

        $user = new Funcionario();

        $cargo = Cargo::findOrNew($request->cargo);
        if (!($cargo->exists))
        {
            $cargo->cargo = $request->novoCargo;
            $cargo->save();
        }

        $subAdm = SubordinacaoAdministrativa::findOrNew($request->subordinacaoAdministrativa);
        if (!($subAdm->exists))
            {
            $subAdm->descricao = $request->novaSubAdm;
            $subAdm->save();
        }

        $tipoPessoa = $request->tipoPessoa;
        $aposenta = $request->aposenta;
        $observacao = $request->observacao;

        if ($tipoPessoa == 1 && (isset($aposenta) || isset($observacao))) //Dados adicionais de tipoPessoa Funcionario
        {
            $adicionais = new FuncionarioAdicionais();
            if(isset($aposenta))
            {
                $this->validate($request, ['dataAposentadoria' => 'required']);
                $data = $request->dataAposentadoria;
                $dtFormat = explode('/', $data);
                $data = $dtFormat[2].'-'.$dtFormat[1].'-'.$dtFormat[0];

                $adicionais->aposenta = 1;
                $adicionais->data_aposentadoria = $data;
            }
            $adicionais->observacao = $observacao;
            $user->secretaria_id = 1;
        }
        elseif  ($tipoPessoa == 2) //tipoPessoa Convocado
        {
            $this->validate($request, ['identificacaoSecretaria' => 'required']);
            $secretaria = Secretaria::findOrNew($request->identificacaoSecretaria);
            if (!($secretaria->exists))
            {
                $secretaria->sigla = $request->siglaSecretaria;
                $secretaria->descricao = $request->descricaoSecretaria;
                $secretaria->save();
            }
            $user->secretaria_id = $secretaria->id;
        }

        $user->nome = $request->input('nome');
        $user->RF = $request->RF;
        $user->vinculo = $request->vinculo;
        $user->tipo_pessoa = $tipoPessoa;
        $user->cargo_id = $cargo->id;
        $user->subordinacao_administrativa_id = $subAdm->id;

        if($user->save()){
            if(isset($adicionais)) {
                $adicionais->funcionario_id = $user->id;
                $adicionais->save();
            }
            return redirect()->route('pessoas.exibeVincular', $user->id)->with('flash_message','Pessoa Cadastrado com Sucesso.');
        }
        return view('gerencial.pessoas.cadastro',compact('request'))->with('flash_message','Erro ao cadastrar funcionario');

    }

    public function create()
    {
        $secretarias = Secretaria::orderBy('descricao')->get();
        $subordinacoesAdministrativas = SubordinacaoAdministrativa::orderBy('descricao')->get();
        $cargos = Cargo::orderBy('cargo')->get();

        return view('gerencial.pessoas.cadastro', compact(
            'secretarias',
            'subordinacoesAdministrativas',
            'cargos'
        ));

    }

    public function update(Request $request, $id){

        $funcionario = Funcionario::findOrFail($id);

        $this->validate($request, [
            'nome'  =>'required',
            'RF' => 'required|unique:funcionarios,RF,'.$funcionario->id,
            'vinculo' => 'required',
            'subordinacaoAdministrativa' => 'required',
            'cargo' => 'required'
        ]);



        $cargo = Cargo::findOrNew($request->cargo);
        if (!($cargo->exists))
        {
            $cargo->cargo = $request->novoCargo;
            $cargo->save();
        }


        $subAdm = SubordinacaoAdministrativa::findOrNew($request->subordinacaoAdministrativa);
        if (!($subAdm->exists))
        {
            $subAdm->descricao = $request->novaSubAdm;
            $subAdm->save();
        }


        $tipoPessoa = $funcionario->tipo_pessoa;
        $aposenta = $request->aposenta;
        $observacao = $request->observacao;


        if ($tipoPessoa == 1 && (isset($aposenta) || isset($observacao))) //Dados adicionais de tipoPessoa Funcionario
        {
            $adicionais = FuncionarioAdicionais::updateOrCreate(['funcionario_id' => $funcionario->id]);

            if(isset($aposenta))
            {
                $this->validate($request, ['dataAposentadoria' => 'required']);
                $data = $request->dataAposentadoria;
                $dtFormat = explode('/', $data);
                $data = $dtFormat[2].'-'.$dtFormat[1].'-'.$dtFormat[0];

                $adicionais->aposenta = 1;
                $adicionais->data_aposentadoria = $data;
            }
            $adicionais->observacao = $observacao;

            $funcionario->secretaria_id = 1;
        }
        elseif  ($tipoPessoa == 2) //tipoPessoa Convocado
        {
            $this->validate($request, ['identificacaoSecretaria' => 'required']);
            $secretaria = Secretaria::findOrNew($request->identificacaoSecretaria);
            if (!($secretaria->exists))
            {
                $secretaria->sigla = $request->siglaSecretaria;
                $secretaria->descricao = $request->descricaoSecretaria;
                $secretaria->save();
            }
            $funcionario->secretaria_id = $secretaria->id;
        }
        else
        {
            $funcionario->FuncionarioAdicionais->delete();
        }

        $funcionario->nome = $request->input('nome');
        $funcionario->RF = $request->RF;
        $funcionario->cargo_id = $cargo->id;
        $funcionario->subordinacao_administrativa_id = $subAdm->id;

        if(isset($adicionais)) {
            $adicionais->funcionario_id = $funcionario->id;
            $adicionais->save();
        }
        if($funcionario->save()){
            return redirect()->route('funcionarios.index', ['type' => '1'])
                ->with('flash_message',
                    'Pessoa Editada com Sucesso!');
        }
    }

    public function exibeVincular($id)
    {
        $user = Funcionario::findOrFail($id);
        $equipamentos = Equipamento::all();
        $cargos = ResponsabilidadeTipo::all();


        return view('gerencial.pessoas.vincular', compact('user','equipamentos', 'cargos'));
    }

    public function vinculaEquipamento(Request $request, $id)
    {
        /** @var User $usuario */
        $usuario = Funcionario::findOrFail($id);
        $equipamentos = $request['equipamento'];
        $cargos = $request['responsabilidadeTipo'];

        $this->validate($request, [
            'responsabilidadeTipo'  =>  'required_with:equipamento'
        ]);

        $syncData = [];

        if ($equipamentos != 0)
        {
            foreach (array_combine($equipamentos, $cargos) as $id => $cargo)
            {
                if($id != "" || $cargo != ""){
                    $pivotData = [
                        'responsabilidade_tipo_id'  =>  $cargo
                    ];
                    $syncData[$id] = $pivotData;
                }
            }
        }

        $usuario->equipamentos()->sync($syncData);

        return redirect()->route('funcionarios.index', ['type' => 1])
            ->with('flash_message',
                'Equipamentos Vinculados com sucesso.');
    }
}
