@extends('layouts.master')

@section('conteudo')

    <h1>
        <i class="glyphicon glyphicon-home"></i>
        Frequência nos Equipamentos
    </h1>
    <div class="panel-heading">Pagina {{$equipamentos->currentPage()}} de {{$equipamentos->lastPage()}}</div>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="50%">Nome do Equipamento</th>
                <th>Operações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($equipamentos as $equipamento)
                <tr>
                    <td>{{$equipamento->nome}}</td>
                    <td>
                        @if($type == 1)
                            <a href="{{ route('frequencia.cadastro', $equipamento->id) }}" class="btn btn-success" style="margin-right: 3px"><i class="glyphicon glyphicon-plus-sign"></i> Evento Interno</a>
                            <a href="#" class="btn btn-success" style="margin-right: 3px"><i class="glyphicon glyphicon-plus-sign"></i> Evento Externo</a>
                            <a href="{{ route('frequencia.portaria.cadastro', $equipamento->id) }}" class="btn btn-success" style="margin-right: 3px"><i class="glyphicon glyphicon-plus-sign"></i> Portaria</a>
                        @else
                            <a href="{{ route('frequencia.listar', $equipamento->id) }}" class="btn btn-warning" style="margin-right: 3px"><i class="glyphicon glyphicon-stats"></i> Frequência Evento Interno</a>
                            <a href="#" class="btn btn-warning" style="margin-right: 3px"><i class="glyphicon glyphicon-stats"></i> Frequência Evento Externo</a>
                            <a href="{{ route('frequencia.portaria.listar', $equipamento->id) }}" class="btn btn-warning" style="margin-right: 3px"><i class="glyphicon glyphicon-stats"></i> Frequência Portaria</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
