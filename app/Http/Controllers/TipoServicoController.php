<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;

use Simbi\Models\TipoServico;

class TipoServicoController extends Controller
{
    public function index()
    {
    	$tipoServicos = TipoServico::where('publicado', '=', '1')->orderBy('descricao')->paginate(10);
    	
    	return view('gerenciar.tipoServico.index', compact('tipoServicos'));

    }

    public function disabled()
    {
    	$tipoServicos = TipoServico::where('publicado', '=', '0')->orderBy('descricao')->paginate(10);
    	
    	return view('gerenciar.tipoServico.disabled', compact('tipoServicos'));

    }

    public function create(Request $request)
    {
        $data = $this->validate($request, [
            'descricao'=>'required|unique:tipo_servicos'
        ]);

        TipoServico::create($data);

        return redirect()->route('tipoServico')
            ->with('flash_message', 'Tipo de serviço Inserido com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $tipoServico = TipoServico::findOrFail($id);

        $this->validate($request, [
            'descricao'=>'required|unique:tipo_servicos'
        ]);

        $tipoServico->update([
            'descricao' => $request->descricao
        ]);

        return redirect()->route('tipoServico')
            ->with('flash_message', 'Tipo de Serviço Editado com Sucesso!');

    }

    public function store(Request $request)
    {
        if($request->has('novo')){
            $data = $this->validate($request, [
                        'descricao'=>'required|unique:tipo_servicos'
                    ]);

            TipoServico::create($data);
            $data = TipoServico::orderBy('descricao')->get();
            return response()->json($data);
        }
    }

    public function destroy($id)
    {
        TipoServico::findOrFail($id)
            ->update(['publicado' => 0]);

        return redirect()->route('tipoServico')
            ->with('flash_message',
            'Tipo de Serviço Desativado com Sucesso!');
    } 

    public function toActivate($id)
    {
        TipoServico::findOrFail($id)
            ->update(['publicado' => 1]);

        return redirect()->route('tipoServicoDisabled')
            ->with('flash_message',
            'Tipo de Serviço Ativado com Sucesso!');
    } 

    public function search(Request $request, TipoServico $tipoServico)
    {
        $dataForm = $request->all();

        $tipoServicos = $tipoServico->search($dataForm)->orderBy('descricao')->paginate(10);

        if ($dataForm['publicado'] == 1) 
        {
            return view('gerenciar.tipoServico.index', compact('tipoServicos'));
        }else
        {   
            return view('gerenciar.tipoServico.disabled', compact('tipoServicos'));
        }
    }
}
