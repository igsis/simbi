@extends ('layouts.master')

@section('conteudo')

    <div class="container">
        <div style="text-align: center;">
            <h2>
                Detalhes do Equipamento<br>
                <small>{{$equipamento->nome}}</small>
            </h2>
        </div>
        <hr>

        <div class="col-md-offset-2 col-md-8"></div>
            <div class="well">
                    <strong>Nome: </strong>{{$equipamento->nome}}
            </div>
            <a href="{{ route('equipamentos.editar', $equipamento->id) }}" class="btn btn-success">Editar Equipamento</a>
        </div>
    </div>

@endsection