@extends('layouts.master')

@section('conteudo')

    <div class="container">
        <div class="centralizado">
            <h2>
                Detalhes de Acessibilidade<br>
                <small>{{$equipamento->nome}}</small>
            </h2>
            <hr>
        </div>

        <form method="POST" action="{{ route('equipamentos.gravaAcessibilidade', $equipamento->id) }}">
            {{ csrf_field() }}

            <div class="row">
                <div class="form-group col-md-3">
                    <label for="acessibilidadeArquitetonica">Acessibilidade Arquitetonica</label>
                    <select class="form-control" name="acessibilidadeArquitetonica" id="acessibilidadeArquitetonica">
                        <option value="">Selecione...</option>
                        @foreach($arquitetonicas as $arquitetonica)
                            <option value="{{$arquitetonica->id}}">{{$arquitetonica->acessibilidade_arquitetonica}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="banheiros">Possui Banheiros Adaptados?</label>
                    <select class="form-control" name="banheiros" id="banheiros">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="rampas">Possui Rampas de Acesso?</label>
                    <select class="form-control" name="rampas" id="rampas">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="elevador">Possui Elevador?</label>
                    <select class="form-control" name="elevador" id="elevador">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="pisoTatil">Possui Piso Tátil?</label>
                    <select class="form-control" name="pisoTatil" id="pisoTatil">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="estacionamentoAcessivel">Possui Estacionamento Acessivel?</label>
                    <select class="form-control" name="estacionamentoAcessivel" id="estacionamentoAcessivel">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="qtdVagasAcessiveis">Quantidade de vagas?</label>
                    <input type="text" class="form-control" name="qtdVagasAcessiveis" id="qtdVagasAcessiveis">
                </div>
            </div>
            <div class="row">
                <hr>
                <div class="form-group col-md-offset-4 col-md-2">
                    <a href="{{route('equipamentos.show', $equipamento->id)}}" class="form-control btn btn-warning">
                        Retornar à Detalhes
                    </a>
                </div>
                <div class="form-group col-md-2">
                    <input type="submit" class="form-control btn btn-primary" name="enviar" value="Cadastrar">
                </div>
            </div>
        </form>
    </div>

@endsection
@section('scripts_adicionais')

    @include('scripts.radio_habilita_input', ['nomeRadio' => 'multiuso', 'idInput' => 'capacidadeMultiuso', 'mensagem' => ''])

@endsection