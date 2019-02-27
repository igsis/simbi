@extends('layouts.master')

@section('tituloPagina')
    Inserir Período de Reforma <small>{{$equipamento->nome}}</small>
@endsection
@section('conteudo')

        <form method="POST" action="{{ route('equipamentos.gravaReforma', $equipamento->id) }}">
            {{ csrf_field() }}

            <div class="row form-group">
                <div class="col-md-offset-3 col-md-3">
                    <label for="inicioReforma">Início da Reforma</label>
                    <input class="form-control" type="date" name="inicioReforma" id="inicioReforma">
                </div>
                <div class="col-md-3">
                    <label for="terminoReforma">Término da Reforma</label>
                    <input class="form-control" type="date" name="terminoReforma" id="terminoReforma">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-md-offset-3 col-md-6">
                    <label for="descricaoReforma">Descrição da Reforma</label>
                    <textarea class="form-control" name="descricaoReforma" id="descricaoReforma" rows="5"></textarea>
                </div>
            </div>

            <div class="form-group col-md-offset-4 col-md-2">
                <a href="{{route('equipamentos.show', $equipamento->id)}}" class="form-control btn btn-warning">
                    Retornar à Detalhes
                </a>
            </div>
            <div class="form-group col-md-2">
                <input class="btn btn-success" type="submit" value="Inserir Reforma">
            </div>

        </form>

@endsection