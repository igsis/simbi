@extends('layouts.master')
<?php $path = isset($equipamento->area) ? 'equipamentos.atualizaArea'
                                        : 'equipamentos.gravaArea'; ?>

@section('tituloPagina')
    Área <small>{{$equipamento->nome}}</small>
@endsection


@section('conteudo')

        <form method="POST" action="{{ route($path, $equipamento->id) }}" autocomplete="off">
            {{ csrf_field() }}
            
            <div class="row">
                <div class="form-group col-md-offset-3 col-md-3">
                    <label for="areaInterna">Área Interna (m²)</label>
                    <input type="number" class="form-control" name="areaInterna" id="areaInterna"
                    value="{{ isset($equipamento->area) ? $equipamento->area->interna
                                                        : old('areaInterna') }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="areaTotalConstruida">Área Total Construída (m²)</label>
                    <input type="number" class="form-control" name="areaTotalConstruida" id="areaTotalConstruida"
                    value="{{ isset($equipamento->area) ? $equipamento->area->total_construida
                                                        : old('areaTotalConstruida') }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-offset-3 col-md-3">
                    <label for="areaTotalTerreno">Área Total do Terreno (m²)</label>
                    <input type="number" class="form-control" name="areaTotalTerreno" id="areaTotalTerreno"
                    value="{{ isset($equipamento->area) ? $equipamento->area->total_terreno
                                                        : old('areaTotalTerreno') }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="areaAuditorio">Área do Auditório (m²)</label>
                    <input type="number" class="form-control" name="areaAuditorio" id="areaAuditorio"
                    value="{{ isset($equipamento->area) ? $equipamento->area->auditorio
                                                        : old('areaAuditorio') }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-offset-3 col-md-3">
                    <label for="areaTeatro">Área do Teatro (m²)</label>
                    <input type="number" class="form-control" name="areaTeatro" id="areaTeatro"
                    value="{{ isset($equipamento->area) ? $equipamento->area->teatro
                                                        : old('areaTeatro') }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-offset-4 col-md-2">
                    <a href="{{route('equipamentos.show', $equipamento->id)}}" class="form-control btn btn-default">
                        Retornar à Detalhes
                    </a>
                </div>
                <div class="form-group col-md-2">
                    <input type="submit" class="form-control btn btn-primary" name="enviar" value="Salvar">
                </div>
            </div>
        </form>

@endsection
