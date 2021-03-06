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

Route::get('/{id}/relatorioCompleto/{idPeriodo}', 
  function($id, $periodo){
    $frequencias = DB::select("
      SELECT * FROM (
        select sum(secoes.quantidade) quantidade, 
               month(secoes.data) mes, 
               year(secoes.data) ano 
        FROM (
          select quantidade, data, equipamento_id, periodo 
          from frequencias_portarias  UNION ALL
        
          select quantidade, data, equipamento_id, periodo 
          from secao_brailes UNION ALL

          select quantidade, data, equipamento_id, periodo 
          from telecentros UNION ALL 

          SELECT quantidade, data, equipamento_id, periodo 
          from tematicas UNION ALL

          SELECT quantidade, data, equipamento_id, periodo 
          from oculos ) AS secoes
        
        where secoes.equipamento_id = ? 
        and secoes.periodo = ? 
        group by ano, mes) fp RIGHT JOIN (
          
          select sum(total) total, 
                 month(o.data) mesf, 
                 year(o.data) anof 
          from frequencias fr inner join 
          evento_ocorrencias o 
          on o.id = fr.evento_ocorrencia_id 
          
          where publicado = 2 
          and equipamento_id = ? 
          and periodo = ? 
          group by anof, mesf) f on fp.mes = f.mesf 
          and fp.ano = f.anof
        
      UNION 
      
      SELECT * FROM (
        select sum(secoes.quantidade) quantidade, 
               month(secoes.data) mes, 
               year(secoes.data) ano
        FROM (
          select quantidade, data, equipamento_id, periodo 
          from frequencias_portarias  UNION ALL
        
          select quantidade, data, equipamento_id, periodo 
          from secao_brailes UNION ALL

          select quantidade, data, equipamento_id, periodo 
          from telecentros UNION ALL 

          SELECT quantidade, data, equipamento_id, periodo 
          from tematicas UNION ALL

          SELECT quantidade, data, equipamento_id, periodo 
          from oculos ) AS secoes 

          where secoes.equipamento_id = ? 
          and secoes.periodo = ? 
          group by ano, mes) fp LEFT JOIN (
            
            select sum(total) total, 
                   month(o.data) mesf, 
                   year(o.data) anof 
            
            from frequencias fr inner join 
                 evento_ocorrencias o 
            on o.id = fr.evento_ocorrencia_id 
            where publicado = 2 
            and equipamento_id = ? 
            and periodo = ? 
            
            group by anof, mesf) f 
            on fp.mes = f.mesf and fp.ano = f.anof
            order by ano, mes, anof desc",
            [$id, $periodo, 
             $id, $periodo, 
             $id, $periodo, 
             $id, $periodo]);

    return Response::json($frequencias);
})->name('api.relatorioCompleto');

Route::get('/{id}/relatorioConsulta/{idPeriodo}', function($id, $periodo){

    $consultas = DB::select('select sum(audio_visual) audio_visual, sum(jornal) jornal, sum(livro) livro, 
                            sum(manga) manga, sum(revista) revista, sum(suportes) suportes , sum(total) total,
                            month(data) mes, year(data) ano from consultas 
                                where periodo = ? and publicado = 1 and equipamento_id = ?
                                group by ano, mes
                                order by data desc;', [$periodo, $id]);
    return Response::json($consultas);
})->name('api.relatorioConsulta');


Route::get('/{id}/relatorioEmprestimo/{idPeriodo}', function($id, $periodo){

    $emprestimos = DB::select('select sum(audio_visual) audio_visual, sum(livro) livro, 
                            sum(manga) manga, sum(revista) revista, sum(suportes) suportes , sum(total) total,
                            month(data) mes, year(data) ano from emprestimos 
                                where periodo = ? and publicado = 1 and equipamento_id = ?
                                group by ano, mes
                                order by data desc;', [$periodo, $id]);
    return Response::json($emprestimos);
})->name('api.relatorioEmprestimo');

Route::get('/{id}/relatorioBibliotecas/{idPeriodo}', function($id, $periodo){

    $bibliotecas = DB::select('select sum(acervo) acervo, sum(frequencia_secao) frequencia_secao, 
                            sum(consulta) consulta, sum(emprestimo) emprestimo, sum(total) total,
                            month(data) mes, year(data) ano from bibliotecas_tematicas 
                                where periodo = ? and publicado = 1 and equipamento_id = ?
                                group by ano, mes
                                order by data desc;', [$periodo, $id]);
    return Response::json($bibliotecas);
})->name('api.relatorioBibliotecas');

Route::get('/{id}/relatorioMatriculas/{idPeriodo}', function($id, $periodo){

    $matricula = DB::select('select sum(nova) nova, sum(renovacao) renovacao, 
                            sum(total) total, month(data) mes, year(data) ano from matriculas 
                                where periodo = ? and publicado = 1 and equipamento_id = ?
                                group by ano, mes
                                order by data desc;', [$periodo, $id]);
    return Response::json($matricula);
})->name('api.relatorioMatriculas');