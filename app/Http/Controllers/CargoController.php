<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;
use Simbi\Models\Cargo;

class CargoController extends Controller
{
    public function index()
    {
        $cargos = Cargo::where('publicado', '=', '1')->orderBy('descricao')->paginate(10);

        return view('gerenciar.cargos.index', compact('cargos'));
    }

    public function disabled()
    {
        $cargos = Cargo::where('publicado', '=', '0')->orderBy('descricao')->paginate(10);

        return view('gerenciar.cargos.disabled', compact('cargos'));
    }


    public function create(Request $request)
    {

        $data = $this->validate($request, [
            'descricao'=>'required|unique:cargos'
        ]);

        Cargo::create($data);

        return redirect()->route('Cargo')
            ->with('flash_message', 'Cargo Inserido com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $Cargo = Cargo::findOrFail($id);

        $this->validate($request, [
            'descricao'=>'required|unique:cargos'
        ]);

        $Cargo->update([
            'descricao' => $request->descricao
        ]);

        return redirect()->route('Cargo')
            ->with('flash_message', 'Cargo Editado com Sucesso!');

    }

    public function destroy($id)
    {
        Cargo::findOrFail($id)
            ->update(['publicado' => 0]);

        return redirect()->route('Cargo')
            ->with('flash_message', 'Cargo Desativado com Sucesso!');
    }

    public function toActivate($id)
    {
        Cargo::findOrFail($id)
            ->update(['publicado' => 1]);

        return redirect()->route('CargoDisabled')
            ->with('flash_message', 'Cargo Ativado com Sucesso!');
    }

    public function search(Request $request, Cargo $Cargo)
    {
        $dataForm = $request->all();

        $cargos = $Cargo->search($dataForm)->orderBy('descricao')->paginate(10);

        if ($dataForm['publicado'] == 1)
        {
            return view('gerenciar.cargos.index', compact('cargos'));
        }else
        {
            return view('gerenciar.cargos.disabled', compact('cargos'));
        }
    }
}
