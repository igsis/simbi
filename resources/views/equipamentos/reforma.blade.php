@extends('layouts.master')

@section('conteudo')

    <div class="container">
        <div class="centralizado">
            <h2>
                Inserir Período de Reforma<br>
                <small>{{$equipamento->nome}}</small>
            </h2>
        </div>

        <hr>

        <form method="POST" action="{{ route('equipamentos.gravaReforma', $equipamento->id) }}">
            {{ csrf_field() }}

            <div class="row form-group">
                <div class="col-md-offset-3 col-md-3">
                    <label for="inicioReforma">Inicio da Reforma</label>
                    <input class="form-control" type="date" name="inicioReforma" id="inicioReforma">
                </div>
                <div class="col-md-3">
                    <label for="terminoReforma">Termino da Reforma</label>
                    <input class="form-control" type="date" name="terminoReforma" id="terminoReforma">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-md-offset-3 col-md-6">
                    <label for="descricaoReforma">Descrição da Reforma</label>
                    <textarea class="form-control" name="descricaoReforma" id="descricaoReforma" rows="5"></textarea>
                </div>
            </div>

            <div class="row centralizado">
                <input class="btn btn-success" type="submit" value="Inserir Reforma">
            </div>
        </form>

    </div>

@endsection