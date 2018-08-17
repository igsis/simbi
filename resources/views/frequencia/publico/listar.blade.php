@extends ('layouts.master')

@section('conteudo')

    <div class="container">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    Frequência
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tbody>
                            @if ($equipamento->frequenciasPublicos->count() != 0)
                                <tr>
                                    <th colspan="4" class="text-center">Frequências Cadastradas</th>
                                </tr>
                                <tr>
                                    @foreach ($equipamento->frequenciasPublicos as $frequencia)
                                        <tr>
                                            <th colspan="2">Dia da Semana: {{ $frequencia->diaSemana->dia }}</th>
                                            <th colspan="2">Usuario: {{$frequencia->user->name}}</th>
                                        </tr>
                                        <tr>
                                            <td>Crianças: {{$frequencia->crianca}}</td>
                                            <td>Jovens: {{$frequencia->jovem}}</td>
                                            <td>Adultos: {{$frequencia->adulto}}</td>
                                            <td>Idosos: {{$frequencia->idoso}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                Total: {{$frequencia->total}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tr>
                            @else
                                <tr>
                                    <th colspan="2" class="text-center">Não há frequência cadastradas</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group col-md-offset-4 col-md-4">
                <a href="{{route('frequencia.publico.relatorio')}}" class="form-control btn btn-warning">
                    Retornar à Lista de Equipamentos
                </a>
            </div>
        </div>
    </div>
@endsection