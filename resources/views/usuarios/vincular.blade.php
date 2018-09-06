@extends('layouts.master')

@section('conteudo')

    <div class="col-lg-8 col-lg-offset-2">
        <h1><i class="glyphicon glyphicon-user"></i> Vincular Equipamento: {{$user->name}}</h1>
        <hr>

        <form method="POST" action="{{ route('usuarios.vincular', $user->id) }}" accept-charset="UTF-8">
            {{ csrf_field() }}

            <div class="row">
                <label>Bibliotecas cadastradas:</label>
                <div class="well">
                    @foreach($equipamentos as $equipamento)
                        <div class="checkbox-inline">
                            <label><input type="checkbox" name="equipamento[]" value="{{$equipamento->id}}">{{$equipamento->nome}}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="dataInicio">Data de Inicio:</label>
                    <input type="date" class="form-control" name="dataInicio" id="dataInicio">
                </div>
                <div class="form-group col-md-6">
                    <label for="dataFim">Data de Término:</label>
                    <input type="date" class="form-control" name="dataFim" id="dataFim">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-offset-4 col-md-4">
                    <label for="dataInicio">Cargo:</label>
                    <input type="date" class="form-control" name="dataInicio" id="dataInicio">
                </div>
            </div>
        </form>
    </div>
@endsection