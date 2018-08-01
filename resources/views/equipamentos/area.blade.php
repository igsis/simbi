@extends('layouts.master')

@section('conteudo')

    <div class="container">
        <div class="centralizado">
            <h2>
                Áreas<br>
                <small>{{$equipamento->nome}}</small>
            </h2>
            <hr>
        </div>

        <hr>

        <form method="POST" action="{{ route('equipamentos.gravaDetalhes', $equipamento->id) }}">
            {{ csrf_field() }}

            <div class="row">
                <div class="form-group col-md-2">
                    <label for="areaInterna">Área Interna</label>
                    <input type="text" class="form-control" name="areaInterna" id="areaInterna"  value="{{old('areaInterna')}}">
                </div>
                <div class="form-group col-md-2">
                    <label for="areaAuditorio">Área do Auditório</label>
                    <input type="text" class="form-control" name="areaAuditorio" id="areaAuditorio"  value="{{old('areaAuditorio')}}">
                </div>
                <div class="form-group col-md-2">
                    <label for="areaTeatro">Área do Teatro</label>
                    <input type="text" class="form-control" name="areaTeatro" id="areaTeatro"  value="{{old('areaTeatro')}}">
                </div>
                <div class="form-group col-md-2">
                    <label for="areaTotalConstruida">Área Total Construída</label>
                    <input type="text" class="form-control" name="areaTotalConstruida" id="areaTotalConstruida"  value="{{old('areaTotalConstruida')}}">
                </div>
                <div class="form-group col-md-2">
                    <label for="areaTotalConstruida">Área Total Construída</label>
                    <input type="text" class="form-control" name="areaTotalConstruida" id="areaTotalConstruida"  value="{{old('areaTotalConstruida')}}">
                </div>
                <div class="form-group col-md-2">
                    <label for="areaTotalTerreno">Área Total do Terreno</label>
                    <input type="text" class="form-control" name="areaTotalTerreno" id="areaTotalTerreno"  value="{{old('areaTotalTerreno')}}">
                </div>
            </div>
            <div class="row">
                <hr>
                <div class="form-group col-md-offset-5 col-md-2">
                    <input type="submit" class="form-control btn btn-primary" name="enviar" value="Cadastrar">
                </div>
            </div>
        </form>
    </div>

@endsection