<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;
use Simbi\Models\Cargo;

class CargoController extends Controller
{
    public function index()
    {
        $cargos = Cargo::where('publicado', '=', '1')->orderBy('cargo')->paginate(10);

        return view('gerencial.gerenciar.cargos.index', compact('cargos'));
    }

    public function disabled()
    {
        $cargos = Cargo::where('publicado', '=', '0')->orderBy('cargo')->paginate(10);

        return view('gerencial.gerenciar.cargos.disabled', compact('cargos'));
    }


    public function create(Request $request)
    {

        $data = $this->validate($request, [
            'cargo'=>'required|unique:cargos'
        ]);

        Cargo::create($data);

        return redirect()->back()
            ->with('flash_message', 'Cargo inserido com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $Cargo = Cargo::findOrFail($id);

        $this->validate($request, [
            'cargo'=>'required|unique:cargos'
        ]);

        $Cargo->update([
            'cargo' => $request->cargo
        ]);

        return redirect()->route('cargo')
            ->with('flash_message', 'Cargo editado com sucesso!');

    }

    public function destroy($id)
    {
        Cargo::findOrFail($id)
            ->update(['publicado' => 0]);

        return redirect()->route('cargo')
            ->with('flash_message', 'Cargo desativado com sucesso!');
    }

    public function toActivate($id)
    {
        Cargo::findOrFail($id)
            ->update(['publicado' => 1]);

        return redirect()->route('cargoDisabled')
            ->with('flash_message', 'Cargo ativado com sucesso!');
    }

    public function search(Request $request, Cargo $Cargo)
    {
        $dataForm = $request->all();

        $cargos = $Cargo->search($dataForm)->orderBy('cargo')->paginate(10);

        if ($dataForm['publicado'] == 1)
        {
            return view('gerencial.gerenciar.cargos.index', compact('cargos'));
        }else
        {
            return view('gerencial.gerenciar.cargos.disabled', compact('cargos'));
        }
    }

    public function cargosJson(){
        $cargos = Cargo::all();
        return json_decode($cargos);
    }
}
