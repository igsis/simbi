@extends('layouts.master')

@section('conteudo')

    <div class="col-lg-6 col-lg-offset-3">
        <h1>
            <i class="glyphicon glyphicon-user"></i> Público Atendido <br>
            <small>{{$equipamento->nome}}</small>
        </h1>
        <hr>

        <form method="POST" action="{{route('frequencia.portaria.gravar', $equipamento->id)}}">
            {{ csrf_field() }}

            <div class="row">
              <div class="form-group">
                <label for="nome">Nome/Nome Social</label>
                <input type="text" class="form-control" class="form-control" id="nome" name="nome" value="{{ old('nome') }}">
              </div>
            </div>

            <div class="row">
              <div class="form-group">
                <label for="data">Data</label>
                <input class="form-control" type="date" name="data">
              </div>
            </div>

            <input class="btn btn-success" type="submit" value="Cadastrar">
        </form>

    </div>

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">

    </script>

@endsection
