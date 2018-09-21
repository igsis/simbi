@extends('layouts.master')

@section('conteudo')

    <div class="col-lg-8 col-lg-offset-2">
        <h1><i class="glyphicon glyphicon-user"></i> Vincular Equipamento: {{$user->name}}</h1>
        <hr>

        <form method="POST" action="{{ route('usuarios.vincular', $user->id) }}" accept-charset="UTF-8">
            {{ csrf_field() }}

            <div class="row">
                <label>Equipamentos vinculados:</label>
                <div class="well">
                    @foreach($equipamentos as $equipamento)
                        <div class="checkbox-inline">
                            <label><input type="checkbox" name="equipamento[]" value="{{$equipamento->id}}" {{ in_array($equipamento->id, $user->equipamentos()->pluck('equipamento_id')->toArray()) ? "checked" : "" }}>{{$equipamento->nome}}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-offset-3 col-md-3">
                    <label for="dataInicio">Data de Inicio:</label>
                    <input type="date" class="form-control" name="dataInicio" id="dataInicio">
                </div>
                <div class="form-group col-md-3">
                    <label for="dataFim">Data de Término:</label>
                    <input type="date" class="form-control" name="dataFim" id="dataFim" value="">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-offset-4 col-md-4">
                    <label for="responsabilidadeTipo">Cargo:</label>
                    <select class="form-control" name="responsabilidadeTipo" id="cargo">
                        <option value="">Selecione...</option>
                        @foreach($cargos as $cargo)

                            <option value="{{$cargo->id}}">{{$cargo->responsabilidade_tipo}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <hr>
                <div class="form-group col-md-offset-4 col-md-2">
                    <a href="{{route('usuarios.index', ['type' => 1])}}" class="form-control btn btn-warning">
                        Voltar
                    </a>
                </div>
                <div class="form-group col-md-2">
                    <input type="submit" class="form-control btn btn-primary" name="enviar" value="Vincular">
                </div>
            </div>
        </form>
    </div>
@endsection