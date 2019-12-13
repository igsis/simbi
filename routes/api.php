<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Simbi\Models\Equipamento;
use Simbi\Models\Evento;
use Simbi\Models\EventoOcorrencia;
use Simbi\Models\Frequencia;
use Simbi\Models\FrequenciasPortaria;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/classificacao', function () {
    $class = \Simbi\Models\Classificacao::all();
    return json_encode($class);
});

Route::get('/cargos', 'CargoController@cargosJson');

Route::get('/funcionamentos', function () {
    $funcionamento = \Simbi\Models\Funcionamento::all();

    return json_decode($funcionamento);
})->name('api.funcionamentos');

Route::get('/editarFrequencia/{id}', function ($id) {
    $frequencia = Frequencia::where('evento_ocorrencia_id', $id)->first();
    $eventoOcorrencia = EventoOcorrencia::find($frequencia->evento_ocorrencia_id);
    $evento = Evento::find($eventoOcorrencia->igsis_id);

    return json_encode(array($frequencia, $eventoOcorrencia, $evento));
});

Route::post('/salvarFrequencia/{id}', function (Request $request, $id) {
    $frequencia = Frequencia::find($id);
    if (isset($frequencia)) {
        $frequencia->crianca = $request->input('crianca');
        $frequencia->jovem = $request->input('jovem');
        $frequencia->adulto = $request->input('adulto');
        $frequencia->idoso = $request->input('idoso');
        $frequencia->total = $request->input('total');
        $frequencia->observacao = $request->input('observacao');

        $frequencia->save();

        return json_encode($frequencia);
    }

    return response('Frequencia não encontrada', 404);
});

Route::get('/{id}/relatorioCompleto/{idPeriodo}', function($id, $periodo){
    $frequencias = Frequencia::join('evento_ocorrencias as o', 'o.id', 'frequencias.evento_ocorrencia_id', '')
        ->join('frequencias_portarias as fp', 'fp.equipamento_id', 'frequencias.equipamento_id')
        ->selectRaw('sum(fp.quantidade) quantidade, sum(frequencias.total) total, year(o.data) ano, monthname(o.data) mes')
        ->where([
            ['o.publicado', 2],
            ['fp.equipamento_id', $id],
            ['o.periodo', $periodo],
            ['fp.periodo', $periodo]
        ])
        ->groupby('ano','mes')->orderBy('o.data', 'desc')
        ->get();

    return Response::json($frequencias);
})->name('api.relatorioCompleto');

