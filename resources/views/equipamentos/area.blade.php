@extends('layouts.master')
<?php $path = isset($equipamento->area) ? 'equipamentos.atualizaArea'
                                        : 'equipamentos.gravaArea'; ?>

@section('tituloPagina','Áreas<br><small>{{$equipamento->nome}}</small>')

@section('conteudo')

        <form method="POST" action="{{ route($path, $equipamento->id) }}">
            {{ csrf_field() }}
            
            <div class="row">
                <div class="form-group col-md-offset-3 col-md-2">
                    <label for="areaInterna">Área Interna</label>
                    <input type="text" class="form-control" name="areaInterna" id="areaInterna"
                    value="{{ isset($equipamento->area) ? $equipamento->area->interna
                                                        : old('areaInterna') }}">
                </div>
                <div class="form-group col-md-2">
                    <label for="areaTotalConstruida">Área Total Construída</label>
                    <input type="text" class="form-control" name="areaTotalConstruida" id="areaTotalConstruida"
                    value="{{ isset($equipamento->area) ? $equipamento->area->total_construida
                                                        : old('areaTotalConstruida') }}">
                </div>
                <div class="form-group col-md-2">
                    <label for="areaTotalTerreno">Área Total do Terreno</label>
                    <input type="text" class="form-control" name="areaTotalTerreno" id="areaTotalTerreno"
                    value="{{ isset($equipamento->area) ? $equipamento->area->total_terreno
                                                        : old('areaTotalTerreno') }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-offset-4 col-md-2">
                    <label for="areaAuditorio">Área do Auditório</label>
                    <input type="text" class="form-control" name="areaAuditorio" id="areaAuditorio"
                    value="{{ isset($equipamento->area) ? $equipamento->area->auditorio
                                                        : old('areaAuditorio') }}">
                </div>
                <div class="form-group col-md-2">
                    <label for="areaTeatro">Área do Teatro</label>
                    <input type="text" class="form-control" name="areaTeatro" id="areaTeatro"
                    value="{{ isset($equipamento->area) ? $equipamento->area->teatro
                                                        : old('areaTeatro') }}">
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
                    <input type="submit" class="form-control btn btn-primary" name="enviar" value="Salvar">
                </div>
            </div>
        </form>

@endsection
