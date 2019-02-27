@include('layouts.br')
@extends ('layouts.master')

@section('tituloPagina')
    Público Atendido
@endsection

@section('conteudo')

        <div class="col-md-offset-1 col-md-10">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">

                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tbody>
                            @if ($equipamento->frequenciasPortarias->count() != 0)
                                <tr>
                                    <th colspan="4" class="text-center">Portaria</th>
                                </tr>
                                <tr>
                                    @foreach ($equipamento->frequenciasPortarias as $frequencia)
                                        <tr>
                                            <th>Data: {{ date('d/m/Y', strtotime($frequencia->data)) }}</th>
                                            <th>{{ ucwords(strftime('%A', strtotime($frequencia->data))) }}</th>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><strong>Nome: </strong>{{$frequencia->nome}}</td>
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
                <a href="{{route('frequencia.relatorio')}}" class="form-control btn btn-warning">
                    Retornar à Lista de Equipamentos
                </a>
            </div>
        </div>
@endsection