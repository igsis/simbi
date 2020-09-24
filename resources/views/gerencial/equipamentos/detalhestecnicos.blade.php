<?php
$path = isset($equipamento->detalhe) ? 'equipamentos.atualizaDetalhes' : 'equipamentos.gravaDetalhes';
$pathAtualiza = false;
if($path == 'equipamentos.atualizaDetalhes')
{
    $pathAtualiza = true;
}
?>

@section('titulo','Cadastro de Detalhes Técnicos')

@extends('layouts.master2')

@section('tituloPagina')
    Detalhes Técnicos <small>{{$equipamento->nome}}</small>
@endsection

@section('conteudo')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="page-header">@yield('tituloPagina')</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{$equipamento->nome}}</h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @includeIf('layouts.erros')
                </div>
            </div>

            <form method="POST" action="{{ route($path, $equipamento->id) }}" autocomplete="off">
                {{ csrf_field() }}
                @if($pathAtualiza)
                    <input type="hidden" name="_method" value="PUT">
                @endif
                <div class="box-body">

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="contratoUso">Contrato de Uso</label>
                            <select class="form-control" name="contratoUso" id="contratoUso">
                                <option value="">Selecione...</option>
                                @foreach($contratos as $contrato)
                                    @if ($contrato->id == old('contratoUso'))
                                        <option value="{{$contrato->id}}" selected>{{$contrato->contrato_uso}}</option>
                                     @else
                                        <option value="{{$contrato->id}}">{{$contrato->contrato_uso}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="utilizacao">Utilização</label>
                            <select class="form-control" name="utilizacao" id="utilizacao">
                                <option value="">Selecione...</option>
                                @foreach($utilizacoes as $utilizacao)
                                    @if ($utilizacao->id == old('utilizacao'))
                                        <option value="{{$utilizacao->id}}" selected>{{$utilizacao->utilizacao}}</option>
                                    @else
                                        <option value="{{$utilizacao->id}}">{{$utilizacao->utilizacao}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="porte">Porte</label>
                            <select class="form-control" name="porte" id="porte">
                                <option value="">Selecione...</option>
                                @foreach($portes as $porte)
                                    @if ($porte->id == old('porte'))
                                        <option value="{{$porte->id}}" selected>{{$porte->porte}}</option>
                                    @else
                                        <option value="{{$porte->id}}">{{$porte->porte}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="padrao">Padrão</label>
                            <select class="form-control" name="padrao" id="padrao">
                                <option value="">Selecione...</option>
                                @foreach($padroes as $padrao)
                                    @if ($padrao->id == old('padrao'))
                                        <option value="{{$padrao->id}}" selected>{{$padrao->padrao}}</option>
                                    @else
                                        <option value="{{$padrao->id}}">{{$padrao->padrao}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="pavimento">Pavimentos</label>
                            <input type="number" class="form-control" name="pavimento" id="pavimento" value="{{isset($equipamento->detalhe->pavimento) ? $equipamento->detalhe->pavimento
                                                                                                                                             : old('pavimento') }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="validade">Validade AVBC <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" title="Laudo de Vistoria do Corpo de Bombeiro"></span></label>
                            <input type="text" class="form-control calendario" name="validade" id="validade" value="{{isset($equipamento->detalhe->validade_avcb) ? date('m/d/Y', strtotime($equipamento->detalhe->validade_avcb))
                                                                                                              : "old('validate')"}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="predioTombado">Prédio Tombado</label>
                            <select class="form-control" name="predioTombado" id="predioTombado" onchange="desabilitar()">
                                <option value="0">Não</option>
                                <option value="1" {{isset($equipamento->detalhe->predio_tombado)
                                                    &&  $equipamento->detalhe->predio_tombado == 1 ? 'selected' : ''}}>Sim</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="lei">Lei de tombamento</label>
                            <input type="text" class="form-control" name="lei" id="lei"
                                   value="{{isset($equipamento->detalhe->lei) ? $equipamento->detalhe->lei : "" }}"
                                    {{isset($equipamento->detalhe->lei) ? "" : "readonly" }}>
                        </div>
                    </div>

                    <div class="centralizado">
                        <h2>
                            Detalhes de Acessibilidade
                        </h2>
                        <hr>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="acessibilidadeArquitetonica">Acessibilidade Arquitetonica</label>
                            <select class="form-control" name="acessibilidadeArquitetonica" id="acessibilidadeArquitetonica">
                                <option value="">Selecione...</option>
                                @foreach($arquitetonicas as $arquitetonica)
                                    @if ($arquitetonica->id == old('acessibilidadeArquitetonica'))
                                        <option value="{{$arquitetonica->id}}" selected>{{$arquitetonica->acessibilidade_arquitetonica}}</option>
                                    @else
                                        <option value="{{$arquitetonica->id}}">{{$arquitetonica->acessibilidade_arquitetonica}}</option>
                                    @endif
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
                                <option selected value="">Selecione...</option>
                                @foreach ($elevadores as $elevador)
                                    @if ($elevador->id == old('elevador'))
                                        <option value="{{ $elevador->id }}" selected>{{ $elevador->elevador }}</option>
                                    @else
                                        <option value="{{ $elevador->id }}">{{ $elevador->elevador }}</option>
                                    @endif
                                @endforeach
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
                            <input type="number" class="form-control" name="qtdVagasAcessiveis" id="qtdVagasAcessiveis" value="{{isset($equipamento->detalhe->acessibilidade->quantidade_vagas) ? $equipamento->detalhe->acessibilidade->quantidade_vagas
                                                                                                                                                                                       : old('qtdVagasAcessiveis')}}">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{route('equipamentos.show', $equipamento->id)}}" class="btn btn-default">
                        Retornar à Detalhes
                    </a>
                    <input type="submit" class="btn btn-primary pull-right" name="enviar" value="Salvar">
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
@section('scripts_adicionais')
    @include('scripts.radio_habilita_input', ['nomeRadio' => 'multiuso', 'idInput' => 'capacidadeMultiuso', 'mensagem' => ''])
    @include('scripts.radio_habilita_input', ['nomeRadio' => 'estudoGrupo', 'idInput' => 'capacidadeEstudoGrupo', 'mensagem' => ''])
    @include('scripts.radio_habilita_input', ['nomeRadio' => 'estudoIndividual', 'idInput' => 'capacidadeEstudoIndividual', 'mensagem' => ''])
    @include('scripts.radio_habilita_input', ['nomeRadio' => 'infantil', 'idInput' => 'capacidadeInfantil', 'mensagem' => ''])
    @include('scripts.radio_habilita_input', ['nomeRadio' => 'estacionamentoPublico', 'idInput' => 'qtdVagasPublico', 'mensagem' => ''])
    <script type="text/javascript">
        $(document).ready(function()
        {
            $('input:radio[name="auditorio"]').change(function(e)
            {
                if ($(this).val() == 0)
                {
                    $("#nomeAuditorio").attr('disabled', true).attr('placeholder', '').attr('value', '').val('');
                    $("#capacidadeAuditorio").attr('disabled', true).attr('placeholder', '').attr('value', '').val('');
                } else
                {
                    $("#nomeAuditorio").attr('disabled', false).attr('placeholder', 'Insira o nome do Auditório').attr('required', true);
                    $("#capacidadeAuditorio").attr('disabled', false).attr('placeholder', '').attr('required', true);
                }
            });
        });

        $(document).ready(function()
        {
            $('input:radio[name="teatro"]').change(function(e)
            {
                if ($(this).val() == 0)
                {
                    $("#nomeTeatro").attr('disabled', true).attr('placeholder', '').attr('value', '').val('');
                    $("#capacidadeTeatro").attr('disabled', true).attr('placeholder', '').attr('value', '').val('');
                } else
                {
                    $("#nomeTeatro").attr('disabled', false).attr('placeholder', 'Insira o nome do Teatro').attr('required', true);
                    $("#capacidadeTeatro").attr('disabled', false).attr('placeholder', '').attr('required', true);
                }
            });
        });

        $(document).ready(function()
        {
            $('input:radio[name="praca"]').change(function(e)
            {
                if ($(this).val() == 0)
                {
                    $("#classificacao").attr('disabled', true).val('');
                } else
                {
                    $("#classificacao").attr('disabled', false).attr('required', true);
                }
            });
        });

        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    @includeWhen($pathAtualiza, 'scripts.preenche_detalhe')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $( ".calendario" ).datepicker({
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
            });
            $('.calendario').datepicker("option","showAnim","blind");
            $('.calendario').datepicker( "option", "dateFormat", "dd/mm/yy");
        });
    </script>

    <script>
        function desabilitar() {
            let predioTombado = document.getElementById('predioTombado');
            let lei = document.getElementById('lei');
            if (predioTombado.value == 1){
                lei.readOnly = false;
                lei.required = true;
            } else {
                lei.readOnly = true;
                lei.value = "";
            }

        }
    </script>
@endsection
@section('linksAdicionais')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
