@extends('layouts.master')

@section('conteudo')

    <div class="col-lg-6 col-lg-offset-3">
        <h1>
            <i class="glyphicon glyphicon-flag"></i> Cadastrar Ocorrência<br>
            <small>{{ $equipamento->nome }}</small>
        </h1>
        <hr>

        <form method="POST" action="{{route('eventos.grava.ocorrencia', [$equipamento->igsis_id, $evento->igsis_evento_id])}}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="form-group">
                    <label for="evento_ocorrencia_id">Nome do Evento</label>
                    <input class="form-control" type="text" id="nome" name="nome" readonly value="{{ $evento->nome_evento }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <div class="form-group ">
                        <label for="email">Data</label>
                        <input class="form-control" type="date" name="data" value="{{ old('data') }}" onblur="arrumaData()">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group ">
                        <label for="login">Hora</label>
                        <input class="form-control" type="text" data-mask="00:00" name="hora" id="hora" placeholder="Digite a hora" value="{{ old('hora') }}">
                    </div>
                </div>
            </div>

            <button class="btn btn-success"> Cadastrar</button>
        </form>
    </div>
@endsection

@section('scripts_adicionais')
    <script type="text/javascript">

    </script>

    <script type="text/javascript">

    </script>

@endsection
