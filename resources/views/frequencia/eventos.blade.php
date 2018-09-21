@extends('layouts.master')

@section('conteudo')

    <h1>
        <i class="glyphicon glyphicon-home"></i>
        Eventos do equipamento
    </h1>
    <div class="panel-heading">Pagina {{$eventos->currentPage()}} de {{$eventos->lastPage()}}</div>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="50%">Eventos</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Operações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($eventos as $evento)
                <tr>
                    <td>{{ $evento->nome_evento }}</td>
                    <td>{{ date('d/m/Y', strtotime($evento->data)) }}</td>
                    <td>{{ date('H:i', strtotime($evento->horario)) }}</td>
                    <td>
                        <a href="{{ route('frequencia.editaEvento', $evento->id) }}" class="btn btn-success" style="margin-right: 3px"><i class="glyphicon glyphicon-edit"></i> Eventos</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-center">
        @if(isset($dataForm))
            {!! $eventos->appends($dataForm)->links() !!}
        @else
            {!! $eventos->links() !!}
        @endif
    </div>
@endsection
